<?php
session_start();

// Fungsi untuk menambahkan data siswa ke dalam session
function tambahSiswa($nama, $nis, $kelas) {
    if (!isset($_SESSION['siswa'])) {
        $_SESSION['siswa'] = array();
    }
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
        // Reindex array to avoid undefined index errors
        $_SESSION['siswa'] = array_values($_SESSION['siswa']);
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
    if(isset($_SESSION['siswa']) && !empty($_SESSION['siswa'])) {
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
            echo "<td class='action-buttons'>";
            // Tombol Hapus dan Edit berada dalam satu form agar bisa diatur posisi dan style-nya
            echo "<form method='post' class='d-inline-block'>";
            echo "<input type='hidden' name='index' value='$index'>";
            echo "<button type='submit' class='btn btn-danger' name='hapus'>Hapus</button>";
            echo "</form>";
            echo "<form method='post' class='d-inline-block ms-2'>";
            echo "<input type='hidden' name='edit_index' value='$index'>";
            echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editModal$index'>Edit</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p class='text-center'>Belum ada data siswa.</p>";
    }
}

// Proses edit data jika tombol edit ditekan
function tampilkanEditModal() {
    if (isset($_SESSION['siswa'])) {
        foreach ($_SESSION['siswa'] as $index => $siswa) {
            echo "
            <div class='modal fade' id='editModal$index' tabindex='-1' aria-labelledby='editModalLabel$index' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='editModalLabel$index'>Edit Data Siswa</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <form method='post'>
                                <input type='hidden' name='edit_index' value='$index'>
                                <div class='mb-3'>
                                    <label for='nama$index' class='form-label'>Nama</label>
                                    <input type='text' class='form-control' id='nama$index' name='nama' value='{$siswa['nama']}' required>
                                </div>
                                <div class='mb-3'>
                                    <label for='nis$index' class='form-label'>NIS</label>
                                    <input type='text' class='form-control' id='nis$index' name='nis' value='{$siswa['nis']}' required>
                                </div>
                                <div class='mb-3'>
                                    <label for='kelas$index' class='form-label'>Kelas</label>
                                    <input type='text' class='form-control' id='kelas$index' name='kelas' value='{$siswa['kelas']}' required>
                                </div>
                                <button type='submit' class='btn btn-primary' name='update'>Simpan Perubahan</button>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Batal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            ";
        }
    }
}

// Proses update data jika form edit disubmit
if(isset($_POST['update'])) {
    $edit_index = $_POST['edit_index'];
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    // Lakukan update data sesuai dengan nilai yang baru di-submit
    $_SESSION['siswa'][$edit_index]['nama'] = $nama;
    $_SESSION['siswa'][$edit_index]['nis'] = $nis;
    $_SESSION['siswa'][$edit_index]['kelas'] = $kelas;
}

// Variabel untuk pesan peringatan
$warning_message = "";

// Proses penambahan data jika form disubmit
if(isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    if(empty($nama) || empty($nis) || empty($kelas)) {
        $warning_message = "Semua kolom harus diisi!";
    } else {
        tambahSiswa($nama, $nis, $kelas);
    }
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
                            <form method="post">
                                <?php
                                // Menampilkan pesan peringatan jika ada
                                if (!empty($warning_message)) {
                                    echo "<div class='alert alert-warning' role='alert'>$warning_message</div>";
                                }
                                // Menampilkan data siswa setelah form disubmit
                                tampilkanSiswa();
                                // Menampilkan modal edit
                                tampilkanEditModal();
                                ?>
                                <label for="nama">Nama:</label><br>
                                <input type="text" id="nama" name="nama" class="form-control"><br>
                                <label for="nis">NIS:</label><br>
                                <input type="text" id="nis" name="nis" class="form-control"><br>
                                <label for="kelas">Rayon:</label><br>
                                <input type="text" id="kelas" name="kelas" class="form-control"><br><br>
                                <input type="submit" class="btn btn-success" name="submit" value="Tambah Data">
                            </form>
                            <!-- Form untuk menghapus semua data siswa -->
                            <form method="post" class="mt-3">
                                <button type="submit" class="btn btn-danger" name="hapus_semua">Hapus Semua Data Siswa</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
