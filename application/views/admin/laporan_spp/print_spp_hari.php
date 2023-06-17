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
      <h2>LAPORAN SPP PER-HARI</h2><br>
      <table cellpadding="5">
        <tr>
          <th>Tanggal</th>
          <td>:</td>
          <td><?= $this->lib->date_indo($tanggal) ?></td>
        </tr>
      </table><br>
       <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th>NIS</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th>Bulan</th>
              <!-- <th>Spp</th>
              <th>Tabsis</th> -->
              <th>Total</th>
              <th>Operator</th>
            </tr>
          </thead>
            <?php $total_spp=0;$total_spp=0;$i=1;foreach ($siswa as $key): ?>
            <?php  $this->db->like('tanggal_bayar_spp', date('Y-m-d', strtotime($tanggal))); ?>
            <?php if ($this->db->get_where('spp', ['id_siswa' => $key->id_siswa, 'status_spp' => 1])->num_rows()): ?>
            <tr>
              <td class="text-center"><?= $i ?> .</td>
              <td><?= $key->nisn ?></td>
              <td><?= $key->nama_siswa ?></td>
              <td><?= $key->nama_kelas ?> - <?= $key->nama_jurusan ?></td>
              <?php 
                // Penamaan bulan
                $this->db->order_by('id_spp', 'ASC');
                $this->db->like('tanggal_bayar_spp', date('Y-m-d', strtotime($tanggal)));
                $bulan1 = $this->db->get_where('spp', ['id_siswa' => $key->id_siswa, 'status_spp' => 1])->row();

                $this->db->order_by('id_spp', 'DESC');
                $this->db->like('tanggal_bayar_spp', date('Y-m-d', strtotime($tanggal)));
                $bulan2 = $this->db->get_where('spp', ['id_siswa' => $key->id_siswa, 'status_spp' => 1])->row();

                $total_spp_siswa = 0;
                $this->db->where('id_spp >=', $bulan1->id_spp);
                $this->db->where('id_spp <=', $bulan2->id_spp);
                $this->db->where('status_spp', 1);
                $this->db->where('id_siswa', $key->id_siswa);
                foreach ($this->db->get('spp')->result() as $rows) {
                  $total_spp_siswa += $rows->jumlah_spp - (($rows->jumlah_spp * $rows->persen_spp) / 100);
                }
              ?>
              <?php if ($bulan1->bulan != $bulan2->bulan): ?>
              <td><?= $bulan1->bulan . ' - ' . $bulan2->bulan ?></td>
              <?php else: ?>
              <td><?= $bulan1->bulan ?></td>
              <?php endif ?>
              <!-- <td>Rp. <?= number_format($total_spp_siswa - $tabsis,0,',','.') ?>,-</td>
              <td>Rp. <?= number_format($tabsis, 0, ',', '.') ?>,-</td> -->
              <td>Rp. <?= number_format($total_spp_siswa, 0, ',', '.') ?>,-</td>
              <td><?= $bulan1->operator ?></td>
            </tr>
            <?php $total_spp+=($total_spp_siswa);endif ?>
            <?php $i++;endforeach ?>
         
            <tr>
              <th colspan="5" class="text-center" >Jumlah Total </th>
              <td colspan="2">Rp. <?= number_format($total_spp,0,',','.'); ?>,-</td>
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
  header("Content-Disposition: attachment; filename=laporan-spp-per-hari-".$tanggal.".xls");
?>
<?php else: ?>
  <?php  redirect(base_url('admin/laporanspp/spp_hari')); ?>
<?php endif ?>
</body>
</html>