<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= @$title ?></title>
  <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<body>
<div class="container" style="margin-top: 30px;">
  <div class="row" id="data-pemasukan">
    <div class="col-lg-12">
      <h2>LAPORAN SALDO TABUNGAN SISWA</h2><br>
      <table cellpadding="5">
        <tr>
          <th>Kelas</th>
          <td>:</td>
          <td><?= $nama_kelas .' - '. $nama_jurusan ?></td>
        </tr>
        <tr>
          <th>Total</th>
          <td>:</td>
          <td><?= count($siswa) ?> data</td>
        </tr>
      </table>
    </div>
    <div class="col-lg-12"><br>
       <table class="table table-striped table-bordered table-hover">
        <tr>
            <th width="1%">No</th>
            <th>Nisn</th>
            <th>Nama Siswa</th>
            <th>Jumlah Saldo Tabungan</th>
          </tr>
         <?php $total_tabungan=0;$i=1;foreach ($siswa as $key): ?>
          <tr>
            <td class="text-center"><?= $i ?></td>
            <td><?= $key->nisn ?></td>
            <td><?= $key->nama_siswa ?></td>
            <td>
            <?php
            $jumlah_tabungan = 0;
              foreach ($this->M_tabungan->get(['id_siswa' => $key->id_siswa])->result() as $rows) {
                $masuk  = 0;
                $keluar = 0;
                 if ($rows->status_tabungan == 1) {
                   $masuk = $rows->jumlah_tabungan;
                 }else{
                   $keluar = $rows->jumlah_tabungan;
                 }
                 $jumlah_tabungan += $masuk - $keluar;
               } 
            ?>
            Rp. <?= number_format($jumlah_tabungan, 0, ',', '.') ?>,-
            </td>
          </tr>
          <?php $total_tabungan+=$jumlah_tabungan;$i++;endforeach ?>
          <tr>
            <th colspan="3">Total Saldo Tabungan</th>
            <th>Rp. <?= number_format($total_tabungan, 0, ',', '.') ?>,-</th>
          </tr>
        </table>
    </div>
  </div>
</div>

<?php if ($type == 'print'): ?>
  <script>
    window.print();
  </script>
  <?php elseif($type == 'exel') : ?>
  <?php 
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=laporan-tabungan-".date('d-M-Y').".xls");
?>
<?php else: ?>
  <?php  redirect(base_url('admin/laporan/tabungan')); ?>
<?php endif ?>
</body>
</html>
