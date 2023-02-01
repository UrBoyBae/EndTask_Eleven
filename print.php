<?php

require 'ceklogin.php';


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

<body class="f1">
    <script>
        window.print();
    </script>

    <div class="container text-center float p-0">
        <div class="row justify-content-center">
            <div class="col-sm-7 mt-4">
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
                            <th>Qty</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $get = mysqli_query($c, "select * from detailpengiriman dp, produk pr where dp.idbarang=pr.idbarang and idbulan='$idb'");
                        $i = 1;

                        while ($b = mysqli_fetch_array($get)) {
                            $idh = $b['idhari'];
                            $namabarang = $b['namabarang'];
                            $harga = $b['harga'];
                            $qty = $b['qty'];
                            $subtotal = $qty * $harga;
                            $tanggal = $b['tanggal'];

                            // Hitung Total Harga
                            $getqty = mysqli_query($c, "select sum(qty) as jumlahqty from detailpengiriman where idbulan='$idb' ");
                            $qtysum = mysqli_fetch_array($getqty); // Simpan Data qty dlm var
                            $totalharga = $qtysum['jumlahqty'] * $harga; // Harga Perbulan
                        ?>

                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $tanggal; ?></td>
                                <td><?= $namabarang; ?> - Rp. <?= number_format($harga); ?></td>
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