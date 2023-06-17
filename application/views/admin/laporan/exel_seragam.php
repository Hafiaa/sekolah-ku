
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
      <h2>LAPORAN PEMBAYARAN BAJU SERAGAM</h2><br>
      <table cellpadding="5">
        <tr>
          <th>Kelas</th>
          <td>:</td>
          <td><?= $kelas->nama_kelas .' - '. $jurusan->nama_jurusan ?></td>
        </tr>
        <tr>
          <th>Total</th>
          <td>:</td>
          <td><?= count($siswa) ?> data</td>
        </tr>
      </table>
    </div>
    <div class="col-lg-12"><br>
        <table class="table table-bordered">
          <thead>
           <tr>
              <th width="1%">No</th>
              <th>Nisn</th>
              <th>Nama Siswa</th>
              <th>Terbayar</th>
              <th>Belum Terbayar</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
           <?php $i=1;foreach ($siswa as $key): ?>
            <tr>
              <td class="text-center"><?= $i ?></td>
              <td><?= $key->nisn ?></td>
              <td><?= $key->nama_siswa ?></td>
              <?php
                $total_seragam = 0;
                $terbayar = 0;
                foreach ($this->db->get_where('seragam', ['id_siswa' => $key->id_siswa])->result() as $val) {
                  $total_seragam += $val->jumlah_seragam;
                    $terbayar += $val->jumlah_seragam;
                }
              ?>
              <td>Rp. <?= number_format($terbayar,0,',','.') ?>,-</td>
              <td>Rp. <?= number_format(($key->uang_seragam - (($key->uang_seragam * $key->persen_baju_seragam)) / 100) - $terbayar,0,',','.') ?>,-</td>
              <td>Rp. <?= number_format(($key->uang_seragam - (($key->uang_seragam * $key->persen_baju_seragam)) / 100),0,',','.') ?>,-</td>
            </tr>
            <?php $i++;endforeach ?>
          </tbody>
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
  header("Content-Disposition: attachment; filename=laporan-pemabayaran-spp-".date('d-M-Y').".xls");
?>
<?php else: ?>
  <?php  redirect(base_url('admin/laporan/seragam')); ?>
<?php endif ?>
</body>
</html>
