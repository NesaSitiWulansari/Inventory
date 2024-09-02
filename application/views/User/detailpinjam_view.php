<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    <a href="<?= base_url('User/lihatdata')?>" class="btn btn-info"><i class="fa fa-arrow-circle-left text-white-50"></i> Kembali</a>
</div>


<div class="row">
    <div class="col-lg-6">
        <?= $this->session->flashdata('message');?>                          
    </div>
</div>

<?php foreach($Tpinjam as $t) :?>
<a href="<?= base_url('User/Ptambah_barang/'.$t['id_p'])?>" type="button" class="btn btn-info mb-3 mt-3"><i class="fas fa-plus"></i> Tambah Data</a>
<br/ >
<br/ >
<?php endforeach;?>

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
                                <td><?php if($dp['kondisi_awal'] != NULL):?>
                                    <img src="<?= base_url('assets/KondisiAwal/') . $dp['kondisi_awal']?>" style="max-width: 200px;">
                                    <?php endif;?>
                                </td>
                                <td><?= $dp['ket_awal']?></td>
                                <td><?php if($dp['kondisi_Akhir'] != NULL) :?>
                                    <img src="<?= base_url('assets/KondisiAkhir/') . $dp['kondisi_Akhir']?>" style="max-width: 200px;">
                                    <?php endif;?>
                                </td>
                                <td><?= $dp['ket_akhir']?></td>
                                <td><?php if ($dp['status_p'] == 0) : ?>
                                    <button class="btn btn-warning btn-sm">Menunggu</button>
                                    <?php elseif ($dp['status_p'] == 1) :?>    
                                        <button class="btn btn-success btn-sm">Disetujui</button>
                                    <?php elseif ($dp['status_p'] == 2) :?>    
                                        <button class="btn btn-danger btn-sm">Tidak Setuju</button>
                                    <?php elseif ($dp['status_p'] == 3) :?>    
                                        <button class="btn btn-success btn-sm">Kembali</button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($dp['status_p'] == 0): ?>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myEditModal<?= $dp['id_peminjaman']?>"><i class="fas fa-edit"></i></button>
                                    <?php else:?>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myEditModal<?= $dp['id_peminjaman']?>"><i class="fas fa-edit"></i></button>
                                    <?php endif; ?>
                                        <a href="<?php echo base_url('User/Phapus_barang/'.$dp['id_peminjaman']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                </td>
                        </tr>
                    <?php $i++; ?>
                    <!-- Modal Edit -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myEditModal<?= $dp['id_peminjaman']?>" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Ubah Data</h4>
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                </div>
                                <form class="form-horizontal" action="<?php echo base_url('User/Pubah_barang/'.$dp['id_peminjaman']) ?>" method="post" enctype="multipart/form-data" role="form">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <Label>ID Barang : </Label>
                                            <input type="text" class="form-control" id="id_barang" name="id_barang" value="<?= $dp['id_barang']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <Label>Nama Barang : </Label>
                                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $dp['nama_barang']?>" readonly>
                                        </div>
                                    </div>
                                    <?php if ($dp['status_p'] == 0) :?>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <label for="">Jumlah : </label>
                                            <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $dp['jumlah']?>" >
                                        </div>
                                    </div>
                                    <?php else:?>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <label for="">Jumlah : </label>
                                            <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $dp['jumlah']?>" readonly>
                                        </div>
                                    </div>
                                    <?php endif;?>
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