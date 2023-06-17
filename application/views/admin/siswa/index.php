<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
        <div class="card-header py-3 bg-gray-900">
        <div class="row">
          <div class="col-lg-6">
           <a href="<?= base_url('admin/siswa/add') ?>" class="btn bg-gradient-primary text-white btn-circle btn-sm">
                <i class="fas fa-plus"></i>
            </a>
          </div>
          <div class="col-lg-6 text-right">
            <a class="btn btn-default bg-gray-300 btn-sm" data-target="#import_siswa" data-toggle="modal"><i class="fas fa-file-import"></i> Import</a>
            <a class="btn btn-default bg-gray-300 btn-sm" href="<?= base_url('admin/siswa/export_siswa') ?>"><i class="fas fa-file-export"></i> Export</a>
          </div>
        </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead class="bg-gray-800 text-white">
                <tr>
                  <th width="1%">No</th>
                  <th>NIS</th>
                  <th>Nama Siswa</th>
                  <th>Kelas</th>
                  <th>Beasiswa</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	<?php $i=1;foreach ($siswa as $key): ?>
              	<tr>
              		<td class="text-center"><?= $i ?></td>
                  <td><?= $key->nisn ?></td>
              		<td><?= $key->nama_siswa ?></td>
                  <td><?= $key->nama_kelas ?> - <?= $key->nama_jurusan ?></td>
                  <td>
                    <?php if ($key->beasiswa): ?>
                      <p class="text-success"><?= $key->beasiswa ?></p>
                    <?php else: ?>
                      <p>-</p>
                    <?php endif ?>
                  </td>
              		<td>
                    <a href="<?= base_url('admin/siswa/detail/').md5($key->id_siswa) ?>" class="btn bg-gradient-info text-white btn-circle btn-sm"><i class="fa fa-eye"></i></a>
              			<a href="<?= base_url('admin/siswa/update/').md5($key->id_siswa) ?>" class="btn bg-gradient-warning text-white btn-circle btn-sm"><i class="fa fa-edit"></i></a> 
                    <a href="<?= base_url('admin/siswa/delete/').md5($key->id_siswa) ?>" class="btn bg-gradient-danger text-white btn-circle btn-sm" onClick="return confirm('Yakin mau hapus data siswa <?= $key->nama_siswa ?> , ini akan menghapus semua data yang bersangkutan ?')"><i class="fas fa-trash"></i></a>
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










<div class="modal fade" id="import_siswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gray-900 text-white">
        <h6 class="modal-title" id="exampleModalLabel">Import Siswa</h6>
        <button class="close x-cancel" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <?= form_open_multipart('admin/siswa/saveimport') ?>
      <div class="modal-body"><br>
        <div class="form-group">
          <label for="">File Exel : </label>
          <input type="file" class="form-control" name="file" required>
        </div><br>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-xs x-cancel" type="button" data-dismiss="modal" id="cancel_keluar">Cancel</button>
        <button class="btn btn-primary btn-xs" type="submit">Proses</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>