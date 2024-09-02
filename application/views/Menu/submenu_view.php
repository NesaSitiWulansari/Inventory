
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

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg">   
                            
                            <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#myTambahModal"><i class="fas fa-plus"></i> Tambah Sub Menu</button>
                            <br/ >
                            <br/ >

                            <!-- DataTales Example -->
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Sub Menu</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Sub Menu</th>
                                <th scope="col">Menu</th>
                                <th scope="col">URL</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Active</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php $i = 1; ?>
                                <?php foreach ($submenu as $sbm) : ?>
                                <tr class="text-center">
                                    <th scope="row"><?= $i; ?></th>
                                        <td><?= $sbm['title']?></td>
                                        <td><?= $sbm['menu']?></td>
                                        <td><?= $sbm['url']?></td>
                                        <td><?= $sbm['icon']?></td>
                                        <td><?php if ($sbm['is_active'] == 1) : ?>
                                            <?= "1"; ?> 
                                            <?php else : ?>
                                            <?= "0" ?>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myEditModal<?= $sbm['id']?>"><i class="fas fa-edit"></i></button>
                                            <a href="<?php echo base_url('Menu/sub_delete/'.$sbm['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                </tr>
                                <?php $i++; ?>
                                <!-- Modal Edit -->
                                <div aria-hidden="true" aria-labelledby="#myEditModal" role="dialog" tabindex="-1" id="myEditModal<?= $sbm['id']?>" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Ubah Data</h4>
                                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                            </div>
                                                                <form class="form-horizontal" action="<?php echo base_url('Menu/sub_edit/'.$sbm['id']) ?>" method="post" enctype="multipart/form-data" role="form">
                                                                <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="title" name="title" placeholder="Nama Sub Menu" value="<?= $sbm['title']?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <select name="menu_id" id="menu_id" class="form-control">
                                                                                <?php foreach ($menu as $m) : 
                                                                                    if($m["id"] == $sbm["id"]): ?>
                                                                                    <option value="<?= $m['id'];?>" class=""><?= $m['menu'];?></option>
                                                                                    <?php endif;?>
                                                                                    <option value="<?= $m['id'];?>"><?= $m['menu'];?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="url" name="url" placeholder="Sub Menu URL" value="<?= $sbm['url']?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub Menu Icon" value="<?= $sbm['icon']?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="form-check">
                                                                            <?php if($sbm['is_active'] == 1) : ?>    
                                                                                    <input type="checkbox" class="" value="1" id="is_active" name="is_active" checked>
                                                                                    <label for="is_active">Active?</label>
                                                                                <?php else : ?>
                                                                                    <input type="checkbox" class="" value="1" id="is_active" name="is_active" >
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
                                <?php endforeach; ?>
                            </tbody> 
                            </table>
                        </div>
                        </div>
                        
                    </div>
                </div>
            <!-- End of Main Content -->
                            <!-- Modal Tambah -->
                            <div aria-hidden="true" aria-labelledby="myTambahModalLabel" role="dialog" tabindex="-1" id="myTambahModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah Data</h4>
                                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        </div>
                                            <form class="form-horizontal" action="<?php echo base_url('Menu/submenu')?>" method="post" enctype="multipart/form-data" role="form">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="title" name="title" placeholder="Nama Sub Menu">
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="menu_id" id="menu_id" class="form-control">
                                                            <option value="" class="">Select Menu</option>
                                                            <?php foreach ($menu as $m) : ?>
                                                                <option value="<?= $m['id'];?>"><?= $m['menu'];?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="url" name="url" placeholder="Sub Menu URL">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub Menu Icon">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" value="1" id="is_active" name="is_active" checked>
                                                            <label class="form-check-label" for="is_active">
                                                                Active?
                                                            </label>
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
 
            

