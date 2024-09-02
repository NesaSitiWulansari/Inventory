
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                        
                        <?= $this->session->flashdata('message');?>          
                            
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-header bg-info text-white">Tambah Data Suplier</div>
                                <div class="card-body">
                                    <form class="form-horizontal" action="<?php echo base_url('Master/Suplier')?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group row col-lg">
                                            <label for="inputPassword" class="col-form-label">Nama Suplier : </label>
                                            <input type="text" class="form-control" id="nama_sup" name="nama_sup">
                                            <?= form_error('nama_sup', '<small class="text-danger pl-3">', '</small>');?>
                                        </div>
                                        <div class="form-group row col-lg">
                                            <label for="inputPassword" class="col-form-label">Alamat : </label>
                                            <textarea class="form-control" id="alamat" name="alamat"></textarea>
                                            <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>');?>
                                        </div>
                                        <div class="form-group row col-lg">
                                            <label for="inputPassword" class="col-form-label">No Hp : </label>
                                            <input type="text" class="form-control" id="no_hp" name="no_hp">
                                            <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>');?>
                                        </div>
                                        <div class="form-group row col-lg">
                                            <label for="inputPassword" class="col-form-label">Nama Rekening : </label>
                                            <input type="text" class="form-control" id="nama_rekening" name="nama_rekening">
                                            <?= form_error('nama_rekening', '<small class="text-danger pl-3">', '</small>');?>
                                        </div>
                                        <div class="form-group row col-lg">
                                            <label for="inputPassword" class="col-form-label">No Rekening : </label>
                                            <input type="text" class="form-control" id="no_rekening" name="no_rekening">
                                            <?= form_error('no_rekening', '<small class="text-danger pl-3">', '</small>');?>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <!-- DataTales Example -->
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Role</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center"> 
                                <th scope="col">No</th>
                                <th scope="col">Nama Suplier</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No HP</th>
                                <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                            <?php $i = 1; ?>
                                <?php foreach ($suplier as $s) : ?>
                                <tr class="text-center">
                                    <th scope="row"><?= $i; ?></th>
                                        <td><?= $s['nama_sup']?></td>
                                        <td><?= $s['alamat']?></td>
                                        <td><?= $s['no_hp']?></td>
                                        <td>
                                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#myViewSuplierModal<?= $s['id_suplier']?>"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myEditSuplierModal<?= $s['id_suplier']?>"><i class="fas fa-edit"></i></button>
                                            <a href="<?php echo base_url('Master/suplier_delete/'.$s['id_suplier']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                </tr>
                                <?php $i++; ?>
                                <!-- Modal Edit -->
                                <div aria-hidden="true" aria-labelledby="myEditRoleModalLabel" role="dialog" tabindex="-1" id="myEditSuplierModal<?= $s['id_suplier']?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ubah Data</h4>
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                            </div>
                                            <form class="form-horizontal" action="<?php echo base_url('Master/suplier_edit/'.$s['id_suplier'])?>" method="post" enctype="multipart/form-data" role="form">
                                                <div class="modal-body">
                                                    <div class="form-group row col-lg">
                                                        <label for="inputPassword" class="col-form-label">Nama Suplier : </label>
                                                        <input type="text" class="form-control" id="nama_sup" name="nama_sup" value="<?= $s['nama_sup']?>">
                                                    </div>
                                                    <div class="form-group row col-lg">
                                                        <label for="inputPassword" class="col-form-label">Alamat : </label>
                                                        <textarea class="form-control" id="alamat" name="alamat" value="<?= $s['alamat']?>"></textarea>
                                                    </div>
                                                    <div class="form-group row col-lg">
                                                        <label for="inputPassword" class="col-form-label">No Hp : </label>
                                                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $s['no_hp']?>">
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

                                <!-- Modal View -->
                                <div aria-hidden="true" aria-labelledby="myEditRoleModalLabel" role="dialog" tabindex="-1" id="myViewSuplierModal<?= $s['id_suplier']?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Lihat Data</h4>
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                            </div>
                                            <form class="form-horizontal" action="#" method="post" enctype="multipart/form-data" role="form">
                                                <div class="modal-body">
                                                    <div class="form-group row col-lg">
                                                        <label for="inputPassword" class="col-form-label">Nama Suplier : </label>
                                                        <input type="text" class="form-control" id="nama_sup" name="nama_sup" value="<?= $s['nama_sup']?>" readonly>
                                                    </div>
                                                    <div class="form-group row col-lg">
                                                        <label for="inputPassword" class="col-form-label">Alamat : </label>
                                                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $s['alamat']?>" readonly>
                                                    </div>
                                                    <div class="form-group row col-lg">
                                                        <label for="inputPassword" class="col-form-label">No Hp : </label>
                                                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $s['no_hp']?>" readonly>
                                                    </div>
                                                    <div class="form-group row col-lg">
                                                        <label for="inputPassword" class="col-form-label">Nama Rekening : </label>
                                                        <input type="text" class="form-control" id="nama_rekening" name="nama_rekening" value="<?= $s['nama_rekening']?>" readonly>
                                                    </div>
                                                    <div class="form-group row col-lg">
                                                        <label for="inputPassword" class="col-form-label">No Rekening : </label>
                                                        <input type="text" class="form-control" id="no_rekening" name="no_rekening" value="<?= $s['no_rekening']?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Modal View -->
                                <?php endforeach; ?>
                            </tbody> 
                            </table>
                        </div>

                     </div>
                        </div>    
                        </div>    
                    </div>
                </div>
                </div>
            <!-- End of Main Content -->

                            
            

