
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pemasukkan</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($jumlah_pemasukan,0,',','.') ?>,-</div>
          </div>
          <div class="col-auto">
            <i class=" fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pengeluaran</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($jumlah_pengeluaran,0,',','.') ?>,-</div>
          </div>
          <div class="col-auto">
            <i class=" fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

 
  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Siswa</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_siswa ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jurusan</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_jurusan ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Content Row -->

<div class="row">

 
  <div class="col-lg-8 mb-4">

    <!-- Illustrations -->
    <div class="card shadow mb-4">
      <div class="card-header bg-gray-900 py-3">
        <h6 class="m-0 font-weight-bold text-white">Tentang Kami</h6>
      </div>
      <div class="card-body">
        <div class="text-center">
          <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="height: 210px;" src="<?= base_url('assets/img/sekolah/').$this->db->get_where('setting', ['name' => 'logo_sekolah'])->row()->value ?>" alt="">
        </div>
        <marquee><p>Hello , Selamat datang di Website kami Sekolah Pintar</p></marquee><br><br>
      </div>
      <div class="card-footer bg-gray-900"></div>
    </div>

  </div>

  <!-- Pie Chart -->
  <div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header bg-gray-900 py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-white">Grafik</h6>
        <div class="dropdown no-arrow">
         <!--  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item pilih-grafik" data-per="hari" href="#">Perhari</a>
            <a class="dropdown-item pilih-grafik" data-per="bulan" href="#">Perbulan</a>
            <a class="dropdown-item pilih-grafik" data-per="tahun" href="#">Pertahun</a>
          </div> -->
        </div>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="chart-pie pt-4 pb-2">
          <canvas id="myPieChart"></canvas>
        </div>
        <div class="mt-4 text-center small">
          <span class="mr-2">
            <i class="fas fa-circle text-danger"></i> Pengeluaran
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-success"></i> Pemasukkan
          </span>
      </div>
    </div>
    <div class="card-footer bg-gray-900"></div>
  </div>

</div>





<script>
            
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';


$(document).ready(function(){

  var jumlah_pemasukan = <?= $jumlah_pemasukan ?>;
  var jumlah_pengeluaran = <?= $jumlah_pengeluaran ?>;
  var ctx = document.getElementById("myPieChart");

  load_grafik();
  function load_grafik(){
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ["Pemasukkan", "Pengeluaran"],
        datasets: [{
          data: [jumlah_pemasukan , jumlah_pengeluaran],
          backgroundColor: ['#1cc88a', '#e74a3b'],
          hoverBackgroundColor: ['#1cc88a', '#e74a3b'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });
  }  





})



</script>

    