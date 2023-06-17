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
                  <select name="kelas" id="kelas" required class="form-control">
                    <?php if (!set_value('kelas')): ?>
                      <option value="">-- Pilih Kelas & Jurusan--</option>
                    <?php endif ?>
                    <?php foreach ($kelas as $key): ?>
                      <?php foreach ($jurusan as $row): ?>
                      <option value="<?= $key->id_kelas.','.$row->id_jurusan ?>" <?= set_value('kelas') == $key->id_kelas.','.$row->id_jurusan ? 'selected' : '' ?>><?= $key->nama_kelas .' - '. $row->nama_jurusan ?></option>
                        
                      <?php endforeach ?>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="col-lg-3  col-md-10 col-xs-12">
                  <input type="date" name="tanggal1" class="form-control" required value="<?= set_value('tanggal1') ? set_value('tanggal1') : date('Y-m-d') ?>">
                </div>
                <div class="col-lg-3  col-md-10 col-xs-12">
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
                    <tr>
                      <th>Tanggal</th>
                      <td>:</td>
                      <td><?= $this->lib->date_indo($_POST['tanggal1']) ?> &nbsp;-&nbsp; <?= $this->lib->date_indo($_POST['tanggal2']) ?></td>
                    </tr>
                      <th>Kelas</th>
                      <td>:</td>
                      <td><?= $this->M_kelas->get(['id_kelas' => $id_kelas])->row()->nama_kelas .' - '. $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row()->nama_jurusan ?></td>
                    </tr>
                  </table>
                </div>
                <div class="col-lg-12"><br><br>
                  <a href="<?= base_url('admin/laporan/print_spp_kelas/').$id_kelas .'/' . $id_jurusan .'/'. $_POST['tanggal1'] .'/' . $_POST['tanggal2'] . '/print' ?>" class="btn btn-default btn-xs pull-right bg-gray-500 text-white" target="_blank"><i class="fas fa-print"></i> Print</a>
                  <a href="<?= base_url('admin/laporan/print_spp_kelas/').$id_kelas . '/'.$id_jurusan .'/' . $_POST['tanggal1']. '/' . $_POST['tanggal2']. '/excel' ?>" class="btn btn-default btn-xs pull-right bg-gray-500 text-white" style="margin-right: 5px;"><i class="fa fa-file-excel"></i> Exel</a>
                  <br><br>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th widt="1%" class="text-center">No</th>
                          <th>NIS</th>
                          <th>Nama</th>
                          <th>Bulan</th>
                          <th>Total</th>
                          <!-- <th>Tabsis</th> -->
                          <!-- <th>Total</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php $total_spp=0;$i=1;foreach ($this->M_siswa->get(['siswa.id_kelas' => $id_kelas, 'siswa.id_jurusan' => $id_jurusan])->result() as $key): ?>
                          <?php 
                          $tanggal1   = date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal1)).' 01:01:01'));
                          $tanggal2   = date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal2)).' 24:01:01'));
                          $this->db->where('tanggal_bayar_spp >=', $tanggal1);
                          $this->db->where('tanggal_bayar_spp <=', $tanggal2);
                          ?>
                          <?php if ($this->M_spp->get(['id_siswa' => $key->id_siswa, 'status_spp' => 1])->num_rows()): ?>
                          <tr>
                            <td class="text-center"><?= $i ?></td>
                            <td><?= $key->nisn ?></td>
                            <td><?= $key->nama_siswa ?></td>
                            <?php
                                // penamaan bulan
                                $this->db->order_by('id_spp', 'ASC');
                                $bulan1 = $this->M_spp->get(['id_siswa' => $key->id_siswa, 'status_spp' => 1])->row();
                                $this->db->order_by('id_spp', 'DESC');
                                $bulan2 = $this->M_spp->get(['id_siswa' => $key->id_siswa, 'status_spp' => 1])->row();
                                $total_spp_siswa = 0;
                                // $total_tabsis = 0;
                                $this->db->where('tanggal_bayar_spp >=', $tanggal1);
                                $this->db->where('tanggal_bayar_spp <=', $tanggal2);
                                foreach ($this->M_spp->get(['id_siswa' => $key->id_siswa, 'status_spp' => 1])->result() as $rows) {
                                  $total_spp_siswa  += ($rows->jumlah_spp - (($rows->jumlah_spp * $rows->persen_spp) / 100));
                                  // $total_tabsis     += $tabsis;
                                }
                            ?>
                            <?php if ($bulan1->id_spp == $bulan2->id_spp): ?>
                            <td><?= $bulan1->bulan ?></td>
                            <?php else: ?>
                            <td><?= $bulan1->bulan ?> - <?= $bulan2->bulan ?></td>
                            <?php endif ?>
                            <td>Rp. <?= number_format($total_spp_siswa, 0, ',', '.') ?>,-</td>
                            <!-- <td>Rp. <?= number_format($total_tabsis, 0, ',', '.') ?>,-</td> -->
                            <!-- <td>Rp. <?= number_format($total_spp_siswa + $total_tabsis, 0, ',', '.') ?>,-</td> -->
                          </tr>
                          <?php $total_spp+=($total_spp_siswa);endif ?>
                        <?php $i++;endforeach ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="4" class="text-center" >Jumlah Total </th>
                          <td>Rp. <?= number_format($total_spp,0,',','.'); ?>,-</td>
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
                  Laporan <?= $messageError ?>
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