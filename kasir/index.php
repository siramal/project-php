<?php
session_start();

// Inisialisasi data barang jika belum ada di sesi
if (!isset($_SESSION['data_barang'])) {
    $_SESSION['data_barang'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_index'])) {
        $deleteIndex = $_POST['delete_index'];
        // Hapus barang dari sesi berdasarkan indeks
        unset($_SESSION['data_barang'][$deleteIndex]);
        // Reset array index setelah penghapusan
        $_SESSION['data_barang'] = array_values($_SESSION['data_barang']);
    } else {
        $namaBarang = $_POST['nama_barang'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];
        $total = $harga * $jumlah;

        // Simpan barang ke dalam sesi
        $_SESSION['data_barang'][] = [
            'nama_barang' => $namaBarang,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'total' => $total
        ];
    }
}

// Hitung total barang dan total harga
$totalBarang = 0;
$totalHarga = 0;
foreach ($_SESSION['data_barang'] as $barang) {
    $totalBarang += $barang['jumlah'];
    $totalHarga += $barang['total'];
}

// Simpan total harga ke dalam sesi untuk digunakan di halaman pembayaran
$_SESSION['total_harga'] = $totalHarga;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masukan Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tambahButton').on('click', function() {
                var namaBarang = $('#namaBarang').val();
                var harga = $('#harga').val();
                var jumlah = $('#jumlah').val();

                if (namaBarang === '' || harga === '' || jumlah === '') {
                    alert('Silakan isi semua data barang.');
                    return;
                }

                $.post('index.php', {
                    nama_barang: namaBarang,
                    harga: harga,
                    jumlah: jumlah
                }, function(data) {
                    location.reload();
                });
            });

            $('#listBarangTable').on('click', '.deleteButton', function() {
                var deleteIndex = $(this).data('index');
                $.post('index.php', {
                    delete_index: deleteIndex
                }, function(data) {
                    location.reload();
                });
            });
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Masukan Data Barang</h1>
        <form id="itemForm" class="row g-3">
            <div class="col-md-4">
                <input type="text" id="namaBarang" name="nama_barang" class="form-control" placeholder="Nama barang" required>
            </div>
            <div class="col-md-4">
                <input type="number" id="harga" name="harga" class="form-control" placeholder="Harga" required>
            </div>
            <div class="col-md-4">
                <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" required>
            </div>
            <div class="col-md-12">
                <button type="button" id="tambahButton" class="btn btn-primary">Tambah</button>
            </div>
        </form>

        <h2 class="mt-5">List Barang</h2>
        <table id="listBarangTable" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['data_barang'] as $index => $barang): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($barang['nama_barang']); ?></td>
                        <td><?php echo 'Rp ' . number_format($barang['harga'], 0, ',', '.'); ?></td>
                        <td><?php echo $barang['jumlah']; ?></td>
                        <td><?php echo 'Rp ' . number_format($barang['total'], 0, ',', '.'); ?></td>
                        <td>
                            <button class="btn btn-danger btn-sm deleteButton" data-index="<?php echo $index; ?>">Hapus</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="mt-4">
            <p><strong>Total Barang:</strong> <?php echo $totalBarang; ?></p>
            <p><strong>Total Harga:</strong> <?php echo 'Rp ' . number_format($totalHarga, 0, ',', '.'); ?></p>
        </div>

            <form action="payment.php">
                <button type="submit" class="btn btn-success">Bayar</button>
            </form>
    </div>
</body>
</html>
