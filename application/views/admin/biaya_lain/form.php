<h1 class="h3 mb-4 text-gray-800"><?= $title ?> <small style="font-size: 15px;"><?= $judul ?></small></h1>
<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
      <div class="card-header py-3 bg-gray-900">
       <a href="<?= base_url('admin/biaya_lain') ?>" class="btn bg-gradient-warning text-white btn-circle btn-sm">
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
                   <th>Kelas</th>
                    <td>:</td>
                    <td><?= $siswa->nama_kelas .' - '. $siswa->nama_jurusan ?></td>
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
        </div>

         <div class="row">
          <div class="col-lg-12">


             <div class="card shadow mb-4">
              <div class="card-header py-3 bg-gray-900">
                <h6 class="m-0 font-weight-bold text-white">Biaya Lain</h6>
              </div>
              <div class="card-body">
                <table class="table-bordered table table-striped">
                 <thead class="bg-gray-800 text-white">
                   <tr>
                     <th>Untuk Biaya</th>
                     <th>Jumlah</th>
                     <th>Potong %</th>
                     <th>Terbayar</th>
                     <th>Belum Terbayar</th>
                     <th>Total</th>
                     <th class="text-center" width="5%">Delete</th>
                     <th class="text-center" width="5%">Action</th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php $total_biaya_lain=0; $terbayar=0;foreach ($siswa_biaya_lain as $key): ?>
                  <tr>
                    <td><?= $key->nama_biaya_lain ?></td>
                    <td>Rp. <?= number_format($key->jumlah_biaya_lain, 0, ',', '.') ?>,-</td>
                    <td class="text-center"><?= $key->persen_biaya_lain ?> %</td>
                    <?php $total_bayar_biaya_lain = 0;foreach ($this->db->get_where('bayar_biaya_lain', ['id_siswa' => $key->id_siswa, 'id_siswa_biaya_lain' => $key->id_siswa_biaya_lain])->result() as $row): ?>
                      <?php $total_bayar_biaya_lain += $row->jumlah_bayar_biaya_lain; ?>
                    <?php endforeach ?>
                    <td>Rp. <?= number_format($total_bayar_biaya_lain, 0, ',', '.') ?>,-</td>
                    <td>Rp. <?= number_format($key->jumlah_biaya_lain - (($key->jumlah_biaya_lain * $key->persen_biaya_lain) / 100) - $total_bayar_biaya_lain, 0, ',', '.') ?>,-</td>
                    <td>Rp. <?= number_format($key->jumlah_biaya_lain - (($key->jumlah_biaya_lain * $key->persen_biaya_lain) / 100), 0, ',', '.') ?>,-</td>
                    <td class="text-center">
                      <a href="<?= base_url('admin/biaya_lain/delete/').md5($key->id_siswa).'/'.md5($key->id_siswa_biaya_lain) ?>" onclick="return confirm('Yakin mau hapus data biaya lain <?= $key->nama_biaya_lain ?> Rp. <?= number_format($key->jumlah_biaya_lain - (($key->jumlah_biaya_lain * $key->persen_biaya_lain) / 100), 0, ',', '.') ?>,-')"><i class="fa fa-trash fa-2x text-danger"></i></a>
                    </td>
                    <td class="text-center">
                    <a href="<?= base_url('admin/biaya_lain/bayar_biaya_lain/').md5($key->id_siswa).'/'.md5($key->id_siswa_biaya_lain) ?>" class="btn bg-gradient-warning text-white btn-circle btn-sm"><i class="fa fa-edit"></i></a> 
                    </td>
                  </tr>
                  <?php
                    $terbayar += $total_bayar_biaya_lain; 
                    $total_biaya_lain += ($key->jumlah_biaya_lain - (($key->jumlah_biaya_lain * $key->persen_biaya_lain) / 100)); ?>
                  <?php endforeach ?>
                 </tbody>
                 <tfoot class="bg-gray-900 text-white">
                   <tr>
                     <?= form_open('') ?>
                     <td colspan="7">
                       <select name="nama_biaya_lain" class="form-control" required >
                        <option value="">-- pilih biaya lain --</option>
                         <?php foreach ($biaya_lain as $row): ?>
                          <?php if ($this->db->get_where('siswa_biaya_lain', ['nama_biaya_lain' => $row->nama_biaya_lain])->num_rows() != 1 ): ?>
                           <option value="<?= $row->nama_biaya_lain ?>"><?= $row->nama_biaya_lain ?></option>
                          <?php endif ?>
                         <?php endforeach ?>
                       </select>
                     </td>
          
                     <td><button class="btn btn-success btn-xs" type="submit" name="add"><i class="fa fa-plus"></i></button></td>
                     <?= form_close() ?>
                   </tr>
                 </tfoot>
               </table><br><br>
               <table>
                  <tr>
                    <th>Terbayar</th>
                    <td>&nbsp; : </td>
                    <td>Rp. <?= number_format($terbayar, 0, ',', '.') ?>,-</td>
                  </tr>
                  <tr>
                    <th>Belum Terbayar</th>
                    <td>&nbsp; : </td>
                    <td>Rp. <?= number_format($total_biaya_lain - $terbayar, 0, ',', '.') ?>,-</td>
                  </tr>
                  <tr>
                    <th>Total</th>
                    <td>&nbsp; : </td>
                    <td>Rp. <?= number_format($total_biaya_lain, 0, ',', '.') ?>,-</td>
                  </tr>
               </table>
              </div>
            </div>

          </div>
          </div>

        </div>

      <div class="card-footer bg-gray-900 text-right">

     </div>
	</div>
</div>
