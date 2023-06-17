<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Print Tabungan Perkelas</title>
  <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<body>
<div class="container" style="margin-top: 30px;">
  <div class="row" id="data-pemasukan">
    <div class="col-lg-12">
      <h2>LAPORAN SALDO TABUNGAN PER-KELAS</h2><br>
      <table cellpadding="5">
        <tr>
          <th>Kelas</th>
          <td>:</td>
          <td><?= $nama_kelas .' - '. $nama_jurusan ?></td>
        </tr>
      </table>
      <br>
      <table class="table table-striped table-bordered table-hover">
        <tr>
          <th class="text-center">No</th>
          <th>NIS</th>
          <th>Nama</th>
          <th>Tabungan Siswa</th>
          <th>Tabungan Pribadi</th>
          <!-- <th>Total Saldo</th> -->
        </tr>
      <?php $i=1;$total_all_tabsis=0;$total_all_tabungan_pribadi=0;foreach ($this->M_siswa->get(['siswa.id_kelas' => $id_kelas, 'siswa.id_jurusan' => $id_jurusan])->result() as $key): ?>
        <?php 
          // Tabsis
          $masuk_tabsis   = (15000 * $this->M_spp->get(['id_siswa' => $key->id_siswa, 'status_spp' => 1])->num_rows());
          $keluar_tabsis  = 0;
          foreach ($this->M_tabungan->get(['id_siswa' => $key->id_siswa, 'status_tabungan' => 2])->result() as $rows) {
            $keluar_tabsis += $rows->jumlah_tabungan;
          }
          $total_tabsis = $masuk_tabsis - $keluar_tabsis;


          $masuk_tabungan_pribadi   = 0;
          $keluar_tabungan_pribadi  = 0;
          foreach ($this->M_tabungan->get(['id_siswa' => $key->id_siswa])->result() as $rows) {
            if ($rows->status_tabungan == 1) {
              $masuk_tabungan_pribadi   += $rows->jumlah_tabungan;
            }elseif($rows->status_tabungan == 0){
              $keluar_tabungan_pribadi  += $rows->jumlah_tabungan;
            }else{

            }
          }
          $total_tabungan_pribadi = $masuk_tabungan_pribadi - $keluar_tabungan_pribadi;
        ?>
        <tr>
          <td class="text-center"><?= $i ?></td>
          <td><?= $key->nisn ?></td>
          <td><?= $key->nama_siswa ?></td>
          <td>Rp. <?= number_format($total_tabsis,0,',','.') ?>,-</td>
          <td>Rp. <?= number_format($total_tabungan_pribadi,0,',','.') ?>,-</td>
          <!-- <td>Rp. <?= number_format($total_tabsis + $total_tabungan_pribadi,0,',','.') ?>,-</td> -->
        </tr>
      <?php $total_all_tabsis+=$total_tabsis;$total_all_tabungan_pribadi+=$total_tabungan_pribadi;$i++;endforeach ?>
      <tr>
        <th colspan="3" class="text-center" >Jumlah Total </th>
        <td>Rp. <?= number_format($total_all_tabsis,0,',','.'); ?>,-</td>
        <td>Rp. <?= number_format($total_all_tabungan_pribadi,0,',','.'); ?>,-</td>
        <!-- <td>Rp. <?= number_format($total_all_tabsis + $total_all_tabungan_pribadi,0,',','.'); ?>,-</td> -->
      </tr>      
    </table>
    </div>
  </div>
</div>
<?php if ($type == 'print'): ?>
  <script>
    window.print();
</script>
  <?php elseif($type == 'excel') : ?>
  <?php 
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=laporan-saldo-tabungan-per-kelas-".$tanggal1."-".$tanggal2.".xls");
?>
<?php else: ?>
  <?php  redirect(base_url('admin/laporantabungan/tabungan_kelas')); ?>
<?php endif ?>
</body>
</html>