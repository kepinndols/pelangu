<?php
include 'koneksi.php'; // Menyertakan file koneksi ke database
session_start(); // Memulai session di awal skrip

if (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Periksa apakah username dan password tidak kosong
    if (!empty($user) && !empty($pass)) {
        // Query untuk mengambil data berdasarkan username
        $query = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE username='$user'");
        $data = mysqli_fetch_array($query);
        $cekdata = mysqli_num_rows($query);

        if ($cekdata > 0) {
            $hash = $data['sandi']; // Mengambil password yang di-hash dari database
            // Verifikasi password yang di-hash
            if (password_verify($pass, $hash)) {
                // Jika password benar, set session username
                $_SESSION['username'] = $data['username'];

                // Arahkan pengguna ke halaman setelah login
                header('location: Dasbor.php');
                exit();
            } else {
                echo "<script>alert('Password salah!');</script>";
            }
        } else {
            echo "<script>alert('username tidak di temukan!');</script>.";
        }
    } else {
        echo "Harap isi username dan password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pelangu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container-fluid px-5">
            <a class="navbar-brand" href="#">
                <img src="assets/img/logo.png" alt="" width="29" height="29">
            </a>
            <a class="navbar-brand" href="#">Pelangu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Tombol Home di tengah -->
            <div class="navbar-center">
                <a href="index.php" style="text-decoration: none;">
                    <button class="button-daftar" data-bs-toggle="modal" data-bs-target="#registerModal">Home</button>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="btn-container ms-auto">
                    <a href="daftar.php" style="text-decoration: none;">
                        <button class="button-masuk" data-bs-toggle="modal" data-bs-target="#loginModal">Daftar</button>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section text-white"
        style="background-image: url(assets/img/d1.jpg); background-size: cover; background-repeat: no-repeat; background-position: center;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4">Pengelola Keuangan Terbaikmu!</h1>
                    <p class="lead">Pelangu adalah sebuah website pengelolaan keuangan, yang dibuat untuk merencanakan,
                        mengatur, dan memantau keuangan pribadi dengan mudah dan efisien.</p>
                </div>
                <div class="col-md-4 ms-auto text-center">
                    <form method="POST" action="" class="p-4 bg-light text-dark rounded shadow form-custom form"
                        style="height :25rem; width: 30rem">
                        <h3 class="mb-4 " style="color: #fff; ">Masuk</h3>
                        <div class="mb-3">
                            <input type="text" class="form-control text-center" name="username" id="username"
                                placeholder="Masukkan Username anda!" required />
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="password" class="form-control text-center" name="password" id="password"
                                    placeholder="Kata Sandi" required />
                                <button type="button" class="btn bg-white btn-outline-secondary"
                                    onclick="togglePasswordVisibility()">
                                    <i class="bi bi-eye" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-cstm w-50 mt-5">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Footer -->
    <footer class="bg-dark text-white py-2">
        <div class="container">
            <div class="text-center pt-2">
                <p>&copy; 2024 Pelangu. Kopi Kanan.</p>
            </div>
        </div>
    </footer>
</body>

<script>
function togglePasswordVisibility() {
    const passwordField = document.getElementById('password');
    const togglePasswordIcon = document.getElementById('togglePasswordIcon');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        togglePasswordIcon.classList.remove('bi-eye');
        togglePasswordIcon.classList.add('bi-eye-slash');
    } else {
        passwordField.type = 'password';
        togglePasswordIcon.classList.remove('bi-eye-slash');
        togglePasswordIcon.classList.add('bi-eye');
    }
}
</script>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>