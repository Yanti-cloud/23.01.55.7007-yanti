<?php
	include 'menu.html';
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://andriyanti.site/yanti/api.php/records/pembelian',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
	));
	$response = curl_exec($curl);
	curl_close($curl);
	$data = json_decode($response);

	$curl4 = curl_init();
	curl_setopt_array($curl4, array(
		CURLOPT_URL => 'https://andriyanti.site/yanti/api.php/records/pemasok',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
	));
	$response4 = curl_exec($curl4);
	curl_close($curl4);
	$pemasok = json_decode($response4);

	$curl5 = curl_init();
	curl_setopt_array($curl5, array(
		CURLOPT_URL => 'https://andriyanti.site/yanti/api.php/records/produk',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
	));
	$response5 = curl_exec($curl5);
	curl_close($curl5);
	$produk = json_decode($response5);
?>

<button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modalTambah">Tambah</button>
<h3>Pembelian</h3>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No.</th>
			<th>Tanggal</th>
			<th>Pemasok</th>
			<th>Produk</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Total Harga</th>
			<th>Opsi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no = 1;
			foreach ($data->records as $x) {
		?>
			<tr>
				<td class="text-center"><?= $no++ ?></td>
				<td><?= $x->tanggal ?></td>
				<td>
					<?php
						$curl2 = curl_init();
						curl_setopt_array($curl2, array(
							CURLOPT_URL => 'https://andriyanti.site/yanti/api.php/records/pemasok/'.$x->id_pemasok,
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => '',
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => 'GET',
						));
						$response2 = curl_exec($curl2);
						curl_close($curl2);
						$data2 = json_decode($response2);
						echo $data2->nama;
					?>
				</td>
				<td>
					<?php
						$curl3 = curl_init();
						curl_setopt_array($curl3, array(
							CURLOPT_URL => 'https://andriyanti.site/yanti/api.php/records/produk/'.$x->id_produk,
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => '',
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => 'GET',
						));
						$response3 = curl_exec($curl3);
						curl_close($curl3);
						$data3 = json_decode($response3);
						echo $data3->nama;
					?>
				</td>
				<td><?= $data3->harga ?></td>
				<td class="text-center"><?= $x->jumlah ?></td>
				<td class="text-right"><?= $data3->harga*$x->jumlah ?></td>
				<td>
					<button type="button" class="btn btn-sm btn-info ubah" data-toggle="modal" data-target="#modalUbah"
						data-id="<?= $x->id ?>"
						data-pemasok="<?= $x->id_pemasok ?>"
						data-produk="<?= $x->id_produk ?>"
						data-tanggal="<?= $x->tanggal ?>"
						data-jumlah="<?= $x->jumlah ?>"
					>
						Ubah
					</button>
					<a href="pembelian-hapus.php?id=<?= $x->id ?>" class="btn btn-sm btn-danger">
						Hapus
					</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<div class="modal fade" id="modalTambah">
	<div class="modal-dialog">
		<form class="modal-content" method="POST" action="pembelian-tambah.php">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Pembelian</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Tanggal</label>
					<input type="date" name="tanggal" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Pemasok</label>
					<select name="pemasok" class="form-control" required>
						<?php foreach ($pemasok->records as $x) { ?>
							<option value="<?= $x->id ?>"><?= $x->nama ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Produk</label>
					<select name="produk" class="form-control" required>
						<?php foreach ($produk->records as $x) { ?>
							<option value="<?= $x->id ?>"><?= $x->nama ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Jumlah</label>
					<input type="number" name="jumlah" class="form-control" required>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="modalUbah">
	<div class="modal-dialog">
		<form class="modal-content" method="POST" action="pembelian-ubah.php">
			<div class="modal-header">
				<h4 class="modal-title">Ubah Pembelian</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id" id="id">
				<div class="form-group">
					<label>Tanggal</label>
					<input type="date" name="tanggal" class="form-control" id="tanggal" required>
				</div>
				<div class="form-group">
					<label>Pemasok</label>
					<select name="pemasok" class="form-control" id="pemasok" required>
						<?php foreach ($pemasok->records as $x) { ?>
							<option value="<?= $x->id ?>"><?= $x->nama ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Produk</label>
					<select name="produk" class="form-control" id="produk" required>
						<?php foreach ($produk->records as $x) { ?>
							<option value="<?= $x->id ?>"><?= $x->nama ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Jumlah</label>
					<input type="number" name="jumlah" class="form-control" id="jumlah" required>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
		</form>
	</div>
</div>

<script>
	$(document).on('click', '.ubah', function () {
		$('#id').val($(this).data('id'))
		$('#tanggal').val($(this).data('tanggal'))
		$('#pemasok').val($(this).data('pemasok'))
		$('#produk').val($(this).data('produk'))
		$('#jumlah').val($(this).data('jumlah'))
	})
</script>

</div>
</body>
</html>