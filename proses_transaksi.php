<?php
// Mulai session
session_start();

include 'koneksi.php'; // Menyertakan file koneksi ke database
// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$id_query = mysqli_query($koneksi, "SELECT id_pengguna FROM pengguna WHERE username = '$username'");
$id = mysqli_fetch_assoc($id_query)['id_pengguna'];

// Proses pemasukan
if (isset($_POST['jumlah_pemasukan']) && isset($_POST['catatan_pemasukan'])) {
    $jumlah_pemasukan = $_POST['jumlah_pemasukan'];
    $catatan_pemasukan = $_POST['catatan_pemasukan'];

    // Simpan transaksi pemasukan
    $query_pemasukan = "INSERT INTO transaksi (id_pengguna, jumlah, tipe, catatan, tanggal_transaksi) VALUES ( '$id', '$jumlah_pemasukan', 'pemasukan', '$catatan_pemasukan', CURDATE())";
    if (!mysqli_query($koneksi, $query_pemasukan)) {
        echo "Error: " . mysqli_error($koneksi);
    }
}

// Proses pengeluaran
if (isset($_POST['jumlah_pengeluaran']) && isset($_POST['catatan_pengeluaran'])) {
    $jumlah_pengeluaran = $_POST['jumlah_pengeluaran'];
    $catatan_pengeluaran = $_POST['catatan_pengeluaran'];

    // Simpan transaksi pengeluaran
    $query_pengeluaran = "INSERT INTO transaksi (id_pengguna, jumlah, tipe, catatan, tanggal_transaksi) VALUES ('$id', '$jumlah_pengeluaran', 'pengeluaran', '$catatan_pengeluaran', CURDATE())";
    if (!mysqli_query($koneksi, $query_pengeluaran)) {
        echo "Error: " . mysqli_error($koneksi);
    }
}

// Update tabel saldo
$total_pemasukan_query = mysqli_query($koneksi, "
    SELECT SUM(jumlah) AS total
    FROM transaksi
    WHERE id_pengguna = '$id' AND tipe = 'pemasukan' AND DATE_FORMAT(tanggal_transaksi, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')
");
$total_pemasukan = mysqli_fetch_assoc($total_pemasukan_query)['total'];

$total_pengeluaran_query = mysqli_query($koneksi, "
    SELECT SUM(jumlah) AS total
    FROM transaksi
    WHERE id_pengguna = '$id' AND tipe = 'pengeluaran' AND DATE_FORMAT(tanggal_transaksi, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')
");
$total_pengeluaran = mysqli_fetch_assoc($total_pengeluaran_query)['total'];

$keseimbangan = ($total_pemasukan ? $total_pemasukan : 0) - ($total_pengeluaran ? $total_pengeluaran : 0);

$bulan_tahun = date('Y-m-01'); // Format tanggal untuk bulan ini

// Update atau insert saldo bulan ini
$update_saldo_query = "
    INSERT INTO saldo (id_pengguna, bulan_tahun, total_pemasukan, total_pengeluaran, keseimbangan)
    VALUES ('$id', '$bulan_tahun', '$total_pemasukan', '$total_pengeluaran', '$keseimbangan')
    ON DUPLICATE KEY UPDATE
        total_pemasukan = VALUES(total_pemasukan),
        total_pengeluaran = VALUES(total_pengeluaran),
        keseimbangan = VALUES(keseimbangan),
        tanggal_diperbarui = CURRENT_TIMESTAMP
";
if (!mysqli_query($koneksi, $update_saldo_query)) {
    echo "Error: " . mysqli_error($koneksi);
}

// Arahkan kembali ke halaman dasbor
header("Location: Dasbor.php");
exit();
?>