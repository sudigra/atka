<?php
	$kon = mysqli_connect("localhost","root","","tumbuh") or die ("koneksi ke server database gagal");
	
	$umur = 3;
	$que = mysqli_query($kon,"select * from kpsp where umur='$umur' order by id_kpsp ASC");
	
	while($res=mysqli_fetch_array($que,MYSQLI_ASSOC)){
		$list_kpsp[] = $res[id_kpsp];
	}
	
	$a = $_POST['l'] + $_POST['btn'];
	$b = count($list_kpsp)-1;
	$id_kpsp = $list_kpsp[$a];
	
	$ques = mysqli_query($kon,"select * from kpsp where id_kpsp = '$id_kpsp'");
	$resq = mysqli_fetch_array($ques,MYSQLI_ASSOC);
?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<div class='container' style='margin-top:80px;'>
	<div class='panel panel-info'>
		<div class='panel-heading'>Kuesioner KPSP</div>
		<div class='panel-body'>
			<h3><?php echo"$resq[isi_kpsp]"; ?></h3>
			<form method='post' action=''>
				<input type='hidden' name='id_kpsp' value='<?php echo $resq[id_kpsp]; ?>'>
				<input type='hidden' name='l' value='<?php echo $a; ?>'>
				<div class='row'>
					<div class='form-group col-sm-3'>
						<h3>
							<label class='form-check-label'>
								<input class='form-check-input' type='radio' value='T' name='ans'>
								Tidak
							</label>
						</h3>
					</div>
					<div class='form-group col-sm-3'>
						<h3>
							<label class='form-check-label'>
								<input class='form-check-input' type='radio' value='Y' name='ans'>
								Ya
							</label>
						</h3>
					</div>
				</div>
				<hr>
				<?php
					if($a<1){
						echo"
						<button class='btn btn-success btn-lg pull-right' type='submit' name='btn' value='1'>Selanjutnya</button>";
					}
					else if($a==$b){
						echo"
						<button class='btn btn-success btn-lg pull-left' type='submit' name='btn' value='-1'>Sebelumnya</button>";
					}
					else{
						echo"
						<button class='btn btn-success btn-lg pull-left' type='submit' name='btn' value='-1'>Sebelumnya</button>
						<button class='btn btn-success btn-lg pull-right' type='submit' name='btn' value='1'>Selanjutnya</button>";
					}
				?>
				
			</form>
		</div>
	</div>
</div>