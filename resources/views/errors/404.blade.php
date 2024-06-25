<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Error</title>
    <meta name="description" content="" />

    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/vendor/vendor.js', 'resources/js/app.js'])

</head>

<body>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="text-center">
            <h1 class="display-1 fw-bold">404</h1>
            <p class="fs-3"> <span class="text-danger">Opps!</span> Halaman Tidak Ditemukan!</p>
            <p class="lead">
                Halaman yang Anda cari tidak ada.
            </p>
            <a href="/admin/dashboard" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</body>

</html>