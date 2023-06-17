<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
        <div class="card-header py-3 bg-gray-900">
        </div>
        <div class="card-body">

            <?= form_open() ?>
            <div class="row">
                <div class="col-lg-11  col-md-11 col-xs-12">
                  <select name="kelas" class="form-control" required>
                    <?php if (!set_value('kelas')): ?>
                    <option value="">-- piih kelas & jurusan --</option>
                    <?php endif ?>
                    <?php foreach ($kelas as $key): ?>
                      <?php foreach ($jurusan as $row): ?>
                        <option value="<?= $key->id_kelas .','.$row->id_jurusan ?>" <?= set_value('kelas') == $key->id_kelas.','. $row->id_jurusan ? 'selected' : '' ?>><?= $key->nama_kelas .' - '. $row->nama_jurusan ?></option>
                      <?php endforeach ?>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="col-lg-1  col-md-2 col-xs-12">
                  <button class="btn bg-gray-900 text-white" type="submit" name="cari"><i class="fa fa-search" aria-hidden="true"></i></button>
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
                      <td>Bagan Spp</td>
                    </tr>
                   <!--  <tr>
                      <th>Total</th>
                      <td>:</td>
                      <?php if ($id_kelas != 4): ?>
                      <td><?= count($siswa) * $id_kelas?> data</td>
                      <?php else: ?>
                      <td><?= count($siswa) * 3 ?> data</td>
                      <?php endif ?>
                    </tr> -->
                  </table>
                </div>
                <div class="col-lg-12"><br><br>
                  <a href="<?= base_url('admin/laporan/print_spp/').$id_kelas.'/'.$id_jurusan ?>" class="btn btn-default btn-xs pull-right bg-gray-500 text-white" target="_blank"><i class="fas fa-print"></i> Print</a>
                  <br><br>
                  <?php foreach ($kelas as $kls): ?>
                  <?php if ($kls->id_kelas != 4 && $id_kelas >= $kls->id_kelas): ?>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th rowspan="2" class="text-center">NISN</th>
                          <th rowspan="2"  class="text-center">Nama</th>
                          <th colspan="12" class="text-center">SPP KELAS &nbsp;:&nbsp; <?= ucfirst($kls->nama_kelas) ?></th>
                          <th rowspan="2">Total</th>
                        </tr>
                        <tr>
                           <th>Juli</th>
                            <th>Agustus</th>
                            <th>September</th>
                            <th>Oktober</th>
                            <th>November</th>
                            <th>Desember</th>
                            <th>Januari</th>
                            <th>Februari</th>
                            <th>Maret</th>
                            <th>April</th>
                            <th>Mei</th>
                            <th>Juni</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 

                         $bulan = ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'];
                           $b=0; 
                          foreach ($siswa as $key) :
                        ?>
                        <?php if ($this->db->get_where('spp', ['id_siswa' => $key->id_siswa, 'id_kelas' => $kls->id_kelas])->num_rows()): ?>
                          
                        <tr>
                          <td><?= $key->nisn ?></td>
                          <td><?= $key->nama_siswa ?></td>
                            <?php 
                              for ($i=0; $i < count($bulan); $i++) { 
                                $result = $this->db->get_where('spp', ['id_siswa' => $key->id_siswa, 'bulan' => $bulan[$i], 'id_kelas' => $kls->id_kelas])->row();
                                if ($result->status_spp == 1) {
                                  echo "<td class='text-center'><i class='fa fa-check '></i></td>";
                                }else{
                                  echo "<td class='text-center'><i class='fa fa-minus'></i></td>";
                                }
                              }
                             ?>
                          <td><?= $this->db->get_where('spp', ['id_siswa' => $key->id_siswa, 'id_kelas' => $kls->id_kelas, 'status_spp' => 1])->num_rows() ?> Bulan</td>
                        </tr> 
                        <?php endif ?>
                        <?php $b++; endforeach ?>
                      </tbody>
                    </table>
                  </div><br>
                  <hr style="border: 1px solid #333;"><br>
                  <?php endif ?>
                  <?php endforeach ?>
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