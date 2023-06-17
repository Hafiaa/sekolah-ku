<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
        <div class="card-header py-3 bg-gray-900">
           <a href="<?= base_url('admin/pemasukan/reset_pemasukan') ?>" class="btn bg-gradient-danger text-white btn-sm float-right" onclick="return confirm('Yakin akan menghapus semua data pemasukan ?')">
                <i class="fas fa-refresh"></i> Reset All Data
          </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead class="bg-gray-800 text-white">
                <tr>
                  <th width="1%">No</th>
                  <th>Tanggal Pemasukan</th>
                  <th>Jumlah</th>
                  <th>Type Pemasukan</th>
                </tr>
              </thead>
              <tbody>
              	<?php $i=1;foreach ($pemasukan as $key): ?>
              	<tr>
              		<td class="text-center"><?= $i ?></td>
              		<td><?= $this->lib->date_indo($key->tanggal_pemasukan) ?></td>
                  <td>Rp. <?= number_format($key->jumlah_pemasukan,0,',','.') ?>,-</td>
                  <td><?= word_limiter($key->type_pemasukan, 10) ?></td>
              	</tr>
              	<?php $i++;endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer bg-gray-900">
          
        </div>
    </div>
	</div>
</div>