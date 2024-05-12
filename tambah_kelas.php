<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Tambah Kelas</title>
</head>
<body>
    <div class="container">
        <h3>Tambah Kelas</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="mb-3">
                <label for="nama_kelas" class="form-label">Nama Kelas:</label>
                <input type="text" name="nama_kelas" value="" class="form-control">
            </div>
            <div class="mb-3">
                <label for="kelompok" class="form-label">Kelompok:</label>
                <input type="text" name="kelompok" value="" class="form-control">
            </div>
            <input type="submit" name="simpan" value="Tambah Kelas" class="btn btn-primary">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <?php
    if($_POST){
        // Ambil data dari formulir
        $nama_kelas = $_POST['nama_kelas'];
        $kelompok = $_POST['kelompok'];

        // Validasi data
        if(empty($nama_kelas)){
            echo "<script>alert('Nama kelas tidak boleh kosong');history.back();</script>";
            exit;
        } elseif(empty($kelompok)){
            echo "<script>alert('Kelompok tidak boleh kosong');history.back();</script>";
            exit;
        }

        // Sisipkan koneksi
        $koneksi = mysqli_connect('localhost','root','','mudrot');
        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Koneksi gagal: %s\n", mysqli_connect_error());
            exit();
        }

        // Siapkan query untuk memasukkan data ke dalam database
        $query = "INSERT INTO kelas (nama_kelas, kelompok) VALUES ('$nama_kelas', '$kelompok')";

        // Eksekusi query
        $result = mysqli_query($koneksi, $query);

        // Periksa apakah query berhasil dieksekusi
        if($result){
            echo "<script>alert('Sukses menambahkan kelas');window.location.href='tambah_kelas.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan kelas');history.back();</script>";
        }

        // Tutup koneksi
        mysqli_close($koneksi);
    }
    ?>
</body>
</html>
