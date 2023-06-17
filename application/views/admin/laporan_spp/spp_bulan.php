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


            <?php if (@$spp): ?>
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
                  <a href="<?= base_url('admin/laporan/print_spp_bulan/').$_POST['tanggal1'].'/'. $_POST['tanggal2'] . '/print' ?>" class="btn btn-default btn-xs pull-right bg-gray-500 text-white" target="_blank"><i class="fas fa-print"></i> Print</a>
                  <a href="<?= base_url('admin/laporan/print_spp_bulan/').$_POST['tanggal1'].'/'. $_POST['tanggal2'] . '/excel' ?>" class="btn btn-default btn-xs pull-right bg-gray-500 text-white" style="margin-right: 5px;"><i class="fa fa-file-excel"></i> Exel</a>
                  <br><br>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th class="text-center" widt="1%" class="text-center" rowspan="2">No</th>
                          <th class="text-center" rowspan="2">Kelas</th>
                          <th class="text-center" rowspan="2">Jumlah</th>
                         <!--  <th class="text-center" colspan="2">Pembayaran</th> -->
                          <th class="text-center" rowspan="2">Total</th>
                          <th class="text-center" colspan="4">Keringanan Spp</th>
                        </tr>
                        <tr>
                          <!-- <th class="text-center">Spp</th>
                          <th class="text-center">Tabsis</th> -->
                          <th class="text-center">Kelas</th>
                          <th class="text-center">Jumlah</th>
                          <th class="text-center">Uang</th>
                          <th class="text-center">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $tanggal1   = date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($this->input->post('tanggal1'))).' 00:00:00'));
                      $tanggal2   = date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($this->input->post('tanggal2'))).' 24:00:00'));
                      // $bulan      = $this->lib->date_bulan($tanggal1); 
                      $i=1;
                      // $tabsis     = 15000;
                      $total_spp_all = 0;
                      ?>
                      <?php foreach ($kelas as $key): ?>
                      <?php foreach ($jurusan as $rows): ?>
                      <?php $z=1;foreach ($this->M_siswa->get(['siswa.id_kelas' => $key->id_kelas, 'siswa.id_jurusan' => $rows->id_jurusan])->result() as $siswa): ?>
                      <?php

                        $this->db->where('tanggal_bayar_spp >=', $tanggal1);
                        $this->db->where('tanggal_bayar_spp <=', $tanggal2); 
                      ?>
                      <?php if ($this->M_spp->get(['id_siswa' => $siswa->id_siswa, 'status_spp' => 1])->num_rows() && $z==1): ?>
                      <?php $z++; ?>
                      <tr>
                        <td class="text-center"><?= $i++ ?></td>
                        <td><?= $key->nama_kelas ?> - <?= $rows->nama_jurusan ?></td>
                        <?php
                          $orang        = $this->db->query("SELECT * FROM spp INNER JOIN siswa ON spp.id_siswa = siswa.id_siswa WHERE siswa.id_kelas = '$key->id_kelas' AND siswa.id_jurusan = '$rows->id_jurusan' AND spp.status_spp = '1' AND spp.tanggal_bayar_spp BETWEEN '$tanggal1' AND '$tanggal2' GROUP BY spp.id_siswa")->num_rows();
                          $keringanan   = $this->M_siswa->get(['siswa.id_kelas' => $key->id_kelas, 'siswa.id_jurusan' => $rows->id_jurusan, 'siswa.persen_spp >=' => 1]);
                          $total_spp    = 0;
                          // $total_tabsis = 0;
                          foreach ($this->db->query("SELECT * FROM spp INNER JOIN siswa ON spp.id_siswa = siswa.id_siswa WHERE siswa.id_kelas = '$key->id_kelas' AND siswa.id_jurusan = '$rows->id_jurusan' AND spp.status_spp = '1' AND spp.tanggal_bayar_spp BETWEEN '$tanggal1' AND '$tanggal2'")->result() as $spp) {
                            $total_spp += ($spp->jumlah_spp - ($spp->jumlah_spp * $spp->persen_spp) / 100);
                            // $total_tabsis += $tabsis;
                            $persen_spp = $spp->persen_spp;
                            $jumlah_spp = $spp->jumlah_spp;
                          }
                          $total_spp_all+=$total_spp;
                        ?>
                        <td><?= $orang ?> Orang</td>
                        <!-- <td>Rp. <?= number_format($total_spp - $total_tabsis, 0, ',', '.') ?>,-</td>
                        <td>Rp. <?= number_format($total_tabsis, 0, ',', '.') ?>,-</td> -->
                        <td>Rp. <?= number_format($total_spp, 0, ',', '.') ?>,-</td>
                        <td><?= $key->nama_kelas ?> <?= $rows->nama_jurusan ?></td>
                        <td><?= $keringanan->num_rows() ?> Orang</td>
                        <td>Rp. <?= number_format(($jumlah_spp * $persen_spp) / 100, 0, ',', '.') ?>,-</td>
                        <td>Rp. <?= number_format((($jumlah_spp * $persen_spp) / 100) * $keringanan->num_rows(), 0, ',', '.') ?>,-</td>
                      </tr>
                      <?php endif ?>
                      <?php endforeach ?>
                      <?php endforeach ?>
                      <?php endforeach ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="3" class="text-left" >Jumlah Total </th>
                          <td colspan="5">Rp. <?= number_format($total_spp_all,0,',','.'); ?>,-</td>
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

            <?php if (@$messageError && !@$spp): ?>
            <div class="row" style="margin-top: 20px;" id="loading-data-spp">
              <div class="col-lg-12 text-center"><h4><i class="fa fa-spinner fa-spin"></i> Loading</h4></div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="alert alert-danger alert-message" data-dismiss="alert" style="display: none;">
                  Laporan spp perbulan periode <b><?= $this->lib->date_indo($this->input->post('tanggal1')) ?></b> s/d. <b><?= $this->lib->date_indo($this->input->post('tanggal1')) ?></b> tidak di temukan !
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