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
    <title>Barang-Barang</title>
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
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 mb-4">Barang-Barang</h1>

                    <button type="button" class="btn bgnav1 text-white mb-3" data-bs-toggle="modal" data-bs-target="#myModal">
                        <i class="fas fa-archive me-1" style="font-size: 18px"></i>
                        Tambah Barang
                    </button>

                    <div class="row">

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Barang-Barang
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                        $get = mysqli_query($c, "select * from produk");
                                        $i = 1;

                                        while ($b = mysqli_fetch_array($get)) {
                                            $namabarang = $b['namabarang'];
                                            $harga = $b['harga'];
                                            $idbarang = $b['idbarang'];

                                        ?>

                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $namabarang; ?></td>
                                                <td>Rp. <?= number_format($harga); ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning text-white mx-2 my-2" data-bs-toggle="modal" data-bs-target="#edit<?= $idbarang; ?>"><i class="fas fa-edit me-1"></i>
                                                        Edit
                                                    </button>

                                                    <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#delete<?= $idbarang; ?>"><i class="fas fa-trash-alt me-1"></i>
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="edit<?= $idbarang; ?>">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Barang</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <form method="post">

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <input type="text" name="namabarang" class="form-control mb-2" placeholder="Masukkan nama barang" value="<?= $namabarang; ?>">
                                                                <input type="number" name="harga" class="form-control" placeholder="Harga" value="<?= $harga; ?>" min="1000">
                                                                <input type="hidden" name="idp" value="<?= $idbarang; ?>">
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="submit" name="editbarang" class="btn bgnav1 text-white" data-bs-dismiss="modal">Submit</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Delete -->
                                            <div class="modal fade" id="delete<?= $idbarang; ?>">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus <?= $namabarang; ?></h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <form method="post">

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                Apakah Anda Yakin Ingin Menghapus Barang Ini ?
                                                                <input type="hidden" name="idp" value="<?= $idbarang; ?>">
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="submit" name="hapusbarang" class="btn bgnav1 text-white" data-bs-dismiss="modal">Yakin</button>
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
            </main>
            <footer class="py-3 mt-auto">
                <div class="container-fluid px-4">
                    <div class="float-end align-items-center justify-content-between small">
                        <div class="text-black">
                            <h6>Copyright &copy; DIVAS Company 2022</h6>
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

<!-- Modal Tambah -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="post">

                <!-- Modal body -->
                <div class="modal-body">
                    <input type="text" name="namabarang" class="form-control mb-2" placeholder="Masukkan nama barang">
                    <input type="number" name="harga" class="form-control" placeholder="Harga" min="1000">
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="tambahbarang" class="btn bgnav1 text-white" data-bs-dismiss="modal">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </form>

        </div>
    </div>
</div>

</html>