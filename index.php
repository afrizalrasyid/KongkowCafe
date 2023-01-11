<?php 

    // inisialiasasi session
    session_start();

    // mengecek username pada sesssion
    if(!isset($_SESSION['username'])){
        $_SESSION['msg'] = 'Anda harus login terlebih dahulu';
        header('Location: login.php');
    }
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>Produk</title>
    </head>
    <body background="img\background1.jpg" style="background-size: 100%;">
        <header>
            <div class="wrapper">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <ul>
                            <font face="Sans-serif" size="4">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="menu.php">Menu</a></li>
                                <li><a href="create.php">Add Menu</a></li>
                                <li><a href="chart.php">Chart Menu</a></li>
                                <li><a href="logout.php" style="color: red;">Log Out</a></li>
                            </font>
                        </ul>
                    </div>                    
                </div>
            </div>
        </header>
        <br>
        <br>
        <br>
        <br>
        <center><font face="Castellar" color="white" size="20">Kongkow Cafe</font></center>
        <center><font face="Calibri" color="white" size="3">GOOD DAYS START WITH <font style="color: #fba244;">COFFEE.</font></font></center><br>        
        <div class="wrapper">
            <div class="row"></div>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </body>
</html>