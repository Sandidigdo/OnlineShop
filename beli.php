<?php
session_start();
// mendapatkan id produk dari url
$id_produk = $_GET['id'];


// jika sudah sudah  ada produk itu dikeranjang. maka produk itu jumlahnya di +1
if (isset($_SESSION['keranjang'][$id_produk]))
{
	$_SESSION['keranjang'][$id_produk]+=1;
}
// selain itu (blum ada dikeranjang , maka produk itu dianggap dibeli 1)
else
{
	$_SESSION['keranjang'][$id_produk] = 1;

}


// echo "<pre>"
// print r[$ SESSION];
// echo "</pre>";

// larikan ke hslsmsn keranjang
echo "<script>alert('produk telah masuk ke dalam keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
?>