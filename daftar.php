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
                <div style="display: flex;" class="btn-container ms-auto">
                    <a href="login.php" style="text-decoration: none;"><button class="button-masuk"
                            data-bs-toggle="modal" data-bs-target="#loginModal">Masuk</button></a>
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
                <div class="col-md-4 ms-auto text-center form-daftar">
                    <form class="p-4 bg-light text-dark rounded shadow form-custom form" action="" method="POST">
                        <h3 class="mb-4 " style="color:#fff">Daftar</h3>
                        <div class="mb-3">
                            <input type="text" class="form-control text-center" name="username" id="username"
                                placeholder="Masukkan Username anda!" />
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control text-center" name="nama" id="nama"
                                placeholder="Masukkan Nama anda!" />
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control text-center" name="email" id="email"
                                placeholder="Masukkan Email anda!" />
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="password" class="form-control text-center" name="password" id="password"
                                    placeholder="Kata Sandi" />
                                <button type="button" class="btn bg-white btn-outline-secondary"
                                    onclick="togglePasswordVisibility()">
                                    <i class="bi bi-eye" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" name="submit" value="submit" class="btn btn-cstm w-50">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <?php
include 'koneksi.php'; // Memasukkan koneksi ke database

if (isset($_POST['submit'])) {
    // Mengambil data dari form
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Memeriksa apakah ada input yang kosong
    if (empty($username) || empty($nama) || empty($email) || empty($password)) {
        echo "<script>
                alert('Harap isi semua form!');
                window.location.href='daftar.php'; // Ganti dengan nama file form pendaftaran Anda
              </script>";
    } else {
        // Enkripsi password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // Menyimpan data ke database
        $sql = "INSERT INTO pengguna VALUES (null ,'$username', '$nama', '$email', '$hashed_password', current_timestamp())";

        if (mysqli_query($koneksi, $sql)) {
            echo "<script>
                    alert('Berhasil! Akun Anda sudah terdaftar. Silahkan login.');
                    window.location.href='login.php'; 
                  </script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
        }

        // Menutup koneksi
        mysqli_close($koneksi);
    }
}
?>


    <!-- Footer -->
    <footer class="bg-dark text-white py-2">
        <div class="container">
            <div class="text-center pt-2">
                <p>&copy; 2024 Pelangu. Kopi Kanan.</p>
            </div>
        </div>
    </footer>

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

</body>

</html>