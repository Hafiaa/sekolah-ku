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
      <h2>LAPORAN BIAYA LAIN</h2><br>
      <table cellpadding="5">
        <tr>
          <th>Kelas</th>
          <td>:</td>
          <td><?= ucfirst($nama_kelas) .' - ' . ucfirst($nama_jurusan) ?></td>
        </tr>
        <tr>
          <th>Laporan</th>
          <td>:</td>
          <td>Biaya <?= ucfirst($nama_biaya_lain) ?></td>
        </tr>
        <tr>
          <th>Total</th>
          <td>:</td>
          <td><?= count($siswa) ?> data</td>
        </tr>
      </table><br>
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
        <thead>
         <tr>
            <th width="1%">No</th>
            <th>Nisn</th>
            <th>Nama Siswa</th>
            <th>Potong %</th>
            <th>Terbayar</th>
            <th>Belum Terbayar</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
        <?php $i=1;foreach ($siswa as $key): ?>
        <tr>
          <td class="text-center"><?= $i++; ?></td>
          <td><?= $key->nisn ?></td>
          <td><?= $key->nama_siswa ?></td>
          <td class="text-center"><?= $key->persen_biaya_lain ?> %</td>
          <?php
            $terbayar=0; 
            $total_biaya_lain=0;
            foreach ($this->db->get_where('siswa_biaya_lain', ['id_siswa' => $key->id_siswa, 'nama_biaya_lain' => $nama_biaya_lain])->result() as $row) {
              $total_biaya_lain += $row->jumlah_biaya_lain - (($row->jumlah_biaya_lain * $row->persen_biaya_lain) / 100);
              foreach ($this->db->get_where('bayar_biaya_lain', ['id_siswa' => $key->id_siswa, 'id_siswa_biaya_lain' => $row->id_siswa_biaya_lain])->result() as $rows) {
                $terbayar += $rows->jumlah_bayar_biaya_lain; 
              }
            }
          ?>
          <td>Rp. <?= number_format($terbayar, 0, ',', '.') ?>,-</td>
          <td>Rp. <?= number_format($total_biaya_lain - $terbayar, 0, ',', '.') ?>,-</td>
          <td>Rp. <?= number_format($total_biaya_lain, 0, ',', '.') ?>,-</td>
        </tr>
        <?php endforeach ?>
        </tbody>
      </table>
    </div>
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
  header("Content-Disposition: attachment; filename=laporan-pemabayaran-spp-".date('d-M-Y').".xls");
?>
<?php else: ?>
  <?php  redirect(base_url('admin/laporan/biaya_lain')); ?>
<?php endif ?>
</body>
</html>
