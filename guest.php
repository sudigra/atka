<style>
input[type="radio"] {
   height: 20px;
   width: 20px;
   display: inline-block;
   cursor: pointer;
   vertical-align: middle;
   background: #FFF;
   border: 1px solid #d2d2d2;
   border-radius: 100%;
}
input[type="radio"] + div:hover {
	border-color: #c2c2c2;
}
input[type="radio"]:checked + div {
	background:gray;
}
</style>

<div class='container' style='margin-top:80px;'>
<?php
	$btn = $_POST['btn'];
	$stat = explode("&",$btn);
	
	$id_anak = $_SESSION['id_anak'];
	
	//inisialisasi form masukkan
	$nama_anak = $_POST['nama_anak'];
	$jenkel = $_POST['jenkel'];
	$nama_ayah = $_POST['nama_ayah'];
	$nama_ibu = $_POST['nama_ibu'];
	$alamat = $_POST['alamat'];
	$tempat_lahir = $_POST['tempat_lahir'];
	$tanggal_lahir = $_POST['tanggal_lahir'];
	$tanggal_periksa = $_POST['tanggal_periksa'];
	$umur = $_POST['umur'];
	$bb = $_POST['bb'];
	$tb = $_POST['tb'];
	$lk = $_POST['lk'];
	$tgl = date("Y-m-d");
	
	//menyimpan data identitas
	if($stat[0]=='simpan_ident'){
		$qCek = mysqli_query($kon,"select * from identitas where nama_anak = '$nama_anak' and tanggal_lahir = '$tanggal_lahir'");
		$rowCek = mysqli_num_rows($qCek);
		if($rowCek=='0'){
			//memasukkan data ke database identitas
			mysqli_query($kon,"insert into identitas(nama_anak,jenkel,nama_ayah,nama_ibu,alamat,tempat_lahir,tanggal_lahir,tanggal_periksa) values('$nama_anak','$jenkel','$nama_ayah','$nama_ibu','$alamat','$tempat_lahir','$tanggal_lahir','$tanggal_periksa')");
			//atur data ke cache browser
			$qdata = mysqli_query($kon,"select * from identitas where nama_anak = '$nama_anak' and tanggal_lahir = '$tanggal_lahir'");
			$rdata = mysqli_fetch_array($qdata,MYSQLI_ASSOC);
			$_SESSION['id_anak'] = $rdata[id_anak];
		}
		else{
			$data = mysqli_fetch_array($qCek,MYSQLI_ASSOC);
			mysqli_query($kon,"update identitas set nama_anak = '$nama_anak', jenkel = '$jenkel', nama_ayah = '$nama_ayah', nama_ibu = '$nama_ibu', alamat = '$alamat', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir' where id_anak = '$id_anak'");
			$qdata = mysqli_query($kon,"select * from identitas where nama_anak = '$nama_anak' and tanggal_lahir = '$tanggal_lahir'");
			$rdata = mysqli_fetch_array($qdata,MYSQLI_ASSOC);
			$_SESSION['id_anak'] = $rdata[id_anak];
		}
	}
	//menyimpan data ukur
	if($stat[0]=='simpan_ukur'){
		$qCek = mysqli_query($kon,"select * from catat_ukur where id_anak = '$id_anak' and tanggal = '$tgl'");
		$rowCek = mysqli_num_rows($qCek);
		$resCek = mysqli_fetch_array($qCek,MYSQLI_ASSOC);
		if($rowCek=='0'){
			mysqli_query($kon,"insert into catat_ukur(id_anak,berat_badan,tinggi_badan,lingkar_kepala,tanggal) values('$id_anak','$bb','$tb','$lk','$tgl')");
		}
		else{
			$data = mysqli_fetch_array($qCek,MYSQLI_ASSOC);
			mysqli_query($kon,"update catat_ukur set berat_badan = '$bb', tinggi_badan = '$tb', lingkar_kepala = '$lk' where id_ukur_anak = '$resCek[id_ukur_anak]'");
		}
	}
	
	//eksekusi jenis penyimpanan
	$proses = explode("_",$stat[0]);
	//menyimpan data kpsp
	if($proses[1]=='kpsp'){
		$fr_id_kpsp = $_POST['fr_id_kpsp'];
		$jawab = $_POST['jawab'];
		$qCek = mysqli_query($kon,"select * from catat_kpsp where id_anak = '$id_anak' and id_kpsp = '$fr_id_kpsp' and tanggal = '$tgl'");
		echo $qCek;
		$rowCek = mysqli_num_rows($qCek);
		$resCek = mysqli_fetch_array($qCek,MYSQLI_ASSOC);
		if($rowCek=='0'){ //insert data catat kpsp jika data belum ada
			mysqli_query($kon,"insert into catat_kpsp(id_anak,id_kpsp,jawab,tanggal) values('$id_anak','$fr_id_kpsp','$jawab','$tgl')");
		}
		else{ //update data catat kpsp jika data sudah ada
			$data = mysqli_fetch_array($qCek,MYSQLI_ASSOC);
			mysqli_query($kon,"update catat_kpsp set jawab = '$jawab' where id_catat_kpsp = '$resCek[id_catat_kpsp]'");
		}
	}
	//menyimpan data tdd
	if($proses[1]=='tdd'){
		$fr_id_tdd = $_POST['fr_id_tdd'];
		$jawab = $_POST['jawab'];
		$qCek = mysqli_query($kon,"select * from catat_tdd where id_anak = '$id_anak' and id_tdd = '$fr_id_tdd' and tanggal = '$tgl'");
		$rowCek = mysqli_num_rows($qCek);
		$resCek = mysqli_fetch_array($qCek,MYSQLI_ASSOC);
		if($rowCek=='0'){ //insert data catat kpsp jika data belum ada
			mysqli_query($kon,"insert into catat_tdd(id_anak,id_tdd,jawab,tanggal) values('$id_anak','$fr_id_tdd','$jawab','$tgl')");
		}
		else{ //update data catat kpsp jika data sudah ada
			$data = mysqli_fetch_array($qCek,MYSQLI_ASSOC);
			mysqli_query($kon,"update catat_tdd set jawab = '$jawab' where id_catat_tdd = '$resCek[id_catat_tdd]'");
		}
	}
	
	if($_POST['pildata']=='ya'){
				
				$id_anak = $_POST['pilih_anak'];
			}
	//pemilihan data anak yang dimasukkan
	$qdata = mysqli_query($kon,"select * from identitas where id_anak = '$id_anak'");
	$rdata = mysqli_fetch_array($qdata,MYSQLI_ASSOC);
	
	$umur_anak = $rdata[umur];
	$umur_kpsp = array("0","3","6","9","12");
	$umur_tdd = array("0","6","12","24");
	$u_k = count($umur_kpsp);
	$u_t = count($umur_tdd);
	
	for($i=0;$i<$u_k;$i++){
		$u = $i+1;
		if($umur_anak>$umur_kpsp[$i]){
			$umur_seleksi_kpsp = $umur_kpsp[$u];
		}
	}
	for($i=0;$i<$u_t;$i++){
		$u = $i+1;
		if($umur_anak>$umur_tdd[$i]){
			$umur_seleksi_tdd = $umur_tdd[$u];
		}
	}
	
	if($page==''){
		$page='home';
	}
	if($page=='home'){
		if($stat[1]==''){
			?>
			<div class='panel panel-info'>
				<div class='panel-heading'>
					<h3 class='text-center'>
						Tes Deteksi Dini Tumbuh Kembang Anak
					</h3>
				</div>
				<div class='panel-body'>
					<p class='text-center'>
						Deteksi dini tumbuh kembang anak adalah kegiatan/pemeriksaan untuk menemukan secara dini adanya penyimpangan tumbuh kembang pada balita dan anak prasekolah. Dengan ditemukan secara dini penyimpangan/masalah tumbuh kembang anak, maka intervensi akan lebih mudah dilakukan.<br>
					</p>
					<form method='post' action=''>
						<p class='text-center'>
							<button class='btn btn-info btn-lg' name='btn' value='mulai&ident'>Mulai Test</button>			
						</p>
					</form>
				</div>
			</div>
		<?php	
		}
		if($stat[1]=='ident'){
			
			?>
		<div class='panel panel-info'>
				<div class='panel-heading'>
					<h3 class=''>
						<b class='text-danger'>Identitas Anak</b>
					</h3>
				</div>
				<div class='panel-body'>
					<div class='row'>
						<label class="col-sm-5 col-form-label">Sudah Pernah melakukan pemeriksaan?</label>
						<div class="col-sm-5">
							<label class='form-check-label'>
								<input type='radio' name='pernah' value='Pernah' onclick='tampil()' checked> Pernah
							</label>
							<label class='form-check-label'>
								<input type='radio' name='pernah' value='Belum' onclick='hilang()'> Belum
							</label>
						</div>
					</div>
					<form method='post' action='' >
						<input type='hidden' name='pildata' id='pildata' value='ya'>
						<input type='hidden' name='btn' value='mulai&ident'>
						<div class="form-group row" id='pilih_data'>
							<label class="col-sm-3 col-form-label">Pilih Nama Anak</label>
							<div class="col-sm-5">
								
								<select name='pilih_anak' class='form-control' onchange='submit()'>
								<?php
									$qDa = mysqli_query($kon,"select * from identitas order by nama_anak ASC");
									while($rDa = mysqli_fetch_array($qDa,MYSQLI_ASSOC)){
										if($id_anak==$rDa[id_anak]){
											echo"<option value=$rDa[id_anak] selected>$rDa[nama_anak]</option>";
										}
										else{
											echo"<option value=$rDa[id_anak]>$rDa[nama_anak]</option>";
										}
										
									}
								?>
								</select>
							</div>
						</div>
					</form>
			<script>
				function tampil(){
					document.getElementById("pilih_data").style.display = "block";
					document.getElementById("pildata").value='ya';
				}
				function hilang(){
					document.getElementById("pildata").value='Tidak';
					document.getElementById("pilih_data").style.display = "none";
				}
			</script>
				<form method="post" action="#">	
					<div class="form-group row">
						<label for="nama_anak" class="col-sm-2 col-form-label">Nama Anak</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="nama_anak" id="nama_anak" value='<?php echo $rdata['nama_anak']; ?>' placeholder="Masukkan nama lengkap anak" required="">
						</div>
						<?php
							$jen = array("Laki-laki","Perempuan");
							$j = count($jen);
							for($i=0;$i<$j;$i++){
								if($rdata[jenkel]==$jen[$i]){
									echo "
										<div class='col-sm-2'>
											<label class='form-check-label'>
												<input class='form-check-input' type='radio' value='$jen[$i]' name='jenkel' checked>
												$jen[$i]
											</label>
										</div>";
								}
								else{
									echo "
										<div class='col-sm-2'>
											<label class='form-check-label'>
												<input class='form-check-input' type='radio' value='$jen[$i]' name='jenkel'>
												$jen[$i]
											</label>
										</div>";
								}
							}
						?>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nama Ayah</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="nama_ayah" placeholder="Masukkan Nama Ayah" required="" value='<?php echo $rdata['nama_ayah']; ?>' >
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nama Ibu</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="nama_ibu" placeholder="Masukkan Nama Ibu" required="" value='<?php echo $rdata['nama_ibu']; ?>' >
						</div>
					</div>
					<div class="form-group row">
						<label for="nama_ibu" class="col-sm-2 col-form-label">Alamat</label>
						<div class="col-sm-5">
							<textarea class="form-control" name="alamat" placeholder="Masukkan alamat" required=""><?php echo $rdata['alamat']; ?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label for="tanggal_lahir" class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" name="tempat_lahir" required="" value='<?php echo $rdata['tempat_lahir']; ?>' >
						</div>
						<div class="col-sm-3">
							<input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" onchange="setUmur()" required="" value='<?php echo $rdata['tanggal_lahir']; ?>' >
						</div>
					</div>
					<div class="form-group row">
						<label for="tanggal_periksa" class="col-sm-2 col-form-label">Tanggal Periksa</label>
						<div class="col-sm-3">
							<input type="date" class="form-control" name="tanggal_periksa" id="tanggal_periksa" value='<?php echo $rdata['tanggal_periksa']; ?>' >
						</div>
					</div>
					<div class="form-group row">
						<label for="Umur" class="col-sm-2 col-form-label">Umur</label>
						<div class="col-sm-1">
							<input type="text" class="form-control" name="umur" id="umur" required="" value='<?php echo $rdata['umur']; ?>' > 
						</div>
						<label for="Bulan" class="col-sm-2 col-form-label">Bulan</label>
					</div>
					<hr>
					*Nb. Umur akan otomatis terisi
					<hr>
					<button type="submit" class="btn btn-info pull-right btn-lg" name='btn' value='simpan_ident&ukur'>Simpan &  Lanjutkan <i class='glyphicon glyphicon-menu-right'></i></button>
				</form>
				<script>
					var date = new Date();

					var day = date.getDate();
					var month = date.getMonth() + 1;
					var year = date.getFullYear();

					if (month < 10) month = "0" + month;
					if (day < 10) day = "0" + day;

					var today = year + "-" + month + "-" + day;

					document.getElementById('tanggal_periksa').value = today;
					
					function setUmur(){
						var tgl_awal = document.getElementById('tanggal_lahir').value;
						var tgl_akhir = document.getElementById('tanggal_periksa').value;
						var tgl_awal_pisah = tgl_awal.split('-');
						var tgl_akhir_pisah = tgl_akhir.split('-');
						var objek_tgl = new Date();
						var tgl_awal_leave = objek_tgl.setFullYear(tgl_awal_pisah[0], tgl_awal_pisah[1], tgl_awal_pisah[2]);
						var tgl_akhir_leave = objek_tgl.setFullYear(tgl_akhir_pisah[0], tgl_akhir_pisah[1], tgl_akhir_pisah[2]);
						var hasil = (tgl_akhir_leave - tgl_awal_leave) / (60*60*24*1000);
						var umur = hasil / 30;
						umur = umur.toFixed(0);
						document.getElementById('umur').value = umur;
					}
					
						var tgl_awal = document.getElementById('tanggal_lahir').value;
						var tgl_akhir = document.getElementById('tanggal_periksa').value;
						var tgl_awal_pisah = tgl_awal.split('-');
						var tgl_akhir_pisah = tgl_akhir.split('-');
						var objek_tgl = new Date();
						var tgl_awal_leave = objek_tgl.setFullYear(tgl_awal_pisah[0], tgl_awal_pisah[1], tgl_awal_pisah[2]);
						var tgl_akhir_leave = objek_tgl.setFullYear(tgl_akhir_pisah[0], tgl_akhir_pisah[1], tgl_akhir_pisah[2]);
						var hasil = (tgl_akhir_leave - tgl_awal_leave) / (60*60*24*1000);
						var umur = hasil / 30;
						umur = umur.toFixed(0);
						document.getElementById('umur').value = umur;
					
				</script>
			</div>
		</div>
		<?php
		}
		else if($stat[1]=='ukur'){
		?>
		<div class='panel panel-info'>
			<div class='panel-heading'>
				<h3 class=''>
					<b class='text-info'>Identitas Anak</b> | <b class='text-danger'>Pengukuran </b>
				</h3>
			</div>
			<div class='panel-body'>
				<form method='post' action=''>
					<div class="form-group row">
						<label for="tb" class="col-sm-2 col-form-label">Tinggi Badan</label>
						<div class="col-sm-1">
							<input type="text" class="form-control" name="tb" id="tb" required="" value='<?php echo $rdata['tb']; ?>' > 
						</div>
						<label for="bb" class="col-sm-2 col-form-label">cm</label>
					</div>
					<div class="form-group row">
						<label for="lk" class="col-sm-2 col-form-label">Lingkar Kepala</label>
						<div class="col-sm-1">
							<input type="text" class="form-control" name="lk" id="lk" required="" value='<?php echo $rdata['lk']; ?>' > 
						</div>
						<label for="bb" class="col-sm-2 col-form-label">cm</label>
					</div>
					<div class="form-group row">
						<label for="bb" class="col-sm-2 col-form-label">Berat Badan</label>
						<div class="col-sm-1">
							<input type="text" class="form-control" name="bb" id="bb" required="" value='<?php echo $rdata['bb']; ?>' > 
						</div>
						<label for="bb" class="col-sm-2 col-form-label">kg</label>
					</div>
					*NB.<br>
					Gunakan tanda (.) jika berat atau panjang tidak bilangan bulat
					<hr>
					<p class='text-center'>
						<button type="submit" class="btn btn-info pull-left btn-lg" name='btn' value='simpan_ukur&ident'><i class='glyphicon glyphicon-menu-left'></i> Kembali</button>
						<button type='submit' class='btn btn-info pull-right btn-lg' name='btn' value='simpan_ukur&kpsp'>Lanjutkan <i class='glyphicon glyphicon-menu-right'></i></button>			
					</p>
				</form>
			</div>
		</div>
		<?php
		}
		else if($stat[1]=='keluh'){
			$que = mysqli_query($kon,"select * from keluh where umur='$umur_seleksi_kpsp' order by id_kpsp ASC");
	
			while($res=mysqli_fetch_array($que,MYSQLI_ASSOC)){
				$list_kpsp[] = $res[id_kpsp];
			}
			 
			$pos = $stat[0];
			$pos = explode("_",$pos);
			$a = $_POST['kpsp'] + $pos[2];
			$b = count($list_kpsp)-1;
			$c = count($list_kpsp);
			$d = $a+1;
			$id_kpsp = $list_kpsp[$a];
	
			$ques = mysqli_query($kon,"select * from kpsp where id_kpsp = '$id_kpsp'");
			$resq = mysqli_fetch_array($ques,MYSQLI_ASSOC);
		//query cek data yang sudah di jawab
		$q = mysqli_query($kon,"select * from catat_kpsp where id_anak = '$id_anak' and tanggal = '$tgl' and id_kpsp = '$id_kpsp'");
		$Cek = mysqli_fetch_array($q,MYSQLI_ASSOC);
		//yang ditampilkan pilihan yang sudah di jawab
		if($Cek[jawab]=='ya'){
			$ya = 'checked';
		}
		else if($Cek[jawab]=='tidak'){
			$tidak = 'checked';
		}
		?>	
		<div class='panel panel-info'>
		<div class='panel-heading'>
			<h3 class=''>
				<b class='text-info'>Identitas Anak</b> | <b class='text-info'>Pengukuran</b> | <b class='text-danger'>KPSP <sup><sup><?php echo $c; ?> Pertanyaan</sup></sup></b> 
			</h3>
		</div>
		<div class='panel-body'>
			<h4><b class='bg-info text-info' style='padding:5px; border-radius:;'>Pertanyaan Nomor <?php echo"<b class='bg-primary text-info' style='padding:5px; border-radius:4px;'>$d</b>";?></b></h4>
			<h3><?php echo"$resq[isi_kpsp]"; ?></h3>
			<form method='post' action=''>
				<input type='hidden' name='kpsp' value='<?php echo $a; ?>'>
				<input type='hidden' name='fr_id_kpsp' value='<?php echo $id_kpsp; ?>'>
				<hr>
				<div class='row'>
					<div class='col-sm-5'>
						<label class='form-check-label'>
							<input class='form-check-input' type='radio' value='ya' name='jawab' <?php echo $ya; ?>>
							<b style='font-size:20pt'>YA
						</label>
					</div>
					<div class='col-sm-5'>
						<label class='form-check-label'>
							<input class='form-check-input' type='radio' value='tidak' name='jawab' <?php echo $tidak; ?>>
							TIDAK</b>
						</label>
					</div>
				</div>
				<hr>
				*Nb.<br>
				Jika merasa ragu-ragu, jawab Tidak
				<hr>
			<?php
					if($a<1){
						echo"
						<button type='submit' class='btn btn-info pull-left btn-lg' name='btn' value='simpan_kpsp&ukur'>Kembali</button>
						<button class='btn btn-success btn-lg pull-right' type='submit' name='btn' value='simpan_kpsp_1&kpsp'>Selanjutnya</button>";
					}
					else if($a==$b){
						echo"
						<button class='btn btn-success btn-lg pull-left' type='submit' name='btn' value='simpan_kpsp_-1&kpsp'>Sebelumnya</button>
						<button type='submit' class='btn btn-info pull-right btn-lg' name='btn' value='simpan_kpsp&tdd'>Lanjutkan</button>";
					}
					else{
						echo"
						<button class='btn btn-success btn-lg pull-left' type='submit' name='btn' value='simpan_kpsp_-1&kpsp'>Sebelumnya</button>
						<button class='btn btn-success btn-lg pull-right' type='submit' name='btn' value='simpan_kpsp_1&kpsp'>Selanjutnya</button>";
					}
				?>
			</form>
		</div>
	</div>
	<?php
		}
		else if($stat[1]=='kpsp'){
			$que = mysqli_query($kon,"select * from kpsp where umur='$umur_seleksi_kpsp' order by id_kpsp ASC");
	
			while($res=mysqli_fetch_array($que,MYSQLI_ASSOC)){
				$list_kpsp[] = $res[id_kpsp];
			}
			 
			$pos = $stat[0];
			$pos = explode("_",$pos);
			$a = $_POST['kpsp'] + $pos[2];
			$b = count($list_kpsp)-1;
			$c = count($list_kpsp);
			$d = $a+1;
			$id_kpsp = $list_kpsp[$a];
	
			$ques = mysqli_query($kon,"select * from kpsp where id_kpsp = '$id_kpsp'");
			$resq = mysqli_fetch_array($ques,MYSQLI_ASSOC);
		//query cek data yang sudah di jawab
		$q = mysqli_query($kon,"select * from catat_kpsp where id_anak = '$id_anak' and id_kpsp = '$id_kpsp'");
		$Cek = mysqli_fetch_array($q,MYSQLI_ASSOC);
		//yang ditampilkan pilihan yang sudah di jawab tanggal = '$tgl' and
		if($Cek[jawab]=='ya'){
			$ya = 'checked';
		}
		else if($Cek[jawab]=='tidak'){
			$tidak = 'checked';
		}
		?>	
		<div class='panel panel-info'>
		<div class='panel-heading'>
			<h3 class=''>
				<b class='text-info'>Identitas Anak</b> | <b class='text-info'>Pengukuran</b> | <b class='text-danger'>KPSP <sup><sup><?php echo $c; ?> Pertanyaan</sup></sup></b> 
			</h3>
		</div>
		<div class='panel-body'>
			<h4><b class='bg-info text-info' style='padding:5px; border-radius:;'>Pertanyaan Nomor <?php echo"<b class='bg-primary text-info' style='padding:5px; border-radius:4px;'>$d</b>";?></b></h4>
			<h3><?php echo"$resq[isi_kpsp]"; ?></h3>
			<form method='post' action=''>
				<input type='hidden' name='kpsp' value='<?php echo $a; ?>'>
				<input type='hidden' name='fr_id_kpsp' value='<?php echo $id_kpsp; ?>'>
				<hr>
				<div class='row'>
					<div class='col-sm-5'>
						<label class='form-check-label'>
							<input class='form-check-input' type='radio' value='ya' name='jawab' <?php echo $ya; ?>>
							<b style='font-size:20pt'>YA
						</label>
					</div>
					<div class='col-sm-5'>
						<label class='form-check-label'>
							<input class='form-check-input' type='radio' value='tidak' name='jawab' <?php echo $tidak; ?>>
							TIDAK</b>
						</label>
					</div>
				</div>
				<hr>
				*Nb.<br>
				Jika merasa ragu-ragu, jawab Tidak
				<hr>
			<?php
					if($a<1){
						echo"
						<button type='submit' class='btn btn-info pull-left btn-lg' name='btn' value='simpan_kpsp&ukur'>Kembali</button>
						<button class='btn btn-success btn-lg pull-right' type='submit' name='btn' value='simpan_kpsp_1&kpsp'>Selanjutnya</button>";
					}
					else if($a==$b){
						echo"
						<button class='btn btn-success btn-lg pull-left' type='submit' name='btn' value='simpan_kpsp_-1&kpsp'>Sebelumnya</button>
						<button type='submit' class='btn btn-info pull-right btn-lg' name='btn' value='simpan_kpsp&tdd'>Lanjutkan</button>";
					}
					else{
						echo"
						<button class='btn btn-success btn-lg pull-left' type='submit' name='btn' value='simpan_kpsp_-1&kpsp'>Sebelumnya</button>
						<button class='btn btn-success btn-lg pull-right' type='submit' name='btn' value='simpan_kpsp_1&kpsp'>Selanjutnya</button>";
					}
				?>
			</form>
		</div>
	</div>
	<?php
		}
		else if($stat[1]=='tdd'){
			$que = mysqli_query($kon,"select * from tdd where umur='$umur_seleksi_tdd' order by id_tdd ASC");
	
			while($res=mysqli_fetch_array($que,MYSQLI_ASSOC)){
				$list_tdd[] = $res[id_tdd];
			}
			
			$pos = $stat[0];
			$pos = explode("_",$pos);
			$a = $_POST['tdd'] + $pos[2];
			$b = count($list_tdd)-1;
			$c = count($list_tdd);
			$d = $a+1;
			$id_tdd = $list_tdd[$a];
			$ques = mysqli_query($kon,"select * from tdd where id_tdd = '$id_tdd'");
			$resq = mysqli_fetch_array($ques,MYSQLI_ASSOC);
			
		//query cek data yang sudah di jawab
		$q = mysqli_query($kon,"select * from catat_tdd where id_anak = '$id_anak' and tanggal = '$tgl' and id_tdd = '$id_tdd'");
		$Cek = mysqli_fetch_array($q,MYSQLI_ASSOC);
		//yang ditampilkan pilihan yang sudah di jawab
		if($Cek[jawab]=='ya'){
			$ya = 'checked';
		}
		else if($Cek[jawab]=='tidak'){
			$tidak = 'checked';
		}
		?>	
		<div class='panel panel-info'>
		<div class='panel-heading'>
			<h3 class=''>
				<b class='text-info'>Identitas Anak</b> | <b class='text-info'>Pengukuran</b> | <b class='text-info'>KPSP</b> | <b class='text-danger'>TDD <sup><sup><?php echo $c; ?> Pertanyaan</sup></sup></b> 
			</h3>
		</div>
		<div class='panel-body'>
			<h4><b class='bg-info text-info' style='padding:5px; border-radius:;'>Pertanyaan Nomor <?php echo"<b class='bg-primary text-info' style='padding:5px; border-radius:4px;'>$d</b>";?></b></h4>
			<h3><?php echo"$resq[isi_tdd]"; ?></h3>
			<form method='post' action=''>
				<input type='hidden' name='tdd' value='<?php echo $a; ?>'>
				<input type='hidden' name='fr_id_tdd' value='<?php echo $id_tdd; ?>'>
				<hr>
				<div class='row'>
					<div class='col-sm-5'>
						<label class='form-check-label'>
							<input class='form-check-input' type='radio' value='ya' name='jawab' <?php echo $ya; ?>>
							<b style='font-size:20pt'>YA
						</label>
					</div>
					<div class='col-sm-5'>
						<label class='form-check-label'>
							<input class='form-check-input' type='radio' value='tidak' name='jawab' <?php echo $tidak; ?>>
							TIDAK</b>
						</label>
					</div>
				</div>
				<hr>
				*Nb.<br>
				Jika merasa ragu-ragu, jawab Tidak
				<hr>
			<?php
					if($a<1){//jika pertanyaan pertama
						echo"
						<button type='submit' class='btn btn-info pull-left btn-lg' name='btn' value='simpan_tdd&kpsp'>Kembali</button>
						<button class='btn btn-success btn-lg pull-right' type='submit' name='btn' value='simpan_tdd_1&tdd'>Selanjutnya</button>";
					}
					else if($a==$b){//jika pertanyaan terakhir
						echo"
						<button class='btn btn-success btn-lg pull-left' type='submit' name='btn' value='simpan_tdd_-1&tdd'>Sebelumnya</button>
						<button type='submit' class='btn btn-info pull-right btn-lg' name='btn' value='simpan_tdd_1&finis'>Lanjutkan</button>";
					}
					else{//jika pertanyaan masih ada
						echo"
						<button class='btn btn-success btn-lg pull-left' type='submit' name='btn' value='simpan_tdd_-1&tdd'>Sebelumnya</button>
						<button class='btn btn-success btn-lg pull-right' type='submit' name='btn' value='simpan_tdd_1&tdd'>Selanjutnya</button>";
					}
				?>
			</form>
		</div>
	</div>
	<?php
		}
		else if($stat[1]=='finis'){
			
		?>	
		<div class='panel panel-info'>
		<div class='panel-heading'>
			<h3 class=''>
				<b class='text-info'>Identitas Anak</b> | <b class='text-info'>Pengukuran</b> | <b class='text-info'>KPSP</b> | <b class='text-danger'>TDD <sup><sup><?php echo $c; ?> Pertanyaan</sup></sup></b> | <b class='text-danger'>Selesai</b> 
			</h3>
		</div>
		<div class='panel-body'>
			<h4><b class='bg-info text-info' style='padding:5px; border-radius:;'>Hasil Test</b></h4>
			<h3><?php echo"$resq[isi_tdd]"; ?></h3>
			<?php 
				//$q_i = mysqli_query($kon,"select * from identitas where id_anak = '$
			?>
			<form method='post' action=''>
				<table class='table table-hover'>
					<tr>
						<td colspan='4'>I. Identitas Anak</td>
					</tr>
					<tr>
						<td>Nama Anak</td>
						<td>: <?php echo $rdata[nama_anak]; ?></td>
						<td>Jenis Kelamin</td>
						<td>: 
						<?php
							$jen = array("Laki-laki","Perempuan");
							$j = count($jen);
							for($i=0;$i<$j;$i++){
								if($rdata[jenkel]==$jen[$i]){
									echo "
										<a>$jen[$i]</a>";
								}
								else{
									echo "
										<i style='text-decoration: line-through;'>$jen[$i]</i>";
								}
							}
							$tgl_periksa = strtotime($rdata[tanggal_periksa]);
							$tgl_lahir = strtotime($rdata[tanggal_lahir]);
							$tgl_periksa = date("d / m / Y", $tgl_periksa);
							$tgl_lahir = date("d / m / Y", $tgl_lahir);
						?>
						</td>
					</tr>
					<tr>
						<td>Nama Ayah</td>
						<td>: <?php echo $rdata[nama_ayah]; ?></td>
						<td>Nama Ibu</td>
						<td>: <?php echo $rdata[nama_ibu]; ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td colspan='3'>: <?php echo $rdata[alamat]; ?></td>
					</tr>
					<tr>
						<td>Tanggal Pemeriksaan</td>
						<td colspan='3'>: <?php echo $tgl_periksa; ?></td>
					</tr>
					<tr>
						<td>Tanggal Lahir</td>
						<td>: <?php echo $tgl_lahir; ?></td>
						<td>Umur</td>
						<td>: <?php echo $rdata[umur]; ?> bulan</td>
					</tr>
					<tr>
						<td colspan='4'>II. Anamnesis</td>
					</tr>
					<tr>
						<td colspan='2'>Keluhan Utama</td>
						<td colspan='2'>: </td>
					</tr>
					<tr>
						<td colspan='2'>Apakah anak memiliki masalah tumbuh kembanga</td>
						<td colspan='2'>: </td>
					</tr>
					<tr>
						<td colspan='4'>III. Pemeriksaan Rutin Sesuai Jadwal</td>
					</tr>
					<tr>
						<td>BB (Berat Badan)</td>
						<td>: <?php echo $rdata[bb]; ?> kg</td>
						<td>TB/PB (Tinggi Badan/Panjang Badan)</td>
						<td>: <?php echo $rdata[tb]; ?> cm</td>
					</tr>
				</table>
				<button class='btn btn-success btn-lg pull-left' type='submit' name='btn' value='simpan_tdd&tdd'>Sebelumnya</button>
			</form>
			<form method='post' action='cetak.php' target='_blank'>
				<button class='btn btn-lg btn-primary pull-right' type='submit' name='id_anak' value='<?php echo $rdata[id_anak]; ?>'>Cetak</button>
			</form>
		</div>
	</div>
	<?php
		}
		//tampilan nya kayak gini
/*	<div class='panel panel-info'>
		<div class='panel-heading'>
			<h3 class=''>
				<?php echo "$title"; ?>
			</h3>
		</div>
		<div class='panel-body'>
			<?php echo $cont; ?>
		</div>
	</div>*/
?>

<?php
		}
		else if($page=='data'){
?>		
		<div class='panel panel-info'>
			<div class='panel-heading'>Data anak</div>
			<div class='panel-body'>
				<table class='table table-hover table-striped'>
					<thead>
						<tr class='bg-info'>
							<th>Nama Anak</th>
							<th>Usia sekarang</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
				<?php
					$qAnak = mysqli_query($kon,"select * from identitas order by nama_anak ASC");
					while($rAnak = mysqli_fetch_array($qAnak,MYSQLI_ASSOC)){
						$thn = $rAnak[umur]/12;
						$thn = $thn - 0.4;
						$thn = number_format($thn, 0);
						$bln = $rAnak[umur]-($thn * 12);
						if($thn<=1){
							$umur_anak = "$bln Bulan";
						}
						else{
							$umur_anak = "$thn Tahun $bln Bulan";
						}
						
						
						echo"
						<tr>
							<td>$rAnak[nama_anak]</td>
							<td align='right'>$umur_anak</td>
							<td></td>
						</tr>
						";
					}
				?>
					</tbody>
				</table>
			</div>
		</div>
<?php
		}
		else if($page=='about'){
?>
		<div class='panel panel-info'>
		<div class='panel-heading'>
			<h3 class='text-center'>
				Tentang Program
			</h3>
		</div>
		<div class='panel-body'>
			<div class='row'>
				<div class='col-sm-6'>
					<img src='gambar/brand1.png'>
				</div>
				<div class='col-sm-6'>
					<h4 class='text-center' style='line-height: 1.6;'>
					<?php
						echo $rApp[tentang_aplikasi];
					?>
					</h4>
				</div>
			</div>
		</div>
	</div>
<?php
		}
?>
</div>