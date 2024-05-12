<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Tambah Siswa</title>
</head>
<body>
    <div class="container">
        <h3>Tambah Siswa</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="mb-3">
                <label for="nama_siswa" class="form-label">Nama Siswa:</label>
                <input type="text" name="nama_siswa" value="" class="form-control">
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" value="" class="form-control">
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <select name="gender" class="form-control">
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat:</label>
                <textarea name="alamat" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="id_kelas" class="form-label">Kelas:</label>
                <select name="id_kelas" class="form-control">
                    <!-- Option kelas bisa diisi dari database atau hard-coded sesuai kebutuhan -->
                    <option value="1">Kelas A</option>
                    <option value="2">Kelas B</option>
                    <option value="3">Kelas C</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" value="" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" value="" class="form-control">
            </div>
            <input type="submit" name="simpan" value="Tambah Siswa" class="btn btn-primary">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <?php
    if($_POST){
        // Ambil data dari formulir
        $nama_siswa = $_POST['nama_siswa'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $gender = $_POST['gender'];
        $alamat = $_POST['alamat'];
        $id_kelas = $_POST['id_kelas'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Gunakan md5 untuk mengenkripsi password

        // Validasi data
        if(empty($nama_siswa) || empty($tanggal_lahir) || empty($gender) || empty($alamat) || empty($id_kelas) || empty($username) || empty($password)){
            echo "<script>alert('Semua field harus diisi');history.back();</script>";
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
        $query = "INSERT INTO siswa (nama_siswa, tanggal_lahir, gender, alamat, id_kelas, username, password) VALUES ('$nama_siswa', '$tanggal_lahir', '$gender', '$alamat', '$id_kelas', '$username', '$password')";

        // Eksekusi query
        $result = mysqli_query($koneksi, $query);

        // Periksa apakah query berhasil dieksekusi
        if($result){
            echo "<script>alert('Sukses menambahkan siswa');window.location.href='tambah_siswa.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan siswa');history.back();</script>";
        }

        // Tutup koneksi
        mysqli_close($koneksi);
    }
    ?>
</body>
</html>
