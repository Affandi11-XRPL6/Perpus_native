<?php
// Periksa apakah request adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah parameter id_siswa tersedia
    if(isset($_POST['id_siswa']) && is_numeric($_POST['id_siswa'])){
        // Sisipkan koneksi
        include "koneksi.php";

        // Ambil data dari formulir
        $id_siswa = $_POST['id_siswa'];
        $nama_siswa = $_POST['nama_siswa'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $gender = $_POST['gender'];
        $alamat = $_POST['alamat'];
        $id_kelas = $_POST['id_kelas'];

        // Siapkan query untuk memperbarui data siswa di database
        $query = "UPDATE siswa SET nama_siswa='$nama_siswa', tanggal_lahir='$tanggal_lahir', gender='$gender', alamat='$alamat', id_kelas='$id_kelas' WHERE id_siswa='$id_siswa'";

        // Eksekusi query
        $result = mysqli_query($koneksi, $query);

        // Periksa apakah query berhasil dieksekusi
        if($result){
            // Redirect kembali ke tampil_siswa.php setelah perubahan disimpan
            header("Location: tampil_siswa.php");
            exit;
        } else {
            // Jika query gagal dieksekusi, tampilkan pesan kesalahan
            echo "Gagal menyimpan perubahan.";
        }

        // Tutup koneksi
        mysqli_close($koneksi);
    } else {
        // Jika parameter id_siswa tidak tersedia atau tidak valid, tampilkan pesan kesalahan
        echo "Parameter id_siswa tidak valid.";
    }
} else {
    // Jika request bukan POST, tampilkan formulir untuk mengubah data siswa
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <title>Ubah Siswa</title>
    </head>
    <body>
        <div class="container">
            <h3>Ubah Siswa</h3>
            <?php
            // Periksa apakah parameter id_siswa telah diset dan merupakan bilangan bulat
            if(isset($_GET['id_siswa']) && is_numeric($_GET['id_siswa'])){
                // Sisipkan koneksi
                include "koneksi.php";

                // Ambil id_siswa dari parameter URL
                $id_siswa = $_GET['id_siswa'];

                // Query untuk mendapatkan data siswa berdasarkan id_siswa
                $query = "SELECT * FROM siswa WHERE id_siswa = $id_siswa";
                $result = mysqli_query($koneksi, $query);

                // Periksa apakah data siswa ditemukan
                if(mysqli_num_rows($result) == 1){
                    $data_siswa = mysqli_fetch_assoc($result);
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="id_siswa" value="<?php echo $id_siswa; ?>">
                        <div class="mb-3">
                            <label for="nama_siswa" class="form-label">Nama Siswa:</label>
                            <input type="text" name="nama_siswa" value="<?php echo $data_siswa['nama_siswa']; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                            <input type="date" name="tanggal_lahir" value="<?php echo $data_siswa['tanggal_lahir']; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender:</label>
                            <select name="gender" class="form-control">
                                <option value="L" <?php if($data_siswa['gender'] == 'L') echo 'selected'; ?>>Laki-laki</option>
                                <option value="P" <?php if($data_siswa['gender'] == 'P') echo 'selected'; ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat:</label>
                            <textarea name="alamat" class="form-control"><?php echo $data_siswa['alamat']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="id_kelas" class="form-label">Kelas:</label>
                            <select name="id_kelas" class="form-control">
                                <!-- Option kelas bisa diisi dari database atau hard-coded sesuai kebutuhan -->
                                <option value="1" <?php if($data_siswa['id_kelas'] == 1) echo 'selected'; ?>>Kelas A</option>
                                <option value="2" <?php if($data_siswa['id_kelas'] == 2) echo 'selected'; ?>>Kelas B</option>
                                <option value="3" <?php if($data_siswa['id_kelas'] == 3) echo 'selected'; ?>>Kelas C</option>
                            </select>
                        </div>
                        <input type="submit" name="simpan" value="Simpan Perubahan" class="btn btn-primary">
                    </form>
                    <?php
                } else {
                    echo "Data siswa tidak ditemukan.";
                }
            } else {
                echo "Parameter id_siswa tidak valid.";
            }
            ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
}
?>
