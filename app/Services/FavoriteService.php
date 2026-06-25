<?php

namespace App\Services;

use App\Contracts\FavoriteServiceInterface;
use App\Models\Favorite;
use Illuminate\Support\Collection;

class FavoriteService implements FavoriteServiceInterface
{
    /**
     * Menambahkan doa ke daftar favorit pengguna.
     */
    public function addToFavorite(int $userId, string $prayerId, string $prayerTitle): bool
    {
        Favorite::updateOrCreate(
            ['user_id' => $userId, 'prayer_id' => $prayerId],
            ['prayer_title' => $prayerTitle]
        );
        return true;
    }

    /**
     * Menghapus doa dari daftar favorit pengguna.
     */
    public function removeFromFavorite(int $userId, string $prayerId): bool
    {
        return Favorite::where('user_id', $userId)
            ->where('prayer_id', $prayerId)
            ->delete() > 0;
    }

    /**
     * Mengambil daftar doa favorit milik pengguna tertentu.
     */
    public function getFavoritesByUser(int $userId): Collection
    {
        return Favorite::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Mengecek apakah doa tertentu sudah difavoritkan oleh pengguna.
     */
    public function isFavorited(int $userId, string $prayerId): bool
    {
        return Favorite::where('user_id', $userId)
            ->where('prayer_id', $prayerId)
            ->exists();
    }
}
