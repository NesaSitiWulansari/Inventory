<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    <a href="<?= base_url('Barang/Peminjaman')?>" class="btn btn-info"><i class="fa fa-arrow-circle-left text-white-50"></i> Kembali</a>
</div>


<div class="row">
    <div class="col-lg-6">
        <?= $this->session->flashdata('message');?>                          
    </div>
</div>

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Peminjaman Barang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No</th>    
                        <th>ID Barang</th>
                        <th>Nama Kategori</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Kondisi Awal</th>
                        <th>Keterangan Kondisi</th>
                        <th>Kondisi Akhir</th>
                        <th>Keterangan Kondisi</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($detailpinjam as $dp) :?>
                        <tr class="text-center">
                            <th scope="row"><?= $i; ?></th>
                                <td><?= $dp['id_barang']?></td>
                                <td><?= $dp['nama_kategori']?></td>
                                <td><?= $dp['nama_barang']?></td>
                                <td><?= $dp['jumlah']?></td>
                                <td><?php if ($dp['kondisi_awal'] != NULL) :?>
                                    <img src="<?= base_url('assets/KondisiAwal/') . $dp['kondisi_awal']?>" style="max-width: 200px;">
                                    <?php else : ?>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myUploadModal<?= $dp['id_peminjaman']?>"><i class="fa fa-arrow-circle-up text-white-50"></i></button>
                                    <?php endif;?>
                                </td>
                                <td><?= $dp['ket_awal']?></td>
                                <td>
                                    <?php if ($dp['kondisi_Akhir'] != NULL) :?>
                                        <img src="<?= base_url('assets/KondisiAkhir/') . $dp['kondisi_Akhir']?>" style="max-width: 200px;">
                                    <?php else : ?>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myUploadAkhirModal<?= $dp['id_peminjaman']?>"><i class="fa fa-arrow-circle-up text-white-50"></i></button>
                                    <?php endif;?>
                                </td>
                                <td><?= $dp['ket_akhir']?></td>
                                <td><?php if ($dp['status_p'] == 0) : ?>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myDetailModal<?= $dp['id_peminjaman']?>">Menunggu</button>
                                    <?php elseif ($dp['status_p'] == 1) :?>    
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myDetailModal<?= $dp['id_peminjaman']?>">Disetujui</button>
                                    <?php elseif ($dp['status_p'] == 2) :?>    
                                        <button class="btn btn-danger btn-sm">Tidak Setuju</button>
                                    <?php elseif ($dp['status_p'] == 3) :?>    
                                        <button class="btn btn-success btn-sm">Kembali</button>
                                    <?php endif; ?>
                                </td>
                                    <td>
                                    <a href="<?php echo base_url('Barang/Dhapus_barang/'.$dp['id_peminjaman']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                    </td>
                        </tr>
                    <?php $i++; ?>
                    <!-- Modal Upload Kondisi Awal -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myUploadModal<?= $dp['id_peminjaman']?>" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Upload Kondisi Awal</h4>
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                </div>
                                <form class="form-horizontal" action="<?php echo base_url('Barang/upload_barang/'.$dp['id_peminjaman']) ?>" method="post" enctype="multipart/form-data" role="form">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <label for="">Kondisi Awal : </label>
                                            <div class="col-sm-12">
                                                <div class="costum-file">
                                                    <input type="file" class="custom-file-input" id="kondisi_awal" name="kondisi_awal">
                                                        <label for="kondisi_awal" class="custom-file-label">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <Label>Keterangan Kondisi: </Label>
                                            <input type="text" class="form-control" id="ket_awal" name="ket_awal">
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
                    <!-- END Modal Upload Kondisi Awal -->
                    <!-- Modal Upload Kondisi Akhir -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myUploadAkhirModal<?= $dp['id_peminjaman']?>" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Upload Kondisi Awal</h4>
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                </div>
                                <form class="form-horizontal" action="<?php echo base_url('Barang/upload_barang/'.$dp['id_peminjaman']) ?>" method="post" enctype="multipart/form-data" role="form">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <label for="">Kondisi Akhir : </label>
                                            <div class="col-sm-12">
                                                <div class="costum-file">
                                                    <input type="file" class="custom-file-input" id="kondisi_Akhir" name="kondisi_Akhir">
                                                        <label for="kondisi_Akhir" class="custom-file-label">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <Label>Keterangan Kondisi: </Label>
                                            <input type="text" class="form-control" id="ket_akhir" name="ket_akhir">
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
                    <!-- END Modal Upload Kondisi Akhir -->
                    <!-- Modal Edit -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myDetailModal<?= $dp['id_peminjaman']?>" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Ubah Status</h4>
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                </div>
                                <form class="form-horizontal" action="<?php echo base_url('Barang/Pubah_barang/'.$dp['id_peminjaman']) ?>" method="post" enctype="multipart/form-data" role="form">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <Label>Nama Barang : </Label>
                                            <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= $dp['nama_barang']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <Label>Jumlah : </Label>
                                            <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $dp['jumlah']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <Label>Status : </Label>
                                            <select name="status_p" id="status_p" class="form-control">
                                                <option value="0">-- Pilih Status --</option>
                                                <option value="1">Disetujui</option>
                                                <option value="2">Ditolak</option>
                                                <option value="3">Kembali</option>
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
        <?php endforeach; ?>
                </tbody>
            </table>
    </div>
</div>
</div>

</div>
</div>