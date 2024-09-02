<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
	</div>

	<div class="row">
		<div class="col-lg-6">

			<?= $this->session->flashdata('message'); ?>

		</div>
	</div>

	<a href="<?= base_url('Transaksi/datajual'); ?>" type="button" class="btn btn-info mb-3 mt-3"><i class="fas fa-eye"></i> Lihat Data</a>
	<br />
	<br />

	<div class="col-sm-12">
		<div class="card">
			<div class="card-header bg-info text-white">Tambah Data Penjualan</div>
			<div class="card-body">
				<form class="form-horizontal" action="<?php echo base_url('Transaksi/datajual') ?>" method="post" enctype="multipart/form-data" role="form">
					<div class="modal-body">
						<div class="form-group">
							<div class="col-lg">
								<label for="">ID User : </label>
								<input type="text" class="form-control" id="id_user" name="id_user" value="<?= $login['id'] ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg">
								<label for="">Nama User : </label>
								<input type="text" class="form-control" id="name" name="name" value="<?= $login['name'] ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg">
								<label for="">Nama Pembeli : </label>
								<input type="text" class="form-control" id="nama" name="nama">
								<?= form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg">
								<Label>Kategori Barang : </Label>
								<select name="id_kategori" id="id_kategori" class="form-control" onchange="pilih_kategori()">
									<option value="">-- Pilih Kategori --</option>
									<?php foreach ($kategori as $k) : ?>
										<?php if ($k['id_kategori'] == '12') :?>
											<option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group" id="show">
							<div class="row col-lg">
							<input type="hidden" class="form-control" id="kode" name="id_kategori[]" readonly>
								<div class="col-md-4">
									<label for="" class="col-form-label">Nama Barang : </label>
									<select name="id_barang[]" id="id_barang" class="form-control" onchange="selectBarang()">
										<option value="<?= 0 ?>">-- Pilih Barang --</option>
									</select>
									<div class="mt-2" id="stock_barang_container">
										<label id="stock_barang">Stok Barang: -</label>
									</div>
								</div>
								<div class="col-md-3">
									<label for="" class="col-form-label">Jumlah : </label>
									<input type="number" class="form-control" id="jumlah" name="jumlah[]" disabled oninput="validasiJumlah()">
									<div class="mt-2" id="jumlah_error" style="color: red;"></div>
								</div>
								<div class="col-md-3">
									<label for="" class="col-form-label">Harga : </label>
									<input type="text" class="form-control" id="harga_satuan" name="harga_satuan[]" readonly>
								</div>
								<div class="col-md-2 align-self-center">
									<button type="submit" class="btn btn-success tambah"><i class="fas fa-plus"></i></button>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg">
								<Label>Status : </Label>
								<input type="text" class="form-control" id="status" name="status" value="Dijual" readonly>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg">
								<label for="">Tanggal : </label>
								<input type="date" class="form-control" id="tgl_jual" name="tgl_jual">
								<?= form_error('tgl_jual', '<small class="text-danger pl-3">', '</small>');?>
							</div>
						</div>
						<div class="modal-footer">
							<button class="btn btn-info" type="submit" id="simpanBtn">Simpan&nbsp;</button>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<!-- End of Main Content -->

<script>
	function selectBarang() {
		const selectElement = document.getElementById('id_barang');
		const stockLabelContainer = document.getElementById('stock_barang_container');
		const jumlahInput = document.getElementById('jumlah');

		const selectedOption = selectElement.options[selectElement.selectedIndex];
		const stock = selectedOption.getAttribute('data-stok');

		console.log(selectedOption.value);
		if (selectedOption.value === '0') {
			jumlahInput.disabled = true;
			document.getElementById('stock_barang').innerText = `Stok Barang: -`;
		} else {
			// stockLabelContainer.style.display = 'block';
			document.getElementById('stock_barang').innerText = `Stok Barang: ${stock}`;
			jumlahInput.disabled = false;
		}

		var id_barang = $("#id_barang").val();
		$.ajax({
			url: "<?php echo base_url() ?>Transaksi/menampilkan_harga",
			data: "id_barang=" + id_barang,
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$("#harga_satuan").val(data.harga_satuan);
			}
		});
	}
</script>

<script>
	function validasiJumlah() {
		const selectElement = document.getElementById('id_barang');
		const selectedOption = selectElement.options[selectElement.selectedIndex];
		const stock = parseInt(selectedOption.getAttribute('data-stok'), 10);
		const jumlahInput = document.getElementById('jumlah');
		const jumlahValue = parseInt(jumlahInput.value, 10);
		const simpanBtn = document.getElementById('simpanBtn');

		const errorContainer = document.getElementById('jumlah_error');

		if (isNaN(jumlahValue) || jumlahValue < 0) {
			errorContainer.textContent = 'Jumlah barang tidak valid';
			simpanBtn.disabled = true;
		} else if (jumlahValue > stock) {
			simpanBtn.disabled = true;
			errorContainer.textContent = 'Jumlah barang tidak boleh melebihi stok barang.';
		} else {
			simpanBtn.disabled = false;
			errorContainer.textContent = '';
		}
	}
</script>


<script>
	$(document).ready(function() {
		$(".tambah").click(function(e) {
			e.preventDefault();
			$("#show").prepend(`<div class="row col-lg append_item">
							<input type="hidden" class="form-control" id="kode" name="id_kategori[]" readonly>
								<div class="col-md-4">
									<label for="" class="col-form-label">Nama Barang : </label>
									<select name="id_barang[]" id="id_barang" class="form-control" onchange="selectBarang()">
										<option value="<?= 0 ?>">-- Pilih Barang --</option>
									</select>
									<div class="mt-2" id="stock_barang_container">
										<label id="stock_barang">Stok Barang: -</label>
									</div>
								</div>
								<div class="col-md-3">
									<label for="" class="col-form-label">Jumlah : </label>
									<input type="number" class="form-control" id="jumlah" name="jumlah[]" disabled oninput="validasiJumlah()">
									<div class="mt-2" id="jumlah_error" style="color: red;"></div>
								</div>
								<div class="col-md-3">
									<label for="" class="col-form-label">Harga : </label>
									<input type="text" class="form-control" id="harga_satuan" name="harga_satuan[]" readonly>
								</div>
								<div class="col-md-2 align-self-center">
									<button type="submit" class="btn btn-danger hapus"><i class="fas fa-times"></i></button>
								</div>`);
		});
		$(document).on("click", ".hapus", function(e) {
			e.preventDefault();
			let row_item = $(this).parent().parent();
			$(row_item).remove();
		});
		
	});

	
	function pilih_kategori() {
        var tes = document.getElementById("id_kategori").value;
        document.getElementById("kode").value=tes;
    }

	$("#id_kategori").change(function(){
                        var id_kategori = $(this).val();
                        $.ajax({
                        url : "<?php echo base_url() ?>Transaksi/menampilkan_barang1",
                        data : {
                            id_kategori:id_kategori
                        },
                        type : 'post',
                        dataType : 'json',
                        success: function(data){
                            $('#id_barang').html(data);
                        }
                    });
                    });  

	$('#id_barang').change(function() {
		var kode = $(this).val();
		$.ajax({
			url: '<?= base_url() ?>User/jumlahstok',
			data: {
				kode: kode
			},
			method: 'post',
			dataType: 'json',
			success: function(hasil) {
				var stok = JSON.stringify(hasil.stok);
				var stok1 = stok.split('"').join('');
				if (stok1 <= 0) {
					alert('Stok Barang Sedang Kosong');
					location.reload();
				}
			}
		});
	});
</script>
