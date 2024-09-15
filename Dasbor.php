<?php
include 'koneksi.php';
session_start(); // Memulai session

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
   
}
$username = $_SESSION['username'];
$id_query = mysqli_query($koneksi, "SELECT id_pengguna FROM pengguna WHERE username = '$username'");
$id = mysqli_fetch_assoc($id_query)['id_pengguna'];
$nama = mysqli_query($koneksi, "SELECT nama FROM pengguna WHERE id_pengguna = '$id'")->fetch_assoc()['nama'];
// Hitung total pemasukan bulan ini
$total_pemasukan_query = mysqli_query($koneksi, "
    SELECT SUM(jumlah) AS total
    FROM transaksi
    WHERE id_pengguna = '$id' AND tipe = 'pemasukan' AND DATE_FORMAT(tanggal_transaksi, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')
");
$total_pemasukan = mysqli_fetch_assoc($total_pemasukan_query)['total'];

// Hitung total pengeluaran bulan ini
$total_pengeluaran_query = mysqli_query($koneksi, "
    SELECT SUM(jumlah) AS total
    FROM transaksi
    WHERE id_pengguna = '$id' AND tipe = 'pengeluaran' AND DATE_FORMAT(tanggal_transaksi, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')
");
$total_pengeluaran = mysqli_fetch_assoc($total_pengeluaran_query)['total'];

// Hitung keseimbangan bulan ini
$keseimbangan = ($total_pemasukan ? $total_pemasukan : 0) - ($total_pengeluaran ? $total_pengeluaran : 0);


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dasbor Pelangu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="cssdasbor.css">
</head>

<body>
    <div class="container-fluid m-0 p-0">
        <section class="hero" id="hero">
            <div class="toggler" id="toggler">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="user">
                <div class="user-info-container">
                    <!-- Tambahkan wrapper baru untuk user-img dan user-info -->
                    <div class="user-img">
                        <img src="asset/WIN_20231130_18_38_28_Pro.jpg" alt="">
                    </div>
                    <div class="user-info">
                        <h3><?= htmlspecialchars($nama) ?></h3>
                        <button class="v-img" id="v-img">
                            <img src="asset/V.png" alt="">
                        </button>
                    </div>
                </div>
                <div class="logout" id="logout">
                    <form action="" method="POST">
                        <input type="submit" name="logout" value="logout">
                    </form>
                    <?php 
            if (isset($_POST['logout'])) {
                session_destroy();
                header("Location: login.php");
                exit();
            }
        ?>
                </div>
            </div>

            <div class="sidebar" id="sidebar">
                <div class="sidebar-content">
                    <h1 class="title">Pelangu</h1>
                    <h3 class="subtitle">Menu Utama</h3>
                    <ul>
                        <li class="active">
                            <a href="Dasbor.php" class="dasbor-link">
                                <img src="asset/Vector.png" alt="Dashboard" class="icon"> Dasbor
                            </a>
                        </li>
                        <li>
                            <a href="riwayat.php">
                                <img src="asset/ic_baseline-history.png" alt="Riwayat" class="icon"> Riwayat
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="section2" id="section2">
            <h1>Dasbor</h1>
            <div class="box">
                <h2>Keuangan</h2>
                <h3>Ini adalah catatan keuangan Anda!</h3>

                <div class="garis">
                    <span>-</span>
                </div>

                <div class="card">
                    <div class="card1">
                        <h1>
                            Rp. <?= number_format($total_pemasukan, 0, ',', '.') ?>
                        </h1>
                        <p>Pemasukan</p>
                    </div>
                    <div class="card2">
                        <h1>
                            Rp. <?= number_format($total_pengeluaran, 0, ',', '.') ?>
                        </h1>
                        <p>Pengeluaran</p>
                    </div>
                    <div class="card3">
                        <h1>
                            Rp. <?= number_format($keseimbangan, 0, ',', '.') ?>
                        </h1>
                        <p>Keseimbangan</p>
                    </div>
                </div>
                <div class="aksi">
                    <button class="kurang" href="#">kurang</button>
                    <button class="tambah" href="#">tambah</button>
                </div>
            </div>
        </section>

        <section class="section3">
            <div class="overlay" id="overlay"></div>
            <div class="popup-form" id="popupForm">
                <div class="popup-content">
                    <h2>Catat Pemasukan Hari ini</h2>
                    <form action="proses_transaksi.php" method="POST">
                        <div class="form-nama mb-3">
                            <label for="nama" class="form-label-nama">Catat Pemasukan Hari ini</label>
                            <input type="number" name="jumlah_pemasukan" class="form-control input-besar" id="nama"
                                placeholder="Rp. 0" required>
                        </div>
                        <div class="form-catatan mb-3">
                            <label for="jumlah" class="form-label-catatan">Catatan</label>
                            <input type="text" name="catatan_pemasukan" class="form-control input-besar" id="jumlah"
                                placeholder="Catatan" required>
                        </div>
                        <div id="closeBtn"></div>
                        <button type="submit" class="btn button-simpan">Simpan</button>
                    </form>

                </div>
            </div>
        </section>

        <section class="section4">
            <div class="overlay2" id="overlay2"></div>
            <div class="popup-form2" id="popupForm2">
                <div class="popup-content">
                    <h2>Catat Pengeluaran Hari ini</h2>
                    <form action="proses_transaksi.php" method="POST">
                        <div class="form-nama mb-3">
                            <label for="nama" class="form-label-nama">Catat Pengeluaran Hari ini</label>
                            <input type="number" name="jumlah_pengeluaran" class="form-control input-besar" id="nama"
                                placeholder="Rp. 0" required>
                        </div>
                        <div class="form-catatan mb-3">
                            <label for="jumlah" class="form-label-catatan">Catatan</label>
                            <input type="text" name="catatan_pengeluaran" class="form-control input-besar" id="jumlah"
                                placeholder="Catatan" required>
                        </div>
                        <div id="closeBtn"></div>
                        <button type="submit" class="btn button-simpan">Simpan</button>
                    </form>
                </div>
            </div>
        </section>

        <div class="footer" id="footer">
            <p style="margin-bottom: 0;">2024©Pelangu | Secang</p>
        </div>
        <div class="wave">
            <img src="asset/wave.png" alt="">
        </div>
    </div>
    <script src="javadasbor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>