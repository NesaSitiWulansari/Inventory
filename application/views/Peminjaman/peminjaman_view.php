
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
                    <div class="row">
                    <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Pending
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $pinjam1; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-folder-open fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Dipinjam
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $pinjam2; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-folder-open fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Dikembalikan
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $pinjam3; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-folder-open fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- DataTales Example -->
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Peminjaman Barang</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>    
                                            <th>Nama</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Tanggal Kembali</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach($pinjam as $p) :?>
                                            <tr class="text-center">
                                                <th scope="row"><?= $i; ?></th>
                                                    <td><?= $p['name']?></td>
                                                    <td><?= $p['tgl_pinjam']?></td>
                                                    <td><?= $p['tgl_kembali']?></td>
                                                    <td><?= $p['keterangan']?></td>
                                                    <td><?php if ($p['status'] == 'Pending') : ?>
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myEditModal<?= $p['id_p']?>"><?= $p['status']?></button>
                                                        <?php elseif ($p['status'] == 'Dipinjam'):?>    
                                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myEditModal<?= $p['id_p']?>"><?= $p['status'] ?></button>
                                                        <?php elseif ($p['status'] == 'Dikembalikan'):?>    
                                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#"><?= $p['status'] ?></button>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                            <a href="<?php echo base_url('Barang/lihatpinjamdetail/'.$p['id_p'])?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                            <a href="<?php echo base_url('Barang/pinjam_hapus/'.$p['id_p']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                                    </td>   
                                            </tr>
                                        <?php $i++; ?>
                                        <!-- Modal Edit -->
                            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myEditModal<?= $p['id_p']?>" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ubah Data</h4>
                                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        </div>
                                        <form class="form-horizontal" action="<?php echo base_url('Barang/peminjaman_ubah/'.$p['id_p']) ?>" method="post" enctype="multipart/form-data" role="form">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <Label>Tanggal Kembali : </Label>
                                                    <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Status : </label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="Dipinjam">Dipinjam</option>
                                                        <option value="Dikembalikan">Dikembalikan</option>
                                                    </select>
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

                            <!-- Modal Edit Kembali -->
                            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="mykembaliModal<?= $p['id_p']?>" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Data</h4>
                                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        </div>
                                        <form class="form-horizontal" action="<?php echo base_url('Barang/peminjaman_ubah/'.$p['id_p']) ?>" method="post" enctype="multipart/form-data" role="form">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Status : </label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="Dipinjam">Dipinjam</option>
                                                        <option value="Dikembalikan">Dikembalikan</option>
                                                    </select>
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
                            <!-- END Modal Edit Kembali -->
                            <?php endforeach; ?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    
                    </div>

                    </div>
                </div> 
            <!-- End of Main Content -->


           