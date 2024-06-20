# Proyek Laravel

Ini adalah proyek Laravel untuk mengelola sistem rumah sakit.

## Fitur

- Manajemen Pasien
- Manajemen Dokter
- Manajemen Bangsal & Tempat Tidur
- Laporan Pasien

## Instalasi

1. Clone the repository
2. Run `composer install`
3. Salin `.env.example` ke `.env` dan konfigurasikan variabel lingkungan Anda
jika ingin menerima inbox(mailtrap)untuk mereset password
example:
    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=220dfc2b0008e2
    MAIL_PASSWORD=246a1faa8dd615
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS="no-reply@tugasPAW.com"
    MAIL_FROM_NAME="PAW Rumah Sakit"

4. Run `php artisan key:generate`
5. Run migrations `php artisan migrate`

## Penggunaan

- Untuk memulai server, jalankan `php artisan serve`
- Buka browser Anda dan buka `http://localhost:8000`


