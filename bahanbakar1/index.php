<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menghitung harga dan konsep OOP</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Menghitung Harga Pembelian Bahan Bakar</h2>
        <form id="bahanBakarForm" action="" method="post">
            <div class="mb-3">
                <label for="liter" class="form-label">Masukan jumlah liter pembelian</label>
                <input type="number" class="form-control" name="liter" id="liter" required>
            </div>
            <div class="mb-3">
                <label for="jenis" class="form-label">Pilih jenis bahan bakar</label>
                <select name="jenis" class="form-select" id="jenis" required>
                    <option value="SSuper">Shell Super</option>
                    <option value="SVPower">Shell V-Power</option>
                    <option value="SVPowerDiesel">Shell V-Power Diesel</option>
                    <option value="SVPowerNitro">Shell V-Power Nitro</option>
                </select>
            </div>
            <button type="submit" name="beli" class="btn btn-success">Beli</button>
            <button type="button" onclick="resetForm()" class="btn btn-danger">Hapus</button>
        </form>
        <div id="output" class="mt-4">
            <?php
            // panggil file nya
            require "logic.php";
            // baru dibuka langsung set harga
            $logic = new Pembelian();
            $logic->setHarga(10000, 15000, 18000, 20000);
            // kalau udah fixs beli, jalankan
            if (isset($_POST['beli'])) {
                $logic->jenisYangDipilih = $_POST['jenis'];
                $logic->totalLiter = $_POST['liter'];
                $logic->totalHarga();
                $logic->cetakBukti();
            }
            ?>
        </div>
        <button id="printButton" onclick="printReceipt()" class="btn btn-primary mt-3" style="display:none;">Print</button>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function resetForm() {
            document.getElementById('bahanBakarForm').reset();
            document.getElementById('output').innerHTML = '';
            document.getElementById('printButton').style.display = 'none';
        }
        function printReceipt() {
            var printContents = document.getElementById('output').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;

            window.location.reload();
        }
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (isset($_POST['beli'])): ?>
            document.getElementById('printButton').style.display = 'block';
            <?php endif; ?>
        });
    </script>
</body>
</html>
