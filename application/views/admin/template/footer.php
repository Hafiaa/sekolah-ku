    <!-- modal Profil -->
    <div class="modal fade" id="update_profil">
      <div class="modal-dialog modal-sm">
       <div class="modal-content">
          <div class="modal-header bg-gray-900 text-white"><i class="fa fa-user"> Profil</i></div>
          <form action="<?= base_url('admin/account/update_profil') ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <label for="username" class="small">Username : </label>
            <input type="text" name="username" class="form-control" required  value="<?= $this->session->userdata('username'); ?>" autofocus="on">
            <br>
            <label for="full_name" class="small">Nama Lengkap : </label>
            <input type="text" name="fullname" class="form-control" required value="<?= $this->session->userdata('fullname'); ?>" >
            <br>
            <label class="small">Foto Profil : </label>
            <img src="<?= base_url('assets/img/account/'). $this->session->userdata('foto_account'); ?>" class="img img-responsive img-thumbnail" style="width: 100%;">
            <input type="file" name="foto_account" class="form-control">
            <small class="text-info">*kosongkan Jika Tidak Akan Merubah Foto</small><br><br>
            <label for="password" class="small">Confirm Password : </label>
            <input type="password" name="password"  class="form-control" required >
            <br><br>
            <small class="text-info">*Jika berhasil akan di minta login kembali !</small>
          </div>
          <div class="modal-footer">
             <button data-dismiss="modal" class="btn bg-gray-500 text-white pull-left btn-xs"><i class="fa fa-remove"></i> Cancel</button>
             <button type="submit" class="btn bg-gray-900 text-white btn-xs"><i class="fa fa-save"></i> Simpan</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- #modalProfil -->

    <!-- modalpassword -->
    <div class="modal fade" id="update_password">
      <div class="modal-dialog modal-sm">
       <div class="modal-content">
          <div class="modal-header bg-blue bg-gray-900 text-white"><i class="fa fa-lock"> Ganti Password</i> </div>
          <form action="<?= base_url('admin/account/update_password') ?>" method="post">
          <div class="modal-body">

            <input type="password" name="pw1"  class="form-control" required placeholder="Password Baru">
            <br>
            <input type="password" name="pw2" class="form-control" required placeholder="Confirm Password Baru">
            <br>
            <input type="password" name="password_lama"  class="form-control" required placeholder="Confirm Password Lama">
            <br><br>
            <small class="text-info">*Jika berhasil akan di minta login kembali !</small>

          </div>
          <div class="modal-footer">
             <button data-dismiss="modal" class="btn bg-gray-500 text-white pull-left btn-xs"><i class="fa fa-remove"></i> Cancel</button>
             <button type="submit" class="btn bg-gray-900 text-white btn-xs"><i class="fa fa-save"></i> Simpan</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- modal import -->
    <div class="modal fade" id="import_database">
      <div class="modal-dialog modaSriwijayal-sm">
       <div class="modal-content">
          <div class="modal-header bg-gray-900 text-center text-white" id="tunggu"> Import Database ( file.sql )</div>
          <?= form_open_multipart('admin/backup/import') ?>
          <div class="modal-body">
            <label for="file">File Sql : </label>
            <input type="file" name="file"  class="form-control" required>
         
            <small class="text-info">* File harus berupa .sql !</small>

          </div>
          <div class="modal-footer">
            <button data-dismiss="modal" class="btn bg-gray-500 text-white pull-left btn-xs"><i class="fa fa-remove"></i> Cancel</button>
            <button type="submit" class="btn bg-gray-900 text-white btn-xs"><i class="fa fa-save"></i> Simpan</button>
          </div>
          <?= form_close() ?>
        </div>
      </div>
    </div>
    <!-- end modal -->


  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
    <footer class="sticky-footer bg-white">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
        <p>© Sekolah Pintar. All Rights Reserved.</p>
        </div>
      </div>
    </footer>
    <!-- End of Footer -->

  </div>
  <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pemberitahuan !</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Yakin mau logout ?</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
      </div>
    </div>
  </div>
</div>

  

  <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?= base_url() ?>assets/js/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url('assets/') ?>js/demo/datatables-demo.js"></script>

  <script>
    $(document).ready(function(){
      $('.textarea').wysihtml5();
    });
  function notifikasi(status, text) {
      if (status == 'success') {
        $.toast({
                  heading: 'Success',
                  text: text,
                  showHideTransition: 'slide',
                  icon: 'success',
                  hideAfter: 5000,
                  position: 'top-right'
        });
         var audio = new Audio('<?= base_url(); ?>assets/sound/1.mp3');
      }else{
        $.toast({
                  heading: 'error',
                  text: text,
                  showHideTransition: 'slide',
                  icon: 'error',
                  hideAfter: 5000,
                  position: 'top-right'
            });
        var audio = new Audio('<?= base_url() ?>assets/sound/1.mp3');
      }

        audio.play();
  }
  </script>

  <?php if (@$this->session->flashdata('message')): ?>
  <script>
    notifikasi('success', '<?= $this->session->flashdata('message'); ?>');
  </script>
<?php elseif($this->session->flashdata('failed')): ?>
  <script>
    notifikasi('failed', '<?= $this->session->flashdata('failed'); ?>');
  </script>
<?php endif; ?>
</body>

</html>
