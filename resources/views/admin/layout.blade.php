<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Starter</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Select 2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset("admin/bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css") }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("admin/bower_components/admin-lte/dist/css/adminlte.min.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/dist/css/style.css") }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Top Navbar -->
    @include("admin.partials.top_navbar")
    <!-- /.navbar -->

    <!-- Left Sidebar Container -->
    @include("admin.partials.left_sidebar")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="main-content">
            <h3 class="text-capitalize">{{ $controllerName }}</h3>
            @yield("content")
        </div>
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    @include("admin.partials.footer")
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset("admin/bower_components/admin-lte/plugins/jquery/jquery.min.js") }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset("admin/bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("admin/bower_components/admin-lte/dist/js/adminlte.min.js") }}"></script>
<!----- SweetAlert2 ----->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!----- Select 2 ----->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<!-- Ckeditor JS -->
<script src="{{ asset("admin/bower_components/admin-lte/plugins/ckeditor/ckeditor.js") }}"></script>

<script> CKEDITOR.replace('ckeditor',{
        language: 'en',
        uiColor: '#343a40',
    });
</script>

<script src="{{ asset("admin/dist/js/main.js") }}"></script>

</body>
</html>
