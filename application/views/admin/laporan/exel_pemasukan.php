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
  header("Content-Disposition: attachment; filename=laporan-pemasukan-".date('d-M-Y').".xls");
?>

<body>
  <div class="container" style="margin-top: 30px;">
  <div class="row" id="data-pemasukan">
    <div class="col-lg-12">
      <h2>LAPORAN PEMASUKAN</h2><br>
      <table cellpadding="5">
        <tr>
          <td>Tanggal</td>
          <td> : <?= $tanggal ?></td>
        </tr>
        <tr>
          <td>Type Pemasukan</td>
          <td> : <?= $type_pemasukan ?></td>
        </tr>
        <tr>
          <td>Total</td>
          <td> : <?= count($pemasukan) ?> data</td>
        </tr>
      </table>
    </div>
    <div class="col-lg-12"><br>
      <div class="table-responsive">
        <table class="table table-bordered">
          <tr>
            <td>No</td>
            <td>Tanggal Pemasukan</td>
            <td>Type Pemasukan</td>
            <td>Jumlah</td>
            <td>Operator</td>
          </tr>
        
          <?php $total_pemasukan=0;$i=1;foreach ($pemasukan as $key): ?>
          <tr>
            <td><?= $i ?></td>
            <td><?= $this->lib->date_indo($key->tanggal_pemasukan) ?></td>
            <td><?= ucfirst($key->type_pemasukan) ?></td>
            <td>Rp. <?= number_format($key->jumlah_pemasukan,0, ',', '.') ?>,-</td>
            <td><?= $key->operator ?></td>
          </tr>
          <?php $total_pemasukan+=$key->jumlah_pemasukan;$i++;endforeach ?>
        
          <tr>
            <td colspan="3" class="text-center">Jumlah Total </td>
            <td colspan="2">Rp. <?= number_format($total_pemasukan,0,',','.'); ?>,-</td>
          </tr>
        </table>
      </div>
    </div>
  </div>





  </div>







</body>
</html>
