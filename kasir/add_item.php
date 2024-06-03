<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namaBarang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $total = $harga * $jumlah;

    // Simpan detail barang dalam session atau database, tergantung implementasi Anda
    $item = [
        'nama_barang' => $namaBarang,
        'harga' => $harga,
        'jumlah' => $jumlah,
        'total' => $total
    ];

    // Simpan dalam session atau tambahkan ke array session barang
    if (!isset($_SESSION['items'])) {
        $_SESSION['items'] = [];
    }
    $_SESSION['items'][] = $item;

    // Hitung total yang harus dibayar
    $totalToPay = 0;
    foreach ($_SESSION['items'] as $item) {
        $totalToPay += $item['total'];
    }
    $_SESSION['total_to_pay'] = $totalToPay;

    // Generate HTML for the new row
    $newRow = "
    <tr>
        <td></td>
        <td>{$namaBarang}</td>
        <td>{$harga}</td>
        <td>{$jumlah}</td>
        <td>{$total}</td>
        <td><button class='btn btn-danger btn-sm' onclick='deleteRow(this)'>Delete</button></td>
    </tr>
    ";

    echo $newRow;
}
?>
