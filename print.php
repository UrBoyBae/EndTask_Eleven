<?php

require 'ceklogin.php';

function convertMonthAndDay($date) {
    $convertDayToString = array('0' => 'Minggu', '1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat', '6' => 'Sabtu');
    $convertMonthToString = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
    
    $explode_tanggal = explode(" ", $date);
    $arr_tanggal = explode("-", $explode_tanggal[0]);
    $get_hari = $convertDayToString[date('w', strtotime($explode_tanggal[0]))];
    $get_bulan = $convertMonthToString[$arr_tanggal[1]];

    return $get_hari.", ".$arr_tanggal[2]." ".$get_bulan." ".$arr_tanggal[0];
} 

if (isset($_GET['bulan'])) {
    $idb = $_GET['bulan'];
} else {
    header('location: index.php');
}

// Total es yang dikirim
$jumlah = mysqli_query($c, "select sum(qty) as jumlah FROM detailpengiriman where idbulan='$idb'"); // Menjumlahkan qty
$total = mysqli_fetch_array($jumlah); // Menyimpan hasil query ke variabel $total

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Data Pengiriman Bulan Ke-<?= $idb ?></title>
    <link href="assets/img/icon3.png" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/styles2.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>
    <script>
        window.print();
    </script>

    <div class="text-center float p-0">
        <div class="row justify-content-center">
            <div class="mt-4">
                <center>
                    <h2>DIVAS Company</h2>
                    <p>GBR 3 Blok A4 No.38</p>
                </center>

                <div class="mb-4"></div>
                <div class="pull-right float-end card-body text-end">
                    <h5>Total Barang Terkirim : <?= ($total['jumlah']); ?> Buah</h5>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Hari Ke-</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Status Pengiriman</th>
                            <th>Qty</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $get = mysqli_query($c, "select * from detailpengiriman dp INNER JOIN produk pr ON dp.idbarang=pr.idbarang LEFT JOIN pengirim pg ON dp.idpengirim=pg.idpengirim where idbulan='$idb' ORDER BY tanggal ASC");
                        $i = 1;

                        while ($b = mysqli_fetch_array($get)) {
                            $idh = $b['idhari'];
                            $namabarang = $b['namabarang'];
                            $harga = $b['harga'];
                            $qty = $b['qty'];
                            $subtotal = $qty * $harga;
                            $tanggal = convertMonthAndDay($b['tanggal']);
                            $status_pengiriman = ($b['flag_libur'] == 1 ? "Libur" : "Melakukan Pengiriman");

                            // Hitung Total Harga
                            $getqty = mysqli_query($c, "select sum(qty) as jumlahqty from detailpengiriman where idbulan='$idb' ");
                            $qtysum = mysqli_fetch_array($getqty); // Simpan Data qty dlm var
                            $totalharga = $qtysum['jumlahqty'] * $harga; // Harga Perbulan
                        ?>

                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $tanggal; ?></td>
                                <td><?= $namabarang; ?> - Rp. <?= number_format($harga); ?></td>
                                <td><?= $status_pengiriman ?></td>
                                <td><?= number_format($qty) ?> Buah</td>
                            </tr>

                        <?php
                        } // End of array
                        ?>

                    </tbody>

                </table>


            </div>
        </div>
    </div>
    </div>
</body>

</html>