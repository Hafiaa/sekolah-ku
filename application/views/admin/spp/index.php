<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
        <div class="card-header py-3 bg-gray-900">
        <form method="GET" action="">
         <div class="row">
           <div class="col-lg-11">
            <input type="number" name="nis" class="form-control" required placeholder="Masukkan NIS siswa" value="<?= @$_GET['nis'] ?>">
           </div>
           <div class="col-lg-1">
             <button class="btn bg-gray-800 text-white" type="submit"><i class="fa fa-search"></i> </button>
           </div>
         </div>
        </form>
        </div>
        <div class="card-body">
            

          <?php if (@$error || @$siswa): ?>  
          
          <h4 class="text-center" id="loading"><i class="fa fa-spinner fa-spin"></i> Loading..</h4>
          <div class="table-responsive" style="display: none;" id="data-siswa">
          
            <?php if (isset($error)): ?>
              <div class="alert alert-danger" data-dismiss="alert">Maaf data siswa <?= 'dengan NIS <b>'.$_GET['nis'].'</b>' ?> tidak di temukan !</div>
            <?php endif ?>
            <?php if (isset($siswa)): ?>
              

          <div class="row">
            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gray-900">
                  <h6 class="m-0 font-weight-bold text-white">Identitas Siswa</h6>
                </div>
                <div class="card-body">
                   <table width="100%" class="table">
                     <tr>
                      <th>NIS</th>
                      <td>:</td>
                      <td><?= $siswa->nisn ?></td>
                     </tr>
                     <tr>
                      <th>Nama Lengkap</th>
                      <td>:</td>
                      <td><?= $siswa->nama_siswa ?></td>
                     </tr>
                     <tr>
                      <th>TTL</th>
                      <td>:</td>
                      <td><?= $siswa->tempat_lahir.', '.$this->lib->date_indo($siswa->tanggal_lahir) ?></td>
                     </tr>
                     <tr>
                      <th>Kelas</th>
                      <td>:</td>
                      <td><?= $siswa->nama_kelas .' - '. $siswa->nama_jurusan ?></td>
                     </tr>
                     <tr>
                      <th>Beasiswa</th>
                      <td>:</td>
                      <td><?= $siswa->beasiswa ? $siswa->beasiswa  : '-' ?></td>
                     </tr>
                   </table>
                </div>
              </div>
            </div>
          </div>
          

          <div class="row">
            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gray-900">
                  <h6 class="m-0 font-weight-bold text-white">Transaction Spp</h6>
                </div>
                <div class="card-body">
                  <table class="table table-striped table-bordered">
                    <?php
                      $this->db->order_by('id_spp', 'ASC');
                      $otomatis_spp         = $this->M_spp->get(['id_siswa' => $siswa->id_siswa, 'id_kelas <=' => $siswa->id_kelas, 'id_kelas <=' => $siswa->id_kelas, 'status_spp' => 0]);
                      $jumlah_otomatis_spp  = $otomatis_spp->num_rows();
                      if ($jumlah_otomatis_spp) {
                        $harga_otomatis_spp   = ($otomatis_spp->row()->jumlah_spp -(($otomatis_spp->row()->jumlah_spp * $otomatis_spp->row()->persen_spp) / 100));
                      }
                    ?>
                    <tr>
                      <th width="40%">Jumlah Bayar</th>
                      <td width="4%" class="text-center">:</td>
                      <td width="56%" id="total_bayar_otomatis">Rp. 0,-</td>
                    </tr>
                    <tr>
                      <th>Untuk Berapa Bulan</th>
                      <td class="text-center">:</td>
                      <td>
                        <?= form_open('admin/spp/otomatis_spp/'.md5($siswa->id_siswa)) ?>
                        <input type="hidden" name="nis" value="<?= $siswa->nisn ?>">
                        <div class="row">
                          <div class="col-lg-6">
                            <input type="text" class="form-control" name="jumlah_otomatis_spp" autocomplete="off" placeholder="0 - <?= $jumlah_otomatis_spp ?> Bulan" min="1" max="<?= $jumlah_otomatis_spp ?>" id="jumlah_otomatis_spp" <?= $jumlah_otomatis_spp == 0 ? 'disabled' : ''?> >
                          </div>
                          <div class="col-lg-1">
                            <button class="btn btn-primary" type="submit" id="btnProses" disabled="">Proses</button>
                          </div>
                        </div>
                        </form>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <script>
            $('#jumlah_otomatis_spp').keyup(function(){
             var inputan              = $(this);
             var btnProses            = $('#btnProses');
             var total_bayar_otomatis = $('#total_bayar_otomatis');
             var harga_otomatis_spp   = <?= $harga_otomatis_spp ?>;
             if(inputan.val() > 0 && inputan.val() != ''){
              if(inputan.val() > <?= $jumlah_otomatis_spp ?>){
                inputan.val('<?= $jumlah_otomatis_spp ?>');
              }
              total_bayar_otomatis.html(convertToRupiah(inputan.val() * harga_otomatis_spp));
              btnProses.removeAttr('disabled');
             }else{
              btnProses.attr('disabled', '');
             }

            })
          </script>


          <div class="row">
            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gray-900">
                  <h6 class="m-0 font-weight-bold text-white">Output Spp</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table-bordered table table-striped">
                    <thead>
                      <tr>
                        <th width="1%">No.</th>
                        <th>Tanggal Transaksi</th>
                        <th>Spp Kelas</th>
                        <th>Bulan</th>
                        <th>Nominal</th>
                        <th>Operator</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $i=1;
                      ?>
                      <?php foreach ($this->db->query("SELECT * FROM spp WHERE id_siswa = '$siswa->id_siswa' AND status_spp = '1' GROUP BY DATE(tanggal_bayar_spp)")->result() as $key): ?>
                      <tr>
                        <td class="text-center"><?= $i; ?></td>
                        <td><?= $this->lib->date_indo($key->tanggal_bayar_spp) ?></td>
                        <?php 
                          $uang_nominal = 0;
                          $this->db->like('tanggal_bayar_spp', date('Y-m-d', strtotime($key->tanggal_bayar_spp)));
                          foreach ($this->M_spp->get(['id_siswa' => $siswa->id_siswa, 'status_spp' => 1])->result() as $rows) {
                             $uang_nominal  += ($rows->jumlah_spp - (($rows->jumlah_spp * $rows->persen_spp) / 100));
                          }
                          $this->db->order_by('id_spp', 'ASC');
                          $this->db->like('tanggal_bayar_spp', date('Y-m-d', strtotime($key->tanggal_bayar_spp)));
                          $bulan1 = $this->M_spp->get(['id_siswa' => $siswa->id_siswa, 'status_spp' => 1])->row();

                          $this->db->order_by('id_spp', 'DESC');
                          $this->db->like('tanggal_bayar_spp', date('Y-m-d', strtotime($key->tanggal_bayar_spp)));
                          $bulan2 = $this->M_spp->get(['id_siswa' => $siswa->id_siswa, 'status_spp' => 1])->row();

                        ?>
                        <?php if ($bulan1->id_spp == $bulan2->id_spp): ?>
                        <td><?= $this->M_kelas->get(['id_kelas' => $bulan1->id_kelas])->row()->nama_kelas ?></td>
                        <td><?= $bulan1->bulan ?></td>
                        <?php else: ?>
                          <?php if ($bulan1->id_kelas == $bulan2->id_kelas): ?>
                            <td><?= $this->M_kelas->get(['id_kelas' => $bulan1->id_kelas])->row()->nama_kelas ?></td>
                          <?php else: ?> 
                          <td><?= $this->M_kelas->get(['id_kelas' => $bulan1->id_kelas])->row()->nama_kelas ?> - <?= $this->M_kelas->get(['id_kelas' => $bulan2->id_kelas])->row()->nama_kelas ?></td>
                          <?php endif ?>
                        <td><?= $bulan1->bulan ?> - <?= $bulan2->bulan ?></td>
                        <?php endif ?>
                        <td>Rp. <?= number_format($uang_nominal, 0, ',', '.') ?>,-</td>
                        <td><?= $bulan2->operator ?></td>
                      </tr>
                      <?php $i++;endforeach ?>
                    </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>


           <div class="row">
            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gray-900">
                  <h6 class="m-0 font-weight-bold text-white">Spp</h6>
                </div>
                <div class="card-body bg-gray-800">
                
                <?php if ($siswa->id_kelas == 1 || $siswa->id_kelas == 4 || $siswa->id_kelas >= 1): ?>
                  
                  <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-gray-900">
                      <h6 class="m-0 font-weight-bold text-white">Spp Kelas X</h6>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive"> 
                       <table class="table-bordered table table-striped">
                         <thead>
                           <tr>
                             <th width="10%">Bulan</th>
                             <th width="15%">Jumlah</th>
                             <th width="15%">Potong % </th>
                             <th width="15%">Total</th>
                             <th width="30%">Tanggal Bayar</th>
                             <th width="20%">Keterangan</th>
                             <th width="20%">Action</th>
                           </tr>
                         </thead>
                         <tbody>
                          <?php foreach ($spp as $key): ?>
                          <?php if ($key->id_kelas == 1): ?>
                            <?php if ($key->status_spp == 1): ?>
                              <tr>
                                <td><?= $key->bulan ?></td>
                                <td>Rp. <?= number_format($key->jumlah_spp,0,',','.') ?>,-</td>
                                <td class="text-center"><?= $key->persen_spp ?> %</td>
                                <?php $potong_spp = ($key->jumlah_spp * $key->persen_spp) / 100; ?>
                                <td>Rp. <?= number_format($key->jumlah_spp - $potong_spp,0,',','.') ?>,-</td>
                                <td><?= $this->lib->date_indo($key->tanggal_bayar_spp) ?></td>
                                <td>Lunas</td>
                                <td>
                                  <a href="<?= base_url('admin/spp/act/').md5($key->id_siswa).'/'.md5($key->id_spp).'/'.$key->status_spp ?>" class="btn bg-gradient-danger text-white btn-sm btn-block">
                                      <i class="fas fa-times"></i>
                                  </a>
                                </td>
                              </tr>
                            <?php else: ?>
                               <tr>
                                <td><?= $key->bulan ?></td>
                                <td>Rp. <?= number_format($key->jumlah_spp,0,',','.') ?>,-</td>
                                <td class="text-center"><?= $siswa->persen_spp ?> %</td>
                                <?php $potong_spp = ($key->jumlah_spp * $siswa->persen_spp) / 100; ?>
                                <td>Rp. <?= number_format($key->jumlah_spp - $potong_spp,0,',','.') ?>,-</td>
                                <td>-</td>
                                <td>Belum Lunas</td>
                                <td>
                                  <a href="<?= base_url('admin/spp/act/').md5($key->id_siswa).'/'.md5($key->id_spp).'/'.$key->status_spp ?>" class="btn bg-gradient-success text-white btn-sm btn-block">
                                      <i class="fas fa-check"></i> 
                                  </a>
                                </td>
                              </tr>
                            <?php endif ?>
                          <?php endif ?>
                          <?php endforeach ?>
                         </tbody>
                       </table>
                      </div>
                    </div>
                  </div>

                <?php endif ?>

                <?php if ($siswa->id_kelas == 2 || $siswa->id_kelas == 4 || $siswa->id_kelas >= 2): ?>
                  
                   <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-gray-900">
                      <h6 class="m-0 font-weight-bold text-white">Spp Kelas XI</h6>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive"> 
                       <table class="table-bordered table table-striped">
                         <thead>
                           <tr>
                             <th width="10%">Bulan</th>
                             <th width="15%">Jumlah</th>
                             <th width="15%">Potong % </th>
                             <th width="15%">Total</th>
                             <th width="30%">Tanggal Bayar</th>
                             <th width="20%">Keterangan</th>
                             <th width="20%">Action</th>
                           </tr>
                         </thead>
                         <tbody>
                          <?php foreach ($spp as $key): ?>
                          <?php if ($key->id_kelas == 2): ?>
                            <?php if ($key->status_spp == 1): ?>
                              <tr>
                                <td><?= $key->bulan ?></td>
                                <td>Rp. <?= number_format($key->jumlah_spp,0,',','.') ?>,-</td>
                                <td class="text-center"><?= $key->persen_spp ?> %</td>
                                <?php $potong_spp = ($key->jumlah_spp * $key->persen_spp) / 100; ?>
                                <td>Rp. <?= number_format($key->jumlah_spp - $potong_spp,0,',','.') ?>,-</td>
                                <td><?= $this->lib->date_indo($key->tanggal_bayar_spp) ?></td>
                                <td>Lunas</td>
                                <td>
                                  <a href="<?= base_url('admin/spp/act/').md5($key->id_siswa).'/'.md5($key->id_spp).'/'.$key->status_spp ?>" class="btn bg-gradient-danger text-white btn-sm btn-block">
                                      <i class="fas fa-times"></i>
                                  </a>
                                </td>
                              </tr>
                            <?php else: ?>
                               <tr>
                                <td><?= $key->bulan ?></td>
                                <td>Rp. <?= number_format($key->jumlah_spp,0,',','.') ?>,-</td>
                                <td class="text-center"><?= $siswa->persen_spp ?> %</td>
                                <?php $potong_spp = ($key->jumlah_spp * $siswa->persen_spp) / 100; ?>
                                <td>Rp. <?= number_format($key->jumlah_spp - $potong_spp,0,',','.') ?>,-</td>
                                <td>-</td>
                                <td>Belum Lunas</td>
                                <td>
                                  <a href="<?= base_url('admin/spp/act/').md5($key->id_siswa).'/'.md5($key->id_spp).'/'.$key->status_spp ?>" class="btn bg-gradient-success text-white btn-sm btn-block">
                                      <i class="fas fa-check"></i> 
                                  </a>
                                </td>
                              </tr>
                            <?php endif ?>
                          <?php endif ?>
                          <?php endforeach ?>
                         </tbody>
                       </table>
                      </div>
                    </div>
                  </div>

                <?php endif ?>

                <?php if ($siswa->id_kelas == 3 || $siswa->id_kelas == 4 || $siswa->id_kelas >= 3): ?>
                  
                   <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-gray-900">
                      <h6 class="m-0 font-weight-bold text-white">Spp Kelas XII</h6>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive"> 
                       <table class="table-bordered table table-striped">
                         <thead>
                           <tr>
                             <th width="10%">Bulan</th>
                             <th width="15%">Jumlah</th>
                             <th width="15%">Potong % </th>
                             <th width="15%">Total</th>
                             <th width="30%">Tanggal Bayar</th>
                             <th width="20%">Keterangan</th>
                             <th width="20%">Action</th>
                           </tr>
                         </thead>
                         <tbody>
                          <?php foreach ($spp as $key): ?>
                          <?php if ($key->id_kelas == 3): ?>
                            <?php if ($key->status_spp == 1): ?>
                              <tr>
                                <td><?= $key->bulan ?></td>
                                <td>Rp. <?= number_format($key->jumlah_spp,0,',','.') ?>,-</td>
                                <td class="text-center"><?= $key->persen_spp ?> %</td>
                                <?php $potong_spp = ($key->jumlah_spp * $key->persen_spp) / 100; ?>
                                <td>Rp. <?= number_format($key->jumlah_spp - $potong_spp,0,',','.') ?>,-</td>
                                <td><?= $this->lib->date_indo($key->tanggal_bayar_spp) ?></td>
                                <td>Lunas</td>
                                <td>
                                  <a href="<?= base_url('admin/spp/act/').md5($key->id_siswa).'/'.md5($key->id_spp).'/'.$key->status_spp ?>" class="btn bg-gradient-danger text-white btn-sm btn-block">
                                      <i class="fas fa-times"></i>
                                  </a>
                                </td>
                              </tr>
                            <?php else: ?>
                               <tr>
                                <td><?= $key->bulan ?></td>
                                <td>Rp. <?= number_format($key->jumlah_spp,0,',','.') ?>,-</td>
                                <td class="text-center"><?= $siswa->persen_spp ?> %</td>
                                <?php $potong_spp = ($key->jumlah_spp * $siswa->persen_spp) / 100; ?>
                                <td>Rp. <?= number_format($key->jumlah_spp - $potong_spp,0,',','.') ?>,-</td>
                                <td>-</td>
                                <td>Belum Lunas</td>
                                <td>
                                  <a href="<?= base_url('admin/spp/act/').md5($key->id_siswa).'/'.md5($key->id_spp).'/'.$key->status_spp ?>" class="btn bg-gradient-success text-white btn-sm btn-block">
                                      <i class="fas fa-check"></i> 
                                  </a>
                                </td>
                              </tr>
                            <?php endif ?>
                          <?php endif ?>
                          <?php endforeach ?>
                         </tbody>
                       </table>
                      </div>
                    </div>
                  </div>

                <?php endif ?>


                </div>
              </div>
            </div>

            
          </div>



































            <?php endif ?>
          <script>
            $(document).ready(function(){
              setTimeout(function(){
                $('#loading').hide('', function(){
                  $('#data-siswa').slideDown('slow');
                })
              }, 1000);
            })
          </script>
          </div>
        <?php endif ?>
        </div>
        <div class="card-footer bg-gray-900">
          
        </div>
    </div>
	</div>
</div>


