<?php
session_start();

$dataBarang = isset($_SESSION['data_barang']) ? $_SESSION['data_barang'] : [];
$totalHarga = isset($_SESSION['total_harga']) ? $_SESSION['total_harga'] : 0;
$nominalUang = isset($_SESSION['nominal_uang']) ? $_SESSION['nominal_uang'] : 0;
$kembalian = $nominalUang - $totalHarga;

// Generate transaction number
$transactionNumber = rand(1000000, 9999999);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Bukti Pembayaran</h1>
        <div class="mb-3">
            <p><strong>No. Transaksi:</strong> #<?php echo $transactionNumber; ?></p>
            <p><strong>Bulan, tanggal:</strong> <?php echo date('F d, Y'); ?></p>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataBarang as $barang): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($barang['nama_barang']); ?></td>
                        <td><?php echo 'Rp ' . number_format($barang['harga'], 0, ',', '.'); ?></td>
                        <td><?php echo $barang['jumlah']; ?></td>
                        <td><?php echo 'Rp ' . number_format($barang['total'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="mb-3">
            <p><strong>Uang Yang Dibayarkan:</strong> Rp <?php echo number_format($nominalUang, 0, ',', '.'); ?></p>
            <p><strong>Total:</strong> Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></p>
            <p><strong>Kembalian:</strong> Rp <?php echo number_format($kembalian, 0, ',', '.'); ?></p>
        </div>
        <p class="text-center">Terima kasih telah berbelanja di toko <strong>Kamal</strong></p>
    </div>
</body>
</html>
