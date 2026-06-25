<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface FavoriteServiceInterface
{
    /**
     * Menambahkan doa ke daftar favorit pengguna.
     * 
     * @param int $userId
     * @param string $prayerId
     * @param string $prayerTitle
     * @return bool
     */
    public function addToFavorite(int $userId, string $prayerId, string $prayerTitle): bool;

    /**
     * Menghapus doa dari daftar favorit pengguna.
     * 
     * @param int $userId
     * @param string $prayerId
     * @return bool
     */
    public function removeFromFavorite(int $userId, string $prayerId): bool;

    /**
     * Mengambil daftar doa favorit milik pengguna tertentu.
     * 
     * @param int $userId
     * @return Collection
     */
    public function getFavoritesByUser(int $userId): Collection;

    /**
     * Mengecek apakah doa tertentu sudah difavoritkan oleh pengguna.
     * 
     * @param int $userId
     * @param string $prayerId
     * @return bool
     */
    public function isFavorited(int $userId, string $prayerId): bool;
}
