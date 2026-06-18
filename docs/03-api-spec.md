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

**URL:** `/api/v1/prayers`

**Deskripsi:** Mengambil seluruh data doa.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Headers:**

```http
Authorization: Bearer <token>
Content-Type: application/json
```

**Request Body:** `-`

**Response Sukses (`200 OK`):**

```json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "title": "Doa Sebelum Makan"
        }
    ]
}
```

**Response Gagal:**

```json
{
    "status": "error",
    "message": "Unauthorized"
}
```

---

## Mendapatkan Detail Doa

**Method:** `GET`

**URL:** `/api/v1/prayers/{id}`

**Deskripsi:** Mengambil detail doa berdasarkan ID.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Headers:**

```http
Authorization: Bearer <token>
Content-Type: application/json
```

**Request Body:** `-`

**Response Sukses (`200 OK`):**

```json
{
    "status": "success",
    "data": {
        "title": "Doa Sebelum Makan",
        "arabic_text": "...",
        "latin_text": "...",
        "translation": "..."
    }
}
```

**Response Gagal:**

```json
{
    "status": "error",
    "message": "Data tidak ditemukan"
}
```

---

## Menambahkan Doa ke Favorit

**Method:** `POST`

**URL:** `/api/v1/favorites`

**Deskripsi:** Menambahkan doa ke daftar favorit pengguna.

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
    "prayer_id": 1
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
    "message": "Data tidak valid"
}
```

---

## Menambahkan Doa ke Daftar Hafalan

**Method:** `POST`

**URL:** `/api/v1/memorization-list`

**Deskripsi:** Menambahkan doa ke daftar yang ingin dihafal.

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
    "prayer_id": 1
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
    "message": "Data tidak valid"
}
```

---

## Menampilkan Doa Acak

**Method:** `GET`

**URL:** `/api/v1/random-prayer`

**Deskripsi:** Mengambil satu doa secara acak untuk ditampilkan pada halaman utama.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Headers:**

```http
Authorization: Bearer <token>
Content-Type: application/json
```

**Request Body:** `-`

**Response Sukses (`200 OK`):**

```json
{
    "status": "success",
    "data": {
        "id": 5,
        "title": "Doa Sebelum Tidur"
    }
}
```

**Response Gagal:**

```json
{
    "status": "error",
    "message": "Data doa tidak tersedia"
}
```

---

## Admin Menambah Data Doa

**Method:** `POST`

**URL:** `/api/v1/prayers`

**Deskripsi:** Menambahkan data doa baru ke sistem.

**Autentikasi Diperlukan:** `Ya (Admin)`

**Sumber:** `Internal System`

**Request Headers:**

```http
Authorization: Bearer <token>
Content-Type: application/json
```

**Request Body:**

```json
{
    "title": "Doa Sebelum Belajar",
    "arabic_text": "...",
    "latin_text": "...",
    "translation": "..."
}
```

**Response Sukses (`201 Created`):**

```json
{
    "status": "success",
    "message": "Doa berhasil ditambahkan"
}
```

---

## Admin Mengubah Data Doa

**Method:** `PUT`

**URL:** `/api/v1/prayers/{id}`

**Deskripsi:** Mengubah data doa yang sudah ada.

**Autentikasi Diperlukan:** `Ya (Admin)`

**Sumber:** `Internal System`

**Response Sukses (`200 OK`):**

```json
{
    "status": "success",
    "message": "Data doa berhasil diperbarui"
}
```

---

## Admin Menghapus Data Doa

**Method:** `DELETE`

**URL:** `/api/v1/prayers/{id}`

**Deskripsi:** Menghapus data doa dari sistem.

**Autentikasi Diperlukan:** `Ya (Admin)`

**Sumber:** `Internal System`

**Response Sukses (`200 OK`):**

```json
{
    "status": "success",
    "message": "Data doa berhasil dihapus"
}
```
