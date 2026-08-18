<?php
require 'function.php';

if(isset($_SESSION['log'])){
    header('location:index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Register - E-Persuratan BMKG</title>
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
            .register-card {
                border: none;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
                max-width: 650px;
                width: 100%;
                background: #ffffff;
            }
            .card-header-custom {
                background: #ffffff;
                border-bottom: 1px solid #eaeaea;
                padding: 25px 30px;
                text-align: center;
            }
            .card-body-custom {
                padding: 35px 40px;
            }
            .form-control-custom {
                border-radius: 8px;
                padding: 10px 15px;
                height: 45px;
                font-size: 14px;
                border: 1px solid #ced4da;
                width: 100%;
            }
            .btn-daftar {
                background: #008751;
                color: #ffffff;
                font-weight: bold;
                border-radius: 8px;
                padding: 12px;
                border: none;
                transition: 0.2s;
            }
            .btn-daftar:hover {
                background: #00663d;
                color: #ffffff;
            }
            .card-footer-custom {
                background: #fafbfc;
                border-top: 1px solid #eaeaea;
                padding: 20px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="card register-card">
                        <div class="card-header-custom">
                            <h3 class="font-weight-bold mb-0" style="font-size: 22px; color: #333333;">Daftar Akun Baru</h3>
                            <p class="text-muted small mb-0 mt-1">E-Persuratan BMKG Terpadu</p>
                        </div>
                        <div class="card-body-custom">
                            <form method="post">
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label class="small mb-1 font-weight-bold">First Name</label>
                                        <input class="form-control-custom" name="firstname" type="text" placeholder="Masukkan nama depan" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="small mb-1 font-weight-bold">Last Name</label>
                                        <input class="form-control-custom" name="lastname" type="text" placeholder="Masukkan nama belakang" required />
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="small mb-1 font-weight-bold">Email</label>
                                    <input class="form-control-custom" name="email" type="email" placeholder="Masukkan email aktif" required />
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label class="small mb-1 font-weight-bold">Password</label>
                                        <input class="form-control-custom" name="password" type="password" placeholder="Buat password" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="small mb-1 font-weight-bold">Confirm Password</label>
                                        <input class="form-control-custom" name="confirmpassword" type="password" placeholder="Ulangi password" required />
                                    </div>
                                </div>
                                <div class="form-group mt-3 mb-0">
                                    <button class="btn btn-daftar btn-block shadow-sm" name="register">Daftar Sekarang</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer-custom">
                            <div class="small">
                                <span class="text-muted">Sudah punya akun?</span> <a href="login.php" class="font-weight-bold" style="color: #008751; text-decoration: none;">Login di sini!</a>
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