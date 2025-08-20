<?php
	$kon = mysqli_connect("localhost","root","","tumbuh");
	
	$id_anak = $_POST['id_anak'];
	
	$q_app = mysqli_query($kon,"select * from app where id_app = '1'");
	$r_app = mysqli_fetch_array($q_app,MYSQLI_ASSOC);
	
	$q_anak = mysqli_query($kon,"select * from identitas where id_anak = '$id_anak'");
	$r_anak = mysqli_fetch_array($q_anak,MYSQLI_ASSOC);
	
?>

<link rel="icon" href="gambar/logo.png" type="image/gif">
<title>ATKA (Aplikasi Tumbuh Kembang Anak)</title>

<table style='width:100%'>
	<tr align='center'>
		<td align='center' style='width:30%'><img src='gambar/brand1.png' width='180'></td>
		<td align='center' style='width:70%'>
			<b style='font-size:16pt;'>LAPORAN HASIL PERKEMBANGAN</b><br>
			<?php
				echo "<b style='font-size:20pt;'>$r_app[nama_tempat]</b><br>$r_app[alamat]<br>$r_app[ket]";
			?>
		</td>
	</tr>
	<tr>
		<td colspan='2' style='border-bottom: 1pt solid black;'></td>
	</tr>
</table>
<br>
<table style='width:100%;'>
	<tr></tr>
	<tr>
		<td colspan='4'><b>I. Identitas Anak</b></td>
	</tr>
	<tr>
		<td>Nama Anak</td>
		<td>: <u><?php echo $r_anak[nama_anak]; ?></u></td>
		<td>Jenis Kelamin</td>
		<td>: <u>
		<?php
			$jen = array("Laki-laki"," / ","Perempuan");
			$j = count($jen);
			for($i=0;$i<$j;$i++){
				if($r_anak[jenkel]==$jen[$i]){
					echo "
						<a>$jen[$i]</a>";
				}
				else if($jen[$i]==" / "){
					echo $jen[$i];
				}
				else{
					echo "
						<i style='text-decoration: line-through;'>$jen[$i]</i>";
				}
			}
			$tgl_periksa = strtotime($r_anak[tanggal_periksa]);
			$tgl_lahir = strtotime($r_anak[tanggal_lahir]);
			$tgl_periksa = date("d / m / Y", $tgl_periksa);
			$tgl_lahir = date("d / m / Y", $tgl_lahir);
		?></u>
		</td>
	</tr>
	<tr>
		<td>Nama Ayah</td>
		<td>: <u><?php echo $r_anak[nama_ayah]; ?></u></td>
		<td>Nama Ibu</td>
		<td>: <u><?php echo $r_anak[nama_ibu]; ?></u></td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td colspan='3'>: <u><?php echo $r_anak[alamat]; ?></u></td>
	</tr>
	<tr>
		<td>Tanggal Pemeriksaan</td>
		<td colspan='3'>: <u><?php echo $tgl_periksa; ?></u></td>
	</tr>
	<tr>
		<td>Tanggal Lahir</td>
		<td>: <u><?php echo $tgl_lahir; ?></u></td>
		<td>Umur</td>
		<td>: <u><?php echo $r_anak[umur]; ?> bulan</u></td>
	</tr>
	<tr></tr>
	<tr>
		<td colspan='4'><b>II. Anamnesis</b></td>
	</tr>
	<tr>
		<td colspan='4'>Keluhan Utama :</td>
	</tr>
	<tr>
		<td colspan='4'><u> </u></td>
	</tr>
	<tr>
		<td colspan='4'>Apakah anak memiliki masalah tumbuh kembanga</td>
	</tr>
	<tr>
		<td colspan='4'><u> </u></td>
	</tr>
	<tr></tr>
	<tr>
		<td colspan='4'><b>III. Pemeriksaan Rutin Sesuai Jadwal</b></td>
	</tr>
	<tr>
		<td colspan='2'>BB (Berat Badan)</td>
		<td colspan='2'>: <u><?php echo $r_anak[bb]; ?> kg</u></td>
	</tr>
	<tr>
		<td colspan='2'>TB/PB (Tinggi Badan/Panjang Badan)</td>
		<td colspan='2'>: <u><?php echo $r_anak[tb]; ?> cm</u></td>
	</tr>
</table>
<script type="text/javascript">
<!--
//window.print();
-->
</script>