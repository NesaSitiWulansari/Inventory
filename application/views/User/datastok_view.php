
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                    </div>

                    
	                <button class="btn btn-warning mb-3 mt-3" data-toggle="modal" data-target="#myPeraturanModal"><i class="fas fa-edit"></i> Peraturan Peminjaman</button>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Stok Barang</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center"> 
                                <th scope="col">No</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Satuan</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php $i = 1; ?>
                                <?php foreach($barang as $b) :?>
                                <tr class="text-center">
                                    <th scope="row"><?= $i; ?></th>
                                        <td><?= $b['nama_barang']?></td>
                                        <td><?= $b['nama_kategori']?></td>
                                        <td><?= $b['stok']?></td>
                                        <td><?= $b['nama_satuan']?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                            </tbody> 
                            </table>
                    </div>
                </div>  
                    </div>
                </div> 
                
	<!-- Modal Edit -->
	<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myPeraturanModal" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Peraturan Peminjaman</h4>
					<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				</div>
				<div class="modal-body">
					<table class="mb-4">
						<tr>
							<td>1.</td>
							<td> Pastikan anda sudah melakukan registrasi dan aktivasi akun kepada pihak sekolah.</td>
						</tr>
						<tr>
							<td>2.</td>
							<td> Lakukan pengecekan stok terlebih dahulu.</td>
						</tr>
						<tr>
							<td>3.</td>
							<td> Jika stok yang anda maksud masih tersedia maka, ajukan peminjaman di form yang sudah di sediakan.</td>
						</tr>
						<tr>
							<td>4.</td>
							<td> Menunggu konfirmasi dari pihak sekolah.</td>
						</tr>
						<tr>
							<td>5.</td>
							<td> Menjaga kondisi barang yang dipinjam dan bertanggung jawab jika ada kerusakan.</td>
						</tr>
						<tr>
							<td>6.</td>
							<td> Mengembalikan barang pinjaman tepat waktu dan melakukan konfirmasi langsung kepada pihak sekolah.</td>
						</tr>
					</table>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END Modal Edit -->
            <!-- End of Main Content -->
           