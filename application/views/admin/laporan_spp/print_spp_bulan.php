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
  <div class="row" id="data-pemasukan">
    <div class="col-lg-12">
      <h2>LAPORAN SPP PER-BULAN</h2><br>
      <table cellpadding="5">
          <tr>
            <th>Periode</th>
            <td>:</td>
            <td><?= $tanggal1 ?> &nbsp;s/d.&nbsp; <?= $tanggal2 ?></td>
          </tr>
      </table><br>
     <table class="table table-striped table-bordered table-hover">
        <tr>
          <th class="text-center" widt="1%" class="text-center" rowspan="2">No</th>
          <th class="text-center" rowspan="2">Kelas</th>
          <th class="text-center" rowspan="2">Jumlah</th>
         <!--  <th class="text-center" colspan="2">Pembayaran</th> -->
          <th class="text-center" rowspan="2">Total</th>
          <th class="text-center" colspan="4">Keringanan Spp</th>
        </tr>
        <tr>
          <!-- <th class="text-center">Spp</th>
          <th class="text-center">Tabsis</th> -->
          <th class="text-center">Kelas</th>
          <th class="text-center">Jumlah</th>
          <th class="text-center">Uang</th>
          <th class="text-center">Total</th>
        </tr>
      
      <?php 
      // $bulan      = $this->lib->date_bulan($tanggal1); 
      $i=1;
      // $tabsis     = 15000;
      $total_spp_all = 0;
      ?>
      <?php foreach ($kelas as $key): ?>
      <?php foreach ($jurusan as $rows): ?>
      <?php $z=1;foreach ($this->M_siswa->get(['siswa.id_kelas' => $key->id_kelas, 'siswa.id_jurusan' => $rows->id_jurusan])->result() as $siswa): ?>
      <?php
        $tanggal1   = date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal1)).' 01:01:01'));
        $tanggal2   = date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal2)).' 24:01:01'));
        $this->db->where('tanggal_bayar_spp >=', $tanggal1);
        $this->db->where('tanggal_bayar_spp <=', $tanggal2); 
      ?>
      <?php if ($this->M_spp->get(['id_siswa' => $siswa->id_siswa, 'status_spp' => 1])->num_rows() && $z==1): ?>
      <?php $z++; ?>
      <tr>
        <td class="text-center"><?= $i++ ?></td>
        <td><?= $key->nama_kelas ?> - <?= $rows->nama_jurusan ?></td>
        <?php
          $orang        = $this->db->query("SELECT * FROM spp INNER JOIN siswa ON spp.id_siswa = siswa.id_siswa WHERE siswa.id_kelas = '$key->id_kelas' AND siswa.id_jurusan = '$rows->id_jurusan' AND spp.status_spp = '1' AND spp.tanggal_bayar_spp BETWEEN '$tanggal1' AND '$tanggal2' GROUP BY spp.id_siswa")->num_rows();
          $keringanan   = $this->M_siswa->get(['siswa.id_kelas' => $key->id_kelas, 'siswa.id_jurusan' => $rows->id_jurusan, 'siswa.persen_spp >=' => 1]);
          $total_spp    = 0;
          // $total_tabsis = 0;
          foreach ($this->db->query("SELECT * FROM spp INNER JOIN siswa ON spp.id_siswa = siswa.id_siswa WHERE siswa.id_kelas = '$key->id_kelas' AND siswa.id_jurusan = '$rows->id_jurusan' AND spp.status_spp = '1' AND spp.tanggal_bayar_spp BETWEEN '$tanggal1' AND '$tanggal2'")->result() as $spp) {
            $total_spp += ($spp->jumlah_spp - ($spp->jumlah_spp * $spp->persen_spp) / 100);
            // $total_tabsis += $tabsis;
            $persen_spp = $spp->persen_spp;
            $jumlah_spp = $spp->jumlah_spp;
          }
          $total_spp_all+=$total_spp;
        ?>
        <td><?= $orang ?> Orang</td>
        <!-- <td>Rp. <?= number_format($total_spp - $total_tabsis, 0, ',', '.') ?>,-</td>
        <td>Rp. <?= number_format($total_tabsis, 0, ',', '.') ?>,-</td> -->
        <td>Rp. <?= number_format($total_spp, 0, ',', '.') ?>,-</td>
        <td><?= $key->nama_kelas ?> <?= $rows->nama_jurusan ?></td>
        <td><?= $keringanan->num_rows() ?> Orang</td>
        <td>Rp. <?= number_format(($jumlah_spp * $persen_spp) / 100, 0, ',', '.') ?>,-</td>
        <td>Rp. <?= number_format((($jumlah_spp * $persen_spp) / 100) * $keringanan->num_rows(), 0, ',', '.') ?>,-</td>
      </tr>
      <?php endif ?>
      <?php endforeach ?>
      <?php endforeach ?>
      <?php endforeach ?>
      <tr>
        <th colspan="3" class="text-left" >Jumlah Total </th>
        <td colspan="5">Rp. <?= number_format($total_spp_all,0,',','.'); ?>,-</td>
      </tr>
    </table>
    </div>
  </div>
<?php if ($type == 'print'): ?>
  <script>
    window.print();
</script>
  <?php elseif($type == 'excel') : ?>
  <?php 
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=laporan-spp-per-bulan-".$tanggal1 .' - ' .$tanggal2.".xls");
?>
<?php else: ?>
  <?php  redirect(base_url('admin/laporanspp/spp_bulan')); ?>
<?php endif ?>
</body>
</html>