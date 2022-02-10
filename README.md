<h1 align='center'>Afif Shafly Nugroho</h1>
<h2 align='center'>Laravel Test Muslim Ads</h2>

## Langkah Install Project


- Clone Project ini masukkan di directory Htdocs pada xampp.
- masuk ke directory tersebut cari file bernama .env.ecample rename file menjadi .env .
- buat database dan setting konfigurasi yang ada di file .env. sesuaikan dengan nama database yang di buat.
- untuk bagian mail sudah tidak perlu di konfigurasi lagi.
- Buka CMD masuk ke directory project ini, lalu ketik composer update.
- setelah proses selesai, lalu ketik 'php artisan passport:install'.
- seteleah proses selesai, ketik lagi perintah 'php artisan migrate --seed'.
- setelah table dan akun admin terbentuk. ketik 'php artisan route:list' untuk melihat daftar routing.
- untuk routing api bisa juga lihat langsung di directory routes/api disana sudah di jelaskan routingnya untuk apa saja.
- setelah semua langkah di atas sudah selesai di lakukan, ketik perintah 'php artisan serve' untuk running project.

