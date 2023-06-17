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
                <h6 class="m-0 font-weight-bold text-white">Seragam</h6>
              </div>
              <div class="card-body">
                <table class="table-bordered table table-striped">
                 <thead class="bg-gray-800 text-white">
                   <tr>
                     <th width="50%">Tanggal Bayar</th>
                     <th width="25%">Jumlah</th>
                     <th width="20%">Operator</th>
                     <th width="5%">Action</th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php $total_seragam=0;foreach ($seragam as $key): ?>
                  <tr>
                    <td><?= $this->lib->date_indo($key->tanggal_seragam) ?></td>
                    <td>Rp. <?= number_format($key->jumlah_seragam, 0, ',', '.') ?>,-</td>
                    <td><?= $key->operator ?></td>
                    <td class="text-center">
                      <a href="<?= base_url('admin/seragam/delete/').md5($key->id_seragam).'?nis='.$siswa->nisn ?>" class="btn bg-gradient-danger text-white btn-circle btn-sm" onClick="return confirm('Yakin mau hapus data uang seragam Rp. <?= number_format($key->jumlah_seragam, 0, ',', '.') ?> ,- ?')"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                  <?php $total_seragam += $key->jumlah_seragam;endforeach ?>
                 </tbody>
                 <?php if ($total_seragam != ($siswa->uang_seragam - (($siswa->uang_seragam * $siswa->persen_baju_seragam)) / 100)): ?>
                 <tfoot class="bg-gray-900 text-white">
                   <tr>
                     <th class="text-center"><?= $this->lib->date_indo(date('Y-m-d')) ?></th>
                     <td colspan="3">
                      <?= form_open('admin/seragam?nis='.$_GET['nis']) ?>
                       <input type="number" name="jumlah_seragam" class="form-control" placeholder="Rp. " min="100" max="<?= ($siswa->uang_seragam - (($siswa->uang_seragam * $siswa->persen_baju_seragam)) / 100) - $total_seragam ?>">
                      <?= form_close() ?>
                     </td>
                   </tr>
                 </tfoot>
                 <?php endif ?>
               </table>
               <table>
                  <tr>
                    <th>Potong % </th>
                    <td>&nbsp; : </td>
                    <td><?= $siswa->persen_baju_seragam ?> % </td>
                  </tr>
                  <tr>
                    <th>Terbayar</th>
                    <td>&nbsp; : </td>
                    <td>Rp. <?= number_format($total_seragam, 0, ',', '.') ?>,-</td>
                  </tr>
                  <tr>
                    <th>Belum Terbayar</th>
                    <td>&nbsp; : </td>
                    <td>Rp. <?= number_format(($siswa->uang_seragam - (($siswa->uang_seragam * $siswa->persen_baju_seragam)) / 100) - $total_seragam, 0, ',', '.') ?>,-</td>
                  </tr>
                  <tr>
                    <th>Total</th>
                    <td>&nbsp; : </td>
                    <td>Rp. <?= number_format(($siswa->uang_seragam - (($siswa->uang_seragam * $siswa->persen_baju_seragam)) / 100), 0, ',', '.') ?>,-</td>
                  </tr>
               </table>
              </div>
            </div>
            
          </div>
          </div>
        <?php endif; ?>

        </div>
        <?php endif; ?>
        </div>
        <div class="card-footer bg-gray-900">
          
        </div>
    </div>
	</div>
</div>

<script>
  $(document).ready(function(){
    setTimeout(function(){
      $('#loading').hide('', function(){
        $('#data-siswa').slideDown('slow');
      })
    }, 1000);
  })
</script>