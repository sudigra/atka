<?php
	session_start();
?>
<?php
	$kon = mysqli_connect("localhost","root","","tumbuh") or die ("Koneksi ke database gagal");
	
	$page = $_GET[page];
	
	$qApp = mysqli_query($kon,"select * from app where id_app = '1'");
	$rApp = mysqli_fetch_array($qApp);
		
	if($page=='home'){
		$lokasi = 'Hamalan Utama';
		$isi = "
			<div class='row'>
				<div class='col-sm-6'>
					<img src='gambar/brand1.png'>
				</div>
				<div class='col-sm-6'>
					<h4 class='text-center' style='line-height: 1.6;'>
						$rApp[tentang_aplikasi]
					</h4>
				</div>
			</div>";
		$n_home="style='background:#c5e8f9;font-weight: bold;'";
	}
	else if($page=='ukur'){
		$lokasi = 'Tabel Pengukuran';
		$n_ukur="style='background:#c5e8f9;font-weight: bold;'";
	}
	else if($page=='kpsp'){
		$lokasi = 'Tabel Perkembangan KPSP(Keusioner Pra Skrining Perkembangan)';
		$n_kembang="style='background:#c5e8f9;font-weight: bold;'";
	}
	else if($page=='tdl'){
		$lokasi = 'Tabel Perkembangan TDL (Tes Daya Lihat)';
		$n_kembang="style='background:#c5e8f9;font-weight: bold;'";
	}
	else if($page=='tdd'){
		$lokasi = 'Tabel Perkembangan TDD (Tes Daya Dengar)';
		$n_kembang="style='background:#c5e8f9;font-weight: bold;'";
	}
	else if($page=='mental'){
		$lokasi = 'Tabel Mental Emosional';
		$n_mental="style='background:#c5e8f9;font-weight: bold;'";
	}
	else if($page=='app'){
		$lokasi = 'Edit data program';
		$n_app="style='background:#c5e8f9;font-weight: bold;'";
	}
	else if($page=='data'){
		$lokasi = 'Data Anak';
		$isi = "
			<div class='row'>
				<div class='col-sm-6'>
					<img src='gambar/brand1.png'>
				</div>
				<div class='col-sm-6'>
					<h4 class='text-center' style='line-height: 1.6;'>
						$rApp[tentang_aplikasi]
					</h4>
				</div>
			</div>";
		$n_edit="style='background:#c5e8f9;font-weight: bold;'";
	}
	else if($page=='about'){
		$qApp = mysqli_query($kon,"select * from app where id_app = '1'");
		$rApp = mysqli_fetch_array($qApp);
		$lokasi = 'Tentang Program';
		$isi = "
			<div class='row'>
				<div class='col-sm-6'>
					<img src='gambar/brand1.png'>
				</div>
				<div class='col-sm-6'>
					<h4 class='text-center' style='line-height: 1.6;'>
						$rApp[tentang_aplikasi]
					</h4>
				</div>
			</div>";
		$n_about="style='background:#c5e8f9;font-weight: bold;'";
	}
	
	//masukan form
	$userform = $_POST['userform'];
	$passform = $_POST['passform'];
	$btnform = $_POST['btn'];
	
	//sesi login
	$userlog = $_SESSION["userlog"];
	$namalog = $_SESSION["namalog"];
	$ketlog = $_SESSION["ketlog"];
	
	if($btnform=='login'){
		$que = mysqli_query($kon,"select * from pengguna where username = '$userform'");
		$row = mysqli_num_rows($que);
		if($row=='0'){
			$notif = "E1";			
		}
		else{
			$res = mysqli_fetch_array($que,MYSQLI_ASSOC);
			if($res[password]==$passform){
				$_SESSION["userlog"] = $res[username];
				$_SESSION["namalog"] = $res[nama_lengkap];
				$_SESSION["ketlog"] = $res[ket];
				header("location:index.php?page=home");
			}
			else{
				$notif = "E2";	
			}
		}
	}
	if($_GET[user]=='logout'){
		$_SESSION["userlog"] = '';
		$_SESSION["namalog"] = '';
		$_SESSION["ketlog"] = '';
		header("location:index.php?page=home");
	}
?>

<html>
	<head>
		<link rel="icon" href="gambar/logo.png" type="image/gif">
		<title>ATKA (Aplikasi Tumbuh Kembang Anak)</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style>
				.dropdown:hover .dropdown-menu {
					display: block;
				}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top" style='background:#d9edf7;'>
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					</button>
					<a class="navbar-brand" href="#">
						<img src='gambar/brand1.png' height='30'>
					</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li><a href="?page=home" <?php echo $n_home; ?>>Home</a></li>
				<?php if($ketlog=='admin'){ ?>
						<li><a href="?page=ukur" <?php echo $n_ukur; ?>>Pengukuran</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#" <?php echo $n_kembang; ?>>Perkembangan
							<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="?page=kpsp">KPSP</a></li>
								<li><a href="?page=tdd">TDD</a></li>
								<li><a href="?page=tdl">TDL</a></li>
							</ul>
						</li>
						<li><a href="?page=mental" <?php echo $n_mental; ?>>Mental emosional</a></li>
						<li><a href="?page=app" <?php echo $n_app; ?>>Aplikasi</a></li>
						
				<?php } ?>
						<li><a href="?page=data" <?php echo $n_edit; ?>>Data</a></li>
						<li><a href="?page=about" <?php echo $n_about; ?>>Tentang</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
					<?php 
						if($ketlog==''){
							echo "<li><a href='#' data-toggle='modal' data-target='#login'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
						}
						else{
							echo "<li><a href='?user=logout'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
						}
						?>
					</ul>
				</div>
			</div>
		</nav>
<?php
	if($ketlog!='admin'){
		include'guest.php';
	}
	include 'admin.php';
	if($notif=='E1'){
		$notif = "
					<div class='alert alert-danger'>
						<strong>Danger!</strong> Username tidak terdaftar di sistem kami, masukkan kembali.
					</div>";
		echo"	
			<script>
				$(window).on('load',function(){
					$('#login').modal('show');
				});
			</script>";
	}
	else if($notif=='E2'){
		$notif = "
					<div class='alert alert-warning'>
						<strong>Warning!</strong> Password yang anda masukkan salah, masukkan kembali.
					</div>";
		echo"	
			<script>
				$(window).on('load',function(){
					$('#login').modal('show');
				});
			</script>";
	}
?>			
		<!-- Modal Login User-->
		<div id="login" class="modal fade" role="dialog" style='margin-top:80px !important;'>
			<div class="modal-dialog modal-sm">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss='modal'>&times;</button>
						<div class="col-lg-12 col-sm-12 col-12 user-img">
							<p class='text-center'>
								<img src='gambar/doctor.png' style='width:50%;margin-top:-50px;'>
						</div>
						
						<div class="col-lg-12 col-sm-12 col-12 user-name">
							<h3 class='text-center'>Login Pengguna</h3>
						</div>
						<form method='post' action='#'>
							<div class="form-group">
								<input type="text" name='userform' class="form-control" placeholder="Masukkan email/username" required=''>
							</div>
							<div class="form-group">
								<input type="password" name='passform' class="form-control" placeholder="Masukkan password" required=''>
							</div>
							<div class="form-group">
								<button style='width:100%;' type="submit" class="btn btn-success" name='btn' value='login'>Login</button>
							</div>
							<?php echo $notif; ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
