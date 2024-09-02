<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <a href="<?= base_url('User/lihatdata')?>" class="btn btn-info"><i class="fa fa-arrow-circle-left text-white-50"></i> Kembali</a>
	</div>

	<div class="row">
		<div class="col-lg-6">

			<?= $this->session->flashdata('message'); ?>

		</div>
	</div>

	<div class="col-sm-12">
		<div class="card">
			<div class="card-header bg-info text-white">Tambah Data Detail Peminjaman</div>
			<div class="card-body">
            <?php foreach($Tpinjam as $tp):?>
				<form class="form-horizontal" action="<?php echo base_url('User/Ptambah_barang1/'.$tp['id_p']) ?>" method="post" enctype="multipart/form-data" role="form">
					<div class="modal-body">
						<div class="form-group">
							<div class="col-lg">
                                <input type="text" class="form-control" id="id_p" name="id_p" value="<?= $tp['id_p']?>" readonly>
							</div>
						</div>
                        <?php endforeach;?>
						<div class="form-group" id="show">
							<div class="row col-lg">
								<div class="col-md-6">
									<label for="" class="col-form-label">Nama Barang : </label>
									<select required value="" name="id_barang[]" id="id_barang" class="form-control" onchange="selectBarang()">
										<option value="<?= 0 ?>">-- Pilih Barang --</option>
										<?php foreach ($barang as $bar) : ?>
											<?php if ($bar['id_kategori'] != '12' && $bar['id_kategori'] != '1') :?>
											<option value="<?= $bar['id_barang']; ?>" data-stok="<?= $bar['stok']; ?>" class=""><?= $bar['nama_barang']; ?></option>
											<?php endif; ?>
										<?php endforeach; ?>
									</select>
												
                                    <input type="hidden" class="form-control" id="id_kategori" name="id_kategori[]" readonly>
									<div class="mt-2" id="stock_barang_container">
										<label id="stock_barang">Stok Barang: -</label>
									</div>
								</div>
								<div class="col-md-4">
									<label for="" class="col-form-label">Jumlah : </label>
									<input type="number" class="form-control" id="jumlah" name="jumlah[]" disabled oninput="validasiJumlah()">
									<div class="mt-2" id="jumlah_error" style="color: red;"></div>
								</div>
								<div class="col-md-2 align-self-center">
									<button type="submit" class="btn btn-success tambah"><i class="fas fa-plus"></i></button>
								</div>
							</div>
						</div>
                        <div class="form-group">
                            <div class="col-lg">
                                <input type="hidden" class="form-control" id="status_p" name="status_p" value="0" readonly>
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

<!-- Content Row -->
<div class="row mt-4">

</div>
<!-- /.container-fluid -->
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
                        url : "<?php echo base_url() ?>User/menampilkan_barang",
                        data : "id_barang=" + id_barang,
                        method : 'post',
                        dataType : 'json',
                        success: function(data){
                            $("#id_kategori").val(data.id_kategori);
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
			<div class="col-md-6">
									<label for="" class="col-form-label">Nama Barang : </label>
									<select required value="" name="id_barang[]" id="id_barang" class="form-control" onchange="selectBarang()">
										<option value="<?= 0 ?>">-- Pilih Barang --</option>
										<?php foreach ($barang as $bar) : ?>
											<?php if ($bar['id_kategori'] != '12' && $bar['id_kategori'] != '1') :?>
											<option value="<?= $bar['id_barang']; ?>" data-stok="<?= $bar['stok']; ?>" class=""><?= $bar['nama_barang']; ?></option>
											<?php endif; ?>
										<?php endforeach; ?>
									</select>
                                    <input type="hidden" class="form-control" id="id_kategori" name="id_kategori[]" readonly>
									<div class="mt-2" id="stock_barang_container">
										<label id="stock_barang">Stok Barang: -</label>
									</div>
								</div>
								<div class="col-md-4">
									<label for="" class="col-form-label">Jumlah : </label>
									<input type="number" class="form-control" id="jumlah" name="jumlah[]" disabled oninput="validasiJumlah()">
									<div class="mt-2" id="jumlah_error" style="color: red;"></div>
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
