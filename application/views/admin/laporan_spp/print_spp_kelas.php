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
      <h2>LAPORAN SPP PER-KELAS</h2><br>
      <table cellpadding="5">
          <tr>
            <th>Tanggal</th>
            <td>:</td>
            <td><?= $this->lib->date_indo($tanggal1) ?> &nbsp;-&nbsp; <?= $this->lib->date_indo($tanggal2) ?></td>
          </tr>
            <th>Kelas</th>
            <td>:</td>
            <td><?= $this->M_kelas->get(['id_kelas' => $id_kelas])->row()->nama_kelas .' - '. $this->M_jurusan->get(['id_jurusan' => $id_jurusan])->row()->nama_jurusan ?></td>
          </tr>
      </table><br>
      <table class="table table-striped table-bordered table-hover">
        <tr>
          <th widt="1%" class="text-center">No</th>
          <th>NIS</th>
          <th>Nama</th>
          <th>Bulan</th>
          <th>Total</th>
          <!-- <th>Tabsis</th> -->
          <!-- <th>Total</th> -->
        </tr>
        <?php $total_spp=0;$i=1;foreach ($this->M_siswa->get(['siswa.id_kelas' => $id_kelas, 'siswa.id_jurusan' => $id_jurusan])->result() as $key): ?>
          <?php 
          $tanggal1   = date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal1)).' 01:01:01'));
          $tanggal2   = date('Y-m-d H:m:s', strtotime(date('Y-m-d', strtotime($tanggal2)).' 24:01:01'));
          $this->db->where('tanggal_bayar_spp >=', $tanggal1);
          $this->db->where('tanggal_bayar_spp <=', $tanggal2);
          ?>
          <?php if ($this->M_spp->get(['id_siswa' => $key->id_siswa, 'status_spp' => 1])->num_rows()): ?>
          <tr>
            <td class="text-center"><?= $i ?></td>
            <td><?= $key->nisn ?></td>
            <td><?= $key->nama_siswa ?></td>
            <?php
                // penamaan bulan
                $this->db->order_by('id_spp', 'ASC');
                $bulan1 = $this->M_spp->get(['id_siswa' => $key->id_siswa, 'status_spp' => 1])->row();
                $this->db->order_by('id_spp', 'DESC');
                $bulan2 = $this->M_spp->get(['id_siswa' => $key->id_siswa, 'status_spp' => 1])->row();
                $total_spp_siswa = 0;
                // $total_tabsis = 0;
                $this->db->where('tanggal_bayar_spp >=', $tanggal1);
                $this->db->where('tanggal_bayar_spp <=', $tanggal2);
                foreach ($this->M_spp->get(['id_siswa' => $key->id_siswa, 'status_spp' => 1])->result() as $rows) {
                  $total_spp_siswa  += ($rows->jumlah_spp - (($rows->jumlah_spp * $rows->persen_spp) / 100));
                  // $total_tabsis     += $tabsis;
                }
            ?>
            <?php if ($bulan1->id_spp == $bulan2->id_spp): ?>
            <td><?= $bulan1->bulan ?></td>
            <?php else: ?>
            <td><?= $bulan1->bulan ?> - <?= $bulan2->bulan ?></td>
            <?php endif ?>
            <td>Rp. <?= number_format($total_spp_siswa, 0, ',', '.') ?>,-</td>
            <!-- <td>Rp. <?= number_format($total_tabsis, 0, ',', '.') ?>,-</td> -->
            <!-- <td>Rp. <?= number_format($total_spp_siswa + $total_tabsis, 0, ',', '.') ?>,-</td> -->
          </tr>
          <?php $total_spp+=($total_spp_siswa);endif ?>
        <?php $i++;endforeach ?>
        <tr>
          <th colspan="4" class="text-center" >Jumlah Total </th>
          <td>Rp. <?= number_format($total_spp,0,',','.'); ?>,-</td>
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
  header("Content-Disposition: attachment; filename=laporan-spp-per-kelas-".$tanggal1 .' - ' .$tanggal2.".xls");
?>
<?php else: ?>
  <?php  redirect(base_url('admin/laporanspp/spp_kelas')); ?>
<?php endif ?>
</body>
</html>