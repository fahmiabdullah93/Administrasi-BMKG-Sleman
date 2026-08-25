<?php
session_start();

//Membuat koneksi ke database lokal (PHPMyAdmin / XAMPP)
$conn = mysqli_connect("localhost", "root", "", "tesapk1");

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}


// 1. BAGIAN ADMINISTRASI BMKG SLEMAN


// Menambah Data Administrasi
if(isset($_POST['addnewsurat'])){
    $tanggalsurat = $_POST['tanggalsurat'];
    $tanggalterima = $_POST['tanggalterima'];
    $nomorsurat = $_POST['nomorsurat'];
    $jenissurat = $_POST['jenissurat'];
    $deskripsisurat = $_POST['deskripsisurat'];
    $asalsurat = $_POST['asalsurat'];
    $banyaksurat = $_POST['banyaksurat'];
    $tindaklanjutkasgeof = $_POST['tindaklanjutkasgeof'];
    $tindaklanjutdatin = $_POST['tindaklanjutdatin'];
    $cppengirim = $_POST['cppengirim'];

    $filename = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    
    if(!empty($filename)){
        $ekstensi_diperbolehkan = array('pdf','doc','docx','jpg','png','jpeg');
        $x = explode('.', $filename);
        $ekstensi = strtolower(end($x));
        $namafilebaru = uniqid() . '-' . $filename;
        
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            move_uploaded_file($file_tmp, 'file/' . $namafilebaru);
            
            $query_insert = "INSERT INTO `administrasi bmkg sleman` (`Tanggal Surat`, `Tanggal Terima Surat`, `Nomor Surat`, `Jenis Surat`, `Deskripsi Surat`, `Asal Surat`, `Banyak Surat`, `Tindak Lanjut KASGEOF`, `Tindak Lanjut Datin Mitigasi`, `CP Pengirim Surat`, `File Surat`, `Status`) VALUES ('$tanggalsurat','$tanggalterima','$nomorsurat','$jenissurat','$deskripsisurat','$asalsurat','$banyaksurat','$tindaklanjutkasgeof','$tindaklanjutdatin','$cppengirim','$namafilebaru', 0)";
            $addtotable = mysqli_query($conn, $query_insert);

            if($addtotable){
                header('location:index.php');
                exit();
            } else {
                echo "Gagal masuk database! Errornya: " . mysqli_error($conn);
                die(); 
            }
        } else {
            echo "<script>
                    alert('Ekstensi file tidak diizinkan! (Gunakan PDF, DOC, atau Gambar)');
                    window.location.href='index.php';
                  </script>";
            exit();
        }
    } else {
        $query_insert = "INSERT INTO `administrasi bmkg sleman` (`Tanggal Surat`, `Tanggal Terima Surat`, `Nomor Surat`, `Jenis Surat`, `Deskripsi Surat`, `Asal Surat`, `Banyak Surat`, `Tindak Lanjut KASGEOF`, `Tindak Lanjut Datin Mitigasi`, `CP Pengirim Surat`, `File Surat`, `Status`) VALUES ('$tanggalsurat','$tanggalterima','$nomorsurat','$jenissurat','$deskripsisurat','$asalsurat','$banyaksurat','$tindaklanjutkasgeof','$tindaklanjutdatin','$cppengirim','', 0)";
        $addtotable = mysqli_query($conn, $query_insert);

        if($addtotable){
            header('location:index.php');
            exit();
        } else {
            echo "Gagal masuk database! Errornya: " . mysqli_error($conn);
            die(); 
        }
    }
}

// Menghapus Data Administrasi
if(isset($_POST['hapuspersuratan'])){
    $idb = $_POST['idb'];

    $get_data = mysqli_query($conn, "SELECT * FROM `administrasi bmkg sleman` WHERE `Nomor`='$idb'");
    $fetch = mysqli_fetch_array($get_data);
    $img = $fetch['File Surat'] ?? '';

    if(!empty($img) && file_exists('file/' . $img)){
        unlink('file/' . $img);
    }

    $query_delete = mysqli_query($conn, "DELETE FROM `administrasi bmkg sleman` WHERE `Nomor`='$idb'");

    if($query_delete){
        header('location:index.php');
        exit();
    } else {
        echo "Gagal menghapus data! Error: " . mysqli_error($conn);
        die();
    }
}

// Mengubah Status Surat (Centang / Silang)
if(isset($_POST['ubahstatus'])){
    $idb = $_POST['idb'];
    $status_sekarang = $_POST['status_sekarang'];
    
    $status_baru = ($status_sekarang == 1) ? 0 : 1;

    $update_status = mysqli_query($conn, "UPDATE `administrasi bmkg sleman` SET `Status`='$status_baru' WHERE `Nomor`='$idb'");

    if($update_status){
        header('location:index.php');
        exit();
    } else {
        echo "Gagal mengubah status! Error: " . mysqli_error($conn);
        die();
    }
}



// 2. BAGIAN SURAT MASUK


// Menambah Surat Masuk
if(isset($_POST['suratmasuk'])){
    $namasurat = $_POST['namasurat'];
    $penerima = $_POST['penerima'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    $filename = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    
    if(!empty($filename)){
        $ekstensi_diperbolehkan = array('pdf','doc','docx','jpg','png','jpeg');
        $x = explode('.', $filename);
        $ekstensi = strtolower(end($x));
        $namafilebaru = uniqid() . '-' . $filename;
        
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            move_uploaded_file($file_tmp, 'file/' . $namafilebaru);
            
            $query_insert = "INSERT INTO `surat masuk` (`Nama Surat`, `Penerima`, `jumlah`, `Tanggal`, `File Surat`) VALUES ('$namasurat','$penerima','$jumlah','$tanggal','$namafilebaru')";
            $addtotable = mysqli_query($conn, $query_insert);

            if($addtotable){
                header('location:masuk.php');
                exit();
            } else {
                echo "Gagal masuk database! Errornya: " . mysqli_error($conn);
                die(); 
            }
        } else {
            echo "<script>
                    alert('Ekstensi file tidak diizinkan! (Gunakan PDF, DOC, atau Gambar)');
                    window.location.href='masuk.php';
                  </script>";
            exit();
        }
    } else {
        $query_insert = "INSERT INTO `surat masuk` (`Nama Surat`, `Penerima`, `jumlah`, `Tanggal`, `File Surat`) VALUES ('$namasurat','$penerima','$jumlah','$tanggal','')";
        $addtotable = mysqli_query($conn, $query_insert);

        if($addtotable){
            header('location:masuk.php');
            exit();
        } else {
            echo "Gagal masuk database! Errornya: " . mysqli_error($conn);
            die(); 
        }
    }
}

// Edit Surat Masuk
if(isset($_POST['editsuratmasuk'])){
    $idm = $_POST['idm'];
    $namasurat = $_POST['namasurat'];
    $jumlah = $_POST['jumlah'];
    $penerima = $_POST['penerima'];
    $tanggal = $_POST['tanggal'];

    $update = mysqli_query($conn, "UPDATE `surat masuk` SET `Nama Surat`='$namasurat', `jumlah`='$jumlah', `Penerima`='$penerima', `Tanggal`='$tanggal' WHERE `Nomor Surat`='$idm'");

    if($update){
        header('location:masuk.php');
        exit();
    } else {
        echo "Gagal mengubah data surat masuk! Error: " . mysqli_error($conn);
        die();
    }
}

// Menghapus Surat Masuk
if(isset($_POST['hapusgudangmasuk'])){
    $idm = $_POST['idm'];

    $get_data = mysqli_query($conn, "SELECT * FROM `surat masuk` WHERE `Nomor Surat`='$idm'");
    $fetch = mysqli_fetch_array($get_data);
    $img = $fetch['File Surat'] ?? '';

    if(!empty($img) && file_exists('file/' . $img)){
        unlink('file/' . $img);
    }

    $query_delete = mysqli_query($conn, "DELETE FROM `surat masuk` WHERE `Nomor Surat`='$idm'");

    if($query_delete){
        header('location:masuk.php');
        exit();
    } else {
        echo "Gagal menghapus data! Error: " . mysqli_error($conn);
        die();
    }
}



// 3. BAGIAN SURAT KELUAR


// Menambah Surat Keluar
if(isset($_POST['suratkeluar'])){
    $namasurat = $_POST['namasurat'];
    $tertuju = $_POST['tertuju'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    $filename = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    
    if(!empty($filename)){
        $ekstensi_diperbolehkan = array('pdf','doc','docx','jpg','png','jpeg');
        $x = explode('.', $filename);
        $ekstensi = strtolower(end($x));
        $namafilebaru = uniqid() . '-' . $filename;
        
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            move_uploaded_file($file_tmp, 'file/' . $namafilebaru);
            
            $query_insert = "INSERT INTO `surat keluar` (`Nama Surat`, `Tertuju`, `jumlah`, `Tanggal`, `File Surat`) VALUES ('$namasurat','$tertuju','$jumlah','$tanggal','$namafilebaru')";
            $addtotable = mysqli_query($conn, $query_insert);

            if($addtotable){
                header('location:keluar.php');
                exit();
            } else {
                echo "Gagal masuk database! Errornya: " . mysqli_error($conn);
                die(); 
            }
        } else {
            echo "<script>
                    alert('Ekstensi file tidak diizinkan! (Gunakan PDF, DOC, atau Gambar)');
                    window.location.href='keluar.php';
                  </script>";
            exit();
        }
    } else {
        $query_insert = "INSERT INTO `surat keluar` (`Nama Surat`, `Tertuju`, `jumlah`, `Tanggal`, `File Surat`) VALUES ('$namasurat','$tertuju','$jumlah','$tanggal','')";
        $addtotable = mysqli_query($conn, $query_insert);

        if($addtotable){
            header('location:keluar.php');
            exit();
        } else {
            echo "Gagal masuk database! Errornya: " . mysqli_error($conn);
            die(); 
        }
    }
}

// Edit Surat Keluar
if(isset($_POST['editsuratkeluar'])){
    $idk = $_POST['idk'];
    $namasurat = $_POST['namasurat'];
    $jumlah = $_POST['jumlah'];
    $tertuju = $_POST['tertuju'];
    $tanggal = $_POST['tanggal'];

    $update = mysqli_query($conn, "UPDATE `surat keluar` SET `Nama Surat`='$namasurat', `jumlah`='$jumlah', `Tertuju`='$tertuju', `Tanggal`='$tanggal' WHERE `Nomor Surat`='$idk'");

    if($update){
        header('location:keluar.php');
        exit();
    } else {
        echo "Gagal mengubah data surat keluar! Error: " . mysqli_error($conn);
        die();
    }
}

// Menghapus Surat Keluar
if(isset($_POST['hapusgudangkeluar'])){
    $idk = $_POST['idk'];

    $get_data = mysqli_query($conn, "SELECT * FROM `surat keluar` WHERE `Nomor Surat`='$idk'");
    $fetch = mysqli_fetch_array($get_data);
    $img = $fetch['File Surat'] ?? '';

    if(!empty($img) && file_exists('file/' . $img)){
        unlink('file/' . $img);
    }

    $query_delete = mysqli_query($conn, "DELETE FROM `surat keluar` WHERE `Nomor Surat`='$idk'");

    if($query_delete){
        header('location:keluar.php');
        exit();
    } else {
        echo "Gagal menghapus data! Error: " . mysqli_error($conn);
        die();
    }
}



// 4. BAGIAN REGISTRASI AKUN

if(isset($_POST['register'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if($password !== $confirmpassword){
        echo "<script>
                alert('Konfirmasi password tidak cocok!');
                window.location.href='register.php';
              </script>";
        exit();
    }

    $cek_email = mysqli_query($conn, "SELECT * FROM `register` WHERE Email = '$email'");
    
    if(mysqli_num_rows($cek_email) > 0){
        echo "<script>
                alert('Email sudah terdaftar, silakan gunakan email lain!');
                window.location.href='register.php';
              </script>";
        exit();
    } else {
        $query_insert_reg = "INSERT INTO `register` (`First Name`, `Last Name`, `Email`, `Password`, `Confirm Password`) VALUES ('$firstname', '$lastname', '$email', '$password', '$confirmpassword')";
        $add_to_register = mysqli_query($conn, $query_insert_reg);

        $query_insert_log = "INSERT INTO `login` (`email`, `password`) VALUES ('$email', '$password')";
        $add_to_login = mysqli_query($conn, $query_insert_log);

        if($add_to_register && $add_to_login){
            echo "<script>
                    alert('Registrasi berhasil! Silakan login.');
                    window.location.href='login.php';
                  </script>";
            exit();
        } else {
            echo "Gagal mendaftarkan akun! Error MySQL: " . mysqli_error($conn);
            die(); 
        }
    }
}
?>