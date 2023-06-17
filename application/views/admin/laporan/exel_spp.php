    <?php 
      header("Content-type: application/vnd-ms-excel");
      header("Content-Disposition: attachment; filename=laporan-spp-".date('d-M-Y').".xls");
    ?>
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
<!-- <div class="container" style="margin-top: 30px;"> -->
  <div class="row" id="data-pemasukan">
    <div class="col-lg-12">
      <h2>LAPORAN BAGAN SPP</h2><br>
      <table cellpadding="5">
        <tr>
          <th>Kelas</th>
          <td>:</td>
          <td><?= $nama_kelas .' - ' . $nama_jurusan ?></td>
        </tr>
        <!-- <tr>
          <th>Total</th>
          <td>:</td>
          <?php if ($id_kelas == 4): ?>
          <td><?= count($siswa) * 3 ?> data</td>
          <?php else: ?>
          <td><?= count($siswa) * $id_kelas ?> data</td>
          <?php endif ?>
        </tr> -->
      </table>
    </div>
    <div class="col-lg-12"><br>
      <?php foreach ($kelas as $kls): ?>
      <?php if ($kls->id_kelas != 4 && $id_kelas >= $kls->id_kelas): ?> 
        <table class="table table-bordered">
          <thead>
            <tr>
              <th rowspan="2">NISN</th>
              <th rowspan="2" >Nama</th>
              <th colspan="12" class="text-center">SPP KELAS &nbsp;:&nbsp; <?= $kls->nama_kelas ?></th>
              <th rowspan="2">Total</th>
            </tr>
            <tr>
               <th>Juli</th>
                <th>Agustus</th>
                <th>September</th>
                <th>Oktober</th>
                <th>November</th>
                <th>Desember</th>
                <th>Januari</th>
                <th>Februari</th>
                <th>Maret</th>
                <th>April</th>
                <th>Mei</th>
                <th>Juni</th>
            </tr>
          </thead>
          <tbody>
            <?php 

              $bulan = ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'];
               $b=0; 
              foreach ($siswa as $key) :
            ?>
            <?php if ($this->db->get_where('spp', ['id_siswa' => $key->id_siswa, 'id_kelas' => $kls->id_kelas])->num_rows()): ?>
            <tr>
              <td><?= $key->nisn ?></td>
              <td><?= $key->nama_siswa ?></td>
                <?php 
                  for ($i=0; $i < count($bulan); $i++) { 
                    $result = $this->db->get_where('spp', ['id_siswa' => $key->id_siswa, 'bulan' => $bulan[$i], 'id_kelas' => $kls->id_kelas])->row();
                    if ($result->status_spp == 1) {
                      echo "<td class='text-center'>Lunas</td>";
                    }else{
                      echo "<td class='text-center'>Belum Lunas</td>";
                    }
                  }
                 ?>
              <td><?= $this->db->get_where('spp', ['id_siswa' => $key->id_siswa, 'id_kelas' => $kls->id_kelas, 'status_spp' => 1])->num_rows() ?> Bulan</td>
            </tr>
            <?php endif ?>
            <?php $b++; endforeach ?>
          </tbody>
        </table><br><br><br>
      <?php endif ?>
      <?php endforeach ?>
    </div>
  </div>
<!-- </div> -->

</body>
</html>