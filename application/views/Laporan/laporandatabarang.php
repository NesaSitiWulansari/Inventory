<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
		<h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
	</div>

	<div class="row">
		<div class="col-lg-6">

			<?= $this->session->flashdata('message'); ?>

		</div>
	</div>

	<a href="<?= base_url('Laporan/barangpdf/') ?>" type="button" class="btn btn-info mb-3"><i class="fas fa-download"></i> Export PDF</a>

	<br>
	<br>


	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Barang Keluar</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr class="text-center">
							<th scope="col">No</th>
							<th scope="col">Nama Barang</th>
							<th scope="col">Kategori</th>
							<th scope="col">Jumlah</th>
							<th scope="col">Nama Satuan</th>
							<th scope="col">Harga Satuan</th>
						</tr>
					</thead>
					<tbody class="table-group-divider">
						<?php $i = 1; ?>
						<?php foreach ($barang as $ba) : ?>
							<!-- <?php var_dump($ba)?> -->
							<tr class="text-center">
								<th scope="row"><?= $i; ?></th>
								<td><?= $ba['nama_barang'] ?></td>
								<td><?= $ba['nama_kategori'] ?></td>
								<td><?= $ba['stok'] ?></td>
								<td><?= $ba['nama_satuan'] ?></td>
								<td><?= 'Rp. '.number_format($ba['harga_satuan']) ?></td>
							</tr>
							<?php $i++; ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
<!-- End of Main Content -->
