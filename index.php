<?php
        $operator=null;
        $keterangan=null;
        if(isset($_POST['submit'])) {
            $number1 = $_POST['number1'];
            $number2 = $_POST['number2'];

            if($number1 == $number2) {
                $keterangan = " <h2>$number1 sama dengan $number2</h2>";
                $operator = "=";
            } elseif($number1 > $number2) {
                $keterangan = "<h2>$number1 lebih besar dari $number2</h2>";
                $operator = ">";
            } else {
                $keterangan = "<h2>$number1 lebih kecil dari $number2</h2>";
                $operator = "<";
            }
        } elseif(isset($_POST['hapus'])){
            $operator=null;
            $keterangan=null;
            $number1 = null;
            $number2 = null;
        }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">

    <title>asdf</title>
  </head>
  <body class=" bg-dark px-5">
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 600px;">
                <div class="col-10">
                    <div class="card bg-info">
                        <div class="card-body">
                            <div class="row my-3">
                                <div class="col-12 text-center ">
                                    <p><?php echo "<h1 class='text-warning'>$operator</h1>";?></p>
                                    <p><?php  echo "$keterangan";?></p>
                                    <h3>cek perbandingan angka</h3>
                                    <form method="post" >
                                        <div class="row justify-content-center pt-3">
                                            <div class="col-lg-4 ">
                                                <input type="number" class="form-control fw-bold" name="number1" placeholder="angka pertama" value="<?php echo $number1;?>" required>
                                            </div>
                                            <div class="col-lg-4 ">
                                                <input type="number" class="form-control fw-bold" name="number2" placeholder="angka kedua" value="<?php echo $number2;?>" required>
                                            </div>
                                            <div class="col-lg-2">
                                                <button class="btn btn-primary" name="submit">kirim</button>
                                            </div>
                                            <div class="col-lg-2">
                                                <button class="btn btn-danger" name="hapus">hapus</button>
                                            </div>
                                        </div>
                                        
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
