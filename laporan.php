<?php
require 'function.php';
require 'cek.php';

// Mengambil tahun filter (default tahun sekarang atau dari parameter GET)
$tahun_pilih = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

// Inisialisasi array data bulanan (12 bulan)
$masuk_bulanan = array_fill(0, 12, 0);
$keluar_bulanan = array_fill(0, 12, 0);

$total_masuk_tahun = 0;
$total_keluar_tahun = 0;

// Ambil data dari database tabel 'administrasi bmkg sleman'
$query = mysqli_query($conn, "SELECT * FROM `administrasi bmkg sleman`");
while($row = mysqli_fetch_array($query)){
    $tgl_surat = $row['Tanggal Surat']; // Format: YYYY-MM-DD
    $jenis = strtolower(trim($row['Jenis Surat'])); // 'masuk' atau 'keluar'
    $banyak = isset($row['Banyak Surat']) ? (int)$row['Banyak Surat'] : 1;

    if(!empty($tgl_surat)){
        $tahun_data = date('Y', strtotime($tgl_surat));
        
        // Filter sesuai tahun yang dipilih
        if($tahun_data == $tahun_pilih){
            $bulan_index = (int)date('n', strtotime($tgl_surat)) - 1; // 0 sampai 11

            if($jenis == 'masuk'){
                $masuk_bulanan[$bulan_index] += $banyak;
                $total_masuk_tahun += $banyak;
            } elseif($jenis == 'keluar'){
                $keluar_bulanan[$bulan_index] += $banyak;
                $total_keluar_tahun += $banyak;
            }
        }
    }
}

// Hitung rata-rata per bulan
$rata_masuk = round($total_masuk_tahun / 12, 1);
$rata_keluar = round($total_keluar_tahun / 12, 1);

// Ubah array data bulanan menjadi string format JSON untuk JavaScript Grafik
$json_masuk = json_encode(array_values($masuk_bulanan));
$json_keluar = json_encode(array_values($keluar_bulanan));
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Laporan Statistik - BMKG Kelas 1 Sleman</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
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
            .btn-primary {
                background-color: #008751;
                border-color: #007443;
                border-radius: 6px;
            }
            .btn-primary:hover {
                background-color: #006c41;
                border-color: #005634;
            }
            .card {
                border: none;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            }
            .card-header {
                background-color: #ffffff;
                border-bottom: 1px solid #edf2f7;
                padding: 20px;
                border-top-left-radius: 12px !important;
                border-top-right-radius: 12px !important;
            }

            /* --- EFEK ANIMASI TIMBUL / HOVER PADA KARTU STATISTIK --- */
            .stat-card {
                border: none;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
                transition: transform 0.25s ease, box-shadow 0.25s ease;
                cursor: pointer;
            }
            .stat-card:hover, .stat-card:active {
                transform: translateY(-6px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
            }
            .border-left-primary {
                border-left: 4px solid #007bff !important;
            }
            .border-left-success {
                border-left: 4px solid #28a745 !important;
            }

            /* Efek Blur Modal */
            .modal-backdrop {
                background-color: rgba(0, 0, 0, 0.2) !important;
            }
            .modal-backdrop.show {
                opacity: 1 !important;
                backdrop-filter: blur(8px) !important;
                -webkit-backdrop-filter: blur(8px) !important;
            }
            @media print {
                .sb-topnav, #layoutSidenav_nav, .btn, .card-header select {
                    display: none !important;
                }
                #layoutSidenav_content {
                    margin-left: 0 !important;
                }
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
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
                            <!-- Menu Laporan Statistik -->
                            <a class="nav-link active" href="laporan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-bar text-primary"></i></div>
                                Laporan Statistik
                            </a>

                            <!-- MENU INFORMASI -->
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

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 py-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h1 class="font-weight-bold text-dark mb-1" style="font-size: 24px;">Laporan Statistik Persuratan</h1>
                                <p class="text-muted small mb-0">Pantau jumlah volume surat masuk dan keluar terintegrasi secara grafik.</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <select class="form-control form-control-sm mr-2" style="width: 110px;" onchange="location = this.value;">
                                    <option value="laporan.php?tahun=2026" <?=($tahun_pilih=='2026')?'selected':'';?>>Tahun 2026</option>
                                    <option value="laporan.php?tahun=2025" <?=($tahun_pilih=='2025')?'selected':'';?>>Tahun 2025</option>
                                </select>
                                <button onclick="window.print()" class="btn btn-primary btn-sm shadow-sm px-3 py-2"><i class="fas fa-print mr-1"></i> Cetak Laporan</button>
                            </div>
                        </div>

                        <!-- Info Cards dengan Efek Animasi Hover/Timbul -->
                        <div class="row">
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card stat-card border-left-primary h-100 py-2">
                                    <div class="card-body">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Volume Surat Masuk Setahun</div>
                                        <div class="h3 mb-0 font-weight-bold text-gray-800"><?=$total_masuk_tahun;?> Surat</div>
                                        <div class="text-muted small mt-2">Rata-rata per bulan: <?=$rata_masuk;?> Surat</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card stat-card border-left-success h-100 py-2">
                                    <div class="card-body">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Volume Surat Keluar Setahun</div>
                                        <div class="h3 mb-0 font-weight-bold text-gray-800"><?=$total_keluar_tahun;?> Surat</div>
                                        <div class="text-muted small mt-2">Rata-rata per bulan: <?=$rata_keluar;?> Surat</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Grafik Card -->
                        <div class="card mb-4">
                            <div class="card-header font-weight-bold text-dark">Grafik Volume Bulanan Surat Masuk vs Surat Keluar (<?=$tahun_pilih;?>)</div>
                            <div class="card-body">
                                <canvas id="myBarChart" width="100%" height="35"></canvas>
                                <div class="text-center mt-3">
                                    <span class="badge badge-primary px-2 py-1 mr-2">&nbsp;</span> Surat Masuk
                                    <span class="badge badge-success px-2 py-1 ml-3 mr-2">&nbsp;</span> Surat Keluar
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Rincian Bulanan -->
                        <div class="card mb-4">
                            <div class="card-header font-weight-bold text-dark">Rincian Volume Persuratan Bulanan</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>BULAN</th>
                                                <th class="text-center">SURAT MASUK</th>
                                                <th class="text-center">SURAT KELUAR</th>
                                                <th class="text-center">TOTAL VOLUME</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $bulan_arr = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
                                            
                                            for($i = 0; $i < 12; $i++){
                                                $sm = $masuk_bulanan[$i];
                                                $sk = $keluar_bulanan[$i];
                                                $tot = $sm + $sk;
                                            ?>
                                            <tr>
                                                <td><?=$bulan_arr[$i];?></td>
                                                <td class="text-center text-primary font-weight-bold"><?=$sm;?></td>
                                                <td class="text-center text-success font-weight-bold"><?=$sk;?></td>
                                                <td class="text-center font-weight-bold"><?=$tot;?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script>
            // Menerima data dari PHP untuk Chart.js
            var dataMasuk = <?=$json_masuk;?>;
            var dataKeluar = <?=$json_keluar;?>;

            var ctx = document.getElementById("myBarChart");
            var myLineChart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des"],
                datasets: [{
                  label: "Surat Masuk",
                  backgroundColor: "#007bff",
                  borderColor: "#007bff",
                  data: dataMasuk,
                }, {
                  label: "Surat Keluar",
                  backgroundColor: "#28a745",
                  borderColor: "#28a745",
                  data: dataKeluar,
                }],
              },
              options: {
                scales: {
                  xAxes: [{
                    gridLines: { display: false },
                    ticks: { maxTicksLimit: 12 }
                  }],
                  yAxes: [{
                    ticks: { min: 0, maxTicksLimit: 5, beginAtZero: true },
                    gridLines: { display: true }
                  }]
                },
                legend: { display: false }
              }
            });
        </script>
    </body>
</html>