
                
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            
                        <?= form_error('role', '<div class="alert alert-success" role="alert">','</div>')?>  
                        <?= $this->session->flashdata('message');?>          
                            
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-header bg-info text-white">Tambah data Menu</div>
                                <div class="card-body">
                                    <form class="form-horizontal" action="<?php echo base_url('Menu')?>" method="post" enctype="multipart/form-data" id="tambahform">
                                        <div class="form-group row col-lg">
                                            <label for="inputPassword" class="col-form-label">Menu : </label>
                                            <input type="text" class="form-control" id="menu" name="menu">
                                            <?= form_error('menu', '<small class="text-danger pl-3">', '</small>');?>
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
                            <h6 class="m-0 font-weight-bold text-primary">Data Menu</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center"> 
                                            <th scope="col">No</th>
                                            <th scope="col">Menu</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <?php $i = 1; ?>
                                        <?php foreach ($menu as $m) : ?>
                                        <tr class="text-center">
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $m['menu']?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myEditMenuModal<?= $m['id']?>"><i class="fas fa-edit"></i></button>
                                            <a href="<?php echo base_url('Menu/menu_delete/'.$m['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                        </tr>
                                        <?php $i++; ?>
                                        <!-- Modal Edit -->
                                        <div aria-hidden="true" aria-labelledby="myEditMenuModalLabel" role="dialog" tabindex="-1" id="myEditMenuModal<?= $m['id']?>" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Data</h4>
                                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                    </div>
                                                    <form class="form-horizontal" action="<?php echo base_url('Menu/menu_edit/'.$m['id'])?>" method="post" enctype="multipart/form-data" role="form">
                                                    <div class="modal-body">
                                                            <div class="form-group">
                                                                <div class="col-lg-10">
                                                                    <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu" value="<?= $m['menu']?>">
                                                                </div>
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