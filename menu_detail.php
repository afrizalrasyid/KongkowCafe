<?php
    require "koneksi.php";

    if($_GET['id'] != null){
        $id = $_GET['id'];
        $script = "SELECT * FROM menu where id=$id";
        $query = mysqli_query($conn, $script);
        $data = mysqli_fetch_array($query);
    }else{
        header("location:menu.php");
    }

    if(isset($_POST['hapus'])){
        $script2 = "DELETE FROM menu where id = $id";
        $query = mysqli_query($conn, $script2);
        if($query){
            header("location:menu.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>Produk</title>
    </head>
    <body style="background-color: #25343C">
        <header>
            <div class="wrapper">
                <div class="row">
                <div class="col-2"></div>
                    <div class="col-6">
                        <ul>
                            <font face="Sans-serif" color="black" size="4">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="menu.php">Menu</a></li>
                                <li><a href="chart.php">Chart Menu</a></li>
                                <li><a href="create.php">Add Menu</a></li>
                            </font>
                        </ul>
                    </div>
                    <div class="col-4">
                        <form method="get">
                            <div class="input-group">
                                <div class="form-outline">
                                    <input type="search" name="search" id="form1" placeholder="mau cari apa?" class="form-control"/>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Search"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <br>
        <ul><a href="menu.php" type="submit" class="btn btn-primary">Kembali</a></ul>
        <div class="wrapper">
            <div class="row">
                <div class="col-7">
                    <img src="<?= $data['foto']?>" width="90%" alt="">
                </div>
                <div class="col-4">
                    <div class="box-detail-produk">
                        <h3 style="color: white;"><?= $data['nama']?></h3>
                        <h5 style="color: white;">Rp <?= number_format($data['harga'])?><h5>
                    </div>
                    <div class="box-detail-produk">
                        <h2 style="color: white;">Aksi Lainnya</h2>
                        <form method="post">
                            <a href="edit.php?id=<?= $data['id']?>" class="btn btn-warning">Update Produk</a>
                            <input type="submit" name="hapus" value="Hapus Produk" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </body>
</html>