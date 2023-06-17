<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
        <div class="card-header py-3 bg-gray-900">
          <a href="<?= base_url('admin/pengeluaran/add') ?>" class="btn bg-gradient-primary text-white btn-circle btn-sm float-left">
              <i class="fas fa-plus"></i>
          </a>
          <a href="<?= base_url('admin/pengeluaran/reset_pengeluaran') ?>" class="btn bg-gradient-danger text-white btn-sm float-right" onclick="return confirm('Yakin akan menghapus semua data pegeluaran ?')">
                <i class="fas fa-refresh"></i> Reset All Data
          </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead class="bg-gray-800 text-white">
                <tr>
                  <th width="1%">No</th>
                  <th>Tanggal Pengeluaran</th>
                  <th>Jumlah</th>
                  <th>Keterangan</th>
                  <th>Operator</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	<?php $i=1;foreach ($pengeluaran as $key): ?>
              	<tr>
              		<td class="text-center"><?= $i ?></td>
              		<td><?= $this->lib->date_indo($key->tanggal_pengeluaran) ?></td>
                  <td>Rp. <?= number_format($key->jumlah_pengeluaran,0,',','.') ?>,-</td>
                  <td><?= word_limiter($key->keterangan_pengeluaran, 10) ?></td>
                  <td><?= $key->operator ?></td>
              		<td>
              			<a href="<?= base_url('admin/pengeluaran/update/').md5($key->id_pengeluaran) ?>" class="btn bg-gradient-warning text-white btn-circle btn-sm">
                      <i class="fa fa-edit"></i>
                    </a> 
                    <a href="<?= base_url('admin/pengeluaran/delete/').md5($key->id_pengeluaran) ?>" class="btn bg-gradient-danger text-white btn-circle btn-sm" onClick="return confirm('Yakin mau hapus data pengeluaran Rp. <?= number_format($key->jumlah_pengeluaran,0,',','.') ?>,- ?')">
                      <i class="fas fa-trash"></i>
                    </a>
              		</td>
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