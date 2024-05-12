<?php
// Periksa apakah parameter id_siswa tersedia
if(isset($_GET['id_siswa']) && is_numeric($_GET['id_siswa'])){
    // Sisipkan koneksi
    include "koneksi.php";

    // Ambil id_siswa dari parameter URL
    $id_siswa = $_GET['id_siswa'];

    // Siapkan query untuk menghapus data siswa dari database
    $query = "DELETE FROM siswa WHERE id_siswa = $id_siswa";

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    // Periksa apakah query berhasil dieksekusi
    if($result){
        // Redirect kembali ke tampil_siswa.php setelah data dihapus
        header("Location: tampil_siswa.php");
        exit;
    } else {
        // Jika query gagal dieksekusi, tampilkan pesan kesalahan
        echo "Gagal menghapus data siswa.";
    }

    // Tutup koneksi
    mysqli_close($koneksi);
} else {
    // Jika parameter id_siswa tidak tersedia atau tidak valid, tampilkan pesan kesalahan
    echo "Parameter id_siswa tidak valid.";
}
?>
