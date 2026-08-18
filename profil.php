<?php
require 'function.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Profil BMKG Sleman" />
        <meta name="author" content="" />
        <title>Profil BMKG - Administrasi BMKG Sleman</title>
        
        <!-- CSS Wajib Template -->
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        
        <style>
            .sb-topnav.navbar {
                background-color: #008751 !important;
            }
            .sb-sidenav-dark {
                background-color: #1a252f !important;
            }
            .sb-sidenav-dark .sb-sidenav-menu .nav-link {
                color: rgba(255, 255, 255, 0.8);
            }
            .sb-sidenav-dark .sb-sidenav-menu .nav-link:hover {
                color: #ffffff;
                background-color: rgba(0, 135, 81, 0.3);
            }
            .sb-sidenav-dark .sb-sidenav-menu .nav-link.active {
                color: #ffffff;
                background-color: #008751;
            }
            .brand-container {
                display: flex;
                align-items: center;
                padding: 15px 20px;
                background: #141c24;
            }
            .brand-title {
                font-size: 14px;
                font-weight: bold;
                color: #ffffff;
                line-height: 1.2;
            }
            .modal-backdrop {
                background-color: rgba(0, 0, 0, 0.2) !important;
            }
            .modal-backdrop.show {
                opacity: 1 !important;
                backdrop-filter: blur(8px) !important;
                -webkit-backdrop-filter: blur(8px) !important;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        
        <!-- NAVBAR ATAS -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark">
            <button class="btn btn-link btn-sm order-1 order-lg-0 ml-2" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <a class="navbar-brand ml-2 font-weight-bold" href="index.php" style="font-size: 16px;">BMKG Kelas 1 Sleman</a>
            
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Cari Berkas..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-light" type="button"><i class="fas fa-search text-success"></i></button>
                    </div>
                </div>
            </form>
        </nav>

        <div id="layoutSidenav">
            
            <!-- SIDEBAR KIRI -->
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="brand-container">
                            <div class="bg-white d-flex justify-content-center align-items-center mr-2 shadow-sm" style="border-radius: 8px; padding: 5px; width: 42px; height: 42px;">
                                <img src="assets/img/logo-bmkg.png" alt="BMKG" style="height: 100%; width: 100%; object-fit: contain;">
                            </div>
                            <div class="brand-title">BMKG Kelas 1<br><span style="font-size: 11px; font-weight: normal; color: #a0aec0;">Kabupaten Sleman</span></div>
                        </div>

                        <div class="nav mt-2">
                            <!-- MENU UTAMA -->
                            <div class="sb-sidenav-menu-heading text-muted" style="font-size: 10px;">MENU UTAMA</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-th-large text-light"></i></div>
                                Dashboard Ringkasan
                            </a>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-folder-open text-success"></i></div>
                                Administrasi BMKG
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-paper-plane text-info"></i></div>
                                Surat Keluar
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-inbox text-warning"></i></div>
                                Surat Masuk
                            </a>
                            <a class="nav-link" href="laporan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-bar text-primary"></i></div>
                                Laporan Statistik
                            </a>

                            <!-- MENU INFORMASI -->
                            <div class="sb-sidenav-menu-heading text-muted" style="font-size: 10px;">INFORMASI</div>
                            
                            <!-- Menu Profil Aktif -->
                            <a class="nav-link active" href="profil.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-info-circle text-primary"></i></div>
                                Profil BMKG
                            </a>
                            
                            <a class="nav-link" href="https://www.bmkg.go.id/" target="_blank">
                                <div class="sb-nav-link-icon"><i class="fas fa-globe text-success"></i></div>
                                Web BMKG
                            </a>
                            <a class="nav-link" href="https://inatews.bmkg.go.id/wrs/index.html" target="_blank">
                                <div class="sb-nav-link-icon"><i class="fas fa-satellite-dish text-warning"></i></div>
                                Web WRS BMKG
                            </a>

                            <!-- AKUN -->
                            <div class="sb-sidenav-menu-heading text-muted" style="font-size: 10px;">AKUN</div>
                            <a class="nav-link text-danger" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt text-danger"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small text-muted">Logged in as:</div>
                        <span class="font-weight-bold" style="font-size: 12px; color: #e2e8f0;"><?= $_SESSION['email']; ?></span>
                    </div>
                </nav>
            </div>

            <!-- KONTEN UTAMA HALAMAN -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 py-4">
                        <h1 class="mt-2 font-weight-bold text-dark" style="font-size: 26px;">Profil BMKG Sleman</h1>
                        <ol class="breadcrumb mb-4 p-3 shadow-sm">
                            <li class="breadcrumb-item active font-weight-bold text-success"><i class="fas fa-info-circle mr-2"></i> Informasi lengkap dan sejarah Stasiun Geofisika Kelas I Sleman.</li>
                        </ol>

                        <div class="card shadow-sm mb-4" style="border-radius: 12px; border: none;">
                            <div class="card-header py-3 bg-white" style="border-bottom: 2px solid #008751; border-radius: 12px 12px 0 0;">
                                <h6 class="m-0 font-weight-bold" style="color: #008751;">Stasiun Geofisika Kelas I Sleman</h6>
                            </div>
                            <div class="card-body p-4">
                                
                                <!-- 1. Bagian Carousel (Foto Bergulir) -->
                                <div id="carouselKantorBMKG" class="carousel slide mb-5 shadow-sm" data-ride="carousel" style="border-radius: 12px; overflow: hidden; background-color: #eee;">
                                    <div class="carousel-inner" style="max-height: 450px;">
                                        <div class="carousel-item active">
                                            <img src="assets/img/kantor1.jpg" class="d-block w-100" alt="Kantor BMKG Sleman 1" style="object-fit: cover; height: 450px;">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/img/kantor2.jpg" class="d-block w-100" alt="Kantor BMKG Sleman 2" style="object-fit: cover; height: 450px;">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/img/kantor3.jpg" class="d-block w-100" alt="Kantor BMKG Sleman 3" style="object-fit: cover; height: 450px;">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/img/kantor4.jpg" class="d-block w-100" alt="Kantor BMKG Sleman 4" style="object-fit: cover; height: 450px;">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/img/kantor5.jpg" class="d-block w-100" alt="Kantor BMKG Sleman 5" style="object-fit: cover; height: 450px;">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-target="#carouselKantorBMKG" data-slide="prev" style="border: none; background: transparent;">
                                        <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: rgba(0,0,0,0.6); border-radius: 50%; padding: 20px;"></span>
                                        <span class="sr-only">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-target="#carouselKantorBMKG" data-slide="next" style="border: none; background: transparent;">
                                        <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: rgba(0,0,0,0.6); border-radius: 50%; padding: 20px;"></span>
                                        <span class="sr-only">Next</span>
                                    </button>
                                </div>

                                <!-- 2. Bagian Sejarah BMKG -->
                                <div class="mb-5 px-2">
                                    <h4 class="font-weight-bold mb-4" style="color: #2c3e50; border-left: 5px solid #008751; padding-left: 15px;">Sejarah BMKG</h4>
                                    <div class="text-muted" style="line-height: 1.8; font-size: 1.05rem; text-align: justify;">
                                        <p>Sejarah pengamatan meteorologi dan geofisika di Indonesia dimulai pada tahun 1841 diawali dengan pengamatan yang dilakukan secara perorangan oleh Dr. Onnen, Kepala Rumah Sakit di Bogor. Tahun demi tahun kegiatannya berkembang sesuai dengan semakin diperlukannya data hasil pengamatan cuaca dan geofisika.</p>
                                        <p>Pada masa pendudukan Jepang antara tahun 1942 sampai dengan 1945, nama instansi meteorologi dan geofisika diganti menjadi <em>Kisho Kauso Kusho</em>. Setelah proklamasi kemerdekaan Indonesia pada tahun 1945, instansi tersebut dipecah menjadi dua yaitu Biro Meteorologi dan Badan Geofisika, yang kemudian disatukan kembali dan mengalami berbagai perubahan nomenklatur di bawah berbagai departemen.</p>
                                        <p>Terakhir, melalui Peraturan Presiden Nomor 61 Tahun 2008, BMG berganti nama menjadi <strong>Badan Meteorologi, Klimatologi, dan Geofisika (BMKG)</strong> dengan status tetap sebagai Lembaga Pemerintah Non Departemen.</p>
                                    </div>
                                </div>

                                <!-- 3. Bagian Informasi Kontak -->
                                <div class="p-4 p-md-5 shadow-sm" style="background-color: #0f172a; color: white; border-radius: 12px;">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 text-center mb-4 mb-md-0 pb-4 pb-md-0" style="border-right: 1px solid rgba(255,255,255,0.1);">
                                            <div class="bg-white d-inline-flex justify-content-center align-items-center shadow-sm mb-2" style="border-radius: 15px; padding: 15px;">
                                                <img src="assets/img/logo-bmkg.png" alt="Logo BMKG" style="width: 100px; height: auto;">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-8 pl-md-5">
                                            <h6 class="text-uppercase font-weight-bold mb-4" style="color: #94a3b8; letter-spacing: 1px;">Kontak Kami</h6>
                                            <ul class="list-unstyled m-0" style="font-size: 1.05rem; line-height: 1.6;">
                                                <li class="mb-4 d-flex align-items-start">
                                                    <i class="fas fa-map-marker-alt mt-1 mr-4 text-center" style="font-size: 1.4rem; width: 25px; color: #008751;"></i>
                                                    <span>Jl. Wates KM. 8, Jitengan, Balecatur, Kec. Gamping,<br>Kabupaten Sleman, Daerah Istimewa Yogyakarta 55295</span>
                                                </li>
                                                <li class="mb-4 d-flex align-items-center">
                                                    <i class="fas fa-phone mr-4 text-center" style="font-size: 1.3rem; width: 25px; color: #008751;"></i>
                                                    <span>(0274) 6498383</span>
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <i class="fas fa-envelope mr-4 text-center" style="font-size: 1.3rem; width: 25px; color: #008751;"></i>
                                                    <span>stageof.sleman@bmkg.go.id</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </main>

                <!-- FOOTER -->
                <footer class="py-4 bg-white mt-auto border-top">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; BMKG Kelas 1 Sleman 2026</div>
                            <div>
                                <a href="#" class="text-success">Privacy Policy</a>
                                &middot;
                                <a href="#" class="text-success">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- SCRIPT JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>