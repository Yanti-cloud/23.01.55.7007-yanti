<?php
	include 'menu.html';
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://andriyanti.site/yanti/api.php/records/produk',
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
?>

<button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modalTambah">Tambah</button>
<h3>Produk</h3>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No.</th>
			<th>Nama</th>
			<th>Harga (Rp)</th>
			<th>Stok</th>
			<th>Terjual</th>
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
				<td><?= $x->nama ?></td>
				<td class="text-right"><?= $x->harga ?></td>
				<td class="text-center"><?= $x->stok ?></td>
				<td class="text-center"><?= $x->terjual ?></td>
				<td>
					<button type="button" class="btn btn-sm btn-info ubah" data-toggle="modal" data-target="#modalUbah"
						data-id="<?= $x->id ?>"
						data-nama="<?= $x->nama ?>"
						data-harga="<?= $x->harga ?>"
						data-stok="<?= $x->stok ?>"
						data-terjual="<?= $x->terjual ?>"
					>
						Ubah
					</button>
					<a href="produk-hapus.php?id=<?= $x->id ?>" class="btn btn-sm btn-danger">
						Hapus
					</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<div class="modal fade" id="modalTambah">
	<div class="modal-dialog">
		<form class="modal-content" method="POST" action="produk-tambah.php">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Produk</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Harga</label>
					<input type="number" name="harga" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Stok</label>
					<input type="number" name="stok" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Terjual</label>
					<input type="number" name="terjual" class="form-control" required>
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
		<form class="modal-content" method="POST" action="produk-ubah.php">
			<div class="modal-header">
				<h4 class="modal-title">Ubah Produk</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id" id="id">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control" id="nama" required>
				</div>
				<div class="form-group">
					<label>Harga</label>
					<input type="number" name="harga" class="form-control" id="harga" required>
				</div>
				<div class="form-group">
					<label>Stok</label>
					<input type="number" name="stok" class="form-control" id="stok" required>
				</div>
				<div class="form-group">
					<label>Terjual</label>
					<input type="number" name="terjual" class="form-control" id="terjual" required>
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
		$('#nama').val($(this).data('nama'))
		$('#harga').val($(this).data('harga'))
		$('#stok').val($(this).data('stok'))
		$('#terjual').val($(this).data('terjual'))
	})
</script>

</div>
</body>
</html>