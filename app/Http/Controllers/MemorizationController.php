<?php

namespace App\Http\Controllers;

use App\Contracts\MemorizationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemorizationController extends Controller
{
    protected MemorizationServiceInterface $memorizationService;

    public function __construct(MemorizationServiceInterface $memorizationService)
    {
        $this->memorizationService = $memorizationService;
    }

    /**
     * Tampilkan halaman progres hafalan doa.
     */
    public function index()
    {
        $memorizations = $this->memorizationService->getMemorizationsByUser(Auth::id());
        
        // Kelompokkan list hafalan berdasarkan status progres
        $grouped = $memorizations->groupBy('status');
        
        $belumMulai = $grouped->get('belum_mulai', collect());
        $sedangDihafal = $grouped->get('sedang_dihafal', collect());
        $sudahHafal = $grouped->get('sudah_hafal', collect());

        return view('memorization', compact('belumMulai', 'sedangDihafal', 'sudahHafal'));
    }

    /**
     * Tambahkan doa baru ke dalam daftar hafalan.
     */
    public function add(Request $request)
    {
        $request->validate([
            'prayer_id' => 'required|string',
            'prayer_title' => 'required|string',
        ]);

        $userId = Auth::id();
        $prayerId = $request->prayer_id;
        $prayerTitle = $request->prayer_title;

        $this->memorizationService->addToMemorization($userId, $prayerId, $prayerTitle);

        return redirect()->route('memorization.index')->with('success', 'Doa berhasil ditambahkan ke daftar hafalan.');
    }

    /**
     * Perbarui status progres hafalan doa harian.
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'prayer_id' => 'required|string',
            'status' => 'required|string|in:belum_mulai,sedang_dihafal,sudah_hafal',
        ]);

        $userId = Auth::id();
        $prayerId = $request->prayer_id;
        $status = $request->status;

        $this->memorizationService->updateMemorizationStatus($userId, $prayerId, $status);

        return back()->with('success', 'Status progres hafalan berhasil diperbarui.');
    }

    /**
     * Hapus doa dari daftar hafalan.
     */
    public function remove(Request $request)
    {
        $request->validate([
            'prayer_id' => 'required|string',
        ]);

        $userId = Auth::id();
        $prayerId = $request->prayer_id;

        $this->memorizationService->removeFromMemorization($userId, $prayerId);

        return back()->with('success', 'Doa berhasil dihapus dari daftar hafalan.');
    }
}
