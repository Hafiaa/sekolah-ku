<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
            <div class="card-header py-3 bg-gray-900 text-white">
            <small>Last Updated : <?= $this->lib->date_indo($tanggal_broadcast) ?></small>
             <!-- <a href="<?= base_url('admin/setting/index') ?>" class="btn bg-gradient-warning text-white btn-circle btn-sm">
                  <i class="fas fa-arrow-left"></i>
              </a> -->
            </div>
            <?= form_open('', "class='form-horizontal'") ?>
            <div class="card-body">
              <div class="form-group">
                <small for="broadcast">Broadcast : </small>
                <textarea name="broadcast" class="form-control"  rows="5" ><?= set_value('broadcast') ? set_value('broadcast') : $broadcast ?></textarea>
                <small class="text-danger"><?= form_error('broadcast') ?></small>
              </div>
            </div>
            <div class="card-footer bg-gray-900 text-right">
              <button type="submit" class="btn bg-gradient-success text-white btn-sm"><i class="fa fa-save"></i> Simpan</button>
            </div>
            <?= form_close(); ?>
        </div>
	</div>
</div>