<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['nominal_uang'] = $_POST['nominal_uang'];
    header('Location: payment_receipt.php');
    exit();
}

$totalHarga = isset($_SESSION['total_harga']) ? $_SESSION['total_harga'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Pembayaran</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nominalUang" class="form-label">Masukan Nominal Uang</label>
                <input type="number" id="nominalUang" name="nominal_uang" class="form-control" required>
            </div>
            <div class="mb-3">
                <p><strong>Total yang harus dibayar:</strong> Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></p>
            </div>
            <button type="submit" class="btn btn-success">Bayar</button>
        </form>
    </div>
</body>
</html>
