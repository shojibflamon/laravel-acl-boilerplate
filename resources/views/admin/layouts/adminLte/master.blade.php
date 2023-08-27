<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    @include($themeLayout.'css')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
        @include($themeLayout.'header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
        @include($themeLayout.'sidebar')
    <!-- /.Main Sidebar Container -->

    <!-- Content Wrapper. Contains page content -->
        @yield('content')
    <!-- /.content-wrapper -->

    <!-- Footer -->
    @include($themeLayout.'footer')
    <!-- /.Footer -->

</body>
</html>
