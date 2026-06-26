<?php

namespace App\Http\Controllers;

use App\Contracts\DoaServiceInterface;
use App\Contracts\FavoriteServiceInterface;
use App\Contracts\MemorizationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoaController extends Controller
{
    protected DoaServiceInterface $doaService;
    protected FavoriteServiceInterface $favoriteService;
    protected MemorizationServiceInterface $memorizationService;

    public function __construct(
        DoaServiceInterface $doaService, 
        FavoriteServiceInterface $favoriteService,
        MemorizationServiceInterface $memorizationService
    ) {
        $this->doaService = $doaService;
        $this->favoriteService = $favoriteService;
        $this->memorizationService = $memorizationService;
    }

    /**
     * Tampilkan halaman utama dengan semua daftar doa & doa acak harian.
     */
    public function index()
    {
        $prayers = $this->doaService->getAllPrayers();
        $randomPrayer = $this->doaService->getRandomPrayer();

        $favoriteIds = [];
        $memorizationIds = [];
        if (Auth::check()) {
            $favoriteIds = $this->favoriteService
                ->getFavoritesByUser(Auth::id())
                ->pluck('prayer_id')
                ->toArray();
                
            $memorizationIds = $this->memorizationService
                ->getMemorizationsByUser(Auth::id())
                ->pluck('prayer_id')
                ->toArray();
        }

        return view('welcome', compact('prayers', 'randomPrayer', 'favoriteIds', 'memorizationIds'));
    }

    /**
     * Tampilkan detail doa berdasarkan ID.
     */
    public function detail(string $id)
    {
        $prayer = $this->doaService->getPrayerById($id);
        if (!$prayer) {
            abort(404, 'Doa tidak ditemukan');
        }

        $isFavorited = false;
        $isMemorized = false;
        if (Auth::check()) {
            $isFavorited = $this->favoriteService->isFavorited(Auth::id(), $id);
            $isMemorized = $this->memorizationService->getMemorizationsByUser(Auth::id())
                ->where('prayer_id', $id)
                ->isNotEmpty();
        }

        return view('detail', compact('prayer', 'isFavorited', 'isMemorized'));
    }

    /**
     * Cari doa berdasarkan nama/kata kunci.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        if (empty($query)) {
            return redirect('/');
        }

        $prayers = $this->doaService->searchPrayers($query);

        $favoriteIds = [];
        $memorizationIds = [];
        if (Auth::check()) {
            $favoriteIds = $this->favoriteService
                ->getFavoritesByUser(Auth::id())
                ->pluck('prayer_id')
                ->toArray();
                
            $memorizationIds = $this->memorizationService
                ->getMemorizationsByUser(Auth::id())
                ->pluck('prayer_id')
                ->toArray();
        }

        return view('welcome', [
            'prayers'     => $prayers,
            'randomPrayer' => null,
            'searchQuery' => $query,
            'favoriteIds' => $favoriteIds,
            'memorizationIds' => $memorizationIds,
        ]);
    }
}
