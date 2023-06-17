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
      <h2>LAPORAN SALDO TABUNGAN PER-BULAN</h2><br>
      <table cellpadding="5">
        <tr>
          <th>Periode</th>
          <td>:</td>
          <td><?= $this->lib->date_indo($tanggal1) ?> &nbsp;s/d.&nbsp; <?= $this->lib->date_indo($tanggal2) ?></td>
        </tr>
      </table><br>
       <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th class="text-center" widt="1%" class="text-center" rowspan="2">No</th>
              <th class="text-center" rowspan="2">Nama Kelas</th>
              <th class="text-center" colspan="4">Tabungan</th>
            </tr>
            <tr>
              <th class="text-center" width="10%">Jumlah</th>
              <th class="text-center">Saldo Menabung</th>
              <th class="text-center" width="10%">Jumlah</th>
              <th class="text-center">Saldo Mengambil</th>
            </tr>
           
          </thead>
          <?php $total_all_masuk=0;$total_all_keluar=0;$i=1; $z=1;foreach ($kelas as $key): ?>
          <?php foreach ($jurusan as $rows): ?>
              <?php foreach ($siswa as $row): ?>
                  <?php 
                    $this->db->where('tanggal_tabungan >=', $tanggal1);
                    $this->db->where('tanggal_tabungan <=', $tanggal2);
                   ?>
                   <?php if ($this->M_tabungan->get(['id_siswa' => $row->id_siswa])->num_rows() && $z==1): ?>
                    <tr>
                      <td class="text-center"><?= $i; ?></td>
                      <td><?= $key->nama_kelas . ' - ' . $rows->nama_jurusan ?></td>
                      <?php 
                        $jumlahMasuk = $this->db->query("SELECT * FROM tabungan INNER JOIN siswa ON tabungan.id_siswa = siswa.id_siswa WHERE siswa.id_kelas = '$key->id_kelas' AND siswa.id_jurusan = '$rows->id_jurusan' AND tabungan.tanggal_tabungan BETWEEN '$tanggal1' AND '$tanggal2' AND tabungan.status_tabungan =  1 GROUP BY tabungan.id_siswa ")->num_rows();
                        $jumlahKeluar = $this->db->query("SELECT * FROM tabungan INNER JOIN siswa ON tabungan.id_siswa = siswa.id_siswa WHERE siswa.id_kelas = '$key->id_kelas' AND siswa.id_jurusan = '$rows->id_jurusan' AND tabungan.tanggal_tabungan BETWEEN '$tanggal1' AND '$tanggal2' AND tabungan.status_tabungan =  0 GROUP BY tabungan.id_siswa ")->num_rows();

                        $total_masuk = 0;
                        $total_keluar = 0;
                        $this->db->where('tanggal_tabungan >=', $tanggal1);
                        $this->db->where('tanggal_tabungan <=', $tanggal2);
                        foreach ($this->db->query("SELECT * FROM tabungan INNER JOIN siswa ON tabungan.id_siswa = siswa.id_siswa WHERE siswa.id_kelas = '$key->id_kelas' AND siswa.id_jurusan = '$rows->id_jurusan' AND tabungan.tanggal_tabungan BETWEEN '$tanggal1' AND '$tanggal2'")->result() as $saldo) {
                          if ($saldo->status_tabungan == 1) {
                            $total_masuk += $saldo->jumlah_tabungan;
                          }else{
                            $total_keluar += $saldo->jumlah_tabungan;
                          }
                        }
                         ?>
                      <td><?= $jumlahMasuk ?> Orang</td>
                      <td>Rp. <?= number_format($total_masuk, 0, ',', '.') ?>,-</td>
                      <td><?= $jumlahKeluar ?> Orang</td>
                      <td>Rp. <?= number_format($total_keluar, 0, ',', '.') ?>,-</td>
                    </tr>
                     
                   <?php $i++; $total_all_masuk+=$total_masuk;$total_all_keluar+=$total_keluar; endif ?>
              <?php $z++;endforeach ?>
          <?php endforeach ?>
          <?php endforeach ?>
            <tr>
              <th colspan="3" class="text-center">Jumlah Total</th>
              <th colspan="2" class="text-left">Rp. <?= number_format($total_all_masuk,0,',','.') ?>,-</th>
              <th class="text-left">Rp. <?= number_format($total_all_keluar,0,',','.') ?>,-</th>
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
  header("Content-Disposition: attachment; filename=laporan-saldo-tabungan-per-bulan-".$tanggal1."-".$tanggal2.".xls");
?>
<?php else: ?>
  <?php  redirect(base_url('admin/laporantabungan/tabungan_bulan')); ?>
<?php endif ?>
</body>
</html>