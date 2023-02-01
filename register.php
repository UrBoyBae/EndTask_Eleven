<?php

require 'function.php';

if (!isset($_SESSION['login'])) {
    // Stay di Login Page
} else {
    // stay di index
    header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register</title>
    <link href="assets/img/icon3.png" rel="shortcut icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@200&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
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

<body class="grd11 f1">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="card rds-card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h4 class="text-center font-weight-light my-3">REGISTER</h4>
                                </div>

                                <div class="card-body">

                                    <form method="post">
                                        <div class="form-floating mt-4 mb-3 mx-4">
                                            <input class="form-control" id="inputEmail" name="username" type="text" placeholder="Masukkan Username" required />
                                            <label for="inputUsername"><i class="fas fa-user-alt ms-1 me-2"></i>Username</label>
                                        </div>

                                        <div class="form-floating mb-3 mx-4">
                                            <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Masukkan Password" required />
                                            <label for="inputPassword"><i class="fas fa-lock ms-1 me-2"></i>Password</label>
                                        </div>

                                        <div class="form-floating mb-3 mx-4">
                                            <input class="form-control" id="inputPasswordConfirm" name="confirmpassword" type="password" placeholder="Confirm Password" />
                                            <label for="inputPasswordConfirm"><i class="fas fa-lock ms-1 me-2"></i>Confirm Password</label>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-3 mb-1">
                                            <button type="submit" name="signup" class="btn bgbtn text-white">SIGN UP</button>
                                        </div>
                                    </form>

                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small">Have an account already? <a class="text-decoration-none signup" href="login.php">Log in</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-2 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="divas">Copyright &copy; DIVAS Company 2022</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>