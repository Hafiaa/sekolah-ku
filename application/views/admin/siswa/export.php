<table>
	<tr>
		<th>Nis</th>
		<th>Nama Siswa</th>
		<th>Kelas</th>
		<th>Jurusan</th>
		<th>Tempat Lahir</th>
		<th>Tanggal Lahir</th>
		<th>Beasiswa</th>
		<th>Persen Spp</th>
		<th>Persen Biaya Lain</th>
		<th>Persen Baju Seragam</th>
		<th>Uang Baju Seragam</th>
	</tr>
	<?php foreach ($siswa as $key): ?>
	<tr>
		<td><?= $key->nisn ?></td>
		<td><?= $key->nama_siswa ?></td>
		<td><?= $key->nama_kelas ?></td>
		<td><?= $key->nama_jurusan ?></td>
		<td><?= $key->tempat_lahir ?></td>
		<td><?= $key->tanggal_lahir ?></td>
		<td><?= $key->beasiswa ?></td>
		<td><?= $key->persen_spp ?></td>
		<td><?= $key->persen_biaya_lain ?></td>
		<td><?= $key->persen_baju_seragam ?></td>
		<td><?= $key->uang_seragam ?></td>
	</tr>
	<?php endforeach ?>
</table>


<?php 
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=data-siswa-".date('d-m-Y').".xls");
?>