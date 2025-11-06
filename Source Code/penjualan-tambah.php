<?php
$pelanggan = $_POST['pelanggan'];
$produk = $_POST['produk'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];

$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_URL => 'https://andriyanti.site/yanti/api.php/records/penjualan',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_POSTFIELDS => array('id_pelanggan' => $pelanggan, 'id_produk' => $produk, 'tanggal' => $tanggal, 'jumlah' => $jumlah),
));
$response = curl_exec($curl);
curl_close($curl);

header('Location: penjualan.php');
die();