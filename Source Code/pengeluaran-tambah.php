<?php
$tanggal = $_POST['tanggal'];
$ket = $_POST['ket'];
$jumlah = $_POST['jumlah'];

$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_URL => 'https://andriyanti.site/yanti/api.php/records/pengeluaran',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_POSTFIELDS => array('tanggal' => $tanggal, 'ket' => $ket, 'jumlah' => $jumlah),
));
$response = curl_exec($curl);
curl_close($curl);

header('Location: pengeluaran.php');
die();