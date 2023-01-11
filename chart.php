<?php
include('koneksi.php');
$produk = mysqli_query($conn, "SELECT * from menu"); //Query untuk mengambil data di tabel menu
while($row = mysqli_fetch_array($produk)){ //Extract data hasil query di baris 3 dan datanya disimpan di variabel $row
    $nama_produk[] = $row['nama']; //Array dengan nama $nama_produk, digunakan untuk menyimpan nama menu hasil query
    $query = mysqli_query($conn, "SELECT SUM(harga) AS harga from menu where id='".$row['id']."'");
    //Query untuk menjumlahkan nilai pada kolom jumlah di tabel menu, berdasarkan id disetiap perulangan data menu
    $row = $query -> fetch_array();
    //Variabel $row digunakan untuk menyimpan hasil query kedalam bentuk array dengan perintah fetch_array
    $harga_produk[] = $row['harga'];
    //Array $jumlah_produk untuk menyimpan data jumlah disetiap barang yang terjual di tabel menu
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>Produk</title>
        <script type="text/javascript" src="Chart.js"></script>
        <!-- Memanggil file Chart.js agar kita bisa membuat grafik dengan menggunakan chart.js -->
    </head>
    <body style="background-color: #25343C">
        <header>
            <div class="wrapper">
                <div class="row">
                    <div class="col-3"></div>
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
                </div>
            </div>
        </header>
        <div style="width: 800px; height: 800px">
            <canvas id="myChart"></canvas>
            <!-- Membuat sebuah object dengan menggunakan tag <canvas> dimana didalamnya menuliskan nama id="myChart" -->
        </div>

        <script type="text/javascript">
            Chart.defaults.color = 'white';
            var ctx = document.getElementById("myChart").getContext('2d'); //Menuliskan myChart itu adalah id dari object yang dibuat
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($nama_produk); ?>,
                    datasets: [{
                        label: 'Grafik Menu',
                        data: <?php echo json_encode($harga_produk); ?>,                
                        backgroundColor: '#29465b',
                        borderColor: 'transparent',
                        borderWidth: 1,
                    }]
                },
                options: {
                    scales: {
                        x: {
                            grid: {
                                color: 'white',
                                borderColor: 'white',
                                tickColor: 'white'
                            }
                        },
                        
                        y: {
                            grid: {
                                color: 'white',
                                borderColor: 'white',
                                tickColor: 'white'
                            }
                        },
                        yAxes: [{                                                        
                            ticks: {                                    
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
    </body>
</html>