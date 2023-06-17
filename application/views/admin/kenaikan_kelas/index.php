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

            <?= form_open() ?>
            <div class="row">
                <div class="col-lg-11  col-md-5 col-xs-12">
                  <select name="kelas" id="kelas" class="form-control" required>
                    <?php if (!set_value('kelas')): ?>
                    <option value="">-- pilih kelas & jurusan --</option>
                    <?php endif ?>
                    <?php foreach ($kelas as $key): ?>
                      <?php foreach ($jurusan as $row): ?>
                        <option value="<?= $key->id_kelas.','. $row->id_jurusan ?>" <?= set_value('kelas') == $key->id_kelas.','.$row->id_jurusan ? 'selected' : '' ?>><?= $key->nama_kelas .' - '. $row->nama_jurusan ?></option>
                      <?php endforeach ?>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="col-lg-1  col-md-2 col-xs-12">
                  <button class="btn bg-gray-900 text-white" type="submit" name="cari"><i class="fa fa-search" aria-hidden="true"></i> </button>
                </div>
            </div>
            <?= form_close(); ?>

            <div class="row">
              <div class="col-lg-12">
                <hr class="sidebar-divider">
              </div>
            </div>


            <script>
              function cheklist(){

                if($('#cheklist').data('active') == 0){
                  $('#cheklist').data('active', 1);
                  $('.checkbox').attr('checked', '');
                }else{
                  $('#cheklist').data('active', 0);
                  $('.checkbox').removeAttr('checked');
                } 
              }
             </script>
            <?php if (@$siswa): ?>
              <div class="row" style="margin-top: 20px;" id="loading-data-pengeluaran">
                <div class="col-lg-12 text-center"><h4><i class="fa fa-spinner fa-spin"></i> Loading</h4></div>
              </div>
              <div class="row" style="margin-top: 20px; display: none;" id="data-pengeluaran">
                <div class="col-lg-12">
                  <table cellpadding="5">
                    <tr>
                      <th>Kelas</th>
                      <td>:</td>
                      <td><?= $nama_kelas .' - '. $nama_jurusan ?></td>
                    </tr>
                    <tr>
                      <th>Total Siswa</th>
                      <td>:</td>
                      <td><?= count($siswa) ?> data</td>
                    </tr>
                  </table>
                </div>
                <div class="col-lg-12"><br>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                      <thead class="bg-gray-900 text-white justify-content-center">
                        <tr>
                          <th width="4%"><input type="checkbox" class="form-control" id="cheklist" data-active="0" onclick="cheklist()"></th>
                          <th>Nisn</th>
                          <th>Nama Lengkap</th>
                        </tr>
                      </thead>
            <?= form_open('admin/siswa/act_naik_kelas/'.$id_kelas .'/'. $id_jurusan) ?>
                      <tbody>
                        <?php $i=1;foreach ($siswa as $key): ?>
                        <tr>
                          <td class="text-center"><input type="checkbox" class="form-control checkbox" name="naik_<?= $i ?>"></td>
                          <td><?= $key->nisn ?></td>
                          <td><?= $key->nama_siswa ?></td>
                        </tr>
                        <?php $i++;endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                
                <div class="col-lg-12">
                  <hr>
                </div>

                <div class="col-lg-6  col-md-7 col-xs-12">
                  <select name="id_naik_kelas" id="id_naik_kelas" class="form-control" required>
                    <?php if (!set_value('id_naik_kelas')): ?>
                    <option value="">-- Naik ke kelas --</option>
                    <?php endif ?>
                    <?php foreach ($kelas as $key): ?>
                    <option value="<?= $key->id_kelas ?>" <?= set_value('id_naik_kelas') ? set_value('id_naik_kelas') == $key->id_kelas ? 'selected' : '' : '' ?>><?= $key->nama_kelas ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="col-lg-6  col-md-5 col-xs-12">
                  <button class="btn bg-gray-900 text-white" type="submit" name="save"><i class="fa fa-save" aria-hidden="true"></i> Simpan</button>
                </div>

              </div>
          <?= form_close(); ?>
              <script>
              $(document).ready(function(){
                $('#loading-data-pengeluaran').delay(3000).hide('', function(){
                  $('#data-pengeluaran').show('slow');
                });
              })
             </script>
            <?php endif ?>

            <?php if (@$messageError): ?>
            <div class="row" style="margin-top: 20px;" id="loading-data-pengeluaran">
              <div class="col-lg-12 text-center"><h4><i class="fa fa-spinner fa-spin"></i> Loading</h4></div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="alert alert-danger alert-message" data-dismiss="alert" style="display: none;">
                 <?= $messageError ?>
                </div>
              </div>
            </div>
            <script>
              $(document).ready(function(){
                $('#loading-data-pengeluaran').delay(3000).hide('', function(){
                  $('.alert-message').show('slow', function(){
                    $('.alert-message').delay(8000).hide('slow');
                  });
                });
              })
            </script>
            <?php endif ?>

          



        </div>
        <div class="card-footer bg-gray-900">
          
        </div>
    </div>
	</div>
</div>