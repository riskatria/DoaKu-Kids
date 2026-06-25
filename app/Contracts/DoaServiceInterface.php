<?php

namespace App\Contracts;

interface DoaServiceInterface
{
    /**
     * Mendapatkan semua daftar doa dari public API.
     * 
     * @return array
     */
    public function getAllPrayers(): array;

    /**
     * Mendapatkan detail doa berdasarkan ID dari public API.
     * 
     * @param string $id
     * @return array|null
     */
    public function getPrayerById(string $id): ?array;

    /**
     * Mencari doa berdasarkan kata kunci nama doa.
     * 
     * @param string $doaName
     * @return array
     */
    public function searchPrayers(string $doaName): array;

    /**
     * Mendapatkan satu doa acak (random).
     * 
     * @return array|null
     */
    public function getRandomPrayer(): ?array;
}
