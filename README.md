# 🚍 Sistem Pemesanan Tiket Travel

Proyek ini merupakan **aplikasi pemesanan tiket berbasis web** yang dibangun menggunakan **Laravel** dan **MySQL**.  
Aplikasi ini memiliki 3 role utama: **Admin**, **Checker**, dan **Customer**, masing-masing dengan fungsi dan akses berbeda.

---

## 🔧 Fitur Utama

### 👤 **Customer**
- Melihat daftar jadwal perjalanan.
- Melakukan pemesanan tiket.
- Mengunggah bukti pembayaran.
- Melihat status pemesanan & detail tiket.
- Mengedit profil pribadi.

### 🧾 **Admin**
- Mengelola jadwal keberangkatan.
- Mengatur kursi dan kapasitas.
- Mengelola data pemesanan dan pembayaran.
- Membuat dan mencetak surat jalan.
- Melihat laporan transaksi.

### ✅ **Checker**
- Melakukan check-in penumpang berdasarkan kode pemesanan.
- Melihat jadwal keberangkatan hari ini.
- Mengakses surat jalan untuk setiap keberangkatan.

---

## 🗂️ Struktur Database

Beberapa tabel utama yang digunakan:
- **users**
- **jadwal**
- **kursi**
- **pemesanan**
- **pembayaran**
- **check_ins**
- **surat_jalans**

---

## 🖥️ Teknologi yang Digunakan
- **Laravel 12**
- **PHP 8.2**
- **MySQL**
- **Bootstrap 5**
- **Blade Template Engine**
- **Font Awesome Icons**
