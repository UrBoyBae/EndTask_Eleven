<?php

require 'ceklogin.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Aplikasi Pendataan Es</title>
    <link href="assets/img/icon3.png" rel="shortcut icon">
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

<body class="sb-nav-fixed f1">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg1">
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-lg-0 ms-4" id="sidebarToggle"><i class="fas fa-bars" style="font-size: 18px"></i></button>

        <!-- Navbar Brand-->
        <a class="navbar-brand mt-auto ms-2" href="index.php">
            <h4>DIVAS Company</h4>
        </a>
        <!-- Sidebar Toggle-->
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading text-white">
                            <h6>MENU</h6>
                        </div>

                        <a class="nav-link icon1 mb-2 " href="index.php" title="pengiriman">
                            <div class="sb-nav-link-icon"><i class="fas fa-shipping-fast" style="font-size: 18px"></i></div>
                            Pengiriman
                        </a>

                        <a class="nav-link icon1 mb-2" href="stock.php" title="barang">
                            <div class="sb-nav-link-icon"><i class="fas fa-archive" style="font-size: 18px"></i></div>
                            Barang
                        </a>

                        <a class="nav-link icon1 mt-3" href="logout.php" title="logout">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out" style="font-size: 18px"></i></div>
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 mb-4">Data Pengiriman</h1>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <button type="button" class="btn bgnav1 text-white mb-3" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fas fa-shipping-fast me-1" style="font-size: 18px"></i>
                                Pengiriman Baru
                            </button>
                        </div>


                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Data Pengiriman Bulanan
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Bulan Ke-</th>
                                            <th>Awal Pengiriman</th>
                                            <th>Barang Yang Dikirim</th>
                                            <th>Total Hari</th>
                                            <th>Total Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $get = mysqli_query($c, "select * from pengiriman p, produk pr where p.idbarang=pr.idbarang");
                                        $i = 1;

                                        while ($b = mysqli_fetch_array($get)) {
                                            $bulanke = $b['idbulan'];
                                            $tanggal = $b['tanggal'];
                                            $namabarang = $b['namabarang'];
                                            $harga = $b['harga'];

                                            // Hitung Total Hari
                                            $hitunghari = mysqli_query($c, "select * from detailpengiriman where idbulan ='$bulanke'");
                                            $totalhari = mysqli_num_rows($hitunghari);

                                            // Hitung Total Harga
                                            $getqty = mysqli_query($c, "select sum(qty) as jumlahqty from detailpengiriman where idbulan='$bulanke' ");
                                            $qty = mysqli_fetch_array($getqty); // Simpan Data qty dlm var
                                            $totalharga = $qty['jumlahqty'] * $harga; // Harga Perbulan

                                        ?>

                                            <tr>
                                                <td><?= $bulanke; ?></td>
                                                <td><?= $tanggal; ?></td>
                                                <td><?= $namabarang; ?> - Rp. <?= number_format($harga); ?></td>
                                                <td><?= $totalhari ?> Hari</td>
                                                <td>Rp. <?= number_format($totalharga) ?></td>
                                                <td><a href="view.php?bulan=<?= $bulanke ?>" class="btn btn-warning text-white mx-2 my-2"><i class="fas fa-eye me-1"></i> View</a>
                                                    <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#delete<?= $bulanke; ?>"><i class="fas fa-trash-alt me-1"></i>
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Modal Delete -->
                                            <div class="modal fade" id="delete<?= $bulanke; ?>">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Data Bulan Ke-<?= $bulanke; ?></h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <form method="post">

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                Apakah Anda Yakin Ingin Menghapus data pengiriman Ini ?
                                                                <input type="hidden" name="idbulan" value="<?= $bulanke; ?>">
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="submit" name="hapusbulan" class="btn bgnav1 text-white" data-bs-dismiss="modal">Yakin</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                        } // End of array
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-3 mt-auto">
                <div class="container-fluid px-4">
                    <div class="float-end align-items-center justify-content-between small">
                        <div class="text-black">
                            <h6>Copyright &copy; DIVAS Company 2022</h6>
                        </div>
                    </div>
                </div>
        </div>
        </footer>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pengiriman Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="post">

                <!-- Modal body -->
                <div class="modal-body">
                    Bulan
                    <input type="text" name="bulan" class="form-control mt-2 mb-2" placeholder="Bulan Ke">

                    Pilih Barang
                    <select name="idbarang" class="form-select mt-2">
                        <?php
                        $getbarang = mysqli_query($c, "select * from produk");

                        while ($b = mysqli_fetch_array($getbarang)) {
                            $idbarang = $b['idbarang'];
                            $namabarang = $b['namabarang'];
                            $harga = $b['harga'];
                        ?>

                            <option value="<?= $idbarang; ?>"><?= $namabarang ?> - Rp. <?= number_format($harga); ?></option>

                        <?php
                        } // End of while
                        ?>
                    </select>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="pengirimanbaru" class="btn bgnav1 text-white" data-bs-dismiss="modal">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </form>

        </div>
    </div>
</div>


</html>