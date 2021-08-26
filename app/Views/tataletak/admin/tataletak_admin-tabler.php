<?php
  helper('general');
?>
<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta3
* @link https://tabler.io
* Copyright 2018-2021 The Tabler Authors
* Copyright 2018-2021 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>eLayanan</title>
    <!-- CSS files -->
    <link href="<?= base_url('tabler-theme/dist/css/tabler.min.css') ?>" rel="stylesheet"/>
    <link href="<?= base_url('tabler-theme/dist/css/tabler-flags.min.css') ?>" rel="stylesheet"/>
    <link href="<?= base_url('tabler-theme/dist/css/tabler-payments.min.css') ?>" rel="stylesheet"/>
    <link href="<?= base_url('tabler-theme/dist/css/tabler-vendors.min.css') ?>" rel="stylesheet"/>
    <link href="<?= base_url('tabler-theme/dist/css/demo.min.css') ?>" rel="stylesheet"/>

    <?= $this->renderSection('css') ?>
  </head>
  <body class="antialiased">
    <div class="wrapper">
      <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            eLayanan
            <!--<a href=".">
               <img src="<?= base_url('tabler-theme/static/logo.svg') ?>" width="110" height="32" alt="eLayanan" class="navbar-brand-image">
            </a> -->
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
              <div class="btn-list">
              
               
              </div>
            </div>
            <div class="nav-item dropdown d-none d-md-flex me-3">
              <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                <span class="badge bg-red"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-card">
                <div class="card">
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad amet consectetur exercitationem fugiat in ipsa ipsum, natus odio quidem quod repudiandae sapiente. Amet debitis et magni maxime necessitatibus ullam.
                  </div>
                </div>
              </div>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url(<?= base_url('tabler-theme/static/avatars/000m.jpg') ?>"></span>
                <div class="d-none d-xl-block ps-2">
                  <div><?= session()->get("nama") ?></div>
                  <div class="mt-1 small text-muted"><?= session()->get("jabatan").' | '.session()->get("level") ?></div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="#" class="dropdown-item">Set status</a>
                <a href="#" class="dropdown-item">Profile & account</a>
                <a href="#" class="dropdown-item">Feedback</a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">Settings</a>
                <a href="#" class="dropdown-item">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </header>
      <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-fluid">
              <ul class="navbar-nav">
                <li class="nav-item <?php if($active=='home') echo 'active'; ?>">
                  <a class="nav-link" href="<?= base_url('home') ?>" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Beranda
                    </span>
                  </a>
                </li>
                <li class="nav-item dropdown <?php if($active2=='pegawai_kgb') echo 'active'; ?>">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <!-- Download SVG icon from http://tabler-icons.io/i/gift -->
  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="8" width="18" height="4" rx="1" /><line x1="12" y1="8" x2="12" y2="21" /><path d="M19 12v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-7" /><path d="M7.5 8a2.5 2.5 0 0 1 0 -5a4.8 8 0 0 1 4.5 5a4.8 8 0 0 1 4.5 -5a2.5 2.5 0 0 1 0 5" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Layanan Kepegawaian
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="./buttons.html" >
                          Cuti
                        </a>
                        <a class="dropdown-item <?php if($active2=='pegawai_kgb') echo 'active'; ?>" href="<?= base_url('/layanan/riwayatkgb/'.my_crypt(session()->get("nip"),'e').'/lihat') ?>" >
                          KGB
                        </a>
                        <a class="dropdown-item" href="./empty.html" >
                          Kenaikan Pangkat
                        </a>
                        <a class="dropdown-item" href="./accordion.html" >
                          Kartu Pegawai
                        </a>
                        <a class="dropdown-item" href="./blank.html" >
                          Kartu Istri/Suami
                        </a>
                        
                        <a class="dropdown-item" href="./cards.html" >
                          Izin Belajar
                        </a>
                        <a class="dropdown-item" href="./cards-masonry.html" >
                          Satya Lencana
                        </a>
                        <a class="dropdown-item" href="./colors.html" >
                          Data Layanan
                        </a>
                       
                      </div>
                    </div>
                  </div>
                </li>
<?php if(session()->get("level")!='pegawai'){ ?>
                <li class="nav-item dropdown <?php if($active2=='admin_kgb') echo 'active'; ?>">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <!-- Download SVG icon from http://tabler-icons.io/i/lego -->
  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="9.5" y1="11" x2="9.51" y2="11" /><line x1="14.5" y1="11" x2="14.51" y2="11" /><path d="M9.5 15a3.5 3.5 0 0 0 5 0" /><path d="M7 5h1v-2h8v2h1a3 3 0 0 1 3 3v9a3 3 0 0 1 -3 3v1h-10v-1a3 3 0 0 1 -3 -3v-9a3 3 0 0 1 3 -3" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Admin Kepegawaian
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item <?php if($active2=='admin_kgb') echo 'active'; ?>" href="<?= base_url('/admin/list_pegawai') ?>" >
                          Pengelolaan KGB
                        </a>
                        <a class="dropdown-item" href="./empty.html" >
                          Approval Pengajuan
                        </a>
                        <a class="dropdown-item" href="./accordion.html" >
                          Pengajuan ke BKPP
                        </a>
                      
                       
                      </div>
                    </div>
                  </div>
                </li>
<?php } ?>              
              </ul>
              <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                <form action="." method="get">
                  <div class="input-icon">
                    <span class="input-icon-addon">
                      <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>
                    </span>
                    <input type="text" class="form-control" placeholder="Search…" aria-label="Search in website">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>



      <!-- <div class="page-wrapper">
        <div class="container-fluid">
          
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Empty page
                </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-fluid">
           
          </div>
        </div> -->
        <div class="page-wrapper">
        <div class="container-fluid">
          
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">
                  <?= $page_title ?>
                </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-fluid">
            <?= $this->renderSection('konten') ?>
          </div>
        </div>



        <footer class="footer footer-transparent d-print-none">
          <div class="container">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                  <!-- <li class="list-inline-item"><a href="./docs/index.html" class="link-secondary">Documentation</a></li>
                  <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a></li> -->
                  <!-- <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank" class="link-secondary" rel="noopener">Source code</a></li> -->
          
                </ul>
              </div>
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                   &copy; Juli 2021
                    <a href="." class="link-secondary">Pemerintah Kabupaten Kulon Progo</a>
                  </li>
                  <li class="list-inline-item">
                    <a href="./changelog.html" class="link-secondary" rel="noopener">v1.0.0</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- Libs JS -->

   <!--  Custom -->
     <script src="<?= base_url('tabler-theme/custom/js/jquery-3.5.1.min.js') ?>"></script>

    <!-- Tabler Core -->
    <script src="<?= base_url('tabler-theme/dist/js/tabler.min.js') ?>"></script>
    <?= $this->renderSection('js') ?>
  </body>
</html>