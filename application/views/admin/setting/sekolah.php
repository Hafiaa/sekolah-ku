<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
            <div class="card-header py-3 bg-gray-900 text-white">
            <!-- <small>Last Updated : </small> -->
             <!-- <a href="<?= base_url('admin/setting/index') ?>" class="btn bg-gradient-warning text-white btn-circle btn-sm">
                  <i class="fas fa-arrow-left"></i>
              </a> -->
            </div>
            <?= form_open_multipart('', "class='form-horizontal'") ?>
            <div class="card-body">
              <div class="form-group">
                <small for="nama_sekolah">Nama Sekolah : </small>
                <input type="text" name="nama_sekolah" class="form-control" value="<?= set_value('nama_sekolah') ? set_value('nama_sekolah') : $nama_sekolah ?>">
                <small class="text-danger"><?= form_error('nama_sekolah') ?></small>
              </div>
               <div class="form-group">
                <small for="alamat_sekolah">Alamat Sekolah : </small>
                <textarea name="alamat_sekolah" class="form-control" ><?= set_value('alamat_sekolah') ? set_value('alamat_sekolah') : $alamat_sekolah ?></textarea>
                <small class="text-danger"><?= form_error('alamat_sekolah') ?></small>
              </div>
              <div class="form-group">
                <small for="email_sekolah">Email Sekolah : </small>
                <input type="email" name="email_sekolah" class="form-control" value="<?= set_value('email_sekolah') ? set_value('email_sekolah') : $email_sekolah ?>">
                <small class="text-danger"><?= form_error('email_sekolah') ?></small>
              </div>
              <div class="form-group">
                <small for="no_telp_sekolah">Nomor Telp Sekolah : </small>
                <input type="number" name="no_telp_sekolah" class="form-control" value="<?= set_value('no_telp_sekolah') ? set_value('no_telp_sekolah') : $no_telp_sekolah ?>">
                <small class="text-danger"><?= form_error('no_telp_sekolah') ?></small>
              </div>
              <div class="form-group">
                <small for="tentang_kami">Tentang Kami : </small>
                <textarea name="tentang_kami" class="form-control textarea" rows="10"><?= set_value('tentang_kami') ? set_value('tentang_kami') : $tentang_kami ?></textarea>
                <small class="text-danger"><?= form_error('tentang_kami') ?></small>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="logo_sekolah">Logo Sekolah : </label><br>
                    <img src="<?= base_url('assets/img/sekolah/' . $logo_sekolah) ?>" class="img img-thumbnail img-responsive" style="width: 200px;"><br>
                  </div>
                  <input type="file" name="logo_sekolah">
                </div>
              </div><br><br>
            </div>
            <div class="card-footer bg-gray-900 text-right">
              <button type="submit" class="btn bg-gradient-success text-white btn-sm"><i class="fa fa-save"></i> Simpan</button>
            </div>
            <?= form_close(); ?>
        </div>
  </div>
</div>