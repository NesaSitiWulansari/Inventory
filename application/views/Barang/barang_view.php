
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                             
                            <?= form_error('kode_barang', '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>','</div>')?>
                            <?= validation_errors(); ?>
                            <?= $this->session->flashdata('message');?>    
                            
                        </div>
                    </div>

                    <a href="<?= base_url('Master/tambah')?>" type="button" class="btn btn-info mb-3 mt-3"><i class="fas fa-plus"></i> Tambah</a>
                    <br/ >
                    <br/ >
                    
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
                                <th scope="col">Harga Satuan</th>
                                <th scope="col">Total</th>
                                <th scope="col" class="text-center">Action</th>
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
                                        <td><?= 'Rp. '.number_format($b['harga_satuan']); ?></td>
                                        <td><?= 'Rp. '.number_format($b['stok'] * $b['harga_satuan']); ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-warning btn-sm mt-2" data-toggle="modal" data-target="#myEditModal<?= $b['id_barang']?>"><i class="fas fa-edit"></i></button>
                                            <a href="<?php echo base_url('Master/barang_hapus/'.$b['id_barang']) ?>" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                </tr>
                                <?php $i++; ?>
                                <!-- Modal Edit -->
                            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myEditModal<?= $b['id_barang']?>" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ubah Data</h4>
                                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        </div>
                                        <form class="form-horizontal" action="<?php echo base_url('Master/barang_ubah/'.$b['id_barang']) ?>" method="post" enctype="multipart/form-data" role="form">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <Label>Nama Kategori : </Label>
                                                    <input type="text" class="form-control" id="id_kategori" name="id_kategori" value="<?= $b['id_kategori']?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Nama Barang : </label>
                                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $b['nama_barang']?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Stok Awal: </label>
                                                    <input type="text" class="form-control" id="stok" name="stok" value="<?= $b['stok']?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Satuan : </label>
                                                    <input type="text" class="form-control" id="nama_satuan" name="nama_satuan" value="<?= $b['nama_satuan']?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Harga : </label>
                                                    <input type="text" class="form-control" id="harga_satuan" name="harga_satuan" value="<?= $b['harga_satuan']?>">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Modal Edit -->
                            <?php endforeach; ?>
                            </tbody> 
                            </table>
                    </div>
                </div>  
                    </div>
                </div> 
            <!-- End of Main Content -->
           