<?php
session_start();
$koneksi = new mysqli("localhost","root","","onlineshop");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Pelanggan</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<!-----navbar----->
<nav class="nav navbar-default">
	<div class="container">
		
	<ul class="nav navbar-nav">
		<li><a href="index.php">Home</a></li>
		<li><a href="Keranjang.php">Keranjang</a></li>
		<!---jk sudah login(ada session pelanggan)-->
		<?php if (isset($_SESSION["pelanggan"])): ?>
			<li><a href="logout.php">Logout</a></li>
			<!---selain itu (blm ada session pelanggan)--->
		<?php else: ?>
			<li><a href="Login.php">Login</a></li>
		<?php endif ?>
		<li><a href="Checkout.php">Checkout</a></li>
	</ul>
	</div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Login Pelanggan</h3>

					
				</div>
				<div class="panel-body">
					<form method="post">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password">
						</div>
						<button class="btn btn-primary" name="login">Login</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
// jk ada tombol login(tombol login ditekan)
if (isset($_POST["login"]))
{
	$email=$_POST["email"];
	$password=$_POST["password"];
	//lakukan kuery ngecek akun ditaabel pelangaan di db
	$ambil=$koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

	//ngitung akun yang terambil
	$akunyangcocok=$ambil->num_rows;

	//jika satu akun yang cocok, maka diloginkan
	if ($akunyangcocok==1)
	{
		//anda sudah login
		//mendapatkan akun dalam bentuk array
		$akun = $ambil->fetch_assoc();
		//simpan di session pelanggan
		$_SESSION["pelanggan"] = $akun;
		echo "<script>alert('anda sukses login'):</script>";
		echo "<script>location='Checkout.php';</script>";

	}
	else
	{
		//anda gagl login
		echo "<script>alert('anda gagal login, ,maka, periksa akun anda'):</script>";
		echo "<script>location='login.ph';</script>";


	}
}
 ?>
 </body>
</html>