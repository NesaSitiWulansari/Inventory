
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                        <?= validation_errors(); ?> 
                        <?= $this->session->flashdata('message');?>     
                            
                        </div>
                    </div>

                    <button type="button" class="btn btn-info mb-3 mt-3" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i> Tambah Kategori</button>
                    <br/ >
                    <br/ >
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Kategori Barang</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center"> 
                                <th scope="col">No</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php $i = 1; ?>
                                <?php foreach($kategori as $k) :?>
                                <tr class="text-center">
                                    <th scope="row"><?= $i; ?></th>
                                        <td><?= $k['nama_kategori']?></td>
                                        <td class="text-center">
                                            <button class="btn btn-warning btn-sm mt-2" data-toggle="modal" data-target="#myEditModal<?= $k['id_kategori']?>"><i class="fas fa-edit"></i></button>
                                            <a href="<?php echo base_url('Master/katbar_hapus/'.$k['id_kategori']) ?>" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                </tr>
                                <?php $i++; ?>
                                <!-- Modal Edit -->
                            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myEditModal<?= $k['id_kategori']?>" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ubah Data</h4>
                                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        </div>
                                        <form class="form-horizontal" action="<?php echo base_url('Master/katbar_ubah/'.$k['id_kategori']) ?>" method="post" enctype="multipart/form-data" role="form">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">ID Kategori : </label>
                                                    <input type="text" class="form-control" id="id_kategori" name="id_kategori" value="<?= $k['id_kategori']?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Nama Kategori : </label>
                                                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= $k['nama_kategori']?>">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
                                                <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
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
                                     <!-- Modal Tambah -->
                            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                                <div class="modal-dialog modal-l">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah Data</h4>
                                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        </div>
                                        <form class="form-horizontal" action="<?php echo base_url('Master/katbar')?>" method="post" enctype="multipart/form-data" role="form">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Kategori : </label>
                                                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori">
                                                </div>
                                            </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Modal Tambah -->
                    </div>
                    </div>
                </div> 
            <!-- End of Main Content -->
           