# API Specification

---

## Get All Doas

**Method:** `GET`

**URL:** `/api/doas`

**Deskripsi:** Mengambil daftar semua doa yang tersimpan di sistem internal.

**Autentikasi Diperlukan:** Tidak

**Sumber:** Internal System

**Request Headers:**
```
Accept: application/json
```

**Request Body:** `-`

**Response Sukses (`200 OK`):**
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "title": "Doa Sebelum Makan",
      "category": "Adab Makan",
      "image_url": "/assets/images/doa-makan.png"
    }
  ]
}
```

---

## Get Detail Doa

**Method:** `GET`

**URL:** `/api/doas/{id}`

**Deskripsi:** Mengambil detail lengkap satu doa termasuk teks Arab dan audio.

**Autentikasi Diperlukan:** Tidak

**Sumber:** Internal System

**Response Sukses (`200 OK`):**
```json
{
  "status": "success",
  "data": {
    "id": 1,
    "title": "Doa Sebelum Makan",
    "arabic": "اللَّهُمَّ بَارِكْ لَنَا فِيمَا رَزَقْتَنَا وَقِنَا عَذَابَ النَّارِ",
    "latin": "Allohumma baarik lanaa fiimaa rozaqtanaa wa qinaa 'adzaaban naar",
    "translation": "Ya Allah, berkahilah kami atas rezeki yang telah Engkau berikan kepada kami dan jagalah kami dari siksa api neraka.",
    "audio_url": "/assets/audio/doa-makan.mp3"
  }
}
```

---

## Search Doa

**Method:** `GET`

**URL:** `/api/doas/search?q={query}`

**Deskripsi:** Mencari doa berdasarkan kata kunci pada judul.

**Autentikasi Diperlukan:** Tidak

**Sumber:** Internal System

**Response Sukses (`200 OK`):**
```json
{
  "status": "success",
  "data": [...]
}
```

---

## Get Categories

**Method:** `GET`

**URL:** `/api/categories`

**Deskripsi:** Mengambil daftar kategori doa yang tersedia.

**Autentikasi Diperlukan:** Tidak

**Sumber:** Internal System

**Response Sukses (`200 OK`):**
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "name": "Adab Harian"
    }
  ]
}
```

---

## Get Prayer Times (Third-Party)

**Method:** `GET`

**URL:** `/api/prayer-times?city={city}&country={country}`

**Deskripsi:** Mengambil jadwal sholat dari Al-Adhan API melalui backend.

**Autentikasi Diperlukan:** Tidak

**Sumber:** Third-Party API — Al-Adhan

**Response Sukses (`200 OK`):**
```json
{
  "status": "success",
  "data": {
    "Fajr": "05:01",
    "Dhuhr": "12:20",
    "Asr": "15:45",
    "Maghrib": "18:35",
    "Isha": "19:50"
  }
}
```
