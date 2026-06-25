<?php

namespace App\Services;

use App\Contracts\DoaServiceInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DoaService implements DoaServiceInterface
{
    protected string $baseUrl = 'https://doa-doa-api-ahmadramadhan.fly.dev/api';

    /**
     * Mendapatkan semua daftar doa dari public API.
     */
    public function getAllPrayers(): array
    {
        try {
            $response = Http::get($this->baseUrl);
            if ($response->successful()) {
                return $response->json() ?? [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching all prayers: ' . $e->getMessage());
        }
        return [];
    }

    /**
     * Mendapatkan detail doa berdasarkan ID dari public API.
     */
    public function getPrayerById(string $id): ?array
    {
        try {
            $response = Http::get("{$this->baseUrl}/{$id}");
            if ($response->successful()) {
                $data = $response->json();
                // Jika API mengembalikan array yang dibungkus, ambil elemen pertamanya
                if (is_array($data) && isset($data[0])) {
                    return $data[0];
                }
                return $data;
            }
        } catch (\Exception $e) {
            Log::error("Error fetching prayer ID {$id}: " . $e->getMessage());
        }
        return null;
    }

    /**
     * Mencari doa berdasarkan kata kunci nama doa.
     */
    public function searchPrayers(string $doaName): array
    {
        try {
            // Bersihkan pencarian: hilangkan kata "doa" di awal/di mana saja untuk menyesuaikan kebutuhan public API
            $cleanName = str_ireplace('doa', '', $doaName);
            $cleanName = trim($cleanName);

            $response = Http::get("{$this->baseUrl}/doa/{$cleanName}");
            if ($response->successful()) {
                $data = $response->json();
                return is_array($data) ? $data : [];
            }
        } catch (\Exception $e) {
            Log::error("Error searching prayers with query {$doaName}: " . $e->getMessage());
        }
        return [];
    }

    /**
     * Mendapatkan satu doa acak (random).
     */
    public function getRandomPrayer(): ?array
    {
        try {
            $response = Http::get("{$this->baseUrl}/doa/v1/random");
            if ($response->successful()) {
                $data = $response->json();
                if (is_array($data) && isset($data[0])) {
                    return $data[0];
                }
                return $data;
            }
        } catch (\Exception $e) {
            Log::error('Error fetching random prayer: ' . $e->getMessage());
        }
        return null;
    }
}
