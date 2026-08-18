<?php
require 'function.php';

// 1. Cek session taruh di paling atas
if(isset($_SESSION['log'])){
    header('location:index.php');
    exit; // Wajib tambahkan exit setelah header location
}

// Cek login apakah terdaftar atau tidak
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Mencocokkan dengan database, mencari ada atau tidak datanya
    $cekdatabase = mysqli_query($conn, "SELECT * FROM login where email ='$email' and password='$password'");
    
    // Menghitung jumlah datanya
    $hitung = mysqli_num_rows($cekdatabase);

    if($hitung > 0){
        $_SESSION['log'] = 'True';
        $_SESSION['email'] = $email; // <-- Menyimpan email user ke dalam session agar bisa dipanggil di sidebar
        header('location:index.php');
        exit; // Wajib tambahkan exit
    } else {
        echo "<script>
                alert('Akun belum terdaftar! Silakan daftar terlebih dahulu.');
                window.location.href='register.php'; 
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Login - E-Persuratan BMKG</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            body {
                background-color: #f4f7f6;
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0;
            }
            .login-card {
                border: none;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
                max-width: 900px;
                width: 100%;
            }
            .left-side {
                background: #ffffff;
                padding: 40px 30px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
            }
            /* Sisi kanan diubah menjadi warna Hijau BMKG */
            .right-side {
                background: #008751;
                color: #ffffff;
                padding: 50px 40px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            .form-control-custom {
                border-radius: 8px;
                padding: 10px 15px;
                height: 45px;
                font-size: 14px;
                border: none;
                width: 100%;
            }
            .btn-masuk {
                background: #ffffff;
                color: #008751;
                font-weight: bold;
                border-radius: 8px;
                padding: 11px;
                border: none;
                transition: 0.2s;
            }
            .btn-masuk:hover {
                background: #e2e6ea;
                color: #00663d;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card login-card">
                        <div class="row gutters">
                            <!-- Sisi Kiri: Logo BMKG & Ilustrasi Surat -->
                            <div class="col-md-6 left-side">
                                <div class="mb-3">
                                    <img src="assets/img/logo-bmkg.png" alt="Logo BMKG" style="max-width: 80px;" onerror="this.src='logo-bmkg.png'">
                                </div>
                                <div class="mb-3">
                                    <img src="assets/img/ilustrasi-surat.png" alt="Ilustrasi Surat" style="max-width: 170px;" onerror="this.src='ilustrasi-surat.png'">
                                </div>
                                <h4 class="font-weight-bold text-dark mb-1" style="font-size: 20px;">E-Persuratan BMKG</h4>
                                <p class="text-muted small mb-0">Sistem Arsip Persuratan BMKG Terpadu</p>
                            </div>

                            <!-- Sisi Kanan: Form Login (Nuansa Hijau BMKG & Putih) -->
                            <div class="col-md-6 right-side">
                                <h3 class="font-weight-bold mb-1" style="font-size: 22px;">Masuk ke Akun Anda</h3>
                                <p class="small text-light mb-4">Gunakan akun terdaftar Anda untuk mengelola surat masuk & keluar.</p>
                                
                                <form method="post">
                                    <div class="form-group mb-3">
                                        <label class="small mb-1 font-weight-bold">Email atau Username</label>
                                        <input class="form-control-custom" name="email" type="email" placeholder="Email atau Username" required />
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="small mb-1 font-weight-bold">Password</label>
                                        <input class="form-control-custom" name="password" type="password" placeholder="Password" required />
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mb-4 mt-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="tetapMasuk">
                                            <label class="custom-control-label small text-white" for="tetapMasuk" style="cursor: pointer;">Tetap Masuk</label>
                                        </div>
                                        <a class="small text-white" href="#" style="text-decoration: none;">Lupa Username / Password?</a>
                                    </div>
                                    <button class="btn btn-masuk btn-block shadow-sm" name="login">Masuk</button>
                                </form>

                                <div class="text-center mt-4">
                                    <p class="small mb-0 text-white-50">Belum punya akun? <a href="register.php" class="text-white font-weight-bold" style="text-decoration: none;">Daftar di sini</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>