# Rencana Fitur

> Dokumentasikan minimal **5 fitur utama** proyek Anda.

---

## Fitur 1 — Daftar Doa Harian

**Role Penanggung Jawab:** Frontend & Backend

**Sumber Data:** Third-Party API — Public Doa API (`/api`)

**Deskripsi & Ekspektasi:**
Menampilkan koleksi doa-doa harian dalam bentuk kartu-kartu visual yang menarik bagi anak-anak. Aplikasi mengambil data seluruh doa dari Public Doa API melalui endpoint `/api` untuk disajikan pada halaman utama.

---

## Fitur 2 — Detail Doa & Audio

**Role Penanggung Jawab:** Frontend & Backend

**Sumber Data:** Third-Party API — Public Doa API (`/api/:id`)

**Deskripsi & Ekspektasi:**
Saat sebuah doa dipilih dari daftar, aplikasi menampilkan detail doa yang terdiri dari teks Arab (`ayat`), transliterasi Latin (`latin`), dan terjemahan bahasa Indonesia (`artinya`). Data ini diambil dari Public Doa API melalui endpoint `/api/:id`. Fitur ini juga dilengkapi dengan pemutar audio lokal agar anak-anak dapat mendengarkan cara pelafalan doa tersebut dengan benar.

---

## Fitur 3 — Pencarian Doa

**Role Penanggung Jawab:** Frontend & Backend

**Sumber Data:** Third-Party API — Public Doa API (`/api/doa/:doa`)

**Deskripsi & Ekspektasi:**
Fitur pencarian yang memungkinkan pengguna menemukan doa tertentu berdasarkan kata kunci judul doa (misalnya "tidur" atau "makan"). Aplikasi akan mengirimkan kata kunci pencarian (tanpa kata "doa" di depannya, misalnya `tidur`) ke Public Doa API melalui endpoint `/api/doa/:doa` dan menampilkan hasilnya ke pengguna.

---

## Fitur 4 — Doa Acak Harian (Random Doa)

**Role Penanggung Jawab:** Frontend & Backend

**Sumber Data:** Third-Party API — Public Doa API (`/api/doa/v1/random`)

**Deskripsi & Ekspektasi:**
Menampilkan satu doa secara acak (random) pada halaman beranda aplikasi setiap kali dibuka atau ketika pengguna menekan tombol "Doa Acak". Fitur ini menggunakan data dari Public Doa API melalui endpoint `/api/doa/v1/random` untuk menarik minat anak-anak dalam menghafal doa yang berganti-ganti setiap hari.

---

## Fitur 5 — Daftar Favorit & Progress Hafalan

**Role Penanggung Jawab:** Frontend & Backend

**Sumber Data:** Internal System (Database MySQL)

**Deskripsi & Ekspektasi:**
Memungkinkan pengguna (anak-anak/orang tua) untuk menandai doa tertentu sebagai favorit untuk akses cepat, serta memasukkan doa ke dalam list progres hafalan. Status progres hafalan dapat diubah (misalnya dari "sedang dihafal" menjadi "sudah hafal") untuk memotivasi anak dalam menghafal doa sehari-hari.
