
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gray-900">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center" style="margin-top: 100px;">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 my-5" style="box-shadow: 10px 15px 20px rgba(0,0,0,0.5) !important;">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-gray-900 text-center justify-content-center">
                <img src="<?= base_url('assets/img/sekolah/' . $logo_sekolah) ?>" alt="" width="50%" class="img img-responsive" style="margin: 100px; auto !important;">
              </div>
              <div class="col-lg-6 bg-gray-800 text-white">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-100 mb-4"> Login</h1>
                  </div>
                  <?php 
                    if ($this->session->flashdata('message')) {
                      echo '<small>'.$this->session->flashdata('message').'</small>';
                    }
                   ?>
                  <?= form_open('', 'class="user"') ?>
                    <div class="form-group">
                      <input type="username" class="form-control"  name="username" placeholder="Username" autofocus autocomplete="off">
                      <?= form_error('username', '<small style="color:red;">', '</small>') ?>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control"  name="password" placeholder="Password">
                      <?= form_error('password', '<small style="color:red;">', '</small>') ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                    <hr>
                    <a href="<?= base_url() ?>"><i class="fa fa-arrow-left"></i> Kembali ke home</a>
                  <?= form_close(); ?>
                
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>


    </div>

    <!--
  </div>
    <footer class="sticky-footer text-white">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
           <strong>Copyright &copy; <?= date('Y').' - '.date('Y', strtotime('+3 year')) ?> <a href="https://lamuncoding.id">Lamun Coding</a>.</strong> All rights reserved.
        </div>
      </div>
    </footer> -->

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

  <script>
    $(document).ready(function(){
      $('.alert').alert().delay(5000).hide('slow');
    });
  </script>

</body>

</html>
