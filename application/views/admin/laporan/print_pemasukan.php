<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DA</title>
  <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container" style="margin-top: 30px;">
  <div class="row" id="data-pemasukan">
    <div class="col-lg-12">
      <h2>LAPORAN PEMASUKAN</h2><br>
      <table cellpadding="5">
        <tr>
          <th>Tanggal</th>
          <td>:</td>
          <td><?= $tanggal ?></td>
        </tr>
        <tr>
          <th>Type Pemasukan</th>
          <td>:</td>
          <td><?= $type_pemasukan ?></td>
        </tr>
        <tr>
          <th>Total</th>
          <td>:</td>
          <td><?= count($pemasukan) ?> data</td>
        </tr>
      </table>
    </div>
    <div class="col-lg-12"><br>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th width="10%" class="text-center">No</th>
              <th>Tanggal Pemasukan</th>
              <th>Type Pemasukan</th>
              <th>Jumlah</th>
              <th>Operator</th>
            </tr>
          </thead>
          <tbody>
            <?php $total_pemasukan=0;$i=1;foreach ($pemasukan as $key): ?>
            <tr>
              <td class="text-center"><?= $i ?> .</td>
              <td><?= $this->lib->date_indo($key->tanggal_pemasukan) ?></td>
              <td><?= ucfirst($key->type_pemasukan) ?></td>
              <td>Rp. <?= number_format($key->jumlah_pemasukan,0, ',', '.') ?>,-</td>
              <td><?= $key->operator ?></td>
            </tr>
            <?php $total_pemasukan+=$key->jumlah_pemasukan;$i++;endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3" class="text-center">Jumlah Total </td>
              <td colspan="2">Rp. <?= number_format($total_pemasukan,0,',','.'); ?>,-</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>





  </div>







  <script>
    window.print();
  </script>
</body>
</html>
