<?php $koneksi = mysqli_connect("localhost","root","","onlineshop"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

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

<section class="konten">
	<div class="container">


<!--- nota disinh copas ajjh di nota--->

<h2>Detail Pembelian</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
    ON pembelian.id_pelanggan=pelanggan.id_pelanggan
    WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>


<strong><?php echo $detail['nama_pelanggan']; ?></strong></br>
<p>
        <?php echo $detail['telepon_pelanggan']; ?><br>
        <?php echo $detail['email_pelanggan']; ?>
</p>

<p>
        tanggal:<?php echo $detail['tanggal_pembelian']; ?><br>
        Total:<?php echo $detail['total_pembelian']; ?>
    </p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>no</th>
            <th>nama produk</th>
            <th>harga</th>
            <th>jumlah</th>
            <th>subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk 
        WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
        <?php while($pecah=$ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_produk']; ?></td>
            <td><?php echo $pecah['harga_produk']; ?></td>
            <td><?php echo $pecah['jumlah']; ?></td>
            <td>
                <?php echo $pecah['harga_produk']*$pecah['jumlah']; ?>
            </td>
        </tr>
        <?php $nomor++; ?>
    <?php } ?>
    </tbody>
</table>



		
	</div>
</section>
</body>
</html>