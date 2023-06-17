
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="widtd=device-widtd, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="autdor" content="">

  <title>DA</title>
  <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>



<?php 
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=laporan-pengeluaran-".date('d-M-Y').".xls");
?>

<body>
  <!-- <div class="container" style="margin-top: 30px;"> -->
  <div class="row" id="data-pengeluaran">
    <div class="col-lg-12">
      <h2>LAPORAN PENGELUARAN</h2><br>
      <table cellpadding="5">
        <tr>
          <th>Tanggal</th>
          <td> : <?= $tanggal ?></td>
        </tr>
        <tr>
          <th>Total</th>
          <td> : <?= count($pengeluaran) ?> data</td>
        </tr>
      </table>
    </div>
    <div class="col-lg-12"><br>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <td>No</td>
              <td>Tanggal Pengeluaran</td>
              <td>Keterangan</td>
              <td>Jumlah</td>
              <td>Operator</td>
            </tr>
          </thead>
          <?php $total_pengeluaran=0;$i=1;foreach ($pengeluaran as $key): ?>
          <tbody>
            <tr>
              <td><?= $i ?></td>
              <td><?= $this->lib->date_indo($key->tanggal_pengeluaran) ?></td>
              <td><?= ucfirst($key->keterangan_pengeluaran) ?></td>
              <td>Rp. <?= number_format($key->jumlah_pengeluaran,0, ',', '.') ?>,-</td>
              <td><?= $key->operator ?></td>
            </tr>
            <?php $total_pengeluaran+=$key->jumlah_pengeluaran;$i++;endforeach ?>
          
            <tr>
              <td colspan="3" class="text-center" >Jumlah Total</td>
              <td colspan="2">Rp. <?= number_format($total_pengeluaran,0,',','.'); ?>,-</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>





  <!-- </div> -->







</body>
</html>
