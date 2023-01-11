<?php require "koneksi.php" ?>
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
                                <li><a href="create.php">Add Menu</a></li>
                                <li><a href="chart.php">Chart Menu</a></li>
                            </font>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="wrapper">
            <div style="color:red">
                <?php
                    if($_GET['id'] == null){
                        header("location:menu.php");
                    }
                    $id = $_GET['id'];
                    $script = "SELECT * FROM menu where id = $id";
                    $query = mysqli_query($conn, $script);
                    $data = mysqli_fetch_array($query);
                    if(isset($_POST['submit'])){
                        if(isset($_FILES['foto'])){
                            $nama = $_POST['nama'];
                            $harga = $_POST['harga'];                            
                            $file_tmp = $_FILES['foto']['tmp_name'];
                            
                            if($file_tmp == null){
                                $foto = $data['foto'];
                                $script = "UPDATE menu SET nama='$nama', harga=$harga, foto='$foto' where id=$id";
                            }else{
                                $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
                                $data = file_get_contents($file_tmp);
                                $foto = 'data:img/' . $type . ';base64,' . base64_encode($data);
                                $script = "UPDATE menu SET nama='$nama', harga=$harga, foto='$foto' where id=$id";
                            }

                            $query = mysqli_query($conn, $script);
                            if($query){
                                header("location:menu.php");
                            }else{
                                echo "gagal mengupload data";
                            }
                        }
                    }
                ?>
            </div>

            <form method="post" enctype="multipart/form-data" style="color: white;">
                <div class="form-group">
                    <label>Nama Menu</label>
                    <input type="text" class="form-control" name="nama" value="<?=$data['nama']?>">
                </div>
                <div class="form-group">
                    <label>Foto Menu</label>
                    <input type="file" class="form-control" name="foto">
                </div>
                <div class="form-group">
                    <label>Harga Menu</label>
                    <input type="number" class="form-control" name="harga" value="<?=$data['harga']?>">
                </div>                
                <input type="submit" class="btn btn-primary" name="submit" value="Update">
                <a href="menu_detail.php" type="submit" class="btn btn-primary">Cancel</a>
            </form>
            <br><br><br>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </body>
</html>