<?php
require 'function.php';
require 'cek.php';

// --- LOGIKA DASHBOARD ---
// 1. Total Surat Masuk
$queryMasuk = mysqli_query($conn, "SELECT COUNT(*) as total FROM `administrasi bmkg sleman` WHERE `Jenis Surat` = 'masuk'");
$dataMasuk = mysqli_fetch_assoc($queryMasuk);
$totalMasuk = $dataMasuk['total'] ?? 0;

// 2. Total Surat Keluar
$queryKeluar = mysqli_query($conn, "SELECT COUNT(*) as total FROM `administrasi bmkg sleman` WHERE `Jenis Surat` = 'keluar'");
$dataKeluar = mysqli_fetch_assoc($queryKeluar);
$totalKeluar = $dataKeluar['total'] ?? 0;

// 3. Kategori Surat
$queryKategori = mysqli_query($conn, "SELECT COUNT(DISTINCT `Jenis Surat`) as total FROM `administrasi bmkg sleman`");
$dataKategori = mysqli_fetch_assoc($queryKategori);
$totalKategori = $dataKategori['total'] ?? 0;

// 4. Aktivitas Surat Terbaru (Ambil 5 data terakhir)
$queryTerbaru = mysqli_query($conn, "SELECT * FROM `administrasi bmkg sleman` ORDER BY `Nomor` DESC LIMIT 5");
$totalSemua = $totalMasuk + $totalKeluar;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Dashboard Ringkasan - BMKG Kelas 1 Sleman</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            /* TEMA ASLI DIPERTAHANKAN */
            .sb-topnav.navbar { background-color: #008751 !important; }
            .sb-sidenav-dark { background-color: #1a252f !important; }
            .sb-sidenav-dark .sb-sidenav-menu .nav-link { color: rgba(255, 255, 255, 0.8); }
            .sb-sidenav-dark .sb-sidenav-menu .nav-link:hover { color: #ffffff; background-color: rgba(0, 135, 81, 0.3); }
            .sb-sidenav-dark .sb-sidenav-menu .nav-link.active { color: #ffffff; background-color: #008751; }
            
            .brand-container { display: flex; align-items: center; padding: 15px 20px; background: #141c24; }
            .brand-title { font-size: 14px; font-weight: bold; color: #ffffff; line-height: 1.2; }

            /* KUSTOMISASI KARTU DASHBOARD DENGAN EFEK TIMBUL (HOVER & ACTIVE) */
            .dash-card {
                border: none;
                border-radius: 12px;
                color: white;
                padding: 24px;
                position: relative;
                overflow: hidden;
                box-shadow: 0 4px 15px rgba(0,0,0,0.05);
                cursor: pointer;
                transition: transform 0.25s ease, box-shadow 0.25s ease;
            }

            .dash-card:hover, .dash-card:active {
                transform: translateY(-6px);
                box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            }

            .dash-card-blue { background: #2f80ed; }
            .dash-card-green { background: #27ae60; }
            .dash-card-purple { background: #8e44ad; }
            
            .dash-card h4 { font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 10px; opacity: 0.9; }
            .dash-card h2 { font-size: 38px; font-weight: 800; margin-bottom: 15px; }
            .dash-card p { font-size: 12px; margin: 0; opacity: 0.8; }
            .dash-card .icon-bg { position: absolute; right: 10px; bottom: -15px; font-size: 90px; opacity: 0.15; }

            .panel-card {
                background: #ffffff;
                border-radius: 12px;
                border: 1px solid #edf2f7;
                padding: 20px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
                height: 100%;
            }
            .panel-title { font-size: 15px; font-weight: 700; color: #333; margin-bottom: 20px; }
            
            /* PROGRESS BAR */
            .progress-group { margin-bottom: 15px; }
            .progress-label { display: flex; justify-content: space-between; font-size: 12px; font-weight: 700; color: #4a5568; margin-bottom: 5px; }
            .progress-sub { font-size: 11px; color: #a0aec0; margin-top: 4px; }
            .progress { height: 8px; border-radius: 4px; background-color: #edf2f7; }

            /* LIST AKTIVITAS TERBARU */
            .activity-item { border-bottom: 1px solid #edf2f7; padding: 12px 0; }
            .activity-item:last-child { border-bottom: none; padding-bottom: 0; }
            .activity-title { font-size: 13px; font-weight: bold; color: #2f80ed; text-decoration: none; }
            .activity-title:hover { text-decoration: underline; }
            .activity-meta { font-size: 11px; color: #718096; margin-top: 5px; line-height: 1.4; }
            .badge-eml { font-size: 9px; background-color: #f1f5f9; color: #4a5568; border: 1px solid #cbd5e0; border-radius: 4px; padding: 2px 6px; }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark">
            <button class="btn btn-link btn-sm order-1 order-lg-0 ml-2" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <a class="navbar-brand ml-2 font-weight-bold" href="dashboard.php" style="font-size: 16px;">BMKG Kelas 1 Sleman</a>
            
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
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <!-- BAGIAN LOGO -->
                        <div class="brand-container">
                            <div class="bg-white d-flex justify-content-center align-items-center mr-2 shadow-sm" style="border-radius: 8px; padding: 5px; width: 42px; height: 42px;">
                                <img src="assets/img/logo-bmkg.png" alt="BMKG" style="height: 100%; width: 100%; object-fit: contain;">
                            </div>
                            <div class="brand-title">BMKG Kelas 1<br><span style="font-size: 11px; font-weight: normal; color: #a0aec0;">Kabupaten Sleman</span></div>
                        </div>

                        <div class="nav mt-2">
                            <div class="sb-sidenav-menu-heading text-muted" style="font-size: 10px;">MENU UTAMA</div>
                            
                            <a class="nav-link active" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-th-large text-white"></i></div>
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

                            <div class="sb-sidenav-menu-heading text-muted" style="font-size: 10px;">INFORMASI</div>
                            
                            <a class="nav-link" href="profil.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-info-circle text-primary"></i></div>
                                Profil BMKG
                            </a>
                            <a class="nav-link" href="https://pelayanan-bmkg.koyeb.app/#layanan" target="_blank">
                                <div class="sb-nav-link-icon"><i class="fas fa-globe text-success"></i></div>
                                Web Pelayanan BMKG
                            </a>
                            <a class="nav-link" href="http://192.168.1.3/bmkg/" target="_blank">
                                <div class="sb-nav-link-icon"><i class="fas fa-satellite-dish text-warning"></i></div>
                                Web BMKG Sleman
                            </a>

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

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 py-4">
                        <h1 class="font-weight-bold text-dark m-0" style="font-size: 24px;">Dashboard Ringkasan</h1>
                        <p class="text-muted small mt-1 mb-4">Analisis ringkas dan rekam aktivitas persuratan BMKG terpadu.</p>
                        
                        <!-- KARTU STATISTIK DENGAN EFEK KLIK/TIMBUL -->
                        <div class="row mb-4">
                            <div class="col-xl-4 col-md-6 mb-3 mb-xl-0">
                                <div class="dash-card dash-card-blue">
                                    <h4>TOTAL SURAT MASUK</h4>
                                    <h2><?= $totalMasuk; ?></h2>
                                    <p><i class="fas fa-chart-line mr-1"></i> Arsip surat masuk terdaftar</p>
                                    <i class="fas fa-inbox icon-bg"></i>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 mb-3 mb-xl-0">
                                <div class="dash-card dash-card-green">
                                    <h4>TOTAL SURAT KELUAR</h4>
                                    <h2><?= $totalKeluar; ?></h2>
                                    <p><i class="fas fa-chart-line mr-1"></i> Arsip surat keluar terdaftar</p>
                                    <i class="fas fa-envelope-open-text icon-bg"></i>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 mb-3 mb-xl-0">
                                <div class="dash-card dash-card-purple">
                                    <h4>KATEGORI SURAT</h4>
                                    <h2><?= $totalKategori; ?></h2>
                                    <p><i class="fas fa-chart-line mr-1"></i> Jenis format persuratan</p>
                                    <i class="fas fa-file-alt icon-bg"></i>
                                </div>
                            </div>
                        </div>

                        <!-- PANEL DATA -->
                        <div class="row">
                            <!-- PANEL KIRI -->
                            <div class="col-lg-5 mb-4">
                                <div class="panel-card">
                                    <h5 class="panel-title">Rasio Kategori Persuratan</h5>
                                    
                                    <div class="progress-group">
                                        <div class="progress-label">
                                            <span>Laporan Teknis (LT)</span>
                                            <span>0 Surat (0%)</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 0%"></div>
                                        </div>
                                        <div class="progress-sub">Masuk: 0 &nbsp;&nbsp; Keluar: 0</div>
                                    </div>

                                    <div class="progress-group">
                                        <div class="progress-label">
                                            <span>Surat Tugas (ST)</span>
                                            <span>0 Surat (0%)</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 0%"></div>
                                        </div>
                                        <div class="progress-sub">Masuk: 0 &nbsp;&nbsp; Keluar: 0</div>
                                    </div>

                                    <div class="progress-group">
                                        <div class="progress-label">
                                            <span>Semua Surat Terdata</span>
                                            <span><?= $totalSemua; ?> Surat (100%)</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                                        </div>
                                        <div class="progress-sub">Masuk: <?= $totalMasuk; ?> &nbsp;&nbsp; Keluar: <?= $totalKeluar; ?></div>
                                    </div>
                                </div>
                            </div>

                            <!-- PANEL KANAN -->
                            <div class="col-lg-7 mb-4">
                                <div class="panel-card">
                                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                                        <h5 class="panel-title m-0">Aktivitas Surat Terbaru</h5>
                                        <div class="d-none d-sm-block">
                                            <span class="text-primary small font-weight-bold mr-3"><i class="fas fa-envelope mr-1"></i> MASUK</span>
                                            <span class="text-success small font-weight-bold"><i class="fas fa-paper-plane mr-1"></i> KELUAR</span>
                                        </div>
                                    </div>

                                    <div class="activity-list">
                                        <?php 
                                        if(mysqli_num_rows($queryTerbaru) > 0) {
                                            while($row = mysqli_fetch_array($queryTerbaru)){
                                                $isMasuk = strtolower($row['Jenis Surat']) == 'masuk';
                                                $iconClass = $isMasuk ? 'fa-envelope text-primary' : 'fa-paper-plane text-success';
                                                $pengirim = isset($row['CP Pengirim Surat']) && $row['CP Pengirim Surat'] != '' ? $row['CP Pengirim Surat'] : 'Tidak diketahui';
                                                $asal = isset($row['Asal Surat']) && $row['Asal Surat'] != '' ? $row['Asal Surat'] : 'Tidak ada keterangan';
                                        ?>
                                        <div class="activity-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="#" class="activity-title text-truncate pr-2">
                                                    <?= htmlspecialchars($row['Nomor Surat']); ?>
                                                </a>
                                                <span class="badge-eml font-weight-bold"><?= strtoupper($row['Jenis Surat']); ?></span>
                                            </div>
                                            <div class="activity-meta">
                                                <span>Dari/Kepada: "<?= htmlspecialchars($asal); ?>" &lt;<?= htmlspecialchars($pengirim); ?>&gt;</span><br>
                                                <strong class="text-dark d-inline-block mt-1">
                                                    <i class="fas <?= $iconClass; ?> mr-1"></i> <?= htmlspecialchars($row['Deskripsi Surat']); ?>
                                                </strong>
                                            </div>
                                        </div>
                                        <?php 
                                            } 
                                        } else {
                                            echo '<div class="text-center text-muted small py-4">Tidak ada rekam aktivitas surat terbaru.</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </main>
                
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

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>