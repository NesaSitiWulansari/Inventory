
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
                                <div class="card-header bg-info text-white">Tambah data Role</div>
                                <div class="card-body">
                                    <form class="form-horizontal" action="<?php echo base_url('Admin/tambahrole')?>" method="post" enctype="multipart/form-data" id="tambahform">
                                        <div class="form-group row col-lg">
                                            <label for="inputPassword" class="col-form-label">Nama Role : </label>
                                            <input type="text" class="form-control" id="role" name="role">
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
                                <th scope="col">Nama Role</th>
                                <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                            <?php $i = 1; ?>
                                <?php foreach ($role as $r) : ?>
                                <tr class="text-center">
                                    <th scope="row"><?= $i; ?></th>
                                        <td><?= $r['role']?></td>
                                        <td>
                                            <a href="<?= base_url('Admin/roleAccess/').$r['id']; ?>" class="btn btn-success btn-sm"><i class="fas fa-unlock"></i></a>
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myEditRoleModal<?= $r['id']?>"><i class="fas fa-edit"></i></button>
                                            <a href="<?php echo base_url('Admin/role_delete/'.$r['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                </tr>
                                <?php $i++; ?>
                                <!-- Modal Edit -->
                                <div aria-hidden="true" aria-labelledby="myEditRoleModalLabel" role="dialog" tabindex="-1" id="myEditRoleModal<?= $r['id']?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ubah Data</h4>
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                            </div>
                                            <form class="form-horizontal" action="<?php echo base_url('Admin/role_edit/'.$r['id'])?>" method="post" enctype="multipart/form-data" role="form">
                                            <div class="modal-body">
                                                    <div class="form-group">
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" id="role" name="role" placeholder="Masukan Role" value="<?= $r['role']?>">
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
                                <!-- END Modal Edit -->
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

                            
            

