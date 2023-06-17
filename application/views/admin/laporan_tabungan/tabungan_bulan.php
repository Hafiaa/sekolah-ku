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
                <div class="col-lg-5  col-md-10 col-xs-12">
                  <input type="date" name="tanggal1" class="form-control" required value="<?= set_value('tanggal1') ? set_value('tanggal1') : date('Y-m-d') ?>">
                </div>
                <div class="col-lg-6  col-md-10 col-xs-12">
                  <input type="date" name="tanggal2" class="form-control" required value="<?= set_value('tanggal2') ? set_value('tanggal2') : date('Y-m-d') ?>">
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
                      <th>Periode</th>
                      <td>:</td>
                      <td><?= $this->lib->date_indo($_POST['tanggal1']) ?> &nbsp;s/d.&nbsp; <?= $this->lib->date_indo($_POST['tanggal2']) ?></td>
                    </tr>
                  </table>
                </div>
                <div class="col-lg-12"><br>
                  <a href="<?= base_url('admin/laporan/print_tabungan_bulan/').$_POST['tanggal1'].'/'. $_POST['tanggal2'] . '/print' ?>" class="btn btn-default btn-xs pull-right bg-gray-500 text-white" target="_blank"><i class="fas fa-print"></i> Print</a>
                  <br><br>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th class="text-center" widt="1%" class="text-center" rowspan="2">No</th>
                          <th class="text-center" rowspan="2">Nama Kelas</th>
                          <th class="text-center" colspan="4">Tabungan</th>
                        </tr>
                        <tr>
                          <th class="text-center" width="10%">Jumlah</th>
                          <th class="text-center">Saldo Menabung</th>
                          <th class="text-center" width="10%">Jumlah</th>
                          <th class="text-center">Saldo Mengambil</th>
                        </tr>
                       
                      </thead>
                      <?php $total_all_masuk=0;$total_all_keluar=0;$i=1; $z=1;foreach ($kelas as $key): ?>
                      <?php foreach ($jurusan as $rows): ?>
                          <?php foreach ($siswa as $row): ?>
                              <?php 
                                $this->db->where('tanggal_tabungan >=', $tanggal1);
                                $this->db->where('tanggal_tabungan <=', $tanggal2);
                               ?>
                               <?php if ($this->M_tabungan->get(['id_siswa' => $row->id_siswa])->num_rows() && $z==1): ?>
                                <tr>
                                  <td class="text-center"><?= $i; ?></td>
                                  <td><?= $key->nama_kelas . ' - ' . $rows->nama_jurusan ?></td>
                                  <?php 
                                    $jumlahMasuk = $this->db->query("SELECT * FROM tabungan INNER JOIN siswa ON tabungan.id_siswa = siswa.id_siswa WHERE siswa.id_kelas = '$key->id_kelas' AND siswa.id_jurusan = '$rows->id_jurusan' AND tabungan.tanggal_tabungan BETWEEN '$tanggal1' AND '$tanggal2' AND tabungan.status_tabungan =  1 GROUP BY tabungan.id_siswa ")->num_rows();
                                    $jumlahKeluar = $this->db->query("SELECT * FROM tabungan INNER JOIN siswa ON tabungan.id_siswa = siswa.id_siswa WHERE siswa.id_kelas = '$key->id_kelas' AND siswa.id_jurusan = '$rows->id_jurusan' AND tabungan.tanggal_tabungan BETWEEN '$tanggal1' AND '$tanggal2' AND tabungan.status_tabungan =  0 GROUP BY tabungan.id_siswa ")->num_rows();

                                    $total_masuk = 0;
                                    $total_keluar = 0;
                                    $this->db->where('tanggal_tabungan >=', $tanggal1);
                                    $this->db->where('tanggal_tabungan <=', $tanggal2);
                                    foreach ($this->db->query("SELECT * FROM tabungan INNER JOIN siswa ON tabungan.id_siswa = siswa.id_siswa WHERE siswa.id_kelas = '$key->id_kelas' AND siswa.id_jurusan = '$rows->id_jurusan' AND tabungan.tanggal_tabungan BETWEEN '$tanggal1' AND '$tanggal2'")->result() as $saldo) {
                                      if ($saldo->status_tabungan == 1) {
                                        $total_masuk += $saldo->jumlah_tabungan;
                                      }else{
                                        $total_keluar += $saldo->jumlah_tabungan;
                                      }
                                    }
                                     ?>
                                  <td><?= $jumlahMasuk ?> Orang</td>
                                  <td>Rp. <?= number_format($total_masuk, 0, ',', '.') ?>,-</td>
                                  <td><?= $jumlahKeluar ?> Orang</td>
                                  <td>Rp. <?= number_format($total_keluar, 0, ',', '.') ?>,-</td>
                                </tr>
                                 
                               <?php $i++; $total_all_masuk+=$total_masuk;$total_all_keluar+=$total_keluar; endif ?>
                          <?php $z++;endforeach ?>
                      <?php endforeach ?>
                      <?php endforeach ?>
                      <tfoot>
                        <tr>
                          <th colspan="3" class="text-center">Jumlah Total</th>
                          <th colspan="2">Rp. <?= number_format($total_all_masuk,0,',','.') ?>,-</th>
                          <th>Rp. <?= number_format($total_all_keluar,0,',','.') ?>,-</th>
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

            <?php if (@$messageError && !@$tabungan): ?>
            <div class="row" style="margin-top: 20px;" id="loading-data-tabungan">
              <div class="col-lg-12 text-center"><h4><i class="fa fa-spinner fa-spin"></i> Loading</h4></div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="alert alert-danger alert-message" data-dismiss="alert" style="display: none;">
                  Laporan tabungan perbulan periode <b><?= $this->lib->date_indo($this->input->post('tanggal1')) ?></b> s/d. <b><?= $this->lib->date_indo($this->input->post('tanggal1')) ?></b> tidak di temukan !
                </div>
              </div>
            </div>
            <script>
              $(document).ready(function(){
                $('#loading-data-spp').delay(3000).hide('', function(){
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