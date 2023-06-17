<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
        <div class="card-header py-3 bg-gray-900">
        <form method="GET" action="">
         <div class="row">
           <div class="col-lg-11">
            <input type="number" name="nisn" class="form-control" required placeholder="Masukkan nisn siswa" value="<?= @$_GET['nisn'] ?>">
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
              <div class="alert alert-danger" data-dismiss="alert">Maaf data siswa <?= 'dengan nisn <b>'.$_GET['nisn'].'</b>' ?> tidak di temukan !</div>
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


