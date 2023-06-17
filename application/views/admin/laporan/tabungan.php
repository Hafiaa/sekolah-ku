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
                  <select name="kelas" class="form-control" required>
                    <?php if (!set_value('kelas')): ?>
                    <option value="">-- piih kelas & jurusan --</option>
                    <?php endif ?>
                    <?php foreach ($kelas as $key): ?>
                      <?php foreach ($jurusan as $row): ?>
                        <option value="<?= $key->id_kelas .','. $row->id_jurusan ?>" <?= set_value('kelas') == $key->id_kelas .','. $row->id_jurusan ? 'selected' : '' ?>><?= $key->nama_kelas .' - '. $row->nama_jurusan ?></option>
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


            <?php if (@$siswa): ?>
              <div class="row" style="margin-top: 20px;" id="loading-data-siswa">
                <div class="col-lg-12 text-center"><h4><i class="fa fa-spinner fa-spin"></i> Loading</h4></div>
              </div>
              <div class="row" style="margin-top: 20px; display: none;" id="data-siswa">
                <div class="col-lg-12">
                  <table cellpadding="5">
                    <tr>
                      <th>Kelas</th>
                      <td>:</td>
                      <td><?= ucfirst($nama_kelas) .' - '. ucfirst($nama_jurusan) ?></td>
                    </tr>
                    <tr>
                      <th>Laporan</th>
                      <td>:</td>
                      <td>Saldo Tabungan</td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <td>:</td>
                      <td><?= count($siswa) ?> data</td>
                    </tr>
                  </table>
                </div>
                <div class="col-lg-12"><br><br>
                  <a href="<?= base_url('admin/laporan/print_tabungan/').$id_kelas.'/'.$id_jurusan .'/print' ?>" class="btn btn-default btn-xs pull-right bg-gray-500 text-white" target="_blank"><i class="fas fa-print"></i> Print</a>
                  <br><br>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                       <tr>
                          <th width="1%">No</th>
                          <th>Nisn</th>
                          <th>Nama Siswa</th>
                          <th>Jumlah Saldo Tabungan</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $total_tabungan=0;$i=1;foreach ($siswa as $key): ?>
                        <tr>
                          <td class="text-center"><?= $i ?></td>
                          <td><?= $key->nisn ?></td>
                          <td><?= $key->nama_siswa ?></td>
                          <td>
                          <?php
                          $jumlah_tabungan = 0;
                            foreach ($this->M_tabungan->get(['id_siswa' => $key->id_siswa])->result() as $rows) {
                              $masuk  = 0;
                              $keluar = 0;
                               if ($rows->status_tabungan == 1) {
                                 $masuk = $rows->jumlah_tabungan;
                               }else{
                                 $keluar = $rows->jumlah_tabungan;
                               }
                               $jumlah_tabungan += $masuk - $keluar;
                             } 
                          ?>
                          Rp. <?= number_format($jumlah_tabungan, 0, ',', '.') ?>,-
                          </td>
                        </tr>
                        <?php $total_tabungan+=$jumlah_tabungan;$i++;endforeach ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="3">Total Saldo Tabungan</th>
                          <th>Rp. <?= number_format($total_tabungan, 0, ',', '.') ?>,-</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
              <script>
              $(document).ready(function(){
                $('#loading-data-siswa').delay(3000).hide('', function(){
                  $('#data-siswa').show('slow');
                });
                
              })
             </script>
            <?php endif ?>

            <?php if (@$messageError): ?>
            <div class="row" style="margin-top: 20px;" id="loading-data-siswa">
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
                $('#loading-data-siswa').delay(3000).hide('', function(){
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