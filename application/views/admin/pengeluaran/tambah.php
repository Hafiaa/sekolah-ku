<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
            <div class="card-header py-3 bg-gray-900">
             <a href="<?= base_url('admin/pengeluaran/index') ?>" class="btn bg-gradient-warning text-white btn-circle btn-sm">
                  <i class="fas fa-arrow-left"></i>
              </a>
            </div>
            <?= form_open('', "class='form-horizontal'") ?>
            <div class="card-body">

              <div class="form-group">
                <small for="jumlah_pengeluaran">Jumlah Pengeluaran : </small>
                <input type="number" name="jumlah_pengeluaran" class="form-control" value="<?= set_value('jumlah_pengeluaran') ?>">
                <small class="text-danger"><?= form_error('jumlah_pengeluaran') ?></small>
              </div>

              <div class="form-group">
                <small for="keterangan_pengeluaran">Keterangan Pengeluaran : </small>
                <textarea name="keterangan_pengeluaran" class="form-control" rows="10"><?= set_value('keterangan_pengeluaran') ?></textarea>
                <small class="text-danger"><?= form_error('keterangan_pengeluaran') ?></small>
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