
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
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
                            <div class="card-header bg-info text-white">
                            Tambah data Barang Keluar
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" enctype="multipart/form-data" action="<?= base_url('Barang/keluar'); ?>" method="post" role="form">
                                    <div class="form-group row col-lg">
                                        <label for="" class="col-form-label">Nama : </label>
                                        <input type="text" class="form-control" id="nama" name="nama">
                                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                    <div class="form-group row col-lg">
                                        <label for="" class="col-form-label">Nama Barang : </label>
                                        <select name="id_barang" id="id_barang" class="form-control" onchange="pilih_barang()">
                                                <option value="">-- Pilih Barang --</option>
                                                <?php foreach ($barang as $b) : ?>
                                                    <?php if($b['id_kategori'] != '12'):?>
                                                    <option value="<?= $b['id_barang'];?>" class=""><?= $b['nama_barang'];?></option>
                                                    <?php endif;?>
                                                <?php endforeach; ?>
                                            </select>
                                    </div>
                                    <input type="hidden" class="form-control" id="id_kategori" name="id_kategori">
                                    <div class="form-group row col-lg">
                                        <label for="" class="col-form-label">Jumlah : </label>
                                        <input type="text" class="form-control" id="jumlah" name="jumlah">
                                        <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                    <div class="form-group row col-lg">
                                        <label for="" class="col-form-label">Tanggal : </label>
                                        <input type="date" class="form-control" id="tgl_bk" name="tgl_bk">
                                        <?= form_error('tgl_bk', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                    <div class="form-group row col-lg">
                                        <label for="" class="col-form-label">Status Barang : </label>
                                        <select name="status" id="status" class="form-control">
                                                <option value="1">Diserahkan</option>
                                                <option value="2">Dihilangkan</option>
                                            </select>
                                    </div>
                                    <div class="form-group row col-lg">
                                        <label for="" class="col-form-label">Keterangan : </label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan">
                                        <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-info" type="submit" id="save"> Simpan&nbsp;</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <!-- DataTales Example -->
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Barang Keluar</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center"> 
                                <th scope="col">No</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Tanggal Keluar</th>
                                <th scope="col">Status</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php $i = 1; ?>
                                <?php foreach($barkel as $ba) :?>
                                <tr class="text-center">
                                    <th scope="row"><?= $i; ?></th>
                                        <td><?= $ba['nama_barang']?></td>
                                        <td><?= $ba['nama']?></td>
                                        <td><?= $ba['nama_kategori']?></td>
                                        <td><?= $ba['tgl_bk']?></td>
                                        <td><?php if($ba['status'] == 1):?>
                                            <?php echo "Diserahkan"; ?>
                                            <?php else :?>
                                            <?php echo "Dihilangkan"; ?>
                                            <?php endif;?>
                                        </td>
                                        <td><?= $ba['jumlah']?></td>
                                        <td><?= $ba['keterangan']?></td>
                                        <td class="text-center">
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myEditModal<?= $ba['id_bk']?>"><i class="fas fa-edit"></i></button>
                                            <a href="<?php echo base_url('Barang/barkel_hapus/'.$ba['id_bk']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                </tr>
                                <?php $i++; ?>
                                
                    <!-- Modal Edit -->
                            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myEditModal<?= $ba['id_bk']?>" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ubah Data</h4>
                                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        </div>
                                        <form class="form-horizontal" action="<?php echo base_url('Barang/barkel_ubah/'.$ba['id_bk']) ?>" method="post" enctype="multipart/form-data" role="form" id="">
                                        <div class="modal-body">
                                        <div class="form-group">
                                                <div class="col-lg">
                                                    <input type="hidden" class="form-control" id="id_bk" name="id_bk" value="<?= $ba['id_bk']?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Nama : </label>
                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $ba['nama']?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Status : </label>
                                                    <input type="text" class="form-control" id="status" name="status" value="<?= $ba['status']?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Nama Barang : </label>
                                                    <input type="text" class="form-control" id="id_barang" name="id_barang" value="<?= $ba['nama_barang']?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Jumlah : </label>
                                                    <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $ba['jumlah']?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Keterangan : </label>
                                                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $ba['keterangan']?>">
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
    <script>
        $('#id_barang').change(function(){
                    var kode = $(this).val();
                    $.ajax({
                        url : '<?= base_url()?>User/jumlahstok',
                        data : {kode:kode},
                        method : 'post',
                        dataType : 'json',
                        success:function(hasil){
                            var stok = JSON.stringify(hasil.stok);
                            var stok1 = stok.split('"').join('');
                            if (stok1 <= 0){
                                alert('Stok Barang Sedang Kosong');
                                location.reload();
                            }
                        }                        
                    });
                });

                    function pilih_barang(){
                    var id_barang = $("#id_barang").val();
                    $.ajax({
                        url : "<?php echo base_url() ?>Transaksi/menampilkan_harga",
                        data : "id_barang=" + id_barang,
                        method : 'post',
                        dataType : 'json',
                        success: function(data){
                            $("#id_kategori").val(data.id_kategori);
                        }
                    });
                }
    </script>
            
           