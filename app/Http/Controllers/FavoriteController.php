<?php

namespace App\Http\Controllers;

use App\Contracts\FavoriteServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    protected FavoriteServiceInterface $favoriteService;

    public function __construct(FavoriteServiceInterface $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    /**
     * Tampilkan daftar doa favorit milik user yang sedang login.
     */
    public function index()
    {
        $favorites = $this->favoriteService->getFavoritesByUser(Auth::id());
        return view('favorites', compact('favorites'));
    }

    /**
     * Tambah atau hapus doa dari favorit (toggle).
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'prayer_id' => 'required|string',
            'prayer_title' => 'required|string',
        ]);

        $userId = Auth::id();
        $prayerId = $request->prayer_id;
        $prayerTitle = $request->prayer_title;

        if ($this->favoriteService->isFavorited($userId, $prayerId)) {
            $this->favoriteService->removeFromFavorite($userId, $prayerId);
            $message = 'Doa berhasil dihapus dari favorit.';
            $isFavorited = false;
        } else {
            $this->favoriteService->addToFavorite($userId, $prayerId, $prayerTitle);
            $message = 'Doa berhasil ditambahkan ke favorit.';
            $isFavorited = true;
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'is_favorited' => $isFavorited
            ]);
        }

        return back()->with('success', $message);
    }
}
