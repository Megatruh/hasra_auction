# Hasra Auction

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red)](https://laravel.com)
![PHP](https://img.shields.io/badge/PHP-%5E8.2-777bb4)
![Tailwind CSS](https://img.shields.io/badge/TailwindCSS-v4-38bdf8)
![Testing](https://img.shields.io/badge/Tests-php%20artisan%20test-10b981)

**Hasra Auction** adalah aplikasi lelang mobil premium berbasis web dengan konsep **Round-based English Auction** (berbasis ronde 1 menit) dan pembaruan data **real-time** menggunakan WebSockets. Tampilan UI mengusung gaya **Old Money / Quiet Luxury** (editorial, whitespace luas, dan tipografi serif).

---

## Daftar Isi

- [Ringkasan](#ringkasan)
- [Tech Stack](#tech-stack)
- [Fitur Utama](#fitur-utama)
- [Konsep Lelang: Round-based English Auction](#konsep-lelang-round-based-english-auction)
- [Role & Akses](#role--akses)
- [Real-time Broadcasting (Reverb + Echo)](#real-time-broadcasting-reverb--echo)
- [Instalasi & Menjalankan Lokal](#instalasi--menjalankan-lokal)
- [Panduan Pengoperasian](#panduan-pengoperasian)
- [Testing](#testing)
- [Troubleshooting](#troubleshooting)

---

## Ringkasan

- **Nama Proyek:** Hasra Auction
- **Deskripsi:** Lelang mobil premium real-time dengan sistem ronde (1 menit per ronde). Jika ada bid masuk dalam ronde berjalan, sistem memperpanjang ke ronde berikutnya; jika tidak ada bid, lelang otomatis ditutup.
- **UI Theme:** Old Money / Quiet Luxury (Playfair Display + Inter, palet warna bone `#FAF8F5`, border-based surfaces).

---

## Tech Stack

- **Backend:** Laravel 12
- **Frontend:** Tailwind CSS v4, Blade Templating, Vite
- **Auth:** Laravel Breeze
- **Real-time/WebSockets:** Laravel Reverb + Laravel Echo
- **Testing:** PHPUnit Feature Test (Laravel built-in) *(struktur kompatibel dengan `php artisan test`)*

---

## Fitur Utama

1. **Pemisahan Role (Role Separation)**
	 - Role: `host` (penyelenggara) dan `player` (peserta)
	 - Akses dikunci menggunakan middleware (`host` / `player`).

2. **Lelang Berbasis Ronde (Round-based English Auction)**
	 - Timer **1 menit** per ronde.
	 - Jika ada bid valid pada ronde berjalan, ronde dilanjutkan dan timer diperpanjang.
	 - Jika tidak ada bid pada ronde berjalan, lelang otomatis ditutup.

3. **Real-time Broadcasting**
	 - Bid yang masuk dibroadcast melalui WebSocket (Reverb) dan diterima client melalui Laravel Echo.

4. **Old Money UI/UX (Quiet Luxury)**
	 - Tipografi: **Playfair Display** (serif) untuk heading & angka harga, **Inter** (sans) untuk body.
	 - Layout minimalis: banyak whitespace, surface berbasis border `border-gray-200`, tanpa shadow “berat”.
	 - Referensi desain ada di `DESIGN.md`.

---

## Konsep Lelang: Round-based English Auction

Aturan inti yang diterapkan:

- Setiap lelang memiliki **ronde aktif** (`auctions.current_round`).
- Setiap bid diberi label ronde (`bids.round_number`).
- Bid baru harus **lebih tinggi** dari harga tertinggi saat ini (atau `harga_awal` jika belum ada bid).
- Saat waktu ronde mencapai **00:00**, sistem melakukan evaluasi ronde:
	- **Ada bid di ronde tersebut** → `current_round` bertambah, timer diperpanjang 1 menit.
	- **Tidak ada bid di ronde tersebut** → status lelang menjadi `closed` dan pemenang dikunci.

---

## Role & Akses

Middleware yang digunakan:

- `host` → hanya user dengan `role=host` dapat mengakses rute host.
- `player` → hanya user dengan `role=player` dapat mengakses rute player.

Contoh rute:

- Host:
	- `route('host.dashboard')`
	- `route('host.auction.session', $auction)`
- Player:
	- `route('player.dashboard')`
	- `route('player.auction.bid', $auction)`

---

## Real-time Broadcasting (Reverb + Echo)

Arsitektur singkat:

- **Server WebSocket:** Laravel Reverb (`php artisan reverb:start`)
- **Client WebSocket:** Laravel Echo (`resources/js/echo.js`)
- Event broadcast:
	- `App\Events\BidPlaced` menyiarkan ke channel: `auction.{auction_id}`
	- Nama event: `bid.updated`

Catatan penting untuk local development:

- Karena event broadcast memakai antrean (queue) secara default, pastikan **queue worker berjalan** agar event benar-benar terkirim.
- Anda bisa menjalankan queue worker dengan `php artisan queue:listen` / `php artisan queue:work`.

---

## Instalasi & Menjalankan Lokal

### Prasyarat

- PHP **8.2+**
- Composer
- Node.js + npm
- Database (MySQL/MariaDB atau SQLite)

### 1) Clone & install dependency

```bash
git clone <URL_REPOSITORY_ANDA>
cd hasra_auction

composer install
npm install
```

### 2) Setup environment

```bash
cp .env.example .env
php artisan key:generate
```

Lalu atur koneksi database di `.env` (contoh MySQL):

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hasra_auction
DB_USERNAME=root
DB_PASSWORD=
```

### 3) Migrasi & seeding (data dummy)

```bash
php artisan migrate:fresh --seed
```

Seeder yang dijalankan antara lain:

- `UserSeeder` (termasuk akun host)
- `CarSeeder` (data dummy mobil)
- `AuctionSeeder` (membuat sesi lelang berstatus `pending` untuk setiap mobil)

### 4) Menjalankan service (Web + Vite + Queue + Reverb)

Jalankan komponen berikut (idealnya di terminal terpisah):

1) Web server Laravel

```bash
php artisan serve
```

2) Vite (Tailwind + asset)

```bash
npm run dev
```

3) Queue worker *(wajib untuk real-time broadcast jika queue driver bukan `sync`)*

```bash
php artisan queue:listen
```

4) WebSocket server (Reverb)

```bash
php artisan reverb:start
```

Alternatif cepat (tanpa Reverb): Anda bisa memakai `composer run dev` untuk menjalankan server + queue + logs + vite secara bersamaan. Reverb tetap dijalankan terpisah.

```bash
composer run dev
```

---

## Panduan Pengoperasian

### Dari sisi Host

1. Login menggunakan akun dengan role `host`.
2. Masuk ke **Host Dashboard** untuk melihat daftar lelang.
3. Klik sesi lelang mobil untuk masuk ke **Panel Kontrol Host**.
4. Klik **“Mulai Lelang”** untuk mengaktifkan timer 1 menit (memulai ronde pertama).
5. Saat timer habis (00:00), sistem otomatis melakukan rekap:
	 - Jika ada bid baru pada ronde berjalan → timer diperpanjang 1 menit dan masuk ronde berikutnya.
	 - Jika tidak ada bid → lelang otomatis ditutup dan pemenang dikunci.

### Dari sisi Player

1. Login menggunakan akun dengan role `player`.
2. Masuk ke **Player Dashboard** untuk melihat sesi lelang.
3. Klik mobil yang dilelang untuk masuk ke halaman detail.
4. Player melihat **Countdown Timer** dan **Harga Tertinggi**.
5. Masukkan nominal tawaran (harus lebih tinggi dari harga saat ini) lalu klik **“Tawar Sekarang”**.
6. Jika berhasil, harga tertinggi akan diperbarui.

---

## Akun Dummy (Seeder)

Seeder menyediakan akun host berikut:

- **Host**
	- Email: `host@utama.com`
	- Password: `Plmoki09`

Untuk akun player, Anda dapat:

- Registrasi melalui halaman register (default role: `player`).

---

## Testing

Menjalankan seluruh Feature Test:

```bash
php artisan test
```

Test yang relevan untuk requirement proyek:

- `tests/Feature/RoleSeparationTest.php` (uji pemisahan role host vs player)
- `tests/Feature/AuctionBidTest.php` (uji bid gagal/berhasil + `round_number`)

---

## Troubleshooting

### 1) Real-time tidak update

Checklist:

- Pastikan **Reverb** berjalan: `php artisan reverb:start`
- Pastikan **queue worker** berjalan: `php artisan queue:listen`
- Pastikan Vite berjalan: `npm run dev` (dan refresh halaman)
- Pastikan `.env` berisi konfigurasi Reverb dan frontend variables:

```env
BROADCAST_CONNECTION=reverb

REVERB_APP_ID=123456
REVERB_APP_KEY=your-app-key
REVERB_APP_SECRET=your-app-secret
REVERB_HOST=127.0.0.1
REVERB_PORT=8080
REVERB_SCHEME=http

VITE_REVERB_APP_KEY="${REVERB_APP_KEY}"
VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
VITE_REVERB_SCHEME="${REVERB_SCHEME}"
```

> Jika Anda mengubah variabel `VITE_*`, restart `npm run dev` agar env terbaru terbaca.

### 2) Gambar mobil tidak muncul

- Pastikan file gambar tersedia sesuai nama yang di-seed (lihat `database/seeders/CarSeeder.php`).
- Jika menggunakan disk `public`, Anda mungkin perlu menjalankan:

```bash
php artisan storage:link
```

---

## Lisensi

Proyek ini digunakan untuk kebutuhan pengembangan/pembelajaran. Silakan sesuaikan lisensi sesuai kebutuhan Anda.
