<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>
<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
      <div class="card-header py-3 bg-gray-900">
       <a href="<?= base_url('admin/biaya_lain/index?nis='.$_GET['nis']) ?>" class="btn bg-gradient-warning text-white btn-circle btn-sm">
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
                    <td><?= $siswa->nama_kelas ?></td>
                   </tr>
                   <tr>
                    <th>Jurusan</th>
                    <td>:</td>
                    <td><?= $siswa->nama_jurusan ?></td>
                   </tr>
                   <tr>
                    <th>Beasiswa</th>
                    <td>:</td>
                    <td><?= $siswa->beasiswa ? $siswa->beasiswa : '-' ?></td>
                   </tr>
                 </table>
              </div>
            </div>
          </div>

         <!--  <div class="col-lg-3">
            <div class="card shadow mb-4">
              <div class="card-header py-3 bg-gray-900 text-white">
                <h6 class="m-0 font-weight-bold text-white">Foto</h6>
              </div>
              <div class="card-body text-center">
                <img src="<?= base_url('assets/img/siswa/').$siswa->foto_siswa ?>" width="80%">
              </div>
            </div>
          </div> -->
        </div>

         <div class="row">
          <div class="col-lg-12">


             <div class="card shadow mb-4">
              <div class="card-header py-3 bg-gray-900">
                <h6 class="m-0 font-weight-bold text-white">Biaya Lain</h6>
              </div>
              <div class="card-body">
               <table>
                  <tr>
                    <th>Type Biaya Lain</th>
                    <td>&nbsp; : </td>
                    <td><?= $siswa_biaya_lain->nama_biaya_lain ?></td>
                  </tr>
                  <tr>
                    <th>Potong</th>
                    <td>&nbsp; : </td>
                    <td><?= $siswa_biaya_lain->persen_biaya_lain ?> %</td>
                  </tr>
                  <?php $total_bayar_biaya_lain=0;foreach ($bayar_biaya_lain as $key): ?>
                    <?php $total_bayar_biaya_lain += $key->jumlah_bayar_biaya_lain;?>
                  <?php endforeach ?>
                  <tr>
                    <th>Terbayar</th>
                    <td>&nbsp; : </td>
                    <td>Rp. <?= number_format($total_bayar_biaya_lain, 0, ',', '.') ?>,-</td>
                  </tr>
                  <tr>
                    <th>Belum Terbayar</th>
                    <td>&nbsp; : </td>
                    <td>Rp. <?= number_format($siswa_biaya_lain->jumlah_biaya_lain - (($siswa_biaya_lain->jumlah_biaya_lain * $siswa_biaya_lain->persen_biaya_lain) / 100) - $total_bayar_biaya_lain, 0, ',', '.') ?>,-</td>
                  </tr>
                  <tr>
                    <th>Total</th>
                    <td>&nbsp; : </td>
                    <td>Rp. <?= number_format($siswa_biaya_lain->jumlah_biaya_lain - (($siswa_biaya_lain->jumlah_biaya_lain * $siswa_biaya_lain->persen_biaya_lain) / 100), 0, ',', '.') ?>,-</td>
                  </tr>
               </table><br>
                <table class="table-bordered table table-striped">
                 <thead class="bg-gray-800 text-white">
                   <tr>
                     <th>Tanggal Bayar</th>
                     <th>Jumlah Bayar</th>
                     <th>Operator</th>
                     <th width="5%">Delete</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php foreach ($bayar_biaya_lain as $key): ?>
                   <tr>
                     <td><?= $this->lib->date_indo($key->tanggal_bayar_biaya_lain) ?></td>
                     <td>Rp. <?= number_format($key->jumlah_bayar_biaya_lain,0,',','.') ?>,-</td>
                     <td><?= $key->operator ?></td>
                     <td class="text-center">
                       <a href="<?= base_url('admin/biaya_lain/delete_bayar_biaya_lain/').md5($key->id_siswa).'/'.md5($siswa_biaya_lain->id_siswa_biaya_lain).'/'.md5($key->id_bayar_biaya_lain).'?nis='.$_GET['nis'] ?>" onclick="return confirm('Yakin mau hapus data pembayaran biaya lain Rp. <?= number_format($key->jumlah_bayar_biaya_lain, 0, ',', '.') ?>,-')"><i class="fa fa-trash fa-2x text-danger"></i></a>
                     </td>
                   </tr>
                   <?php endforeach ?>
                 </tbody>
                 <?php if ($siswa_biaya_lain->jumlah_biaya_lain - (($siswa_biaya_lain->jumlah_biaya_lain * $siswa_biaya_lain->persen_biaya_lain) / 100) - $total_bayar_biaya_lain != 0): ?>
                 <?= form_open('admin/biaya_lain/bayar_biaya_lain/'.md5($siswa->id_siswa).'/'.md5($siswa_biaya_lain->id_siswa_biaya_lain).'?nis='.$_GET['nis']) ?>
                 <tfoot class="bg-gray-900 text-white">
                   <tr>
                     <td><?= $this->lib->date_indo(date('Y-m-d')) ?></td>
                     <td colspan="3">
                       <input type="number" name="jumlah_bayar_biaya_lain" class="form-control" required max="<?= $siswa_biaya_lain->jumlah_biaya_lain - (($siswa_biaya_lain->jumlah_biaya_lain * $siswa_biaya_lain->persen_biaya_lain) / 100) - $total_bayar_biaya_lain ?>" placeholder="Rp.">
                     </td>
                   </tr>
                 </tfoot>
                 <?= form_close() ?>
                 <?php endif ?>
               </table><br><br>
              </div>
            </div>

          </div>
          </div>

        </div>

      <div class="card-footer bg-gray-900 text-right">

     </div>
	</div>
</div>
