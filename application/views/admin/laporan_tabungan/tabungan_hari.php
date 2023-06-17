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
                  <input type="date" name="tanggal1" class="form-control" required value="<?= set_value('tanggal1') ? set_value('tanggal1') : date('Y-m-d') ?>">
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
                      <th>Tanggal</th>
                      <td>:</td>
                      <td><?= $this->lib->date_indo($_POST['tanggal1']) ?></td>
                    </tr>
                  </table>
                </div>
                <div class="col-lg-12"><br><br>
                  <a href="<?= base_url('admin/laporan/print_tabungan_hari/').$_POST['tanggal1']. '/print' ?>" class="btn btn-default btn-xs pull-right bg-gray-500 text-white" target="_blank"><i class="fas fa-print"></i> Print</a>
                  <br><br>
                  <div class="table-responsive">
                    <!-- <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th>NIS</th>
                          <th>Nama</th>
                          <th>Kelas</th>
                          <th>Jumlah Saldo Menabung</th>
                          <th>Jumlah Saldo Mengambil</th>
                          <th>Operator</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $total_tabungan_masuk=0;$total_tabungan_keluar=0;$i=1;foreach ($siswa as $key): ?>
                       <?php $this->db->like('tanggal_tabungan', date('Y-m-d', strtotime($_POST['tanggal1']))); ?>
                       <?php if ($this->M_tabungan->get(['id_siswa' => $key->id_siswa])->num_rows()): ?>
                       <tr>
                         <td><?= $i; ?></td>
                         <td><?= $key->nisn ?></td>
                         <td><?= $key->nama_siswa ?></td>
                         <td><?= $key->nama_kelas ?> - <?= $key->nama_jurusan ?></td>
                         <?php 
                         $uang_masuk=0; $uang_keluar=0;
                          $this->db->like('tanggal_tabungan', date('Y-m-d', strtotime($_POST['tanggal1'])));
                          foreach ($this->M_tabungan->get(['id_siswa' => $key->id_siswa])->result() as $rows) {
                            if ($rows->status_tabungan) {
                              $uang_masuk += $rows->jumlah_tabungan;
                            }else{
                              $uang_keluar += $rows->jumlah_tabungan;
                            }
                            $operator = $rows->operator;
                          }
                         ?>
                         <td>Rp. <?= number_format($uang_masuk, 0, ',', '.') ?>,-</td>
                         <td>Rp. <?= number_format($uang_keluar, 0, ',', '.') ?>,-</td>
                         <td><?= $operator ?></td>
                       </tr>
                       <?php $i++;$total_tabungan_masuk+=$uang_masuk; $total_tabungan_keluar+=$uang_keluar; endif ?>
                       <?php endforeach ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="4" class="text-center" >Jumlah Total </th>
                          <td>Rp. <?= number_format($total_tabungan_masuk,0,',','.'); ?>,-</td>
                          <td colspan="2">Rp. <?= number_format($total_tabungan_keluar,0,',','.'); ?>,-</td>
                        </tr>
                      </tfoot>
                    </table> -->

                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <td colspan="7">Ket Id : &nbsp; 1 = Menabung, 2 = Mengambil</td>
                        </tr>
                        <tr>
                          <th class="text-center" width="1%">No</th>
                          <th>NIS</th>
                          <th>Nama</th>
                          <th>Kelas</th>
                          <th class="text-center">Id</th>
                          <th>Status</th>
                          <th>Operator</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $i=1;foreach ($this->db->query("SELECT * FROM tabungan INNER JOIN siswa ON tabungan.id_siswa = siswa.id_siswa INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas INNER JOIN jurusan ON siswa.id_jurusan = jurusan.id_jurusan WHERE tabungan.tanggal_tabungan LIKE '%".$this->input->post('tanggal1')."%'")->result() as $key): ?>
                        <tr>
                          <td class="text-center"><?= $i; ?></td>
                          <td><?= $key->nisn ?></td>
                          <td><?= $key->nama_siswa ?></td>
                          <td><?= $key->nama_kelas ?> - <?= $key->nama_jurusan ?></td>
                          <td class="text-center"><?= $key->status_tabungan ? 1 : 2 ?></td>
                          <td><?= $key->status_tabungan ? 'Menabung' : 'Mengambil' ?></td>
                          <td><?= $key->operator ?></td>
                        </tr>
                       <?php $i++;endforeach ?>
                      </tbody>
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

            <?php if (@$messageError): ?>
            <div class="row" style="margin-top: 20px;" id="loading-data-spp">
              <div class="col-lg-12 text-center"><h4><i class="fa fa-spinner fa-spin"></i> Loading</h4></div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="alert alert-danger alert-message" data-dismiss="alert" style="display: none;">
                  Laporan transaksi saldo tabugan pada tanggal <b><?= $this->lib->date_indo($_POST['tanggal1']) ?></b> tidak ditemukan !
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