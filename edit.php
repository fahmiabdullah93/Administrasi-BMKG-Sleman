<?php
require 'function.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data lama berdasarkan ID
$data = query("SELECT * FROM administrasi_bmkg_sleman WHERE Nomor = '$id'")[0];

// Cek apakah tombol submit edit ditekan
if (isset($_POST['ubahdata'])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah atau tidak ada perubahan!');
                document.location.href = 'index.php';
              </script>";
    }
}
?>

<!-- Form Edit HTML -->
<form action="" method="POST">
    <!-- Hidden input untuk menyimpan ID agar tahu baris mana yang diupdate -->
    <input type="hidden" name="nomor" value="<?= $data['Nomor']; ?>">

    <div class="mb-3">
        <label>Tindak Lanjut Datin</label>
        <input type="text" name="tindak_lanjut" value="<?= htmlspecialchars($data['Tindak_Lanjut_Datin']); ?>" required>
    </div>
    
    <div class="mb-3">
        <label>CP Pengirim</label>
        <input type="text" name="cp_pengirim" value="<?= htmlspecialchars($data['CP_Pengirim']); ?>" required>
    </div>

    <!-- Tambahkan field lain sesuai kolom database Anda -->

    <button type="submit" name="ubahdata">Simpan Perubahan</button>
</form>