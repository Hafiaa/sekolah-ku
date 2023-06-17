<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>


<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
      <div class="card-header py-3 bg-gray-900">
       <a href="<?= base_url('admin/siswa/index') ?>" class="btn bg-gradient-warning text-white btn-circle btn-sm">
            <i class="fas fa-arrow-left"></i>
        </a>
      </div> 
      <div class="card-body bg-gray-800">
        
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
                    <td><?= $siswa->nama_kelas ?> - <?= $siswa->nama_jurusan ?></td>
                   </tr>
                   <tr>
                    <th>Beasiswa</th>
                    <td>:</td>
                    <td><?= $siswa->beasiswa ? ucfirst($siswa->beasiswa) : '-' ?></td>
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
                           <th width="20%">Jumlah</th>
                           <th width="15%">Potongan %</th>
                           <th width="20%">Total</th>
                           <th width="20%">Tanggal Bayar</th>
                           <th width="15%">Keterangan</th>
                         </tr>
                       </thead>
                       <tbody>
                        <?php foreach ($spp as $key): ?>
                        <?php if ($key->id_kelas == 1): ?>
                          <?php if ($key->status_spp): ?>
                          <tr>
                            <td><?= $key->bulan ?></td>
                            <td>Rp. <?= number_format($key->jumlah_spp,0,',','.') ?>,-</td>
                            <td class="text-center"><?= $key->persen_spp ?> %</td>
                            <?php $potong_spp = ($key->jumlah_spp * $key->persen_spp) / 100; ?>
                            <td>Rp. <?= number_format($key->jumlah_spp - $potong_spp,0,',','.') ?>,-</td>
                            <td><?= $this->lib->date_indo($key->tanggal_bayar_spp) ?></td>
                            <td>Lunas</td>
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
                          </tr>
                          <?php endif ?>
                        <?php endif ?>
                        <?php endforeach ?>
                       </tbody>
                     </table>
                    </div>
                  </div>
                </div>

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
                           <th width="20%">Jumlah</th>
                           <th width="15%">Potongan %</th>
                           <th width="20%">Total</th>
                           <th width="20%">Tanggal Bayar</th>
                           <th width="15%">Keterangan</th>
                         </tr>
                       </thead>
                       <tbody>
                        <?php foreach ($spp as $key): ?>
                        <?php if ($key->id_kelas == 2): ?>
                          <?php if ($key->status_spp): ?>
                          <tr>
                            <td><?= $key->bulan ?></td>
                            <td>Rp. <?= number_format($key->jumlah_spp,0,',','.') ?>,-</td>
                            <td class="text-center"><?= $key->persen_spp ?> %</td>
                            <?php $potong_spp = ($key->jumlah_spp * $key->persen_spp) / 100; ?>
                            <td>Rp. <?= number_format($key->jumlah_spp - $potong_spp,0,',','.') ?>,-</td>
                            <td><?= $this->lib->date_indo($key->tanggal_bayar_spp) ?></td>
                            <td>Lunas</td>
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
                          </tr>
                          <?php endif ?>
                        <?php endif ?>
                        <?php endforeach ?>
                       </tbody>
                     </table>
                    </div>
                  </div>
                </div>

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
                           <th width="20%">Jumlah</th>
                           <th width="15%">Potongan %</th>
                           <th width="20%">Total</th>
                           <th width="20%">Tanggal Bayar</th>
                           <th width="15%">Keterangan</th>
                         </tr>
                       </thead>
                       <tbody>
                        <?php foreach ($spp as $key): ?>
                        <?php if ($key->id_kelas == 3): ?>
                          <?php if ($key->status_spp): ?>
                          <tr>
                            <td><?= $key->bulan ?></td>
                            <td>Rp. <?= number_format($key->jumlah_spp,0,',','.') ?>,-</td>
                            <td class="text-center"><?= $key->persen_spp ?> %</td>
                            <?php $potong_spp = ($key->jumlah_spp * $key->persen_spp) / 100; ?>
                            <td>Rp. <?= number_format($key->jumlah_spp - $potong_spp,0,',','.') ?>,-</td>
                            <td><?= $this->lib->date_indo($key->tanggal_bayar_spp) ?></td>
                            <td>Lunas</td>
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
                          </tr>
                          <?php endif ?>
                        <?php endif ?>
                        <?php endforeach ?>
                       </tbody>
                     </table>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3 bg-gray-900">
                <h6 class="m-0 font-weight-bold text-white">Baju Seragam</h6>
              </div>
              <div class="card-body">
                <table class="table-bordered table table-striped">
                 <thead>
                   <tr>
                     <th width="61%">Tanggal Bayar</th>
                     <th width="39%">Jumlah</th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php $total_seragam=0;foreach ($seragam as $key): ?>
                  <tr>
                    <td><?= $this->lib->date_indo($key->tanggal_seragam) ?></td>
                    <td>Rp. <?= number_format($key->jumlah_seragam, 0, ',', '.') ?>,-</td>
                  </tr>
                  <?php $total_seragam += $key->jumlah_seragam;endforeach ?>
                 </tbody>
               </table>
               <table>
                  <tr>
                    <th>Potongan </th>
                    <td>&nbsp; : &nbsp;</td>
                    <td><?= $siswa->persen_baju_seragam ?> % </td>
                  </tr>
                  <tr>
                    <th>Terbayar</th>
                    <td>&nbsp; : &nbsp;</td>
                    <td>Rp. <?= number_format($total_seragam, 0, ',', '.') ?>,-</td>
                  </tr>
                  <tr>
                    <th>Belum Terbayar</th>
                    <td>&nbsp; : &nbsp;</td>
                    <?php 
                     $potong_baju_seragam = ($siswa->uang_seragam * $siswa->persen_baju_seragam) / 100;
                     $uang_baju_seragam = $siswa->uang_seragam - $potong_baju_seragam;
                    ?>
                    <td>Rp. <?= number_format($uang_baju_seragam - $total_seragam, 0, ',', '.') ?>,-</td>
                  </tr>
                  <tr>
                    <th>Total</th>
                    <td>&nbsp; : &nbsp;</td>
                    <td>Rp. <?= number_format($uang_baju_seragam, 0, ',', '.') ?>,-</td>
                  </tr>
               </table>
              </div>
            </div>
          </div>
      

          <div class="col-lg-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3 bg-gray-900">
                 <h6 class="m-0 font-weight-bold text-white">Saldo Tabungan &nbsp; : &nbsp; <i>Rp. <?= number_format($uang_masuk - $uang_keluar, 0, ',', '.') ?>,-</i></h6>
              </div>
              <div class="card-body">
                <table class="table-bordered table table-striped">
                 <thead>
                   <tr>
                     <th width="61%">Tanggal Transaksi</th>
                     <th width="39%">Jumlah Saldo</th>
                     <th>Status</th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php $total_tabungan=0;foreach ($tabungan as $key): ?>
                  <tr>
                    <td><?= $this->lib->date_indo($key->tanggal_tabungan) ?></td>
                    <td>Rp. <?= number_format($key->jumlah_tabungan, 0, ',', '.') ?>,-</td>
                    <td>
                      <?php if ($key->status_tabungan): ?>
                        <p class="text-success">Menabung</p>
                      <?php else: ?>
                        <p class="text-warning">Mengambil</p>
                      <?php endif ?>
                    </td>
                  </tr>
                  <?php $total_tabungan += $key->jumlah_tabungan;endforeach ?>
                 </tbody>
               </table>
              </div>
            </div>
          </div>



          <?php if (count($siswa_biaya_lain)): ?>
          <div class="col-lg-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3 bg-gray-900">
                <h6 class="m-0 font-weight-bold text-white">Biaya Lainnya</h6>
              </div>
              <div class="card-body bg-gray-800">
              <?php $total_biaya_lain=0;$terbayar=0;foreach ($siswa_biaya_lain as $key): ?>
               <div class="col-lg-12">
                <div class="card shadow mb-4">
                  <div class="card-header py-3 bg-gray-900">
                    <h6 class="m-0 font-weight-bold text-white">* <?= $key->nama_biaya_lain ?></h6>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover">
                        <thead>
                          <th width="70%">Tanggal Bayar</th>
                          <th>Jumlah Bayar</th>
                        </thead>
                        <tbody>
                          <?php $total_bayar=0;foreach ($this->db->get_where('bayar_biaya_lain', ['id_siswa' => $siswa->id_siswa, 'id_siswa_biaya_lain' => $key->id_siswa_biaya_lain])->result() as $row): ?>
                          <tr>
                            <td><?= $this->lib->date_indo($row->tanggal_bayar_biaya_lain) ?></td>
                            <td>Rp. <?= number_format($row->jumlah_bayar_biaya_lain, 0, ',', '.') ?>,-</td>
                          </tr>
                          <?php $total_bayar+=$row->jumlah_bayar_biaya_lain;$terbayar+=$row->jumlah_bayar_biaya_lain;endforeach ?>
                        </tbody>
                      </table>
                      <table>
                        <tr>
                          <th>Potongan </th>
                          <td>&nbsp; : &nbsp;</td>
                          <td><?= $key->persen_biaya_lain ?> % </td>
                        </tr>
                        <tr>
                          <th>Terbayar</th>
                          <td>&nbsp; : &nbsp;</td>
                          <td>Rp. <?= number_format($total_bayar, 0, ',', '.') ?>,-</td>
                        </tr>
                        <tr>
                          <th>Belum Terbayar</th>
                          <td>&nbsp; : &nbsp;</td>
                          <td>Rp. <?= number_format($key->jumlah_biaya_lain - $total_bayar, 0, ',', '.') ?>,-</td>
                        </tr>
                        <tr>
                          <th>Total</th>
                          <td>&nbsp; : &nbsp;</td>
                          <td>Rp. <?= number_format($key->jumlah_biaya_lain - (($key->jumlah_biaya_lain * $key->persen_biaya_lain) / 100), 0, ',', '.') ?>,-</td>
                        </tr>
                     </table>
                    </div>
                  </div>
                </div>
              </div>
              <?php $total_biaya_lain+=$key->jumlah_biaya_lain - (($key->jumlah_biaya_lain * $key->persen_biaya_lain) / 100);endforeach ?>
              <div class="col-lg-12">
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table>
                        <tr>
                          <th>Total Terbayar</th>
                          <td>&nbsp; : &nbsp;</td>
                          <td>Rp. <?= number_format($terbayar, 0, ',', '.') ?>,-</td>
                        </tr>
                        <tr>
                          <th>Total Belum Terbayar</th>
                          <td>&nbsp; : &nbsp;</td>
                          <td>Rp. <?= number_format($total_biaya_lain - $terbayar, 0, ',', '.') ?>,-</td>
                        </tr>
                        <tr>
                          <th>Jumlah Total</th>
                          <td>&nbsp; : &nbsp;</td>
                          <td>Rp. <?= number_format($total_biaya_lain, 0, ',', '.') ?>,-</td>
                        </tr>
                     </table>
                    </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
          <?php endif ?>
          



        </div>
      </div>
      <div class="card-footer bg-gray-900 text-right">
      
     </div>
	</div>
</div>