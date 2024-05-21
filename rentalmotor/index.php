<!DOCTYPE html>
<html>
<head>
    <title>Form Pembelian Bahan Bakar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <style>
        body {
            background-image: url(https://img.freepik.com/free-photo/rider-motorbike-road-riding-having-fun-driving-empty-road_1150-10701.jpg?t=st=1714117479~exp=1714121079~hmac=185d59d7e67d27aadb91f2efaf617597ad);
            background-repeat:no-repeat;
            background-position:center;
            background-size:cover;
        }
        .container{
            background-image: url(https://img.freepik.com/free-photo/rider-motorbike-road-riding-having-fun-driving-empty-road_1150-10701.jpg?t=st=1714117479~exp=1714121079~hmac=185d59d7e67d27aadb91f2efaf617597ad);
            background-repeat:no-repeat;
            background-position:center;
            background-size:cover;
        }

    </style>
     <?php
    if (isset($_POST['submit'])) {
        // Handle form submission here
        $namaPelanggan = $_POST['nama'];
        $jenisMotor = $_POST['motor'];
        $durasiSewa = $_POST['durasi'];

        // Lakukan apa yang ingin dilakukan setelah form disubmit, misalnya hitung biaya sewa
        // Untuk contoh, kita hanya menampilkan data yang di-submit

    }
    ?>
               
        <body>
        <div class="col-6 container">
            <div class="row justify-content-center align-items-center" style="height: 600px;">
                <div class="col-12">
                    <div>
                        <div class="card-body">
                            <div class="row my-3">
                                <div class="col-12 text-center ">
                                <p>
                                    <?php 
                                      if (isset($_POST["submit"])){
                                        echo "<h3>Data yang Anda masukkan:</h3>";
                                        echo "Nama Pelanggan: " . $namaPelanggan . "<br>";
                                        echo "Jenis Motor: " . $jenisMotor . "<br>";
                                        echo "Durasi Sewa: " . $durasiSewa . " hari<br>";
                                      }
                                    ?>
                                </p>
                               
                                <h2>Form Rental Motor</h2>
    <form method="post">
        <p>Pembelian Bahan Bakar</p>
        <label for="nama">Nama Pelanggan:</label><br>
        <input type="text" id="nama" name="nama"><br>
        
        <label for="motor">Jenis Motor:</label><br>
        <select id="motor" name="motor">
            <option value="Supra X">Supra X</option>
            <option value="Beat">Beat</option>
            <option value="Vario">Vario</option>
            <option value="NMAX">NMAX</option>
        </select><br>
        
        <label for="durasi">Durasi Sewa (hari):</label><br>
        <input type="number" id="durasi" name="durasi" min="1"><br>
        
        <button type="submit" name="submit">Submit</button>
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
