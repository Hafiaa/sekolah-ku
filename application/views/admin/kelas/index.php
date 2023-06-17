<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
        <div class="card-header py-3 bg-gray-900">
         <!-- <a href="<?= base_url('admin/kelas/add') ?>" class="btn bg-gradient-primary text-white btn-circle btn-sm">
              <i class="fas fa-plus"></i>
          </a> -->
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
              <thead class="bg-gray-800 text-white">
                <tr>
                  <th width="1%">No</th>
                  <th>Kelas</th>
                </tr>
              </thead>
              <tbody>
              	<?php $i=1;foreach ($kelas as $key): ?>
              	<tr>
              		<td class="text-center"><?= $i ?></td>
              		<td><?= $key->nama_kelas ?></td>
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