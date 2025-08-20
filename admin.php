<?php
if($ketlog=='admin'){
	$opsi = $_POST['opsi'];
	
	$tombol = $_POST['tombol'];
	$b = $_POST['baru'];
	$id_ukur = $_POST['id_ukur'];

	//olah data pada tabel pengukuran
	if($tombol=='simpan_ukur'){
		$jenkel = $_POST['jenkel'];
		$tb = $_POST['tb'];
		$bks = $_POST['bks'];
		$bk = $_POST['bk'];
		$bn = $_POST['bn'];
		$bg = $_POST['bg'];
		if($b=='ya'){
			mysqli_query($kon,"insert into pengukuran(jenkel,tinggi_badan,kurus_sekali,kurus,normal,gemuk) values('$jenkel','$tb','$bks','$bk','$bn','$bg')");
		}else{
			mysqli_query($kon,"update pengukuran set jenkel='$jenkel',tinggi_badan='$tb',kurus_sekali='$bks',kurus='$bk',normal='$bn',gemuk='$bg' where id_ukur = '$id_ukur'");
		}
	}
	else if($tombol=='hapus_ukur'){
		mysqli_query($kon,"delete from pengukuran where id_ukur = '$id_ukur'");
	}
	
	//olah data pada tabel kpsp
	
	$id_kpsp = $_POST['id_kpsp'];
	if($tombol=='simpan_kpsp'){
		$isi_kpsp = $_POST['isi_kpsp'];
		$kemampuan = $_POST['kemampuan'];
		$jika_tidak = $_POST['jika_tidak'];
		$umur = $_POST['umur'];
		if($b=='ya'){
			mysqli_query($kon,"insert into kpsp(isi_kpsp,kemampuan,jika_tidak,umur) values('$isi_kpsp','$kemampuan','$jika_tidak','$umur')");
		}else{
			mysqli_query($kon,"update kpsp set isi_kpsp='$isi_kpsp',kemampuan='$kemampuan',jika_tidak='$jika_tidak',umur='$umur' where id_kpsp = '$id_kpsp'");
		}
	}
	else if($tombol=='hapus_kpsp'){
		mysqli_query($kon,"delete from kpsp where id_tdd = '$id_tdd'");
	}
	//olah data pada tabel tdd
	$id_tdd = $_POST['id_tdd'];
	if($tombol=='simpan_tdd'){
		$isi_tdd = $_POST['isi_tdd'];
		$jika_tidak = $_POST['jika_tidak'];
		$umur = $_POST['umur'];
		if($b=='ya'){
			mysqli_query($kon,"insert into tdd(isi_tdd,jika_tidak,umur) values('$isi_tdd','$jika_tidak','$umur')");
		}
		else{
			mysqli_query($kon,"update tdd set isi_tdd='$isi_tdd',jika_tidak='$jika_tidak',umur='$umur' where id_tdd = '$id_tdd'");
		}
	}
	else if($tombol=='hapus_kpsp'){
		mysqli_query($kon,"delete from tdd where id_tdd = '$id_tdd'");
	}
	
?>
		<div class='container' style='margin-top:80px;'>
			<div class='panel panel-info'>
				<div class='panel-heading'>
					<?php echo $lokasi; ?>
				</div>
				<div class='panel-body'>
				<?php 
				echo $isi;
				if($page=='ukur'){
				?>
					<form method='post' action='#'>
					Tabel Berat badan dan Tinggi badan
					<table class='table table-striped table-hover'>
						<thead>
							<tr class='bg-info'>
								<th>No.</th>
								<th>Tinggi Badan</th>
								<th>Jenis Kelamin</th>
								<th>Berat Kurus Sekali</th>
								<th>Berat Kurus</th>
								<th>Berat Normal</th>
								<th>Berat Gemuk</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$no = 1;
						$Qdata = mysqli_query($kon,"select * from pengukuran order by jenkel ASC");
						while($Rdata = mysqli_fetch_array($Qdata,MYSQLI_ASSOC)){
							echo"
							<tr class='bg-info'>
								<td>$no</td>
								<td>$Rdata[tinggi_badan]</td>
								<td>$Rdata[jenkel]</td>
								<td>$Rdata[kurus_sekali]</td>
								<td>$Rdata[kurus]</td>
								<td>$Rdata[normal]</td>
								<td>$Rdata[gemuk]</td>
								<td>
									<button class='btn btn-warning' name='opsi' value='ukur_edit-$Rdata[id_ukur]'><i class='glyphicon glyphicon-pencil'></i></button>
									<button class='btn btn-danger' name='opsi' value='ukur_hapus-$Rdata[id_ukur]'><i class='glyphicon glyphicon-remove'></i></button>
								</td>
							</tr>
							";
							$no++;
						}
						?>
							<tr>
								<td colspan='7' align='right'>
									<button class='btn btn-primary' name='opsi' value='ukur_tambah-1'><i class='glyphicon glyphicon-plus'></i> Tambah</button>
								</td>
							</tr>
						</tbody>
					</table>
					</form>
				<?php 
				} 
				else if($page=='kpsp'){
				?>
					<form method='post' action='#'>
					Tabel Kuesioner Pra Skrinning Perkembangan
					<table class='table table-striped table-hover'>
						<thead>
							<tr class='bg-info'>
								<th>No.</th>
								<th>Isi Perkembangan</th>
								<th>Kemampuan</th>
								<th>Jika Tidak</th>
								<th>Umur</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$no = 1;
						$Qdata = mysqli_query($kon,"select * from kpsp order by umur, id_kpsp ASC");
						while($Rdata = mysqli_fetch_array($Qdata,MYSQLI_ASSOC)){
							echo"
							<tr class='bg-info'>
								<td>$no</td>
								<td>$Rdata[isi_kpsp]</td>
								<td>$Rdata[kemampuan]</td>
								<td>$Rdata[jika_tidak]</td>
								<td>$Rdata[umur]</td>
								<td>
									<button class='btn btn-warning' name='opsi' value='kpsp_edit-$Rdata[id_kpsp]'><i class='glyphicon glyphicon-pencil'></i></button>
									<button class='btn btn-danger' name='opsi' value='kpsp_hapus-$Rdata[id_kpsp]'><i class='glyphicon glyphicon-remove'></i></button>
								</td>
							</tr>
							";
							$no++;
						}
						?>
							<tr>
								<td colspan='7' align='right'>
									<button class='btn btn-primary' name='opsi' value='kpsp_tambah-1'><i class='glyphicon glyphicon-plus'></i> Tambah</button>
								</td>
							</tr>
						</tbody>
					</table>
					</form>
				<?php 
				} 
				else if($page=='tdd'){
				?>
					<form method='post' action='#'>
					Tabel Tes Daya Dengar
					<table class='table table-striped table-hover'>
						<thead>
							<tr class='bg-info'>
								<th>No.</th>
								<th>Isi Tes Daya Dengar</th>
								<th>Jika Tidak</th>
								<th>Umur</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$no = 1;
						$Qdata = mysqli_query($kon,"select * from tdd order by umur, id_tdd ASC");
						while($Rdata = mysqli_fetch_array($Qdata,MYSQLI_ASSOC)){
							echo"
							<tr class='bg-info'>
								<td>$no</td>
								<td>$Rdata[isi_tdd]</td>
								<td>$Rdata[jika_tidak]</td>
								<td>$Rdata[umur]</td>
								<td>
									<button class='btn btn-warning' name='opsi' value='tdd_edit-$Rdata[id_tdd]'><i class='glyphicon glyphicon-pencil'></i></button>
									<button class='btn btn-danger' name='opsi' value='tdd_hapus-$Rdata[id_tdd]'><i class='glyphicon glyphicon-remove'></i></button>
								</td>
							</tr>
							";
							$no++;
						}
						?>
							<tr>
								<td colspan='7' align='right'>
									<button class='btn btn-primary' name='opsi' value='tdd_tambah-1'><i class='glyphicon glyphicon-plus'></i> Tambah</button>
								</td>
							</tr>
						</tbody>
					</table>
					</form>
				<?php 
				}
				else if($page=='app'){
					$simpan = $_POST['simpan_app'];
					$nama_tempat = $_POST['nama_tempat'];
					$alamat = $_POST['alamat'];
					$ket = $_POST['ket'];
					$tentang_aplikasi = $_POST['tentang_aplikasi'];
					
					if($simpan=='simpan'){
						mysqli_query($kon,"update app set nama_tempat = '$nama_tempat', alamat = '$alamat', ket = '$ket', tentang_aplikasi = '$tentang_aplikasi' where id_app = '1'");
					}
					
					$qApp = mysqli_query($kon,"select * from app where id_app = '1'");
					$rApp = mysqli_fetch_array($qApp);
			?>
					<form action='' method='post'>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Nama Tempat</label>
							<div class="col-sm-5">
								<input type='text' class='form-control' name='nama_tempat' value='<?php echo $rApp[nama_tempat]; ?>'>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Alamat</label>
							<div class="col-sm-5">
								<textarea name='alamat' class='form-control'><?php echo $rApp[alamat]; ?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Keterangan</label>
							<div class="col-sm-5">
								<textarea name='ket' class='form-control'><?php echo $rApp[ket]; ?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Tentang Apliaksi</label>
							<div class="col-sm-5">
								<textarea name='tentang_aplikasi' class='form-control'><?php echo $rApp[tentang_aplikasi]; ?></textarea>
							</div>
						</div>
						<button class='btn btn-info btn-lg pull-right' name='simpan_app' value='simpan'>Simpan Data</button>
					</form>
			<?php		
				}
				
				?>
				</div>
			</div>
		</div>
<?php
	$opsi = explode('-',$opsi);
	//pemanggilan modal pengukuran
	if($opsi[0]=='ukur_tambah'){
		echo"
			<script>
				$(window).on('load',function(){
					$('#data_ukur').modal('show');
				});
			</script>";
		$baru = "ya";
	}
	else if($opsi[0]=='ukur_edit'){
		echo"
			<script>
				$(window).on('load',function(){
					$('#data_ukur').modal('show');
				});
			</script>";
		$id_ukur = $opsi[1];
		$q = mysqli_query($kon,"select * from pengukuran where id_ukur = '$id_ukur'");
		$r = mysqli_fetch_array($q,MYSQLI_ASSOC);
		$baru = "tidak";
	}
	else if($opsi[0]=='ukur_hapus'){
		echo"
			<script>
				$(window).on('load',function(){
					$('#notif_hapus_ukur').modal('show');
				});
			</script>";
		$id_ukur = $opsi[1];
		$q = mysqli_query($kon,"select * from pengukuran where id_ukur = '$id_ukur'");
		$r = mysqli_fetch_array($q,MYSQLI_ASSOC);
	}
	
	//pemanggilan modal kpsp
	else if($opsi[0]=='kpsp_tambah'){
		echo"
			<script>
				$(window).on('load',function(){
					$('#data_kpsp').modal('show');
				});
			</script>";
		$baru = "ya";
	}
	else if($opsi[0]=='kpsp_edit'){
		echo"
			<script>
				$(window).on('load',function(){
					$('#data_kpsp').modal('show');
				});
			</script>";
		$id_kpsp = $opsi[1];
		$q = mysqli_query($kon,"select * from kpsp where id_kpsp = '$id_kpsp'");
		$r = mysqli_fetch_array($q,MYSQLI_ASSOC);
		$baru = "tidak";
	}
	else if($opsi[0]=='kpsp_hapus'){
		echo"
			<script>
				$(window).on('load',function(){
					$('#notif_hapus_kpsp').modal('show');
				});
			</script>";
		$id_kpsp = $opsi[1];
		$q = mysqli_query($kon,"select * from kpsp where id_kpsp = '$id_kpsp'");
		$r = mysqli_fetch_array($q,MYSQLI_ASSOC);
	}	
	//pemanggilan modal tdd
	else if($opsi[0]=='tdd_tambah'){
		echo"
			<script>
				$(window).on('load',function(){
					$('#data_tdd').modal('show');
				});
			</script>";
		$baru = "ya";
	}
	else if($opsi[0]=='tdd_edit'){
		echo"
			<script>
				$(window).on('load',function(){
					$('#data_tdd').modal('show');
				});
			</script>";
		$id_tdd = $opsi[1];
		$q = mysqli_query($kon,"select * from tdd where id_tdd = '$id_tdd'");
		$r = mysqli_fetch_array($q,MYSQLI_ASSOC);
		$baru = "tidak";
	}
	else if($opsi[0]=='tdd_hapus'){
		echo"
			<script>
				$(window).on('load',function(){
					$('#notif_hapus_tdd').modal('show');
				});
			</script>";
		$id_tdd = $opsi[1];
		$q = mysqli_query($kon,"select * from tdd where id_tdd = '$id_tdd'");
		$r = mysqli_fetch_array($q,MYSQLI_ASSOC);
	}
?>
		<!-- Modal olah data pengukuran-->
		<div id="data_ukur" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header bg-info">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Data pengukuran</h4>
					</div>
					<div class="modal-body">
						<form method='post' action='#'>
							<input type='hidden' name='baru' value='<?php echo $baru; ?>'>
							<input type='hidden' name='id_ukur' value='<?php echo $id_ukur; ?>'>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Jenis Kelamin</label>
								<div class="col-sm-5">
									<select name='jenkel' class='form-control'>
									<?php
									$jen = array("Laki-laki","Perempuan");
									$j = count($jen);
									for($i=0;$i<$j;$i++){
										if($jen[$i]==$r[jenkel]){
											echo"
											<option value='$jen[$i]' selected>$jen[$i]</option>
											";
										}
										else{
											echo"
											<option value='$jen[$i]'>$jen[$i]</option>
											";
										}
									}
									?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Tinggi badan</label>
								<div class="col-sm-2">
									<input type='text' class='form-control' name='tb' placeholder='cm' value='<?php echo $r[tinggi_badan]; ?>'>
								</div>
								<label class="col-sm-1" style=''>cm</label>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Berat Kurus Sekali</label>
								<div class="col-sm-2">
									<input type='text' class='form-control' name='bks' placeholder='kg' value='<?php echo $r[kurus_sekali]; ?>'>
								</div>
								<label class="col-sm-1" style=''>kg</label>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Berat Kurus</label>
								<div class="col-sm-2">
									<input type='text' class='form-control' name='bk' placeholder='kg' value='<?php echo $r[kurus]; ?>'>
								</div>
								<label class="col-sm-1" style=''>kg</label>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Berat Normal</label>
								<div class="col-sm-2">
									<input type='text' class='form-control' name='bn' placeholder='kg' value='<?php echo $r[normal]; ?>'>
								</div>
								<label class="col-sm-1" style=''>kg</label>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Berat Gemuk</label>
								<div class="col-sm-2">
									<input type='text' class='form-control' name='bg' placeholder='kg' value='<?php echo $r[gemuk]; ?>'>
								</div>
								<label class="col-sm-1" style=''>kg</label>
							</div>
						*Nb : <br>
						Gunakan karakter (.) titik jika berat atau tinggi tudak bilangan bulat.<br>
						Masukkan nilai maksimum pada ukuran berat badan anak.
					</div>
					<div class="modal-footer bg-info">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-success" name='tombol' value='simpan_ukur'>Simpan</button>
						</form>
					</div>
				</div>

			</div>
		</div>
		
		<!-- Modal  notifikasi hapus pengukuran-->
		<div id="notif_hapus_ukur" class="modal fade" role="dialog">
			<div class="modal-dialog modal-sm">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header bg-danger">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Hapus data pengukuran</h4>
					</div>
					<div class="modal-body">
						<form method='post' action='#'>
							<input type='hidden' name='id_ukur' value='<?php echo $r[id_ukur]; ?>'>
							<p>Apa Anda yakin ingin menghapus data berikut?<br>
							<?php	
								echo "Data dengan jenis kelamin <b>$r[jenkel]</b> tinggi badan <b>$r[tinggi_badan]</b> berat kurus sekali <b>$r[kurus_sekali]</b> berat kurus <b>$r[kurus]</b> berat normal <b>$r[normal]</b> berat gemuk <b>$r[gemuk]</b>";
							?>
							</p>
					</div>
					<div class="modal-footer bg-danger">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
							<button type="submit" class="btn btn-success" name='tombol' value='hapus_ukur'>Ya</button>
						</form>
					</div>
				</div>

			</div>
		</div>
		<!-- Modal olah data kpsp-->
		<div id="data_kpsp" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header bg-info">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Data perkembangan</h4>
					</div>
					<div class="modal-body">
						<form method='post' action='#'>
							<input type='hidden' name='baru' value='<?php echo $baru; ?>'>
							<input type='hidden' name='id_kpsp' value='<?php echo $r[id_kpsp]; ?>'>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Pertanyaan</label>
								<div class="col-sm-8">
									<textarea class='form-control' name='isi_kpsp' placeholder='Pertanyaan sessuai dengan jenis perkembangan'><?php echo $r[isi_kpsp]; ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Kemampuan</label>
								<div class="col-sm-5">
									<select name='kemampuan' class='form-control'>
									<?php
									$jen = array("Bicara & bahasa","Gerak halus","Gerak kasar","Sosialisasi & kemandirian");
									$j = count($jen);
									for($i=0;$i<$j;$i++){
										if($jen[$i]==$r[kemampuan]){
											echo"
											<option value='$jen[$i]' selected><i class='$jeni[$i]'></i> $jen[$i]</option>
											";
										}
										else{
											echo"
											<option value='$jen[$i]'>$jen[$i]</option>
											";
										}
									}
									?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Jika Tidak</label>
								<div class="col-sm-8">
									<textarea class='form-control' name='jika_tidak' placeholder='Pernyataan jika jawaban tidak'><?php echo $r[jika_tidak]; ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Umur</label>
								<div class="col-sm-2">
									<input type='text' class='form-control' name='umur' placeholder='Bulan' value='<?php echo $r[umur]; ?>'>
								</div>
								<label class="col-sm-1" style=''>Bulan</label>
							</div>						
					</div>
					<div class="modal-footer bg-info">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-success" name='tombol' value='simpan_kpsp'>Simpan</button>
						</form>
					</div>
				</div>

			</div>
		</div>
		<!-- Modal notifikasi hapus kpsp-->
		<div id="notif_hapus_kpsp" class="modal fade" role="dialog">
			<div class="modal-dialog modal-sm">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header bg-danger">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Hapus data pengukuran</h4>
					</div>
					<div class="modal-body">
						<form method='post' action='#'>
							<input type='hidden' name='id_ukur' value='<?php echo $r[id_ukur]; ?>'>
							<p>Apa Anda yakin ingin menghapus data berikut?<br>
							<?php	
								echo "Data dengan isi <b>$r[isi_kpsp]</b> kemampuan <b>$r[kemampuan]</b> pada usia <b>$r[umur]</b> bulan";
							?>
							</p>
					</div>
					<div class="modal-footer bg-danger">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
							<button type="submit" class="btn btn-success" name='tombol' value='hapus_kpsp'>Ya</button>
						</form>
					</div>
				</div>

			</div>
		</div>
		
		<!-- Modal olah data tdd-->
		<div id="data_tdd" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header bg-info">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Data Tes Daya Dengar</h4>
					</div>
					<div class="modal-body">
						<form method='post' action='#'>
							<input type='hidden' name='baru' value='<?php echo $baru; ?>'>
							<input type='hidden' name='id_tdd' value='<?php echo $r[id_tdd]; ?>'>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Pertanyaan</label>
								<div class="col-sm-8">
									<textarea class='form-control' name='isi_tdd' placeholder='Pertanyaan sessuai dengan jenis perkembangan'><?php echo $r[isi_tdd]; ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Jika Tidak</label>
								<div class="col-sm-8">
									<textarea class='form-control' name='jika_tidak' placeholder='Pernyataan jika jawaban tidak'><?php echo $r[jika_tidak]; ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Umur</label>
								<div class="col-sm-2">
									<input type='text' class='form-control' name='umur' placeholder='Bulan' value='<?php echo $r[umur]; ?>'>
								</div>
								<label class="col-sm-1" style=''>Bulan</label>
							</div>						
					</div>
					<div class="modal-footer bg-info">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-success" name='tombol' value='simpan_tdd'>Simpan</button>
						</form>
					</div>
				</div>

			</div>
		</div>
		<!-- Modal notifikasi hapus kpsp-->
		<div id="notif_hapus_tdd" class="modal fade" role="dialog">
			<div class="modal-dialog modal-sm">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header bg-danger">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Hapus data pengukuran</h4>
					</div>
					<div class="modal-body">
						<form method='post' action='#'>
							<input type='hidden' name='id_ukur' value='<?php echo $r[id_ukur]; ?>'>
							<p>Apa Anda yakin ingin menghapus data berikut?<br>
							<?php	
								echo "Data dengan isi <b>$r[isi_tdd]</b> pada usia <b>$r[umur]</b> bulan";
							?>
							</p>
					</div>
					<div class="modal-footer bg-danger">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
							<button type="submit" class="btn btn-success" name='tombol' value='hapus_tdd'>Ya</button>
						</form>
					</div>
				</div>

			</div>
		</div>
	</body>
</html>
<?php
}
?>