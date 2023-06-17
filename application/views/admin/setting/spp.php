<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
            <div class="card-header py-3 bg-gray-900 text-white">
            <small>Harga spp per jurusan</small>
            <!--  <a href="<?= base_url('admin/setting/index') ?>" class="btn bg-gradient-warning text-white btn-circle btn-sm">
                  <i class="fas fa-arrow-left"></i>
              </a> -->
            </div>
            <?= form_open('', "class='form-horizontal'") ?>
            <div class="card-body">
              <?php $i=1;foreach ($jurusan as $key): ?>
              <div class="form-group">
                <small for="harga_spp_<?= $i ?>"><?= ucfirst($key->nama_jurusan) ?></small>
                <input type="number" name="harga_spp_<?= $i ?>" class="form-control" value="<?= $key->harga_spp ?>"  required>
              </div>
              <?php $i++;endforeach ?>
            </div>
            <div class="card-footer bg-gray-900 text-right">
              <button type="submit" name="save" class="btn bg-gradient-success text-white btn-sm"><i class="fa fa-save"></i> Simpan</button>
            </div>
            <?= form_close(); ?>
        </div>
	</div>
</div>