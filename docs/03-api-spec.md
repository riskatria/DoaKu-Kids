# API Specification

---

## Login Pengguna

**Method:** `POST`

**URL:** `/api/v1/login`

**Deskripsi:** Melakukan autentikasi pengguna dan mengembalikan token akses.

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Internal System`

**Request Headers:**

```http
Content-Type: application/json
```

**Request Body:**

```json
{
    "email": "string",
    "password": "string"
}
```

**Response Sukses (`200 OK`):**

```json
{
    "status": "success",
    "token": "jwt_token"
}
```

**Response Gagal:**

```json
{
    "status": "error",
    "message": "Email atau password salah"
}
```

---

## Registrasi Pengguna

**Method:** `POST`

**URL:** `/api/v1/register`

**Deskripsi:** Membuat akun pengguna baru.

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Internal System`

**Request Headers:**

```http
Content-Type: application/json
```

**Request Body:**

```json
{
    "name": "string",
    "email": "string",
    "password": "string"
}
```

**Response Sukses (`201 Created`):**

```json
{
    "status": "success",
    "message": "Registrasi berhasil"
}
```

**Response Gagal:**

```json
{
    "status": "error",
    "message": "Email sudah digunakan"
}
```

---

## Mendapatkan Daftar Doa

**Method:** `GET`

**URL:** `/api`

**Deskripsi:** Mengambil seluruh data doa dari Public Doa API.

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Third-Party API — Public Doa API`

**Request Headers:**

```http
Content-Type: application/json
```

**Request Body:** `-`

**Response Sukses (`200 OK`):**

```json
[
    {
        "id": "1",
        "doa": "Doa Sebelum Makan",
        "ayat": "اللَّهُمَّ بَارِكْ لَنَا فِيْمَا رزَقْتَنَا وَقِنَا عَذَابَ النَّارِ",
        "latin": "Allahumma baarika lanaa fiimaa razaqtana waqinaa 'adzaa ban-naar",
        "artinya": "Ya Allah, berkahilah kami pada apa yang telah Engkau karuniakan kepada kami dan peliharalah kami dari siksa neraka."
    },
    {
        "id": "2",
        "doa": "Doa Setelah Makan",
        "ayat": "الْحَمْدُ لِلَّهِ الَّذِي أَطْعَمَنَا وَسَقَانَا وَجَعَلَنَا مُسْلِمِينَ",
        "latin": "Alhamdu lillahil-ladzi ath'amanaa wa saqaanaa wa ja'alanaa muslimiin",
        "artinya": "Segala puji bagi Allah yang memberi kami makan dan minum serta menjadikan kami memeluk agama Islam."
    }
]
```

---

## Mendapatkan Detail Doa

**Method:** `GET`

**URL:** `/api/{id}`

**Deskripsi:** Mengambil detail doa spesifik berdasarkan ID dari Public Doa API.

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Third-Party API — Public Doa API`

**Request Headers:**

```http
Content-Type: application/json
```

**Request Body:** `-`

**Response Sukses (`200 OK`):**

```json
{
    "id": "1",
    "doa": "Doa Sebelum Makan",
    "ayat": "اللَّهُمَّ بَارِكْ لَنَا فِيْمَا رَزَقْتَنَا وَقِنَا عَذَابَ النَّارِ",
    "latin": "Allahumma baarika lanaa fiimaa razaqtana waqinaa 'adzaa ban-naar",
    "artinya": "Ya Allah, berkahilah kami pada apa yang telah Engkau karuniakan kepada kami dan peliharalah kami dari siksa neraka."
}
```

**Response Gagal (`404 Not Found`):**

```json
{
    "status": "error",
    "message": "Doa tidak ditemukan"
}
```

---

## Mendapatkan Doa Spesifik Berdasarkan Nama

**Method:** `GET`

**URL:** `/api/doa/{doa}`

**Deskripsi:** Mengambil doa spesifik berdasarkan kata kunci nama doa (tanpa kata "doa" di depannya, misalnya cukup ketik "tidur" atau "makan") dari Public Doa API.

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Third-Party API — Public Doa API`

**Request Headers:**

```http
Content-Type: application/json
```

**Request Body:** `-`

**Response Sukses (`200 OK`):**

```json
[
    {
        "id": "5",
        "doa": "Doa Sebelum Tidur",
        "ayat": "بِاسْمِكَ اللَّهُمَّ أَحْيَا وَبِاسْمِكَ أَمُوتُ",
        "latin": "Bismikallahumma ahya wa bismika amut",
        "artinya": "Dengan nama-Mu ya Allah aku hidup, dan dengan nama-Mu aku mati."
    },
    {
        "id": "6",
        "doa": "Doa Bangun Tidur",
        "ayat": "الْحَمْدُ لِلَّهِ الَّذِي أَحْيَانَا بَعْدَ مَا أَمَاتَنَا وَإِلَيْهِ النُّشُورُ",
        "latin": "Alhamdu lillahil-ladzi ahyaanaa ba'da maa amaatanaa wa ilaihin-nusyur",
        "artinya": "Segala puji bagi Allah yang menghidupkan kami kembali setelah mematikan kami dan kepada-Nya kami bangkit."
    }
]
```

**Response Gagal (`404 Not Found`):**

```json
{
    "status": "error",
    "message": "Doa tidak ditemukan"
}
```

---

## Mendapatkan Doa Acak (Random Doa)

**Method:** `GET`

**URL:** `/api/doa/v1/random`

**Deskripsi:** Mengambil satu doa secara acak (random) dari Public Doa API.

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Third-Party API — Public Doa API`

**Request Headers:**

```http
Content-Type: application/json
```

**Request Body:** `-`

**Response Sukses (`200 OK`):**

```json
{
    "id": "5",
    "doa": "Doa Sebelum Tidur",
    "ayat": "بِاسْمِكَ اللَّهُمَّ أَحْيَا وَبِاسْمِكَ أَمُوتُ",
    "latin": "Bismikallahumma ahya wa bismika amut",
    "artinya": "Dengan nama-Mu ya Allah aku hidup, dan dengan nama-Mu aku mati."
}
```

---

## Menambahkan Doa ke Favorit

**Method:** `POST`

**URL:** `/api/v1/favorites`

**Deskripsi:** Menambahkan doa ke daftar favorit pengguna pada sistem internal.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Headers:**

```http
Authorization: Bearer <token>
Content-Type: application/json
```

**Request Body:**

```json
{
    "prayer_id": "1"
}
```

**Response Sukses (`200 OK`):**

```json
{
    "status": "success",
    "message": "Doa berhasil ditambahkan ke favorit"
}
```

**Response Gagal:**

```json
{
    "status": "error",
    "message": "Data tidak valid atau unauthorized"
}
```

---

## Menambahkan Doa ke Daftar Hafalan

**Method:** `POST`

**URL:** `/api/v1/memorization-list`

**Deskripsi:** Menambahkan doa ke daftar hafalan pengguna pada sistem internal.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Headers:**

```http
Authorization: Bearer <token>
Content-Type: application/json
```

**Request Body:**

```json
{
    "prayer_id": "1"
}
```

**Response Sukses (`200 OK`):**

```json
{
    "status": "success",
    "message": "Doa berhasil ditambahkan ke daftar hafalan"
}
```

**Response Gagal:**

```json
{
    "status": "error",
    "message": "Data tidak valid atau unauthorized"
}
```
