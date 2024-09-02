
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
                        

                            <!-- DataTales Example -->
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Login</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Email</th>
                                <th scope="col">Akses</th>
                                <th scope="col">Active</th>
                                <th scope="col">Tanggal Akun</th>
                                <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php $i = 1; ?>
                                <?php foreach ($Klogin as $log) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                        <td><?= $log['name']?></td>
                                        <td><?= $log['jenkel']?></td>
                                        <td><?= $log['email']?></td>
                                        <td><?= $log['role']?></td>
                                        <td><?php if ($log['is_active'] == 1) : ?>
                                            <?= "1"; ?> 
                                            <?php else : ?>
                                            <?= "0" ?>
                                            <?php endif ?>
                                        </td>
                                        <td><?= date('d F Y', $log['date_created']);?></td>
                                        <td class="text-center">
                                            <button class="btn btn-info btn-sm mt-2" data-toggle="modal" data-target="#mylihat<?= $log['id']?>"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-success btn-sm mt-2" data-toggle="modal" data-target="#myEditPass<?= $log['id']?>"><i class="fas fa-key"></i></button>
                                            <button class="btn btn-warning btn-sm mt-2" data-toggle="modal" data-target="#myEditModal<?= $log['id']?>"><i class="fas fa-edit"></i></button>
                                            <a href="<?php echo base_url('Admin/log_delete/'.$log['id']) ?>" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                </tr>
                                <?php $i++; ?>
                                                <!-- Modal Edit -->
                                                <div aria-hidden="true" aria-labelledby="#myEditModal" role="dialog" tabindex="-1" id="myEditModal<?= $log['id']?>" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Ubah Data</h4>
                                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                            </div>
                                                                <form class="form-horizontal" action="<?php echo base_url('Admin/log_edit/'.$log['id']) ?>" method="post" enctype="multipart/form-data" role="form">
                                                                <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="<?= $log['name']?>" readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= $log['email']?>" readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <select name="role" id="role" class="form-control">
                                                                                <?php foreach ($role as $r) : 
                                                                                    if($r["id"] == $log["id"]): ?>
                                                                                    <option value="<?= $r['id'];?>" class=""><?= $r['role'];?></option>
                                                                                    <?php endif;?>
                                                                                    <option value="<?= $r['id'];?>"><?= $r['role'];?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="form-check">
                                                                                <?php if($log['is_active'] == 1) : ?>    
                                                                                    <input type="checkbox" class="" value="1" id="is_active" name="is_active" checked>
                                                                                    <label for="is_active">Active?</label>
                                                                                <?php else : ?>
                                                                                    <input type="checkbox" class="" value="1" id="is_active" name="is_active">
                                                                                    <label for="is_active">Active?</label>
                                                                                <?php endif ?>
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

                                                <!-- Modal Edit -->
                                                <div aria-hidden="true" aria-labelledby="#myEditModal" role="dialog" tabindex="-1" id="myEditPass<?= $log['id']?>" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Ubah Password</h4>
                                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                            </div>
                                                                <form class="form-horizontal" action="<?php echo base_url('Admin/pass_edit/'.$log['id']) ?>" method="post" enctype="multipart/form-data" role="form">
                                                                    <div class="modal-body">
                                                                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $log['id']?>" readonly>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="email" name="email" value="<?= $log['email']?>" readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="password" name="password" placeholder="Password Baru">
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

                                                <!-- Modal Edit -->
                                                <div aria-hidden="true" aria-labelledby="#myEditModal" role="dialog" tabindex="-1" id="mylihat<?= $log['id']?>" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Detail Data</h4>
                                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                            </div>
                                                                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                                                                <div class="modal-body">
                                                                    <div class="row ml-1">
                                                                        <div class="form-group">
                                                                            <img src="<?= base_url('assets/img/') . $log['image'];?>" class="img-fluid rounded-start" style="width: 200px; height: 400px;">
                                                                        </div> 
                                                                        <div class="form-group ml-3">
                                                                            <label for="" class="mt-2">Nama : </label>
                                                                            <input type="text" class="form-control" value="<?= $log['name']?>" readonly>
                                                                            <label for="" class="mt-2">Email : </label>
                                                                            <input type="text" class="form-control" value="<?= $log['email']?>" readonly>
                                                                            <label for="" class="mt-2">Jenis Kelamin : </label>
                                                                            <input type="text" class="form-control" value="<?= $log['jenkel']?>" readonly>
                                                                            <label for="" class="mt-2">Alamat : </label>
                                                                            <input type="text" class="form-control" value="<?= $log['alamat']?>" readonly>
                                                                            <label for="" class="mt-2">No Handphone : </label>
                                                                            <input type="text" class="form-control" value="<?= $log['no_hp']?>" readonly>
                                                                            <label for="" class="mt-2">Akses : </label>
                                                                            <input type="text" class="form-control" value="<?= $log['role']?>" readonly>
                                                                        </div>   
                                                                    </div>
                                                                </div>
                                                                    <div class="modal-footer">
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
            <!-- End of Main Content -->  

