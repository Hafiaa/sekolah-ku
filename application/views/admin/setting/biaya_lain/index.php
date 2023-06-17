<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
        <div class="card-header py-3 bg-gray-900">
         <a href="<?= base_url('admin/setting/add_biaya_lain') ?>" class="btn bg-gradient-primary text-white btn-circle btn-sm">
              <i class="fas fa-plus"></i>
          </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead class="bg-gray-800 text-white">
                <tr>
                  <th width="1%">No</th>
                  <th>Biaya Lain</th>
                  <th>Harga</th>
                  <th>Tanggal Update</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	<?php $i=1;foreach ($biaya_lain as $key): ?>
              	<tr>
              		<td class="text-center"><?= $i ?></td>
              		<td><?= $key->nama_biaya_lain ?></td>
                  <td>Rp. <?= number_format($key->harga_biaya_lain, 0,',','.') ?>,-</td>
                  <td><?= $this->lib->date_time($key->tanggal_biaya_lain) ?></td>
              		<td>
              			<a href="<?= base_url('admin/setting/edit_biaya_lain/').md5($key->id_biaya_lain) ?>" class="btn bg-gradient-warning text-white btn-circle btn-sm">
                      <i class="fa fa-edit"></i>
                    </a> 
                    <a href="<?= base_url('admin/setting/delete_biaya_lain/').md5($key->id_biaya_lain) ?>" class="btn bg-gradient-danger text-white btn-circle btn-sm" onClick="return confirm('Yakin mau hapus data <?= $key->nama_biaya_lain ?> ?')">
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