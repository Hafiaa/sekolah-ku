<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
        <div class="card-header py-3 bg-gray-900">
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead class="bg-gray-800 text-white">
                <tr>
                  <th width="1%">No</th>
                  <th>File Name</th>
                  <th>Tanggal Backup</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	<?php $i=1;foreach ($backup as $key): ?>
              	<tr>
              		<td class="text-center"><?= $i ?></td>
              		<td><?= $key->name_backup_data ?></td>
                  <td><?= $this->lib->date_indo($key->tanggal_backup_data) .' &nbsp; '.date('H:i a') ?></td>
              		<td>
                  <a href="<?= base_url('backup/db/').$key->name_backup_data ?>" class="btn bg-gradient-success text-white btn-circle btn-sm" download>
                      <i class="fa fa-download"></i>
                    </a> 
                    <a href="<?= base_url('admin/backup/delete/').md5($key->id_backup_data) ?>" class="btn bg-gradient-danger text-white btn-circle btn-sm" onClick="return confirm('Yakin mau hapus data backup <?= $key->name_backup_data ?> ?')">
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