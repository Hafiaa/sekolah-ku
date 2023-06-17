<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
        <div class="card-header py-3 bg-gray-900">
         <a href="<?= base_url('admin/jurusan/add') ?>" class="btn bg-gradient-primary text-white btn-circle btn-sm">
              <i class="fas fa-plus"></i>
          </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead class="bg-gray-800 text-white">
                <tr>
                  <th width="1%">No</th>
                  <th>Jurusan</th>
                  <th>Harga spp / bulan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	<?php $i=1;foreach ($jurusan as $key): ?>
              	<tr>
              		<td class="text-center"><?= $i ?></td>
              		<td><?= $key->nama_jurusan ?></td>
                  <td>Rp. <?= number_format($key->harga_spp, 0,',','.') ?>,-</td>
              		<td>
              			<a href="<?= base_url('admin/jurusan/update/').md5($key->id_jurusan) ?>" class="btn bg-gradient-warning text-white btn-circle btn-sm">
                      <i class="fa fa-edit"></i>
                    </a> 
                    <a href="<?= base_url('admin/jurusan/delete/').md5($key->id_jurusan) ?>" class="btn bg-gradient-danger text-white btn-circle btn-sm" onClick="return confirm('Yakin mau hapus data jurusan <?= $key->nama_jurusan ?> ?')">
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