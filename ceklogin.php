<?php

require 'function.php';

if(isset($_SESSION['login'])) {
    // Berarti Sudah Login
}
else {
    // Berarti Belum Login
    header('location: login.php');
}

?>