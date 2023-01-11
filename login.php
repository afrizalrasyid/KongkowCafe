<?php
    // menyertakan file program koneksi.php pada login
    require('koneksi.php');
    // insialisasi session
    session_start();

    $error = '';
    $validate = '';

    // mengecek apakah session username tersedia atau tidak jika tersedia maka akan redirect ke halaman index
    if(isset($_SESSION['username'])) header('Location: index.php');

    // mengecek apakah form disubmit atau tidak
    if(isset($_POST['submit'])){
        // mengilangkan backshlases
        $username = stripslashes($_POST['username']);
        // cara sederhana mengamankan dari SQL injection
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($conn, $password);

        // cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
        if(!empty(trim($username)) && !empty(trim($password))){
            // mengecek apakah nilai captcha yang diinput sama dengan yang diberikan atau tidak
            if($_SESSION["code"] == $_POST["kodecaptcha"]){
                // select data berdasarkan username dari database
                $query  = "SELECT * FROM users WHERE username = '$username'";
                $result = mysqli_query($conn, $query);
                $rows   = mysqli_num_rows($result);

                if($rows != 0){
                    $hash = mysqli_fetch_assoc($result)['password'];
                    if(password_verify($password, $hash)){
                        $_SESSION['username'] = $username;

                        header('Location: index.php');
                    }
                // jika gagal maka akan menampilkan pesan error    
                }else{
                    $error = 'Login user gagal!';
                }
            }
        }else{
            $error = 'Data tidak boleh kosong!';
        }

        if($_SESSION["code"] == $_POST["kodecaptcha"]) {
            header('Location: index.php');
        }else{
            $error = 'Login user Gagal';
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
    <!-- Meta Tags-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" crossorigin="anonymous">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="style.css">
    </head>
    <body style="background-color: #25343C">
        <section class="container-fluid mb-4">
            <!-- justify-content-center untuk mengatur posisi form agar berada di tengah-tengah -->
            <section class="row justify-content-center">
                <section class="col-12 col-sm-6 col-md-4">
                    <form class="form-container" action="login.php" method="POST">
                        <h4 class="text-center font-weight-bold" style="color: white;">Sign-In</h4>
                        <?php if($error != ''){ ?>
                            <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="username" style="color: white;">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
                        </div>
                        <div class="form-group">
                            <label for="InputPassword" style="color: white;">Password</label>
                            <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Password">
                            <?php if($validate !=''){ ?>
                                <p class="text-danger"><?= $validate; ?></p>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="ImageCaptcha" style="color: white;">Captcha</label>
                            <img src="captcha.php" alt="gambar"/>
                        </div>
                        <div class="form-group">
                            <label for="CodeCaptcha" style="color: white;">Fill the captcha</label>
                            <input name="kodecaptcha" value="" maxlength="5" />
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
                        <div class="form-footer mt-2">
                            <p style="color: white;">Belum punya account? <a href="register.php">Register</a></p>
                        </div>
                    </form>
                </section>
            </section>
        </section>

        <!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan yang terakhir Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </body>
</html>