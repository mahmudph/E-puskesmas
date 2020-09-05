<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <?= view('partials/head.php') ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url() ?>" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right data-notive">
          
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          <div class="profile-data">
            <a href="">
              <img src="<?= base_url('img/icon.jpeg') ?>" class="img-responsive img-circle" alt="profile" width="80px" height="80px">
            </a>
            <p class="admin-name"><?= session()->get('nama')?> </p>
            
          </div>
          <div class="dropdown-divider"></div>
          <a href="<?= base_url('auth/logout') ?>" class="dropdown-item">
            <i class="fa fa-sign-out mr-2"></i>Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link">
      <img src="<?= base_url()?>/img/icon.jpeg" alt="Banyuasin Logo" class="brand-image img elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Welcome Adm</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?= view('partials/menu/admin.menu.php') ?>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $title ? $title : 'Dasboard' ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
              <li class="breadcrumb-item active"><?= $title ? $title : 'Dasboard' ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?= view($content) ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- REQUIRED SCRIPTS -->
<?= view('partials/footer-jsconfig.php') ?>
<script>
$(document).ready(function() {
  $.get('<?= base_url('admin/api/notif') ?>', function(data){
    $('.navbar-badge').text((data.count + data.pendaftar));
      $('.data-notive').append(`
        <span class="dropdown-header count-notive">${data.count} notifikasi terbaru</span>
          <div class="dropdown-divider"></div>
          <a href="/admin/pengumuman/" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> ${data.count} pengumuman terbaru
            <span class="float-right text-muted text-sm">1 mins</span>
          </a>
          <a href="/admin/pendaftaran/" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> ${data.pendaftar} pendaftar terbaru
            <span class="float-right text-muted text-sm">1 mins</span>
          </a>
      `);
  });
})
</script>


</body>
</html>
