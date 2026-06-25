<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface MemorizationServiceInterface
{
    /**
     * Menambahkan doa ke daftar hafalan pengguna.
     * 
     * @param int $userId
     * @param string $prayerId
     * @param string $prayerTitle
     * @return bool
     */
    public function addToMemorization(int $userId, string $prayerId, string $prayerTitle): bool;

    /**
     * Memperbarui status/progres hafalan doa pengguna.
     * 
     * @param int $userId
     * @param string $prayerId
     * @param string $status
     * @return bool
     */
    public function updateMemorizationStatus(int $userId, string $prayerId, string $status): bool;

    /**
     * Menghapus doa dari daftar hafalan pengguna.
     * 
     * @param int $userId
     * @param string $prayerId
     * @return bool
     */
    public function removeFromMemorization(int $userId, string $prayerId): bool;

    /**
     * Mengambil daftar progres hafalan milik pengguna tertentu.
     * 
     * @param int $userId
     * @return Collection
     */
    public function getMemorizationsByUser(int $userId): Collection;
}
