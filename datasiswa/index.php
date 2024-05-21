<?php
session_start();

// Fungsi untuk menambahkan data siswa ke dalam session
function tambahSiswa($nama, $nis, $kelas) {
    $_SESSION['siswa'][] = array(
        'nama' => $nama,
        'nis' => $nis,
        'kelas' => $kelas
    );
}

// Fungsi untuk menghapus data siswa dari session berdasarkan indeks
function hapusSiswa($index) {
    if(isset($_SESSION['siswa'][$index])) {
        unset($_SESSION['siswa'][$index]);
    }
}

// Fungsi untuk menghapus semua data siswa dari session
function hapusSemuaSiswa() {
    if(isset($_SESSION['siswa'])) {
        unset($_SESSION['siswa']);
    }
}

// Fungsi untuk menampilkan data siswa dari session
function tampilkanSiswa() {
    if(isset($_SESSION['siswa'])) {
        echo "<h2>Data Siswa:</h2>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered'>";
        echo "<thead class='thead-light'>";
        echo "<tr><th>Nama</th><th>NIS</th><th>Kelas</th><th>Aksi</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach($_SESSION['siswa'] as $index => $siswa) {
            echo "<tr>";
            echo "<td>".$siswa['nama']."</td>";
            echo "<td>".$siswa['nis']."</td>";
            echo "<td>".$siswa['kelas']."</td>";
            echo "<td>
                    <form method='post'>
                        <input type='hidden' name='index' value='$index'>
                        <button type='submit' class='btn btn-danger' name='hapus'>Hapus</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p class='text-center'>Belum ada data siswa.</p>";
    }
}

// Proses penambahan data jika form disubmit
if(isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    tambahSiswa($nama, $nis, $kelas);
}

// Proses penghapusan data jika tombol hapus ditekan
if(isset($_POST['hapus'])) {
    $index = $_POST['index'];
    hapusSiswa($index);
}

// Proses penghapusan semua data siswa jika tombol hapus semua ditekan
if(isset($_POST['hapus_semua'])) {
    hapusSemuaSiswa();
}

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <title>Data Siswa</title>
</head>
<body class="bg-dark px-5">
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 600px;">
        <div class="col-10">
            <div class="card bg-info">
                <div class="card-body">
                    <div class="row my-3">
                        <div class="col-12 text-center">
                            <h1>Formulir Data Siswa</h1>
                            <!-- Form untuk menghapus semua data siswa -->
                            <form method="post" class="mb-3">
                                <button type="submit" class="btn btn-danger" name="hapus_semua">Hapus Semua Data Siswa</button>
                            </form>
                            <form method="post">
                                <?php
                                // Menampilkan data siswa setelah form disubmit
                                tampilkanSiswa();
                                ?>
                                <label for="nama">Nama:</label><br>
                                <input type="text" id="nama" name="nama"><br>
                                <label for="nis">NIS:</label><br>
                                <input type="text" id="nis" name="nis"><br>
                                <label for="kelas">Rayon:</label><br>
                                <input type="text" id="kelas" name="kelas"><br><br>
                                <input type="submit" class="btn btn-success" name="submit" value="Tambah Data">
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
