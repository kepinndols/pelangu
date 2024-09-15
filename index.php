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
            <div class="collapse navbar-collapse" id="navbarNav">
                <div style="display: flex;" class="btn-container ms-auto">
                    <a href="daftar.php" style="text-decoration: none;">
                        <button class="button-daftar me-2" data-bs-toggle="modal" data-bs-target="#registerModal">
                            Daftar</button></a>
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
                    <a href="daftar.php" style="text-decoration: none;">
                        <button class="button-daftar1" data-bs-toggle="modal" data-bs-target="#loginModal">Daftar
                            Sekarang!</button>
                    </a>
                </div>
            </div>
        </div>
    </header>


    <!-- Footer -->
    <footer class="bg-dark text-white py-2 ">
        <div class="container">
            <div class="text-center pt-2">
                <p>&copy; 2024 Pelangu. Kopi Kanan.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>