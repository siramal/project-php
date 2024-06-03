<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Motor Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            background-image: linear-gradient(to bottom right, #ffcccc, #ff6666);
            background-size: cover;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 600px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .btn-submit {
            min-width: 120px;
        }
        .btn-action {
            min-width: 100px;
        }
        #printArea {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-primary:hover {
            background-color: #c82333;
            border-color: #c82333;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #545b62;
            border-color: #545b62;
        }
        .btn-danger {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-danger:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Rental Motor Form</h2>
        <form action="index.php" method="post" id="rentalForm">
            <div class="form-group">
                <label for="member" class="form-label">Nama Member:</label>
                <input type="text" class="form-control" id="member" name="member" required>
            </div>

            <div class="form-group">
                <label for="jenis" class="form-label">Jenis Motor:</label>
                <select class="form-select" id="jenis" name="jenis" required>
                    <option value="Scooter">Scooter</option>
                    <option value="Sport">Sport</option>
                    <option value="SportTouring">Sport Touring</option>
                    <option value="Cross">Cross</option>
                </select>
            </div>

            <div class="form-group">
                <label for="waktu" class="form-label">Durasi Sewa (hari):</label>
                <input type="number" class="form-control" id="waktu" name="waktu" min="1" value="1" required>
            </div>

            <button type="submit" class="btn btn-primary btn-submit me-2">Submit</button>
            <button type="button" class="btn btn-secondary btn-action me-2" onclick="printOutput()">Print</button>
            <button type="button" class="btn btn-danger btn-action" onclick="clearOutput()">Hapus</button>
        </form>

        <div id="printArea">
            <?php
            // Include the class definition
            include 'execute.php';

            // Check if form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Create instance of Rental class
                $rental = new Rental();

                // Assign form data to object properties
                $rental->member = $_POST['member'];
                $rental->jenis = $_POST['jenis'];
                $rental->waktu = $_POST['waktu'];

                // Set harga for each type of motor
                $rental->setHarga(200000, 300000, 400000, 500000);

                // Display payment details
                $rental->pembayaran();
            }
            ?>
        </div>

        <script>
            function printOutput() {
                var printContents = document.getElementById('printArea').innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }

            function clearOutput() {
                document.getElementById('printArea').innerHTML = '';
            }
        </script>
    </div>
</body>
</html>
