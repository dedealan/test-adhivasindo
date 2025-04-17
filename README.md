# Back-End Developer Take Home Test

## ⚙️ Teknologi yang Digunakan

- Laravel 10
- Sanctum (token authentication)
- Guzzle HTTP Client
- MySQL


---

## 📦 Fitur API

| Endpoint                  | Method | Auth | Keterangan                                      |
|---------------------------|--------|------|-------------------------------------------------|
| `/api/auth/login`             | POST   | ❌   | Login user dan dapatkan token                   |
| `/api/users`             | GET    | ✅   | List semua user                          |
| `/api/users`             | POST   | ✅   | Tambah user baru                              |
| `/api/users/{id}`        | GET    | ✅   | Tampilkan detail user tertentu            |
| `/api/users/{id}`        | PUT    | ✅   | Update data user                              |
| `/api/users/{id}`        | DELETE | ✅   | Hapus user                               |
| `/api/cari/nama?q=`    | GET    | ✅   | Cari berdasarkan NAMA              |
| `/api/cari/nim?q=`     | GET    | ✅   | Cari berdasarkan NIM               |
| `/api/cari/ymd?q=`     | GET    | ✅   | Cari berdasarkan YMD               |

---


## 🔐 Autentikasi

Gunakan endpoint `/api/auth/login` untuk login dan mendapatkan token:
```json
{
  "email": "user@dummy.com",
  "password": "user123"
}
```

## 🔧 Cara Install

Ikuti langkah-langkah berikut untuk menjalankan proyek ini:

```bash
# 1. Clone repository
git clone https://github.com/dedealan/test-adhivasindo.git
cd test-adhivasindo

# 2. Install dependencies
composer install

# 3. Copy konfigurasi environment
cp .env.example .env

# 4. Generate app key
php artisan key:generate

# 5. Atur koneksi database di file .env
# Contoh:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=tht_adhivasindo
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Jalankan migrasi dan seeder
php artisan migrate --seed

# 7. Jalankan server lokal
php artisan serve
```

