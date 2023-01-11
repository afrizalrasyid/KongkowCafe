<?php require "koneksi.php"?>
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
                                <li><a href="logout.php" style="color: red;">Log Out</a></li>
                            </font>
                        </ul>
                    </div>
                    <div class="col-4">
                        <form method="get">
                            <div class="input-group">
                                <div class="form-outline">
                                    <input type="search" name="search" id="form1" placeholder="Search Menu" class="form-control"/>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Search"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <br>
        <div class="wrapper">
            <div class="row">
                <?php
                    $batas = 8;
                    $halaman = @$_GET['halaman'];
                    if(empty($halaman)){
                        $posisi = 0;
                        $halaman = 1;
                    }else{
                        $posisi = ($halaman-1) * $batas;
                    }

                    if(isset($_GET['search'])){
                        $search = $_GET['search'];
                        $sql = "SELECT * FROM menu WHERE nama LIKE '%$search%' order by id Desc limit $posisi, $batas";
                    }else{
                        $sql = "SELECT * FROM menu order by id Desc limit $posisi, $batas";
                    }

                    $hasil = mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_array($hasil)){
                        ?>
                            <div class="col-md-3 produk">
                                <a href="menu_detail.php?id=<?= $data['id'] ?>">
                                    <img src="<?= $data['foto'] ?>" width="100%" alt="">
                                    <h4><?=$data['nama']?></h4>
                                    <p class="deskripsi-produk">Price: Rp<?= number_format($data['harga']) ?></p>

                                </a>
                            </div>
                        <?php 
                    }
                ?>
            </div>
            <?php
                if(isset($_GET['search'])){
                    $search = $_GET['search'];
                    $query2 = "SELECT * FROM menu WHERE nama LIKE '%$search%' order by id Desc";
                }else{
                    $query2 = "SELECT * FROM menu order by id Desc";
                }
                $result2 = mysqli_query($conn, $query2);
                $jmldata = mysqli_num_rows($result2);
                $jmlhalaman = ceil($jmldata/$batas);
            ?>
            <br>
            <ul class="pagination">
                <?php
                    for($i=1;$i<=$jmlhalaman;$i++){
                        if($i != $halaman){
                            if(isset($_GET['search'])){
                                $search = $_GET['search'];
                                echo "<li class='page-item'><a class='page-link' href='read.php?halaman=$i&search=$search'>$i</a></li>";
                            }else{
                                echo "<li class='page-item'><a class='page-link' href='read.php?halaman=$i'>$i</a></li>";
                            }
                            }else{
                                echo "<li class='page-item active'><a class='page-link' href='#'>$i</a></li>";
                            }
                        }
                ?>
            </ul>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </body>
</html>