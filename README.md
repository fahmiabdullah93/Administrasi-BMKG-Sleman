  # BUKU PANDUAN PENGGUNA (USER GUIDE BOOK)
## SISTEM INFORMASI PENGELOLAAN ADMINISTRASI & E-PERSURATAN
### TIM MTG 4 — STASIUN GEOFISIKA KELAS I SLEMAN
**BADAN METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA (BMKG)**--
## DAFTAR ISI
1. [PENDAHULUAN](#1-pendahuluan)- 1.1 Latar Belakang- 1.2 Tujuan Sistem- 1.3 Sasaran Pengguna
2. [SPESIFIKASI & ARSITEKTUR SISTEM](#2-spesifikasi--arsitektur-sistem)- 2.1 Spesifikasi Teknis- 2.2 Struktur Data & Basis Data- 2.3 Hak Akses & Keamanan Sistem
3. [PETUNJUK AKSES & AUTENTIKASI AKUN](#3-petunjuk-akses--autentikasi-akun)- 3.1 Pendaftaran Akun Baru (Registrasi)- 3.2 Masuk ke Sistem (Login)- 3.3 Keluar dari Sistem (Logout)
4. [PANDUAN OPERASIONAL SETIAP MODUL](#4-panduan-operasional-setiap-modul)- 4.1 Modul Dashboard Ringkasan- 4.2 Modul Administrasi BMKG (Modul Utama)- 4.2.1 Membaca Tabel Administrasi- 4.2.2 Menambah Berkas Surat Baru- 4.2.3 Mengubah Status Penyelesaian (Selesai / Belum)- 4.2.4 Mengubah (Edit) Data Surat- 4.2.5 Menghapus Data Surat- 4.2.6 Melihat dan Mengunduh Berkas Fisik Digital- 4.3 Modul Buku Surat Masuk- 4.4 Modul Buku Surat Keluar- 4.5 Modul Laporan Statistik & Cetak Laporan- 4.6 Modul Profil BMKG Sleman & Tautan Eksternal
5. [STANDAR OPERASIONAL PROSEDUR (SOP) PERSURATAN TIM MTG
4](#5-standar-operasional-prosedur-sop-persuratan-tim-mtg-4)- 5.1 Alur Disposisi Surat Masuk- 5.2 Alur Pengarsipan Surat Keluar- 5.3 Kebijakan Penamaan Berkas & Format File
6. [PANDUAN PENANGANAN MASALAH
(TROUBLESHOOTING)](#6-panduan-penanganan-masalah-troubleshooting)- 6.1 Kendala Gagal Unggah Berkas- 6.2 Kendala Akun Tidak Terdaftar- 6.3 Kendala Tampilan Laporan saat Mencetak- 6.4 Kendala Koneksi Basis Data
7. [KONTAK DAN DUKUNGAN TEKNIS](#7-kontak-dan-dukungan-teknis)--
## 1. PENDAHULUAN
### 1.1 Latar Belakang
Pengelolaan tata persuratan dan administrasi operasional pada unit kerja lingkungan BMKG
menuntut kecepatan, ketelitian, dan integritas data yang tinggi. Stasiun Geofisika Kelas I Sleman
memiliki unit operasional teknis, salah satunya adalah **Tim MTG 4** (Meteorologi / Tim Mitigasi &
Geofisika) yang secara rutin memproses surat dinas, nota dinas, permohonan data, laporan
bulanan, dan dokumen teknis operasional.
Sistem Informasi E-Persuratan ini dirancang khusus untuk memfasilitasi pencatatan, pemantauan
status disposisi (Kasgeof dan Datin Mitigasi), pengarsipan dokumen digital, serta visualisasi data
statistik persuratan secara terpusat dan terstruktur.
### 1.2 Tujuan Sistem- **Digitalisasi Pengarsipan:** Menghindari kehilangan berkas fisik dengan menyediakan salinan
digital (PDF/gambar) yang tersimpan aman.- **Transparansi Alur Disposisi:** Memastikan setiap arahan dari Kepala Stasiun Geofisika
(KASGEOF) dan Ketua Tim Mitigasi / Datin tercatat dengan jelas dan dapat dimonitor
perkembangannya.- **Monitoring Status Real-Time:** Mengetahui secara instan surat mana yang sudah selesai
ditindaklanjuti dan mana yang masih tertunda (pending).- **Efisiensi Pelaporan:** Membantu penyusunan laporan statistik volume persuratan bulanan dan
tahunan secara otomatis dalam bentuk grafik dan tabel cetak.
### 1.3 Sasaran Pengguna
1. **Ketua & Anggota Tim MTG 4 / Datin Mitigasi:** Sebagai pelaksana teknis persuratan,
pengunggah berkas, dan penindak lanjut instruksi dinas.
2. **Kepala Stasiun Geofisika (KASGEOF):** Pemberi disposisi dan pemantau ketercapaian
administrasi stasiun.
3. **Petugas Administrasi / Tata Usaha:** Pengelola nomor surat, buku register surat masuk/keluar,
dan arsiparis stasiun.--
## 2. SPESIFIKASI & ARSITEKTUR SISTEM
### 2.1 Spesifikasi Teknis- **Bahasa Pemrograman:** PHP (Hypertext Preprocessor) versi 7.4 - 8.2 (Native Procedural +
Object MySQLi)- **Basis Data:** MariaDB / MySQL (Tabel `administrasi bmkg sleman`, `surat masuk`, `surat
keluar`, `login`, `register`)- **Frontend Framework:** Bootstrap 4, FontAwesome 5, SB Admin Dashboard- **Komponen Pendukung:** jQuery, DataTables (Pencarian, Filter, Paginasi interaktif), Chart.js
(Grafik Batang)- **Format Berkas Lampiran:** PDF, DOC, DOCX, JPG, PNG, JPEG (Pemberian awalan ID unik
otomatis)
### 2.2 Struktur Data & Basis Data
Sistem ini menggunakan 4 entitas tabel utama dalam basis data:
1. **`administrasi bmkg sleman`:** Menyimpan catatan komprehensif persuratan terpadu meliputi
Nomor Surat, Tanggal Surat, Tanggal Terima, Jenis Surat, Deskripsi, Asal Surat, Banyak Surat,
Disposisi KASGEOF, Disposisi Datin Mitigasi, Kontak CP Pengirim, File Digital, dan Flag Status (0
= Belum Selesai, 1 = Selesai).
2. **`surat masuk`:** Buku inventaris khusus pencatatan surat masuk stasiun (Nomor Surat, Nama
Surat, Tanggal, Penerima, Jumlah, File Berkas).
3. **`surat keluar`:** Buku inventaris khusus pencatatan surat dinas yang diterbitkan keluar stasiun
(Nomor Surat, Nama Surat, Tanggal, Tertuju, Jumlah, File Berkas).
4. **`login` & `register`:** Kredensial autentikasi pengguna terdaftar (Email, Password, Nama).
### 2.3 Hak Akses & Keamanan Sistem- Sistem dilengkapi mekanisme **Session Guard** (`cek.php`). Halaman di dalam sistem tidak
dapat dibuka melalui URL langsung tanpa melewati proses login yang sah.- Terdapat peringatan integritas internal stasiun: *Segala bentuk penyebaran data dan berkas resmi
stasiun tanpa izin merupakan pelanggaran hukum kedinasan.*--
## 3. PETUNJUK AKSES & AUTENTIKASI AKUN
### 3.1 Pendaftaran Akun Baru (Registrasi)
Bagi staf atau anggota Tim MTG 4 yang belum memiliki akun, langkah-langkah pendaftarannya
adalah:
1. Buka peramban web (Google Chrome / Mozilla Firefox / Microsoft Edge).
2. Akses alamat web sistem, lalu klik **Daftar di sini** pada halaman login (atau langsung buka
`register.php`).
3. Lengkapi formulir registrasi yang tersedia:- **First Name:** Masukkan nama depan Anda.- **Last Name:** Masukkan nama belakang Anda.- **Email:** Masukkan alamat email resmi/aktif (contoh: `nama@bmkg.go.id` atau email aktif Anda).- **Password:** Masukkan kata sandi yang aman.
- **Confirm Password:** Ulangi kata sandi yang sama untuk konfirmasi.
4. Klik tombol **Daftar Sekarang**.
5. Sistem akan menampilkan notifikasi *“Registrasi berhasil! Silakan login”* dan mengalihkan
halaman ke formulir login.
> Catatan: Jika email yang didaftarkan sudah pernah tercatat pada sistem, sistem akan menolak
dan meminta penggunaan email lain.
### 3.2 Masuk ke Sistem (Login)
1. Akses halaman `login.php`.
2. Masukkan **Email** yang telah didaftarkan pada kolom *Email atau Username*.
3. Masukkan **Password** akun Anda.
4. Centang kotak *Tetap Masuk* jika menggunakan komputer kerja pribadi.
5. Klik tombol hijau **Masuk**.
6. Sistem memverifikasi data dan secara otomatis mengarahkan Anda ke halaman utama
(`index.php` atau `dashboard.php`). Email aktif Anda akan tampil di pojok kiri bawah navigasi
(sidebar).
### 3.3 Keluar dari Sistem (Logout)
Untuk menjaga keamanan data dinas, selalu lakukan logout setelah selesai bertugas:
1. Pada menu navigasi sebelah kiri (sidebar), gulir ke bagian paling bawah bertuliskan **AKUN**.
2. Klik tombol merah **Logout**.
3. Sesi Anda akan dimusnahkan secara aman dan diarahkan kembali ke halaman login.--
## 4. PANDUAN OPERASIONAL SETIAP MODUL
### 4.1 Modul Dashboard Ringkasan (`dashboard.php`)
Modul Dashboard menyajikan ikhtisar eksekutif bagi pimpinan dan anggota tim terkait kondisi
persuratan saat ini:- **Kartu Biru (Total Surat Masuk):** Menampilkan akumulasi jumlah berkas surat masuk yang
tercatat.- **Kartu Hijau (Total Surat Keluar):** Menampilkan akumulasi jumlah berkas surat dinas yang
dikirim keluar.- **Kartu Ungu (Kategori Surat):** Ragam jenis klasifikasi berkas yang aktif.- **Panel Rasio Persuratan:** Grafik persentase dan perbandingan volume surat.- **Panel Aktivitas Surat Terbaru:** Menampilkan 5 arsip surat terakhir yang masuk ke basis data
secara real-time, lengkap dengan label jenis surat dan asal pengirim.--
### 4.2 Modul Administrasi BMKG (`index.php`)
Modul ini adalah **jantung operasional persuratan Tim MTG 4**, tempat pengelolaan dokumen
masuk/keluar beserta alur disposisi pimpinan.
#### 4.2.1 Membaca Tabel Administrasi
Tabel pada halaman ini memiliki fitur **DataTables**, dengan kolom:
1. **No:** Nomor urut data.
2. **Tanggal Surat:** Tanggal pembuatan resmi pada surat.
3. **Tanggal Terima:** Tanggal fisik/berkas surat diterima oleh staf BMKG Sleman.
4. **Nomor Surat:** Nomor resmi surat dinas (contoh: `HM.02.02/003`, `B/KP.01.00/...`).
5. **Jenis:** Klasifikasi berkas (`Masuk` atau `Keluar`).
6. **Deskripsi Surat:** Perihal atau uraian singkat isi surat.
7. **Asal Surat:** Instansi / perorangan / bagian asal surat.
8. **Jumlah:** Volume berkas surat yang dilampirkan.
9. **Tindak Lanjut KASGEOF:** Arahan disposisi dari Kepala Stasiun Geofisika.
10. **Tindak Lanjut Datin:** Arahan teknis dari Koordinator Data & Informasi / Ketua Tim Mitigasi.
11. **CP Pengirim:** Nomor telepon / kontak penanggung jawab surat.
12. **File Berkas:** Akses cepat untuk mengunduh atau membuka lampiran digital.
13. **Status:** Indikator penyelesaian surat (`Selesai` / `Belum`).
14. **Aksi:** Kumpulan tombol cepat (Lihat, Edit, Hapus).
#### 4.2.2 Menambah Berkas Surat Baru
1. Klik tombol hijau **+ Tambah Surat** di atas tabel.
2. Jendela formulir modal akan muncul. Isi seluruh kolom dengan benar:- **Tanggal Surat & Tanggal Terima:** Pilih tanggal melalui kalender pemilih tanggal.- **Nomor Surat:** Tuliskan nomor lengkap surat.- **Jenis Surat:** Pilih opsi `Masuk` atau `Keluar`.- **Deskripsi Surat:** Tulis perihal surat secara ringkas dan padat.- **Asal Surat:** Tulis nama instansi atau pihak pengirim.- **Banyak Surat:** Masukkan angka jumlah eksemplar/lembar berkas.- **Tindak Lanjut KASGEOF:** Masukkan catatan disposisi Kepala Stasiun (contoh: *"Mohon
Ditindaklanjuti"*, *"Koordinasikan dengan Tim Operasional"*).- **Tindak Lanjut Datin Mitigasi:** Masukkan catatan tindak lanjut Tim Mitigasi (contoh: *"Disiapkan
data gempa bumi oleh staf teknis"*).- **CP Pengirim Surat:** Nomor WhatsApp / Handphone pengirim surat.- **Upload Berkas / File:** Klik *Choose File*, lalu pilih dokumen hasil scan (format PDF, DOC,
DOCX, JPG, JPEG, atau PNG).
3. Klik tombol hijau **Simpan Data**.
4. Berkas akan otomatis terunggah ke folder server dan data langsung tercatat di tabel utama.
#### 4.2.3 Mengubah Status Penyelesaian (Toggle Status Selesai / Belum)
Sistem menyediakan tombol status instan tanpa perlu membuka form edit:- Jika status surat masih berlabel merah **[Belum]** (Status = 0):- Klik tombol **Belum** tersebut.- Sistem akan langsung memperbarui status menjadi **[Selesai]** (Status = 1) berlabel hijau cerah.- Sebaliknya, jika ingin membatalkan status atau menandai surat belum tuntas, cukup klik tombol
**Selesai** untuk mengembalikannya ke status **Belum**.
#### 4.2.4 Mengubah (Edit) Data Surat
1. Cari baris surat yang ingin diubah datanya. Anda dapat memanfaatkan fitur **Cari/Search** di
pojok kanan atas tabel.
2. Pada kolom **Aksi**, klik ikon pensil kuning (**Edit**).
3. Jendela modal edit akan muncul dengan data lama yang sudah terisi otomatis.
4. Lakukan penyesuaian pada kolom yang diperlukan.
5. Klik **Simpan Perubahan**. Sistem akan menyimpan pembaruan ke basis data.
#### 4.2.5 Menghapus Data Surat
1. Pada baris surat yang hendak dihapus, klik ikon tempat sampah merah (**Hapus**).
2. Sistem akan menampilkan dialog konfirmasi penghapusan agar tidak terjadi kesalahan hapus
yang tidak disengaja.
3. Klik **Hapus** untuk menyetujui.
4. Data di basis data serta berkas lampiran digital di folder server akan dihapus secara permanen.
#### 4.2.6 Melihat dan Mengunduh Berkas Digital- Klik tautan teks berwarna biru bertuliskan **Lihat** pada kolom *File Berkas*, atau klik ikon mata
(**Eye**) pada kolom *Aksi*.- Berkas digital akan langsung terbuka pada tab baru peramban Anda untuk ditinjau atau dicetak.--
### 4.3 Modul Buku Surat Masuk (`masuk.php`)
Modul ini difungsikan sebagai buku agenda khusus surat masuk stasiun:
1. **Mencatat Surat Masuk:** Klik tombol **+ Tambah Surat Masuk**, isi nama/perihal surat, nama
staf penerima surat di stasiun, jumlah berkas, tanggal masuk, dan berkas lampiran digital.
2. **Pencarian Cepat:** Gunakan kotak *Search* DataTables untuk mencari berdasarkan nomor
surat atau nama penerima.
3. **Penyuntingan & Penghapusan:** Gunakan tombol kuning (Edit) atau merah (Hapus) pada
kolom Aksi sesuai kebutuhan.--
### 4.4 Modul Buku Surat Keluar (`keluar.php`)
Modul ini difungsikan sebagai buku agenda khusus surat keluar stasiun:
1. **Mencatat Surat Keluar:** Klik tombol **+ Tambah Surat Keluar**, isi perihal/nama surat,
pihak/instansi yang dituju (tertuju), volume surat, tanggal terbit, dan unggah berkas surat yang telah
ditandatangani.
2. **Pengawasan Arsip:** Memastikan seluruh surat yang keluar memiliki nomor arsip dan arsip
berkas tersimpan sebelum didistribusikan ke pihak luar.--
### 4.5 Modul Laporan Statistik & Cetak Laporan (`laporan.php`)
Modul ini ditujukan untuk evaluasi kinerja tata persuratan Tim MTG 4 secara berkala:
1. **Filter Tahun Pelaporan:**- Gunakan menu *dropdown* pemilih tahun di pojok kanan atas (contoh: *Tahun 2026*, *Tahun
2025*).- Seluruh metrik angka, grafik, dan tabel akan otomatis menyesuaikan dengan tahun yang dipilih.
2. **Kartu Rekapitulasi Tahunan:**- Menampilkan total volume surat masuk & rata-rata per bulan.- Menampilkan total volume surat keluar & rata-rata per bulan.
3. **Grafik Batang Interaktif (Chart.js):**- Memvisualisasikan fluktuasi surat masuk (biru) dan surat keluar (hijau) dari bulan Januari hingga
Desember.
4. **Tabel Rincian Bulanan:**- Menyajikan angka agregat per bulan untuk kebutuhan verifikasi data.
5. **Fungsi Cetak Laporan (Print to Paper / PDF):**- Klik tombol **Cetak Laporan** (ikon printer).- Tampilan cetak telah dirancang otomatis dengan *CSS Print Media* khusus yang
menyembunyikan navigasi sidebar, tombol-tombol, dan hanya mencetak lembar laporan resmi
yang bersih dan rapi.- Pada kotak dialog printer, Anda dapat memilih pencetak fisik atau memilih opsi **Save as PDF**
untuk menghasilkan berkas laporan digital.--
### 4.6 Modul Profil BMKG Sleman & Tautan Eksternal (`profil.php`)
Modul ini menyajikan profil institusi dan navigasi integrasi layanan:- **Galeri Foto Kantor:** Dokumentasi sarana dan prasarana Stasiun Geofisika Kelas I Sleman.- **Sejarah BMKG:** Informasi sejarah perkembangan meteorologi, klimatologi, dan geofisika di
Indonesia.- **Identitas & Kontak Resmi:**- Alamat: Jl. Wates KM. 8, Jitengan, Balecatur, Kec. Gamping, Kab. Sleman, D.I. Yogyakarta 55295- Telepon: (0274) 6498383- Email: `stageof.sleman@bmkg.go.id`- **Tautan Cepat Eksternal di Sidebar:**
- *Web Pelayanan BMKG:* Menghubungkan langsung ke portal permohonan data dan pelayanan
publik BMKG.- *Web BMKG Sleman:* Menghubungkan ke jaringan web lokal/intranet Stasiun Geofisika Sleman.--
## 5. STANDAR OPERASIONAL PROSEDUR (SOP) PERSURATAN TIM MTG 4
```
ALUR PROSES PERSURATAN TIM MTG 4:
+-------------------+ +--------------------+ +--------------------+
| 1. Surat Diterima | ---> | 2. Registrasi Web | ---> | 3. Disposisi |
| (Fisik/Email) | | (Upload Berkas) | | Kasgeof & Tim |
+-------------------+ +--------------------+ +---------+----------+
|
+-------------------+ +--------------------+ |
| 5. Verifikasi & | <--- | 4. Pelaksanaan | <--------------+
| Status Selesai | | Tindak Lanjut |
+-------------------+ +--------------------+
```
### 5.1 Alur Disposisi Surat Masuk
1. **Penerimaan Berkas:** Surat dinas fisik atau elektronik diterima oleh staf administrasi / anggota
piket Tim MTG 4.
2. **Digitalisasi (Scanning):** Berkas fisik dipindai (scan) menjadi format PDF atau JPG berkualitas
jelas.
3. **Pencatatan Awal:** Petugas membuka modul **Administrasi BMKG**, lalu menginput tanggal
surat, tanggal terima, perihal, pengirim, dan mengunggah berkas scan.
4. **Pemberian Catatan Disposisi:**- Kolom *Tindak Lanjut KASGEOF* diisi sesuai disposisi tertulis/lisan Kepala Stasiun Geofisika.- Kolom *Tindak Lanjut Datin Mitigasi* diisi sesuai instruksi penanggung jawab Tim MTG 4 / Datin.
5. **Pelaksanaan Tugas:** Anggota tim yang ditugaskan melaksanakan instruksi (misalnya
penyiapan data seismisitas, analisis guncangan gempa bumi, sosialisasi mitigasi bencana, atau
surat balasan).
6. **Penutupan Status:** Setelah instruksi selesai dikerjakan, petugas mengklik tombol status
menjadi **Selesai**.
### 5.2 Alur Pengarsipan Surat Keluar
1. Konsep surat keluar yang telah disetujui pimpinan dan ditandatangani dibubuhi nomor surat
resmi stasiun.
2. Petugas menginput data pada modul **Surat Keluar** dan modul **Administrasi BMKG**.
3. Berkas digital surat keluar yang telah berstempel resmi diunggah ke sistem sebagai arsip
permanen.
4. Surat dikirimkan kepada instansi mitra / tertuju.
### 5.3 Kebijakan Penamaan Berkas & Format File- **Ukuran Berkas Disarankan:** Kurang dari 5 Megabytes (MB) agar proses unggah dan unduh
berjalan cepat.- **Format yang Didukung Sistem:** `.pdf`, `.doc`, `.docx`, `.jpg`, `.jpeg`, `.png`.- **Standar Penamaan File Sebelum Diunggah:** Disarankan menggunakan penamaan baku,
contoh:- `SuratMasuk_InstansiPengirim_PerihalSingkat.pdf`- `SuratKeluar_BMKGSleman_ST_PemeriksaanAlat.pdf`--
## 6. PANDUAN PENANGANAN MASALAH (TROUBLESHOOTING)
| No | Gejala Masalah | Penyebab Umum | Solusi Perbaikan |
|---|---|---|---|
| 1 | Muncul notifikasi *"Ekstensi file tidak diizinkan!"* saat menyimpan data. | Berkas yang diunggah
memiliki ekstensi di luar format yang diizinkan (misal `.zip`, `.rar`, `.exe`). | Pastikan berkas diubah
terlebih dahulu menjadi format **PDF**, **DOC/DOCX**, atau **Gambar (JPG/PNG)** sebelum
diunggah. |
| 2 | Muncul pesan *"Email sudah terdaftar!"* pada saat registrasi akun. | Email yang dimasukkan
sudah ada dalam tabel basis data. | Gunakan email yang berbeda atau langsung masuk
menggunakan halaman login jika akun tersebut milik Anda. |
| 3 | Tampilan halaman langsung kembali ke `login.php` saat membuka halaman lain. | Sesi login
Anda telah habis (*expired*) atau Anda belum melakukan login yang sah. | Masuk kembali dengan
memasukkan email dan password Anda di `login.php`. |
| 4 | File berkas tidak dapat dibuka (*File not found* / 404). | Berkas fisik terhapus dari folder `file/` di
server hosting / komputer lokal. | Hubungi administrator sistem untuk memeriksa keberadaan folder
`file/` dan hak akses (*permissions*) direktori tersebut. |
| 5 | Saat mencetak laporan, sidebar dan menu navigasi ikut tercetak. | Peramban (*browser*) tidak
menerapkan aturan print-media dengan benar. | Pastikan menggunakan tombol **Cetak Laporan**
di halaman web dan centang opsi *"Background graphics"* pada pratinjau cetak peramban. |
| 6 | Muncul galat *"Koneksi database gagal"*. | Layanan MySQL pada XAMPP berhenti atau
parameter koneksi di `function.php` tidak cocok. | Buka XAMPP Control Panel, pastikan module
**Apache** dan **MySQL** berstatus *Running* (berwarna hijau). Periksa konfigurasi nama
database dan kredensial di file `function.php`. |--
## 7. KONTAK DAN DUKUNGAN TEKNIS
Apabila Anda mengalami kendala teknis operasional, kegagalan sistem, atau memerlukan
modifikasi fitur persuratan lebih lanjut, silakan menghubungi:- **Unit Kerja:** Tim MTG 4 / Sub Koordinator Datin & Mitigasi
- **Instansi:** Stasiun Geofisika Kelas I Sleman - BMKG D.I. Yogyakarta- **Alamat Kantor:** Jl. Wates KM. 8, Jitengan, Balecatur, Kec. Gamping, Kabupaten Sleman,
Daerah Istimewa Yogyakarta 55295- **Telepon:** (0274) 6498383- **Surel Kedinasan:** `stageof.sleman@bmkg.go.id`--
*Buku Panduan ini disusun untuk standarisasi operasional tata kelola administrasi digital Stasiun
Geofisika Kelas I Sleman — BMKG.*
