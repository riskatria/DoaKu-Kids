<?php

namespace App\Services;

use App\Contracts\MemorizationServiceInterface;
use App\Models\MemorizationList;
use Illuminate\Support\Collection;

class MemorizationService implements MemorizationServiceInterface
{
    /**
     * Menambahkan doa ke daftar hafalan pengguna.
     */
    public function addToMemorization(int $userId, string $prayerId, string $prayerTitle): bool
    {
        MemorizationList::updateOrCreate(
            ['user_id' => $userId, 'prayer_id' => $prayerId],
            ['prayer_title' => $prayerTitle]
        );
        return true;
    }

    /**
     * Memperbarui status/progres hafalan doa pengguna.
     */
    public function updateMemorizationStatus(int $userId, string $prayerId, string $status): bool
    {
        // Pastikan status yang dikirimkan valid
        if (!in_array($status, ['belum_mulai', 'sedang_dihafal', 'sudah_hafal'])) {
            return false;
        }

        return MemorizationList::where('user_id', $userId)
            ->where('prayer_id', $prayerId)
            ->update(['status' => $status]) > 0;
    }

    /**
     * Menghapus doa dari daftar hafalan pengguna.
     */
    public function removeFromMemorization(int $userId, string $prayerId): bool
    {
        return MemorizationList::where('user_id', $userId)
            ->where('prayer_id', $prayerId)
            ->delete() > 0;
    }

    /**
     * Mengambil daftar progres hafalan milik pengguna tertentu.
     */
    public function getMemorizationsByUser(int $userId): Collection
    {
        return MemorizationList::where('user_id', $userId)
            ->orderBy('updated_at', 'desc')
            ->get();
    }
}
