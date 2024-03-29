<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $judul ?></title>

  <!-- Custom styles for this page -->
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/inovindo.png" />

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <!-- <link rel="stylesheet" href="../node_modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="../node_modules/weathericons/css/weather-icons.min.css">
  <link rel="stylesheet" href="../node_modules/weathericons/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="../node_modules/summernote/dist/summernote-bs4.css"> -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/components.css">

  <!-- Plugin leaflet maps -->
  <link href="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Plugin leaflet maps -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
 <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
  <!-- Plugin leaflet search -->
  <script src="<?= base_url('leaflet-search/') ?>src/leaflet-search.js"></script>

  <!-- Plugin leaflet GEOCODER -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

  <!-- Plugin leaflet fullscreen -->

  <!-- data table -->
  <link href="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />

  <!-- Select Search -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  
  <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
  <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />


  <style>
    .Tulisanbagus {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
      background-color: #fff;
      border-radius: 3px;
      border: none;
      position: relative;
      margin-bottom: 30px;
      padding: 20px;
      /* display: flex; */
      align-items: center;
    }

    .Tulisanbagus h1 {
      margin-bottom: 0;
      font-weight: 700;
      display: inline-block;
      font-size: 24px;
      margin-top: 3px;
      color: #34395e;
    }
  </style>

  <!-- Custom styles for this template -->
  <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet" />

  <link href="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />

  <!-- JS Charts -->
  <!-- //pemanggilan line -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="<?= base_url() ?>assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Hi, <?= $user['username'] ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="<?= base_url('auth/logout') ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?= base_url() ?>">Pemetaan Client</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url() ?>"><img src="assets/img/icon.png" class="w3-circle" alt="Alps"></a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">DASHBOARD</li>
            <li><a class="nav-link" href="<?= base_url('Dashboard') ?>"><i class="fas fa-chart-line"></i> <span>Dashboard </span></a></li>
            </li>
            <li class="menu-header">MAP</li>
            <li><a class="nav-link" href="<?= base_url('Map') ?>"><i class="fas fa-map-marker-alt"></i> <span>Map</span></a></li>
            <li class="menu-header">CLIENT</li>
            <li><a class="nav-link" href="<?= base_url('Client') ?>"><i class="fas fa-users"></i> <span>Data Client</span></a></li>
            <li class="menu-header">PROJECT</li>
            <li><a class="nav-link" href="<?= base_url('Project') ?>"><i class="fas fa-tasks"></i> <span>Data Project</span></a></li>
            <li class="menu-header">LOGOUT</li>
            <li><a class="nav-link" href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
        </aside>
      </div>