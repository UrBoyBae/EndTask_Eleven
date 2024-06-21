<?php

session_start();

// Bikin Koneksi dulu
$c = mysqli_connect('localhost', 'root', '', 'pengiriman');
// if($c) {
//     echo 'berhasil';
// }


// Login
if (isset($_POST['login'])) {
    // initiate variable
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check data user
    $check = mysqli_query($c, "select * from user where username = '$username'");

    // Check username
    if (mysqli_num_rows($check) > 0) {
        // Datanya ditemukan
        // Verifikasi password

        $datauser = mysqli_fetch_array($check);
        if (password_verify($password, $datauser['password'])) {
            // Jika password yang dimasukkan benar
            // Maka Berhasil Login
            $_SESSION['login'] = 'true';
            header('location: index.php');
        } else {
            // Password salah
            // Gagal login

            echo '
                <script>
                    alert("Password Salah !")
                    window.location.href="login.php";
                </script>
            ';
        }
    } else {
        // Datanya tidak ditemukan 
        // Gagal Login

        echo '
        <script>
            alert( "Username Belum Terdaftar !" );
            window.location.href("login.php")
        </script>
        ';
    }
}


// Tambah barang
if (isset($_POST['tambahbarang'])) {
    $namabarang = $_POST['namabarang'];
    $harga = $_POST['harga'];

    $insert = mysqli_query($c, "insert into produk (namabarang,harga) values ('$namabarang', '$harga')");

    if ($insert) {
        header('location: stock.php');
    } else {
        echo '
        <script>
            alert("Gagal menambahkan barang baru");
            window.location.href("stock.php")
        </script>
        ';
    }
}

// Buat Pengiriman Baru
if (isset($_POST['pengirimanbaru'])) {
    $idbarang = $_POST['idbarang'];
    $bulan = $_POST['bulan'];

    $insert = mysqli_query($c, "insert into pengiriman (idbulan, idbarang) values ('$bulan', '$idbarang')");

    if ($insert) {
        echo'
        <script>
            alert("Berhasil Menambahkan Pengiriman");
            window.location.href="index.php"  
        </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal menambahkan pengiriman baru");
            window.location.href("index.php")
        </script>
        ';
    }
}

// Pengiriman Hari Ini
if (isset($_POST['addpengiriman'])) {
    $idp = $_POST['idp'];
    $qty = $_POST['qty'];
    $idb = $_POST['idb'];
    $idpg = $_POST['idpg'];

    $insert = mysqli_query($c, "insert into detailpengiriman (idbulan,idbarang,qty,idpengirim) values ('$idb','$idp','$qty','$idpg')");

    if ($insert) {
        header('location: view.php?bulan=' . $idb);
    } else {
        echo '
        <script>
            alert("Gagal menambahkan pengiriman hari ini");
            window.location.href="view.php?bulan="' . $idb . '
        </script>
        ';
    }
}

// Edit Barang
if (isset($_POST['editbarang'])) {
    $np = $_POST['namabarang'];
    $harga = $_POST['harga'];
    $idp = $_POST['idp'];

    $query = mysqli_query($c, "update produk set namabarang='$np', harga='$harga' where idbarang='$idp' ");

    if ($query) {
        header('location: stock.php');
    } else {
        echo '
        <script>
            alert("Gagal mengedit barang");
            window.location.href("stock.php")
        </script>
        ';
    }
}

// Hapus Barang
if (isset($_POST['hapusbarang'])) {
    $idp = $_POST['idp'];

    // Hapus data tabel produk
    $hpsbarang = mysqli_query($c, "delete from produk where idbarang='$idp'");

    // Hapus data tabel pengiriman
    $hpspengiriman = mysqli_query($c, "delete from pengiriman where idbarang='$idp' ");

    // Hapus data dari tabel detail pengiriman
    $hpsdetail = mysqli_query($c, "delete from detailpengiriman where idbarang='$idp' ");

    if ($hpsbarang && $hpspengiriman && $hpsdetail) {
        header('location: stock.php');
    } else {
        echo '
        <script>
            alert("Gagal menghapus barang");
            window.location.href("stock.php")
        </script>
        ';
    }
}

// Hapus Data Pengiriman
if (isset($_POST['hapusbulan'])) {
    $idb = $_POST['idbulan'];

    // Hapus data tabel pengiriman
    $hpspengiriman = mysqli_query($c, "delete from pengiriman where idbulan='$idb'");

    // Hapus data tabel detail peminjaman
    $hpsdetail = mysqli_query($c, "delete from detailpengiriman where idbulan='$idb' ");

    if ($hpspengiriman && $hpsdetail) {
        echo'
            <script>
                alert("Pengiriman Bulan Ke-'.$idb.'  Berhasil Dihapus");
                window.location.href="index.php"
            </script>
        ';
    } else {
        echo '
        <script>
            alert("Gagal menghapus data pengiriman");
            window.location.href("index.php")
        </script>
        ';
    }
}

// Edit Pengiriman harian
if (isset($_POST['editpengiriman'])) {

    $jumlah = $_POST['qty'] + $_POST['qty2'];
    $idh = $_POST['idh'];
    $idb = $_POST['idb'];
    $idpg = $_POST['idpg'];

    $query = mysqli_query($c, "update detailpengiriman set qty='$jumlah', idpengirim='$idpg' where idhari='$idh' ");

    if ($query) {
        header('location: view.php?bulan=' . $idb);
    } else {
        echo '
        <script>
            alert("Gagal mengedit pengiriman");
            window.location.href="view.php?bulan="' . $idb . '
        </script>
        ';
    }
}

// Hapus Pengiriman harian
if (isset($_POST['hapuspengiriman'])) {

    $idh = $_POST['idh'];
    $idb = $_POST['idb'];

    $query = mysqli_query($c, "delete from detailpengiriman where idhari='$idh'");

    if ($query) {
        header('location: view.php?bulan=' . $idb);
    } else {
        echo '
        <script>
            alert("Gagal menghapus pengiriman");
            window.location.href="view.php?bulan="' . $idb . '
        </script>
        ';
    }
}

// Registrasi
if (isset($_POST['signup'])) {

    $user = $_POST['username'];
    $pass = $_POST['password']; // Password Murni atau belum dienkripsi
    $confirmpass = $_POST['confirmpassword'];

    // Cek username karna username tidak boleh ada yang sama
    $checkuser = mysqli_query($c, "select username from user where username = '$user' ");

    if (mysqli_fetch_array($checkuser)) {
        echo '
            <script>
                alert ("Username Sudah Terpakai !")
                window.location.href("register.php")
            </script>
        ';

        return false;
    }

    // Cek apakah password isinya sama dgn confirm password
    if ($pass !== $confirmpass) {
        echo ' 
            <script>
                alert ("Confirm Password Yang Dimasukkan Tidak Sesuai !")
                window.location.href("register.php")
            </script>
        ';

        return false;
    }

    // Hash Passwordnya
    $hashpass = password_hash($pass, PASSWORD_DEFAULT); // Password yang sudah dienkripsi

    // Masukkin data ke tabel user
    $adduser = mysqli_query($c, "insert into user (username,password) values ('$user','$hashpass')");

    if ($adduser) {
        echo '
            <script>
                alert ("Berhasil Melakukan Registrasi")
                window.location.href="login.php"
                </script>
        ';
    } else {
        echo ' 
            <script>
                alert ("Gagal Menambahkan User!")
                window.location.href("register.php")
            </script>
        ';
    }
}

// Tambah Pengirim
if (isset($_POST['tambahpengirim'])) {
    $namapengirim = $_POST['namapengirim'];

    $insert = mysqli_query($c, "insert into pengirim (namapengirim) values ('$namapengirim')");

    if ($insert) {
        header('location: sender.php');
    } else {
        echo '
        <script>
            alert("Gagal menambahkan pengirim baru");
            window.location.href("sender.php")
        </script>
        ';
    }
}

// Edit Pengirim
if (isset($_POST['editpengirim'])) {
    $namapengirim = $_POST['namapengirim'];
    $idpengirim = $_POST['idpengirim'];

    $query = mysqli_query($c, "update pengirim set namapengirim='$namapengirim' where idpengirim='$idpengirim' ");

    if ($query) {
        header('location: sender.php');
    } else {
        echo '
        <script>
            alert("Gagal mengedit pengirim");
            window.location.href("sender.php")
        </script>
        ';
    }
}

// Hapus Pengirim
if (isset($_POST['hapuspengirim'])) {
    $idpengirim = $_POST['idpengirim'];

    // Hapus data tabel produk
    $query = mysqli_query($c, "delete from pengirim where idpengirim='$idpengirim'");

    if ($query) {
        header('location: sender.php');
    } else {
        echo '
        <script>
            alert("Gagal menghapus pengirim");
            window.location.href("sender.php")
        </script>
        ';
    }
}