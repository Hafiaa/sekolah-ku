<?php
$url1 = strtolower($this->uri->segment(1));
$url2 = $this->uri->segment(3);
?>

<ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin') ?>">
    <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-graduation-cap"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Sekolah Pintar</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item <?= $url1 == 'dashboard' || $url1 == '' ? 'active' : '' ?>">
    <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">


  <?php if ($this->session->userdata('hak_akses')) : ?>



    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= ($url1 == 'kelas' || $url1 == 'jurusan' || $url1 == 'siswa') && $url2 != 'kenaikan_kelas' ? 'active' : '' ?>">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-list"></i>
        <span>Master Data</span>
      </a>
      <div id="collapseTwo" class="collapse <?= ($url1 == 'kelas' || $url1 == 'jurusan' || $url1 == 'siswa') && $url2 != 'kenaikan_kelas' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item <?= $url1 == 'kelas' && $url2 == '' ? 'active' : '' ?>" href="<?= base_url('admin/kelas') ?>"><small class="fas fa-circle"></small> Kelas</a>
          <a class="collapse-item <?= $url1 == 'jurusan' && ($url2 == '' || $url2 == 'index' || $url2 == 'add' || $url2 == 'update') ? 'active' : '' ?>" href="<?= base_url('admin/jurusan') ?>"><small class="fas fa-circle"></small> Jurusan</a>
        </div>
      </div>
    </li>

    <hr class="sidebar-divider">
  <?php endif ?>
  <!-- Heading -->
  <!-- <div class="sidebar-heading">
Manage
</div> -->



  <li class="nav-item <?= $url1 == 'spp' || $url1 == 'seragam' || $url1 == 'biaya_lain' || $url1 == 'tabungan' ? 'active' : '' ?>">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo1" aria-expanded="true" aria-controls="collapseTwo1">
      <i class="fa fa-credit-card"></i>
      <span>Payment</span>
    </a>
    <div id="collapseTwo1" class="collapse <?= $url1 == 'spp' || $url1 == 'seragam' || $url1 == 'biaya_lain' || $url1 == 'tabungan' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item <?= $url1 == 'spp' && ($url2 == '' || $url2 == 'index' || $url2 == 'update') ? 'active' : '' ?>" href="<?= base_url('admin/spp') ?>"><small class="fas fa-circle"></small> Spp</a>
        <a class="collapse-item <?= $url1 == 'seragam' && ($url2 == '' || $url2 == 'index' || $url2 == 'add') ? 'active' : '' ?>" href="<?= base_url('admin/seragam') ?>"><small class="fas fa-circle"></small> Baju Seragam</a>
        <a class="collapse-item <?= $url1 == 'biaya_lain' && ($url2 == '' || $url2 == 'index' || $url2 == 'add' || $url2 == 'bayar_biaya_lain') ? 'active' : '' ?>" href="<?= base_url('admin/biaya_lain') ?>"><small class="fas fa-circle"></small> Biaya Lain</a>
        <a class="collapse-item <?= $url1 == 'tabungan' && ($url2 == '' || $url2 == 'index' || $url2 == 'form') ? 'active' : '' ?>" href="<?= base_url('admin/tabungan') ?>"><small class="fas fa-circle"></small> Tabungan</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">

  <?php if ($this->session->userdata('hak_akses')) : ?>

    <li class="nav-item <?= $url1 == 'pemasukan' || $url1 == 'pengeluaran' ? 'active' : '' ?>">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo2" aria-expanded="true" aria-controls="collapseTwo2">
        <i class="fas fa-arrow-right" aria-hidden="true"></i>
        <span>Money</span>
      </a>
      <div id="collapseTwo2" class="collapse <?= $url1 == 'pemasukan' || $url1 == 'pengeluaran' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item <?= $url1 == 'pemasukan' && ($url2 == '' || $url2 == 'index') ? 'active' : '' ?>" href="<?= base_url('admin/pemasukan') ?>"><small class="fas fa-circle"></small> Pemasukan</a>
          <a class="collapse-item <?= $url1 == 'pengeluaran' && ($url2 == '' || $url2 == 'index' || $url2 == 'add' || $url2 == 'update') ? 'active' : '' ?>" href="<?= base_url('admin/pengeluaran') ?>"><small class="fas fa-circle"></small> Pengeluaran</a>
        </div>
      </div>
    </li>

    <hr class="sidebar-divider">



    <li class="nav-item <?= $url1 == 'laporan' && $url2 != 'spp' ? 'active' : '' ?>">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo3" aria-expanded="true" aria-controls="collapseTwo3">
        <i class="fas fa-print"></i>
        <span>Laporan Umum</span>
      </a>
      <div id="collapseTwo3" class="collapse <?= $url1 == 'laporan' && $url2 != 'spp' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item <?= $url1 == 'laporan' && $url2 == 'pemasukan' ? 'active' : '' ?>" href="<?= base_url('admin/laporan/pemasukan') ?>"><small class="fas fa-circle"></small> Laporan Pemasukan</a>
          <a class="collapse-item <?= $url1 == 'laporan' && $url2 == 'pengeluaran' ? 'active' : '' ?>" href="<?= base_url('admin/laporan/pengeluaran') ?>"><small class="fas fa-circle"></small> Laporan Pengeluaran</a>
          <!-- <a class="collapse-item <?= $url1 == 'laporan' && $url2 == 'spp' ? 'active' : '' ?>" href="<?= base_url('admin/laporan/spp') ?>"><small class="fas fa-circle"></small> Laporan Spp</a> -->
          <a class="collapse-item <?= $url1 == 'laporan' && $url2 == 'seragam' ? 'active' : '' ?>" href="<?= base_url('admin/laporan/seragam') ?>"><small class="fas fa-circle"></small> Laporan Seragam</a>
          <a class="collapse-item <?= $url1 == 'laporan' && $url2 == 'biaya_lain' ? 'active' : '' ?>" href="<?= base_url('admin/laporan/biaya_lain') ?>"><small class="fas fa-circle"></small> Laporan Biaya Lain</a>
          <!-- <a class="collapse-item <?= $url1 == 'laporan' && $url2 == 'tabungan' ? 'active' : '' ?>" href="<?= base_url('admin/laporan/tabungan') ?>"><small class="fas fa-circle"></small> Laporan Tabungan</a> -->
        </div>
      </div>
    </li>
    <hr class="sidebar-divider">

    <li class="nav-item <?= $url1 == 'laporantabungan' ? 'active' : '' ?>">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFor" aria-expanded="true" aria-controls="collapseFor">
        <i class="fas fa-print"></i>
        <span>Laporan Tabungan</span>
      </a>
      <div id="collapseFor" class="collapse <?= $url1 == 'laporantabungan' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item <?= $url1 == 'laporantabungan' && $url2 == 'tabungan_bulan' ? 'active' : '' ?>" href="<?= base_url('admin/laporantabungan/tabungan_bulan') ?>"><small class="fas fa-circle"></small> Tabungan Perbulan</a>
        </div>
      </div>
    </li>
    <hr class="sidebar-divider">


   
    <hr class="sidebar-divider">

    <li class="nav-item <?= $url1 == 'setting' ? 'active' : '' ?>">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo5" aria-expanded="true" aria-controls="collapseTwo5">
        <i class="fas fa-cog"></i>
        <span>Settings</span>
      </a>
      <div id="collapseTwo5" class="collapse <?= $url1 == 'setting' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item <?= $url1 == 'setting' && ($url2 == 'sekolah') ? 'active' : '' ?>" href="<?= base_url('admin/setting/sekolah') ?>"><small class="fas fa-circle"></small> Setting Sekolah</a>
          <a class="collapse-item <?= $url1 == 'setting' && ($url2 == 'broadcast') ? 'active' : '' ?>" href="<?= base_url('admin/setting/broadcast') ?>"><small class="fas fa-circle"></small> Setting Broadcast</a>
          <a class="collapse-item <?= $url1 == 'setting' && ($url2 == 'harga_spp') ? 'active' : '' ?>" href="<?= base_url('admin/setting/harga_spp') ?>"><small class="fas fa-circle"></small> Setting Spp</a>
          <a class="collapse-item <?= $url1 == 'setting' && ($url2 == 'harga_seragam') ? 'active' : '' ?>" href="<?= base_url('admin/setting/harga_seragam') ?>"><small class="fas fa-circle"></small> Setting Baju Seragam</a>
          <a class="collapse-item <?= $url1 == 'setting' && ($url2 == 'biaya_lain') ? 'active' : '' ?>" href="<?= base_url('admin/setting/biaya_lain') ?>"><small class="fas fa-circle"></small> Setting Biaya Lain</a>
        </div>
      </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
  <?php endif ?>

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>





      <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="clock">
            <i class="fas fa-clock fa-fw"></i>
          </a>
          <script>
            var myVar;
            var url = window.location.href;
            myVar = setInterval(function() {
              myTimer();
            }, 1);

            function myTimer() {
              var d = new Date();
              var t = d.toLocaleTimeString();
              $('#clock').html('<i class="fas fa-clock fa-fw"></i> &nbsp; <b style="color:black;"> ' + t + '</b>');
            }
          </script>
        </li>




        <!--     <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
      
        <span class="badge badge-danger badge-counter">3+</span>
      </a>
     
      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
          Alerts Center
        </h6>
        <a class="dropdown-item d-flex align-items-center" href="#">
          <div class="mr-3">
            <div class="icon-circle bg-primary">
              <i class="fas fa-file-alt text-white"></i>
            </div>
          </div>
          <div>
            <div class="small text-gray-500">December 12, 2019</div>
            <span class="font-weight-bold">A new monthly report is ready to download!</span>
          </div>
        </a>
        <a class="dropdown-item d-flex align-items-center" href="#">
          <div class="mr-3">
            <div class="icon-circle bg-success">
              <i class="fas fa-donate text-white"></i>
            </div>
          </div>
          <div>
            <div class="small text-gray-500">December 7, 2019</div>
            $290.29 has been deposited into your account!
          </div>
        </a>
        <a class="dropdown-item d-flex align-items-center" href="#">
          <div class="mr-3">
            <div class="icon-circle bg-warning">
              <i class="fas fa-exclamation-triangle text-white"></i>
            </div>
          </div>
          <div>
            <div class="small text-gray-500">December 2, 2019</div>
            Spending Alert: We've noticed unusually high spending for your account.
          </div>
        </a>
        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
      </div>
    </li>

    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope fa-fw"></i>

        <span class="badge badge-danger badge-counter">7</span>
      </a>

      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">
          Message Center
        </h6>
        <a class="dropdown-item d-flex align-items-center" href="#">
          <div class="dropdown-list-image mr-3">
            <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
            <div class="status-indicator bg-success"></div>
          </div>
          <div class="font-weight-bold">
            <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
            <div class="small text-gray-500">Emily Fowler · 58m</div>
          </div>
        </a>
        <a class="dropdown-item d-flex align-items-center" href="#">
          <div class="dropdown-list-image mr-3">
            <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
            <div class="status-indicator"></div>
          </div>
          <div>
            <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
            <div class="small text-gray-500">Jae Chun · 1d</div>
          </div>
        </a>
        <a class="dropdown-item d-flex align-items-center" href="#">
          <div class="dropdown-list-image mr-3">
            <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
            <div class="status-indicator bg-warning"></div>
          </div>
          <div>
            <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
          </div>
        </a>
        <a class="dropdown-item d-flex align-items-center" href="#">
          <div class="dropdown-list-image mr-3">
            <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
            <div class="status-indicator bg-success"></div>
          </div>
          <div>
            <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
            <div class="small text-gray-500">Chicken the Dog · 2w</div>
          </div>
        </a>
        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
      </div>
    </li>
 -->
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('fullname') ?></span> &nbsp;
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" data-target="#update_profil" data-toggle="modal" href="#">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>
            <a class="dropdown-item" data-target="#update_password" data-toggle="modal" href="#">
              <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
              Password
            </a>
            <!--  <a class="dropdown-item" href="#">
          <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
          Activity Log
        </a> -->
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>

      </ul>

    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->