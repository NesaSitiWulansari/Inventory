<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    <a href="<?= base_url('User/user')?>" class="btn btn-info"><i class="fa fa-arrow-circle-left text-white-50"></i> Kembali</a>
</div>


<div class="row">
    <div class="col-lg-6">
        <?= $this->session->flashdata('message');?>                          
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
                    <?php 
                    $i = 1; 
                    ?>
                    <?php foreach($pinjam as $p) :   
                    $tanggalkem = $p['tgl_kembali'];
                    ?>
                        <tr class="text-center">
                            <th scope="row"><?= $i; ?></th>
                                <td><?= $p['name']?></td>
                                <td><?= $p['tgl_pinjam']?></td>
                                <td>
                                        <?= $tanggalkem; ?>
                                </td>
                                <td><?= $p['keterangan']?></td>
                                <td><?php if ($p['status'] == 'Pending') : ?>
                                    <button class="btn btn-warning btn-sm"><?= $p['status'] ?></button>
                                    <?php elseif ($p['status'] == 'Dipinjam') :?>    
                                        <button class="btn btn-success btn-sm"><?= $p['status'] ?></button>
                                        <br><br><label for="" style="color: blue; font-size: 12px;">*Barang yang sudah disetujui <br>bisa diambil 1 hari sebelum tanggal <br>pengajuan peminjaman</label>
                                    <?php else :?>    
                                        <button class="btn btn-success btn-sm"><?= $p['status'] ?></button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('User/lihatpinjamdetail/'.$p['id_p']) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <?php if ($p['status'] == 'Pending') : ?>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myEditModal<?= $p['id_p']?>"><i class="fas fa-edit"></i></button>
                                    <a href="<?php echo base_url('User/user_hapus/'.$p['id_p']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                    <?php else :?>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myviewModal<?= $p['id_p']?>"><i class="fas fa-edit"></i></button>
                                    <?php endif?>
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
                                <form class="form-horizontal" action="<?php echo base_url('User/user_ubah/'.$p['id_p']) ?>" method="post" enctype="multipart/form-data" role="form">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $p['id_p']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <label for="">Nama : </label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?= $p['name']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <label for="">Tanggal Peminjaman : </label>
                                            <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="<?= $p['tgl_pinjam']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <label for="">Keterangan : </label>
                                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $p['keterangan']?>">
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
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myviewModal<?= $p['id_p']?>" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Ubah Data</h4>
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                </div>
                                <form class="form-horizontal" action="#" method="post" enctype="multipart/form-data" role="form">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $p['id_p']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <label for="">Nama : </label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?= $p['name']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <label for="">Tanggal Peminjaman : </label>
                                            <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="<?= $p['tgl_pinjam']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <label for="">Tanggal Pengembalian : </label>
                                            <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="<?= $p['tgl_kembali']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <label for="">Keterangan : </label>
                                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $p['keterangan']?>" readonly>
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
<!-- End of Main Content -->