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
                 <div class="col-lg-11  col-md-10 col-xs-12">
                    <select name="kelas" id="kelas" required class="form-control" required>
                      <?php if (!@set_value('kelas')): ?>
                      <option value="">-- Pilih kelas & jurusan --</option>
                      <?php endif ?>
                      <?php foreach ($kelas as $key): ?>
                        <?php foreach ($jurusan as $row): ?>
                        <option value="<?= $key->id_kelas .','. $row->id_jurusan  ?>" <?= set_value('kelas') == $key->id_kelas.','. $row->id_jurusan ? 'selected' : '' ?>><?= $key->nama_kelas .' - '. $row->nama_jurusan?></option>
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

            <?php if (@$tabungan): ?>
                <div class="row" style="margin-top: 20px;" id="loading-data-spp">
                  <div class="col-lg-12 text-center"><h4><i class="fa fa-spinner fa-spin"></i> Loading</h4></div>
                </div>
                <div class="row" style="margin-top: 20px; display: none;" id="data-spp">
                  <div class="col-lg-12">
                    <table cellpadding="5">
                      <tr>
                        <th>Kelas</th>
                        <td>:</td>
                        <td><?= $nama_kelas .' - '. $nama_jurusan ?></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-lg-12"><br><br>
                    <a href="<?= base_url('admin/laporan/print_tabungan_kelas/').$id_kelas.'/'.$id_jurusan.'/print'; ?>" class="btn btn-default btn-xs pull-right bg-gray-500 text-white" target="_blank"><i class="fas fa-print"></i> Print</a>
                    <br><br>
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Tabungan Siswa</th>
                            <th>Tabungan Pribadi</th>
                            <!-- <th>Total Saldo</th> -->
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;$total_all_tabsis=0;$total_all_tabungan_pribadi=0;foreach ($this->M_siswa->get(['siswa.id_kelas' => $id_kelas, 'siswa.id_jurusan' => $id_jurusan])->result() as $key): ?>
                          <?php 
                            // Tabsis
                            $masuk_tabsis   = (15000 * $this->M_spp->get(['id_siswa' => $key->id_siswa, 'status_spp' => 1])->num_rows());
                            $keluar_tabsis  = 0;
                            foreach ($this->M_tabungan->get(['id_siswa' => $key->id_siswa, 'status_tabungan' => 2])->result() as $rows) {
                              $keluar_tabsis += $rows->jumlah_tabungan;
                            }
                            $total_tabsis = $masuk_tabsis - $keluar_tabsis;


                            $masuk_tabungan_pribadi   = 0;
                            $keluar_tabungan_pribadi  = 0;
                            foreach ($this->M_tabungan->get(['id_siswa' => $key->id_siswa])->result() as $rows) {
                              if ($rows->status_tabungan == 1) {
                                $masuk_tabungan_pribadi   += $rows->jumlah_tabungan;
                              }else if($rows->status_tabungan == 0){
                                $keluar_tabungan_pribadi  += $rows->jumlah_tabungan;
                              }else{
                                
                              }
                            }
                            $total_tabungan_pribadi = $masuk_tabungan_pribadi - $keluar_tabungan_pribadi;
                          ?>
                          <tr>
                            <td class="text-center"><?= $i ?></td>
                            <td><?= $key->nisn ?></td>
                            <td><?= $key->nama_siswa ?></td>
                            <td>Rp. <?= number_format($total_tabsis,0,',','.') ?>,-</td>
                            <td>Rp. <?= number_format($total_tabungan_pribadi,0,',','.') ?>,-</td>
                            <!-- <td>Rp. <?= number_format($total_tabsis + $total_tabungan_pribadi,0,',','.') ?>,-</td> -->
                          </tr>
                        <?php $total_all_tabsis+=$total_tabsis;$total_all_tabungan_pribadi+=$total_tabungan_pribadi;$i++;endforeach ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="3" class="text-center" >Jumlah Total </th>
                            <td>Rp. <?= number_format($total_all_tabsis,0,',','.'); ?>,-</td>
                            <td>Rp. <?= number_format($total_all_tabungan_pribadi,0,',','.'); ?>,-</td>
                            <!-- <td>Rp. <?= number_format($total_all_tabsis + $total_all_tabungan_pribadi,0,',','.'); ?>,-</td> -->
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
                <script>
                $(document).ready(function(){
                  $('#loading-data-spp').delay(3000).hide('', function(){
                    $('#data-spp').show('slow');
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