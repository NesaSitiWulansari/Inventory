
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                        <a href="<?= base_url('Transaksi/jual')?>" class="btn btn-info"><i class="fa fa-arrow-circle-left text-white-50"></i> Kembali</a>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= $this->session->flashdata('message');?>                          
                        </div>
                    </div>
                    
                    <!-- DataTales Example -->
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Penjualan Barang</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>    
                                            <th>Nama</th>
                                            <th>Tanggal Penjualan</th>
                                            <th>Status</th>
                                            <th>Bukti</th>
                                            <th>User</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach($jual as $j) :?>
                                            <tr class="text-center">
                                                <th scope="row"><?= $i; ?></th>
                                                    <td><?= $j['nama']?></td>
                                                    <td><?= $j['tgl_jual']?></td>
                                                    <td><button class="btn btn-success btn-sm"><?= $j['status']?></button></td>
                                                    <td><a href="#"><?= $j['bukti']?></a></td>
                                                    <td><?= $j['name']?></td>
                                                    <td>
                                                        <a href="<?php echo base_url('Transaksi/lihatjualdetail/'.$j['id_jual']) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myEditModal<?= $j['id_jual']?>"><i class="fas fa-edit"></i></button>
                                                        <a href="<?php echo base_url('Transaksi/Trans_hapus/'.$j['id_jual']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                                    </td>
                                            </tr>
                                        <?php $i++; ?>  
                                        <!-- Modal Edit -->
                                        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myEditModal<?= $j['id_jual']?>" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Data</h4>
                                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                    </div>
                                                    <form class="form-horizontal" action="<?php echo base_url('Transaksi/Jual_ubah/'.$j['id_jual']) ?>" method="post" enctype="multipart/form-data" role="form">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <div class="col-lg">
                                                                <label for="">Nama : </label>
                                                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $j['nama']?>" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-lg">
                                                                <label for="">Tanggal Penjualan : </label>
                                                                <input type="date" class="form-control" id="tgl_jual" name="tgl_jual" value="<?= $j['tgl_jual']?>" >
                                                            </div>
                                                        </div>                                   
                                                            <div class="form-group">
                                                                <div class="col-lg">
                                                                    <label for="">Bukti Pembayaran : </label>
                                                                    <div class="col-sm-12">
                                                                        <div class="costum-file">
                                                                            <input type="file" class="custom-file-input" id="bukti" name="bukti">
                                                                            <label for="bukti" class="custom-file-label">Choose file</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                                                        </div>
                                                    </div>
                                                    </form>
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


           