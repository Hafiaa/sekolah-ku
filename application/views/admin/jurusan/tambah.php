<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
            <div class="card-header py-3 bg-gray-900">
             <a href="<?= base_url('admin/jurusan/index') ?>" class="btn bg-gradient-warning text-white btn-circle btn-sm">
                  <i class="fas fa-arrow-left"></i>
              </a>
            </div>
            <?= form_open('', "class='form-horizontal'") ?>
            <div class="card-body">
              <div class="form-group">
                <small for="nama_jurusan">Jurusan : </small>
                <input type="text" name="nama_jurusan" class="form-control" value="<?= set_value('nama_jurusan') ?>">
                <small class="text-danger"><?= form_error('nama_jurusan') ?></small>
              </div>
              <div class="form-group">
                <small for="harga_spp">Harga Spp / Bulan : </small>
                <input type="number" name="harga_spp" class="form-control" value="<?= set_value('harga_spp') ?>">
                <small class="text-danger"><?= form_error('harga_spp') ?></small>
              </div>
            </div>
            <div class="card-footer bg-gray-900 text-right">
              <button type="submit" class="btn bg-gradient-success text-white btn-sm"><i class="fa fa-save"></i> Simpan</button>
              <button type="reset" class="btn bg-gradient-danger text-white btn-sm"><i class="fa fa-"></i> Reset</button>
            </div>
            <?= form_close(); ?>
        </div>
	</div>
</div>