<!DOCTYPE html>
<html lang="en" class="layout-menu-fixed">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Admin | {{ $title }}</title>
    <meta name="description" content="" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    {{-- TRIX EDITOR --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/vendor/vendor.js', 'resources/js/app.js',
    'resources/css/main.css'])

    {{-- CHART JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- LEAFLET --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    {{-- SELECT2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.81.1
/dist/L.Control.Locate.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.81.1
/dist/L.Control.Locate.min.js" charset="utf-8"></script>


</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('admin.partials.sidebar')
            <div class="layout-page" id="layout-page">
                @include('admin.partials.navbar')
                <div class="content-wrapper">
                    @yield('main-container')
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div id="layout-overlay" class="layout-overlay layout-menu-toggle"></div>
    </div>
    @vite(['resources/js/app.js'])

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
    <script>
        Swal.fire({
        position: "top-center",
        icon: "success",
        title: "{{ session('success') }}",
        showConfirmButton: true,
        timer: 2000
    });
    </script>
    @endif
    @stack('js')
    <script>
        function openNav() {
            document.getElementById("layout-menu").style.width = "250px";
            document.getElementById("layout-menu").style.display = "block";
            document.getElementById("layout-page").style.width = "100%";
            document.getElementById("layout-page").style.paddingLeft = "260px";

        }
        function openNavMini() {
            document.getElementById("layout-menu").style.width = "250px";
            document.getElementById("layout-menu").style.display = "block";
            document.getElementById("layout-page").style.width = "100%";
        }
        function closeNavMini() {
            document.getElementById("layout-menu").style.width = "0";
            document.getElementById("layout-menu").style.display = "none";
            document.getElementById("layout-page").style.width = "100%";
        }
        function closeNav() {
            document.getElementById("layout-menu").style.width = "0";
            document.getElementById("layout-menu").style.display = "none";
            document.getElementById("layout-page").style.width = "100%";
            document.getElementById("layout-page").style.paddingLeft = "0";
        }
        function confirmDelete(id) {
            Swal.fire({
                title: "Yakin ingin menghapus data ini?",
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus",
                cancelButtonText: "Batal",
                backdrop: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
</body>

</html>