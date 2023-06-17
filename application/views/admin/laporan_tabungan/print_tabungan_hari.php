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
      <h2>LAPORAN SALDO TABUNGAN PER-HARI</h2><br>
      <table cellpadding="5">
        <tr>
          <th>Tanggal</th>
          <td>:</td>
          <td><?= $this->lib->date_indo($tanggal) ?></td>
        </tr>
      </table><br>
       <!-- <table class="table table-striped table-bordered table-hover">
            <tr>          
              <th class="text-center">No</th>
              <th>NIS</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th>Jumlah Saldo Menabung</th>
              <th>Jumlah Saldo Mengambil</th>
              <th>Operator</th>
            </tr>

             <?php $total_tabungan_masuk=0;$total_tabungan_keluar=0;$i=1;foreach ($siswa as $key): ?>
             <?php $this->db->like('tanggal_tabungan', date('Y-m-d', strtotime($tanggal))); ?>
             <?php if ($this->M_tabungan->get(['id_siswa' => $key->id_siswa])->num_rows()): ?>
             <tr>
               <td><?= $i; ?></td>
               <td><?= $key->nisn ?></td>
               <td><?= $key->nama_siswa ?></td>
               <td><?= $key->nama_kelas ?> - <?= $key->nama_jurusan ?></td>
               <?php 
                $uang_masuk=0; $uang_keluar=0;
                $this->db->like('tanggal_tabungan', date('Y-m-d', strtotime($tanggal)));
                foreach ($this->M_tabungan->get(['id_siswa' => $key->id_siswa])->result() as $rows) {
                  if ($rows->status_tabungan) {
                    $uang_masuk += $rows->jumlah_tabungan;
                  }else{
                    $uang_keluar += $rows->jumlah_tabungan;
                  }
                  $operator = $rows->operator;
                }
               ?>
               <td>Rp. <?= number_format($uang_masuk, 0, ',', '.') ?>,-</td>
               <td>Rp. <?= number_format($uang_keluar, 0, ',', '.') ?>,-</td>
               <td><?= $operator ?></td>
             </tr>
             <?php $i++;$total_tabungan_masuk+=$uang_masuk; $total_tabungan_keluar+=$uang_keluar; endif ?>
             <?php endforeach ?>
          
              <tr>
                <th colspan="4" class="text-center" >Jumlah Total </th>
                <td>Rp. <?= number_format($total_tabungan_masuk,0,',','.'); ?>,-</td>
                <td colspan="2">Rp. <?= number_format($total_tabungan_keluar,0,',','.'); ?>,-</td>
              </tr>
        
          </table> -->


          <table class="table table-striped table-bordered table-hover">
            <tr>
              <td colspan="7">Ket Id : &nbsp; 1 = Menabung, 2 = Mengambil</td>
            </tr>
            <tr>
              <th class="text-center" width="1%">No</th>
              <th>NIS</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th class="text-center">Id</th>
              <th>Status</th>
              <th>Operator</th>
            </tr>
           <?php $i=1;foreach ($this->db->query("SELECT * FROM tabungan INNER JOIN siswa ON tabungan.id_siswa = siswa.id_siswa INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas INNER JOIN jurusan ON siswa.id_jurusan = jurusan.id_jurusan WHERE tabungan.tanggal_tabungan LIKE '%".$tanggal."%'")->result() as $key): ?>
            <tr>
              <td class="text-center"><?= $i; ?></td>
              <td><?= $key->nisn ?></td>
              <td><?= $key->nama_siswa ?></td>
              <td><?= $key->nama_kelas ?> - <?= $key->nama_jurusan ?></td>
              <td class="text-center"><?= $key->status_tabungan ? 1 : 2 ?></td>
              <td><?= $key->status_tabungan ? 'Menabung' : 'Mengambil' ?></td>
              <td><?= $key->operator ?></td>
            </tr>
           <?php $i++;endforeach ?>
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
  header("Content-Disposition: attachment; filename=laporan-saldo-tabungan-per-hari-".$tanggal.".xls");
?>
<?php else: ?>
  <?php  redirect(base_url('admin/laporanspp/spp_hari')); ?>
<?php endif ?>
</body>
</html>