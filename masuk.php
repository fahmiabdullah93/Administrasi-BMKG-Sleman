<?php
require 'function.php';
require 'cek.php';

// Logika Edit Surat Masuk
if(isset($_POST['editsuratmasuk'])){
    $idm = $_POST['idm'];
    $namasurat = $_POST['namasurat'];
    $jumlah = $_POST['jumlah'];
    $penerima = $_POST['penerima'];
    $tanggal = $_POST['tanggal'];

    $update = mysqli_query($conn, "UPDATE `surat masuk` SET 
        `Nama Surat`='$namasurat', 
        `jumlah`='$jumlah', 
        `Penerima`='$penerima', 
        `Tanggal`='$tanggal' 
        WHERE `Nomor Surat`='$idm'");

    if($update){
        echo "<script>alert('Data surat masuk berhasil diubah!'); window.location.href='masuk.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah data surat masuk!'); window.location.href='masuk.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Surat Masuk - BMKG Kelas 1 Sleman</title>
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
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;
            }
            .card-header {
                background-color: #ffffff;
                border-bottom: 1px solid #edf2f7;
                padding: 20px;
                border-top-left-radius: 12px !important;
                border-top-right-radius: 12px !important;
            }
            .breadcrumb {
                background-color: #e8f5e9;
                color: #2e7d32;
                border-left: 4px solid #008751;
                border-radius: 4px;
            }

            /* --- EFEK SHADOW DI BELAKANG TABEL & CONTAINER --- */
            .table-responsive {
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08), 0 1px 8px rgba(0, 0, 0, 0.04);
                background-color: #ffffff;
                padding: 8px;
                margin-bottom: 10px;
            }

            /* --- KUSTOMISASI DESAIN TABEL & KONTROL DATA TABLES --- */
            .table {
                color: #333333;
                margin-bottom: 0 !important;
            }
            .table thead th {
                vertical-align: middle !important;
                text-align: left;
                font-size: 11px;
                font-weight: 700;
                letter-spacing: 0.5px;
                text-transform: uppercase;
                background-color: #fafbfc !important;
                color: #6c757d;
                border-top: none;
                border-bottom: 2px solid #edf2f7;
                padding: 16px 12px;
                white-space: nowrap;
            }
            .table tbody td {
                vertical-align: middle !important;
                font-size: 13px;
                padding: 16px 12px;
                border-top: 1px solid #f8f9fa;
                border-bottom: 1px solid #f8f9fa;
            }
            .table tbody tr:hover {
                background-color: #fafbfc;
            }
            .table td.text-wrap-custom {
                max-width: 180px;
                word-wrap: break-word;
            }

            /* Tata letak kontrol DataTables (Search & Length) agar berdampingan rapi */
            .dataTables_wrapper .row {
                align-items: center;
                margin-bottom: 15px;
            }
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                margin-bottom: 0;
            }
            .dataTables_wrapper .dataTables_filter {
                text-align: right;
            }
            .dataTables_wrapper .dataTables_filter input {
                border: 1px solid #ced4da;
                border-radius: 6px;
                padding: 5px 12px;
                outline: none;
                margin-left: 8px;
            }
            .dataTables_wrapper .dataTables_filter input:focus {
                border-color: #008751;
                box-shadow: 0 0 0 0.2rem rgba(0, 135, 81, 0.25);
            }

            /* Kontainer agar ikon aksi sejajar rapi ke samping */
            .action-container {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 4px;
            }
            .btn-action-icon {
                background: transparent;
                border: none;
                color: #6c757d;
                font-size: 14px;
                padding: 4px 6px;
                transition: color 0.2s ease;
                cursor: pointer;
            }
            .btn-action-icon:hover {
                color: #008751;
            }
            .btn-action-warning:hover {
                color: #ffc107;
            }
            .btn-action-danger:hover {
                color: #dc3545;
            }

            /* --- EFEK BLUR KUAT PADA LATAR BELAKANG MODAL --- */
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
                            <a class="nav-link active" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-inbox text-warning"></i></div>
                                Surat Masuk
                            </a>
                            <a class="nav-link" href="laporan.php">
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
                        <h1 class="mt-2 font-weight-bold text-dark" style="font-size: 26px;">Data Surat Masuk</h1>
                        <ol class="breadcrumb mb-4 p-3 shadow-sm">
                            <li class="breadcrumb-item active font-weight-bold text-success"><i class="fas fa-shield-alt mr-2"></i> Segala bentuk penyebaran data perusahaan akan dipidanakan.</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-primary px-4 py-2 shadow-sm" data-toggle="modal" data-target="#myModal">
                                    <i class="fas fa-plus mr-2"></i> Tambah Surat Masuk
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-middle" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Nama Surat</th>
                                                <th>Tanggal</th>
                                                <th>Penerima</th>
                                                <th>Jumlah</th>
                                                <th>File Berkas</th>
                                                <th width="10%" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ambilsemuadatasuratmasuk = mysqli_query($conn, "select * from `surat masuk`");
                                            $i = 1;
                                            while($data=mysqli_fetch_array($ambilsemuadatasuratmasuk)){
                                                $idm = $data['Nomor Surat']; 
                                                $namasurat = $data['Nama Surat'];
                                                $tanggal = isset($data['Tanggal']) ? $data['Tanggal'] : '-';
                                                $penerima = $data['Penerima'];
                                                $jumlah = $data['jumlah'];
                                                $fileberkas = isset($data['File Surat']) ? $data['File Surat'] : '';
                                            ?>
                                            <tr>
                                                <td class="font-weight-bold text-secondary"><?=$i++;?></td>
                                                <td class="font-weight-bold text-primary text-wrap-custom"><?=$namasurat;?></td>
                                                <td><?=$tanggal;?></td>
                                                <td class="text-wrap-custom"><?=$penerima;?></td>
                                                <td><span class="badge badge-success px-2 py-1 font-weight-normal" style="font-size: 11px;"><?=$jumlah;?> Berkas</span></td>
                                                <td>
                                                    <?php if(!empty($fileberkas)){ ?>
                                                        <a href="file/<?=$fileberkas;?>" target="_blank" class="text-info font-weight-bold small text-decoration-none">
                                                            <i class="fas fa-file-download mr-1"></i> Lihat
                                                        </a>
                                                    <?php } else { ?>
                                                        <span class="text-muted small">Tidak ada</span>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                    <!-- Kontainer Flex agar Ikon Lihat, Edit, dan Hapus Sejajar Rapi -->
                                                    <div class="action-container">
                                                        <?php if(!empty($fileberkas)){ ?>
                                                            <a href="file/<?=$fileberkas;?>" target="_blank" class="btn-action-icon" title="Lihat Berkas">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        <?php } ?>
                                                        
                                                        <!-- Tombol Edit -->
                                                        <button type="button" class="btn-action-icon btn-action-warning" data-toggle="modal" data-target="#editModal<?=$idm;?>" title="Edit Data">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        
                                                        <!-- Tombol Hapus -->
                                                        <button type="button" class="btn-action-icon btn-action-danger" data-toggle="modal" data-target="#deleteModal<?=$idm;?>" title="Hapus Data">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- MODAL EDIT SURAT MASUK -->
                                            <div class="modal fade" id="editModal<?=$idm;?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                                                        <div class="modal-header bg-warning text-white">
                                                            <h5 class="modal-title font-weight-bold"><i class="fas fa-edit mr-2"></i> Edit Surat Masuk</h5>
                                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="post">
                                                            <div class="modal-body p-4 text-left">
                                                                <input type="hidden" name="idm" value="<?=$idm;?>">
                                                                
                                                                <div class="form-group mb-3">
                                                                    <label class="small font-weight-bold text-dark">Nama / Deskripsi Surat</label>
                                                                    <input type="text" name="namasurat" value="<?=$namasurat;?>" class="form-control" required style="border-radius: 8px; height: 45px;">
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label class="small font-weight-bold text-dark">Jumlah Surat</label>
                                                                    <input type="number" name="jumlah" value="<?=$jumlah;?>" class="form-control" required style="border-radius: 8px; height: 45px;">
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label class="small font-weight-bold text-dark">Penerima</label>
                                                                    <input type="text" name="penerima" value="<?=$penerima;?>" class="form-control" required style="border-radius: 8px; height: 45px;">
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label class="small font-weight-bold text-dark">Tanggal Surat</label>
                                                                    <input type="date" name="tanggal" value="<?=$tanggal;?>" class="form-control" required style="border-radius: 8px; height: 45px;">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer bg-light px-4 py-3">
                                                                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                                                                <button type="submit" class="btn btn-warning px-4 text-white" name="editsuratmasuk" style="border-radius: 8px;">Simpan Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Konfirmasi Hapus Surat Masuk -->
                                            <div class="modal fade" id="deleteModal<?=$idm;?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title font-weight-bold"><i class="fas fa-exclamation-triangle mr-2"></i> Hapus Surat Masuk</h5>
                                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="post">
                                                            <div class="modal-body p-4 text-dark text-left">
                                                                Apakah Anda yakin ingin menghapus surat masuk <b><?=$namasurat;?></b> dengan penerima <b><?=$penerima;?></b>?
                                                                <input type="hidden" name="idm" value="<?=$idm;?>">
                                                            </div>
                                                            <div class="modal-footer bg-light px-4 py-3">
                                                                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                                                                <button type="submit" class="btn btn-danger px-4" name="hapusgudangmasuk" style="border-radius: 8px;">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            };
                                            ?>
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
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>

        <!-- The Modal Tambah Surat Masuk -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                    
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-inbox mr-2"></i> Tambah Surat Masuk Baru</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-body p-4 text-left">
                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark">Pilih Jenis / Deskripsi Surat</label>
                                <select name="namasurat" class="form-control" required style="border-radius: 8px; height: 45px;">
                                    <option value="" disabled selected>Pilih deskripsi surat masuk</option>
                                    <?php
                                    $ambilsemuadata = mysqli_query($conn, "SELECT * FROM `administrasi bmkg sleman` WHERE `Jenis Surat` LIKE '%masuk%'");
                                    while($fetcharray = mysqli_fetch_array($ambilsemuadata)){
                                        $deskripsisurat = $fetcharray['Deskripsi Surat'];
                                    ?>
                                    <option value="<?=$deskripsisurat;?>"><?=$deskripsisurat;?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark">Jumlah Surat</label>
                                <input type="number" name="jumlah" class="form-control" placeholder="Masukkan jumlah surat" required style="border-radius: 8px; height: 45px;">
                            </div>
                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark">Penerima</label>
                                <input type="text" name="penerima" class="form-control" placeholder="Masukkan nama penerima" required style="border-radius: 8px; height: 45px;">
                            </div>
                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark">Tanggal Surat</label>
                                <input type="date" name="tanggal" class="form-control" required style="border-radius: 8px; height: 45px;">
                            </div>
                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark">Upload Berkas / File (PDF/Gambar)</label>
                                <input type="file" name="file" class="form-control-file border p-2" style="border-radius: 8px; width: 100%;">
                            </div>
                        </div>
                        
                        <div class="modal-footer bg-light px-4 py-3">
                            <button type="button" class="btn btn-secondary px-4" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                            <button type="submit" class="btn btn-success px-4" name="suratmasuk" style="border-radius: 8px;">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>