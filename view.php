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
    <title>Detail Bulan Ke-<?= $idb ?></title>
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
                    <h1 class="mt-4">Detail Pengiriman</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">
                            <h5>Bulan Ke : <?= $idb ?></h5>
                        </li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">

                            <div class="card bg-light text-black mb-3 me-5">
                                <div class="card-body">Total Barang Terkirim : <?= number_format($total['jumlah']); ?> Buah</div>
                            </div>

                            <button type="button" class="btn bgnav1 text-white mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fas fa-shipping-fast me-1" style="font-size: 18px"></i>
                                Tambah Pengiriman
                            </button>

                            <a href="print.php?bulan=<?= $idb ?>" class="btn bg-secondary text-white mb-4 ms-2" target="_blank">
                                <i class="fas fa-print me-1" style="font-size: 18px"></i>
                                Print</a>

                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Data Pengiriman
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Hari Ke-</th>
                                            <th>Tanggal</th>
                                            <th>Nama Barang</th>
                                            <th>Qty</th>
                                            <th>Sub-Total</th>
                                            <th>Pengirim</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $get = mysqli_query($c, "select * from detailpengiriman dp, produk pr, pengirim pg where dp.idbarang=pr.idbarang and dp.idpengirim=pg.idpengirim and idbulan='$idb'");
                                        $i = 1;

                                        while ($b = mysqli_fetch_array($get)) {
                                            $idh = $b['idhari'];
                                            $namabarang = $b['namabarang'];
                                            $harga = $b['harga'];
                                            $qty = $b['qty'];
                                            $subtotal = $qty * $harga;
                                            $tanggal = $b['tanggal'];
                                            $idpg = $b['idpengirim'];
                                            $namapg = $b['namapengirim'];
                                        ?>

                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $tanggal; ?></td>
                                                <td><?= $namabarang; ?> - Rp. <?= number_format($harga); ?></td>
                                                <td><?= number_format($qty) ?> Buah</td>
                                                <td>Rp. <?= number_format($subtotal) ?></td>
                                                <td><?= $namapg; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning text-white mx-2 my-2" data-bs-toggle="modal" data-bs-target="#edit<?= $idh; ?>"><i class="fas fa-edit me-1"></i>
                                                        Edit
                                                    </button>

                                                    <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#delete<?= $idh; ?>"><i class="fas fa-trash-alt me-1"></i>
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="edit<?= $idh; ?>">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Pengiriman</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <form method="post">

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                Tanggal Pengiriman
                                                                <input type="text" name="tanggal" class="form-control  mt-2 mb-2" placeholder="Tanggal" value="<?= $tanggal; ?>" disabled>

                                                                Nama Barang
                                                                <input type="text" name="namabarang" class="form-control mt-2 mb-2" placeholder="Nama Barang" value="<?= $namabarang; ?> - Rp. <?= number_format($harga); ?>" disabled>

                                                                Jumlah Barang
                                                                <input type="number" name="qty" class="form-control mt-2 mb-2" placeholder="Jumlah" value="<?= $qty; ?>" min="1">
                                                                Jumlah Barang Tambahan
                                                                <input type="number" name="qty2" class="form-control mt-2 mb-2" placeholder="Jumlah" value="0" min="0">
                                                                <input type="hidden" name="idh" value="<?= $idh; ?>">
                                                                <input type="hidden" name="idb" value="<?= $idb ?>">
                                                                <p class="mt-2 mb-2">Nama Pengirim</p>
                                                                <select class="form-select mt-2" aria-label="select-pengirim" name="idpg">
                                                                    <?php
                                                                    // Ambil data pengirim dari tabel pengirim
                                                                    $getdatapengirim = mysqli_query($c, "select * from pengirim");
                                                                    // Simpan data dari $getdata
                                                                    while ($data = mysqli_fetch_array($getdatapengirim)) {
                                                                        $idpengirim = $data['idpengirim'];
                                                                        $namapengirim = $data['namapengirim'];

                                                                        $selected = "";
                                                                        if ($idpengirim == $idpg) {
                                                                            $selected = "selected";
                                                                        }
                                                                    ?>
                                                                        <option <?= $selected ?> value="<?= $idpengirim ?>"><?= $namapengirim ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="submit" name="editpengiriman" class="btn bgnav1 text-white" data-bs-dismiss="modal">Submit</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Delete -->
                                            <div class="modal fade" id="delete<?= $idh; ?>">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Pengiriman</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <form method="post">

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                Apakah Anda Yakin Ingin Menghapus Pengiriman Ini ?
                                                                <input type="hidden" name="idh" value="<?= $idh; ?>">
                                                                <input type="hidden" name="idb" value="<?= $idb ?>">
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="submit" name="hapuspengiriman" class="btn bgnav1 text-white" data-bs-dismiss="modal">Yakin</button>
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

<!-- Modal tambah -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Pengiriman Hari Ini</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="post">

                <!-- Modal body -->
                <div class="modal-body">
                    <?php
                    // Ambil data dari tabel pengiriman dan produk
                    $getdata = mysqli_query($c, "select * from pengiriman p, produk pr, pengirim pg where idbulan='$idb' and p.idbarang=pr.idbarang");
                    // Simpan data dari $getdata
                    $dppr = mysqli_fetch_array($getdata);

                    // Panggil data dan simpan dalam var
                    $nb = $dppr['namabarang'];
                    $h = $dppr['harga'];
                    $idp = $dppr['idbarang'];
                    $namapengirim = $dppr['namapengirim'];
                    $idpengirim = $dppr['idpengirim'];

                    ?>

                    Barang Yang Dikirim
                    <input type="text" name="namabarang" class="form-control mt-2 mb-2" placeholder="Nama Barang" value="<?= $nb ?> - Rp. <?= number_format($h);  ?>" disabled>
                    <input type="number" name="qty" class="form-control mt-2" placeholder="Masukkan Jumlah" min="1">
                    <input type="hidden" name="idb" value="<?= $idb ?>">
                    <input type="hidden" name="idp" value="<?= $idp ?>">
                    <p class="mt-2 mb-2">Nama Pengirim</p>
                    <select class="form-select mt-2" aria-label="select-pengirim" name="idpg">
                        <?php
                        // Ambil data pengirim dari tabel pengirim
                        $getdatapengirim = mysqli_query($c, "select * from pengirim");
                        // Simpan data dari $getdata
                        while ($data = mysqli_fetch_array($getdatapengirim)) {
                            $idpengirim = $data['idpengirim'];
                            $namapengirim = $data['namapengirim'];
                        ?>
                            <option value="<?= $idpengirim ?>"><?= $namapengirim ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="addpengiriman" class="btn bgnav1 text-white" data-bs-dismiss="modal">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </form>

        </div>
    </div>
</div>


</html>