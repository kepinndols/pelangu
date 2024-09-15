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

// Ambil ID pengguna dari database
$id_query = mysqli_query($koneksi, "SELECT id_pengguna FROM pengguna WHERE username = '$username'");
$id = mysqli_fetch_assoc($id_query)['id_pengguna'];

// Pagination settings
$items_per_page = 5; // Jumlah baris per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman saat ini
$offset = ($page - 1) * $items_per_page;

// Hitung total baris
$total_query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM transaksi WHERE id_pengguna = '$id'");
$total_rows = mysqli_fetch_assoc($total_query)['total'];
$total_pages = ceil($total_rows / $items_per_page);

// Ambil data riwayat transaksi dari database dengan pagination
$riwayat_query = mysqli_query($koneksi, "
    SELECT tanggal_transaksi, jumlah, tipe, catatan
    FROM transaksi
    WHERE id_pengguna = '$id'
    ORDER BY tanggal_transaksi DESC
    LIMIT $offset, $items_per_page
");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Pelangu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="cssriwayat.css">
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
                    <div class="user-img">
                        <img src="asset/WIN_20231130_18_38_28_Pro.jpg" alt="">
                    </div>
                    <div class="user-info">
                        <h3><?= htmlspecialchars($username) ?></h3>
                        <button class="v-img" id="v-img">
                            <img src="asset/V.png" alt="">
                        </button>
                    </div>
                </div>
                <div class="logout" id="logout">
                    <form action="" method="POST">
                        <input type="submit" name="logout" value="logout">
                    </form>
                </div>
            </div>

            <div class="sidebar" id="sidebar">
                <div class="sidebar-content">
                    <h1 class="title">Pelangu</h1>
                    <h3 class="subtitle">Menu Utama</h3>
                    <ul>
                        <li>
                            <a href="Dasbor.php" class="dasbor-link">
                                <img src="asset/Vector.png" alt="Dashboard" class="icon"> Dasbor
                            </a>
                        </li>
                        <li class="active">
                            <a href="riwayat.php">
                                <img src="asset/ic_baseline-history.png" alt="Riwayat" class="icon"> Riwayat
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="section2" id="section2">
            <h1>Riwayat Transaksi</h1>
            <div class="box">
                <h2 class="my-3">Riwayat catatan anda</h2>

                <div class="garis">
                    <span>-</span>
                </div>
                <div class="table">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Tipe</th>
                                <th scope="col">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
            $no = $offset + 1;
            while ($row = mysqli_fetch_assoc($riwayat_query)) {
                echo "<tr>
                    <th scope='row' style='font-size: 1.5rem'>{$no}</th>
                    <td>{$row['tanggal_transaksi']}</td>
                    <td>Rp. " . number_format($row['jumlah'], 0, ',', '.') . "</td>
                    <td>" . ucfirst($row['tipe']) . "</td>
                    <td>{$row['catatan']}</td>
                </tr>";
                $no++;
            }
            ?>
                        </tbody>
                    </table>

                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>">Previous</a>
                    <?php endif; ?>

                    <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>">Next</a>
                    <?php endif; ?>
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
    <script src="javariwayat.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var vImgButton = document.getElementById('v-img');
        var logoutDiv = document.getElementById('logout');

        vImgButton.addEventListener('click', function() {
            if (logoutDiv.style.display === 'block') {
                logoutDiv.style.display = 'none'; // Sembunyikan logout jika sudah tampil
            } else {
                logoutDiv.style.display = 'block'; // Tampilkan logout jika belum tampil
            }
        });
    });
    </script>
</body>

</html>