<?php
$id = $_POST['id'];
$pelanggan = $_POST['pemasok'];
$produk = $_POST['produk'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];

$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_URL => 'https://andriyanti.site/yanti/api.php/records/pembelian/'.$id,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'PUT',
	CURLOPT_POSTFIELDS => 'id_pemasok='.$pelanggan.'&id_produk='.$produk.'&tanggal='.$tanggal.'&jumlah='.$jumlah,
	CURLOPT_HTTPHEADER => array(
		'Content-Type: application/x-www-form-urlencoded'
	),
));
$response = curl_exec($curl);
curl_close($curl);

header('Location: pembelian.php');
die();