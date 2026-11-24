# SIPINJAM — Peminjaman Barang Sekolah

Aplikasi Laravel untuk mengelola inventaris dan peminjaman barang sekolah.

## Deploy ke Vercel

Proyek ini menggunakan container FrankenPHP karena Vercel tidak menyediakan
runtime PHP resmi. Vercel membangun container dari `Dockerfile.vercel`; file
`.env` lokal tidak dimasukkan ke image.

### Persiapan layanan

Sebelum deploy, siapkan:

1. Database PostgreSQL terkelola. SQLite lokal tidak cocok untuk Vercel karena
   filesystem instance tidak persisten dan tidak dibagi antar-instance.
2. Bucket object storage kompatibel S3 untuk foto profil/avatar agar file
   tetap tersedia setelah instance diganti.
3. Repository GitHub yang sudah berisi perubahan deployment ini.

### Environment variables Vercel

Tambahkan di **Project Settings → Environment Variables** untuk Production dan
Preview sesuai kebutuhan:

```dotenv
APP_ENV=production
APP_DEBUG=false
APP_KEY=<isi-dari-output-key-generate>
APP_URL=https://<domain-vercel>

DB_CONNECTION=pgsql
DB_HOST=<host-database>
DB_PORT=5432
DB_DATABASE=<nama-database>
DB_USERNAME=<user-database>
DB_PASSWORD=<password-database>
DB_SSLMODE=require

SESSION_DRIVER=database
CACHE_STORE=array
QUEUE_CONNECTION=sync
AVATAR_DISK=s3

AWS_ACCESS_KEY_ID=<access-key-bucket>
AWS_SECRET_ACCESS_KEY=<secret-key-bucket>
AWS_DEFAULT_REGION=<region-bucket>
AWS_BUCKET=<nama-bucket>
AWS_ENDPOINT=<endpoint-s3-jika-diperlukan>
AWS_URL=<url-publik-bucket-jika-diperlukan>
AWS_USE_PATH_STYLE_ENDPOINT=false
```

Buat `APP_KEY` baru dengan `php artisan key:generate --show`; gunakan key yang
sama untuk redeploy dalam environment yang sama. Jangan commit `.env` atau
menaruh secret di source code. Jika penyedia database memberikan URL koneksi,
gunakan `DB_URL` sesuai format Laravel sebagai pengganti variabel `DB_HOST`,
`DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD`.

### Migrasi dan deploy

1. Hubungkan repository ke Vercel dan pilih direktori proyek ini sebagai root.
2. Pastikan konfigurasi container terbaca dari `vercel.json` dan seluruh
   environment variables sudah ditambahkan.
3. Jalankan `php artisan migrate --force` satu kali terhadap database produksi
   dari lingkungan yang memiliki akses ke database tersebut.
   Migrasi hanya membuat skema; data dari SQLite lokal tidak otomatis ikut
   dipindahkan.
4. Deploy dari dashboard Vercel, atau jalankan `vercel deploy --prod` dengan
   Vercel CLI.
5. Setelah deploy, cek halaman `/up`, login, alur peminjaman, dan unggah foto.

Jangan menjalankan migrasi pada setiap startup container. Untuk upload avatar,
`AVATAR_DISK=s3` harus memakai bucket S3 yang sudah dikonfigurasi dan dapat
menyajikan file secara publik; penyimpanan lokal container tidak persisten.
Perintah terjadwal di `routes/console.php` tidak berjalan otomatis di Vercel;
pengingat peminjaman dan penandaan keterlambatan perlu dijalankan melalui
Vercel Cron atau scheduler eksternal.

### Pengembangan lokal

```sh
composer install
npm install
php artisan migrate
php artisan storage:link
npm run build
php artisan serve
```

Jalankan `npm run dev` secara terpisah saat mengembangkan frontend. Untuk
menjalankan pengujian, gunakan `php artisan test`.
