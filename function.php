<?php
session_start();

//Membuat koneksi ke database
//Membuat koneksi ke database di InfinityFree
$conn = mysqli_connect("sql106.epizy.com","if0_42467295","Haters93","if0_42467295_administrasibmkg");


//Menambah Barang Baru
if(isset($_POST['addnewsurat'])){
    // Pastikan teks di dalam kurung siku sesuaikan dengan atribut name="" di HTML-mu
    $jenissurat = $_POST['jenissurat'];
    $deskripsisurat = $_POST['deskripsisurat'];
    $banyaksurat = $_POST['banyaksurat'];

    // Perintah Insert
    $query_insert = "INSERT INTO `administrasi bmkg sleman` (`Jenis Surat`, `Deskripsi Surat`, `Banyak Surat`) VALUES ('$jenissurat','$deskripsisurat','$banyaksurat')";
    
    $addtotable = mysqli_query($conn, $query_insert);

    if($addtotable){
        header('location:index.php');
    } else {
        // Baris ini akan memunculkan pesan error asli dari MySQL ke layarmu
        echo "Gagal masuk database! Errornya: " . mysqli_error($conn);
        die(); 
    }
}


//Menambah surat masuk
if(isset($_POST['suratmasuk'])){
    // Pastikan teks di dalam kurung siku sesuaikan dengan atribut name="" di HTML-mu
    $namasurat = $_POST['namasurat'];
    $penerima = $_POST['penerima'];
    $jumlah = $_POST['jumlah'];

    // Perintah Insert
    $query_insert = "INSERT INTO `surat masuk` (`Nama Surat`, `Penerima`, `jumlah`) VALUES ('$namasurat','$penerima','$jumlah')";
    
    $addtotable = mysqli_query($conn, $query_insert);

    if($addtotable){
        header('location:index.php');
    } else {
        // Baris ini akan memunculkan pesan error asli dari MySQL ke layarmu
        echo "Gagal masuk database! Errornya: " . mysqli_error($conn);
        die(); 
    }
}


//Menambah surat keluar
if(isset($_POST['suratkeluar'])){
    // Pastikan teks di dalam kurung siku sesuaikan dengan atribut name="" di HTML-mu
    $namasurat = $_POST['namasurat'];
    $tertuju = $_POST['tertuju'];
    $jumlah = $_POST['jumlah'];

    // Perintah Insert
    $query_insert = "INSERT INTO `surat keluar` (`Nama Surat`, `Tertuju`, `jumlah`) VALUES ('$namasurat','$tertuju','$jumlah')";
    
    $addtotable = mysqli_query($conn, $query_insert);

    if($addtotable){
        header('location:index.php');
    } else {
        // Baris ini akan memunculkan pesan error asli dari MySQL ke layarmu
        echo "Gagal masuk database! Errornya: " . mysqli_error($conn);
        die(); 
    }
}


?>