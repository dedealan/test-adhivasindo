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
  "email": "user@example.com",
  "password": "your_password"
}

