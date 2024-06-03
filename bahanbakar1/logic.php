<?php
class DataBahanBakar {
    private $HargaSSuper;
    private $HargaSVPower;
    private $HargaSVPowerDiesel;
    private $HargaSVPowerNitro;
    
    public $jenisYangDipilih;
    public $totalLiter;
    
    protected $totalPembayaran;
    
    public function setHarga($valSSuper, $valSVPower, $valSVPowerDiesel, $valSVPowerNitro) {
        $this->HargaSSuper = $valSSuper;
        $this->HargaSVPower = $valSVPower;
        $this->HargaSVPowerDiesel = $valSVPowerDiesel;
        $this->HargaSVPowerNitro = $valSVPowerNitro;
    }

    public function getHarga() {
        $semuaDataSolar = [
            "SSuper" => $this->HargaSSuper,
            "SVPower" => $this->HargaSVPower,
            "SVPowerDiesel" => $this->HargaSVPowerDiesel,
            "SVPowerNitro" => $this->HargaSVPowerNitro
        ];
        return $semuaDataSolar;
    }
}

class Pembelian extends DataBahanBakar {
    public function totalHarga() {
        $this->totalPembayaran = $this->getHarga()[$this->jenisYangDipilih] * $this->totalLiter;
    }
    
    public function cetakBukti() {
        echo "Jenis Bahan Bakar : " . $this->jenisYangDipilih . "<br>";
        echo "Total Liter : " . $this->totalLiter . "<br>";
        echo "Harga bayar: Rp" . number_format($this->totalPembayaran, 0, ',', '.') . "<br>";
    }
}
?>
