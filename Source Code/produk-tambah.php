<?php
$nama = $_POST['nama'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$terjual = $_POST['terjual'];

$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_URL => 'https://andriyanti.site/yanti/api.php/records/produk',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_POSTFIELDS => array('nama' => $nama, 'harga' => $harga, 'stok' => $stok, 'terjual' => $terjual),
));
$response = curl_exec($curl);
curl_close($curl);

header('Location: index.php');
die();