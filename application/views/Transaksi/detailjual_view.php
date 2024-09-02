<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    <a href="<?= base_url('Transaksi/datajual')?>" class="btn btn-info"><i class="fa fa-arrow-circle-left text-white-50"></i> Kembali</a>
</div>


<div class="row">
    <div class="col-lg-6">
        <?= $this->session->flashdata('message');?>                          
    </div>
</div>

<?php foreach($jual as $j) :?>
<a href="<?= base_url('Transaksi/tambahdetail/'.$j['id_jual'])?>" type="button" class="btn btn-info mb-3 mt-3"><i class="fas fa-plus"></i> Tambah Data</a>
<br/ >
<br/ >
<?php endforeach;?>

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Penjualan Barang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No</th>    
                        <th>Nama Kategori</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $total = 0;
                        $i = 1; 
                    ?>
                    <?php foreach($detailjual as $dj) :?>
                        <?php 
                            $jumlah = $dj['jumlah'] * $dj['harga_satuan']; 
                            $total += $jumlah;
                        ?>
                        <tr class="text-center">
                            <th scope="row"><?= $i; ?></th>
                                <td><?= $dj['nama_kategori']?></td>
                                <td><?= $dj['nama_barang']?></td>
                                <td><?= $dj['jumlah']?></td>
                                <td><?= 'Rp. '.number_format($dj['harga_satuan']); ?></td>
                                <td><?= 'Rp. '.number_format($jumlah);?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myEditModal<?= $dj['id_penjualan']?>"><i class="fas fa-edit"></i></button>
                                        <a href="<?php echo base_url('Transaksi/hapusdetail/'.$dj['id_penjualan']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                    </td>
                        </tr>
                    <?php $i++; ?>
                    <!-- Modal Edit -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myEditModal<?= $dj['id_penjualan']?>" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Ubah Data</h4>
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                </div>
                                <form class="form-horizontal" action="<?php echo base_url('Transaksi/ubahdetail/'.$dj['id_penjualan']) ?>" method="post" enctype="multipart/form-data" role="form">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <input type="hidden" class="form-control" id="id_penjualan" name="id_penjualan" value="<?= $dj['id_penjualan']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <input type="hidden" class="form-control" id="id_jual" name="id_jual" value="<?= $dj['id_jual']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <Label>Nama Barang : </Label>
                                            <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= $dj['nama_barang']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <label for="">Jumlah : </label>
                                            <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $dj['jumlah']?>" >
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
                <tr class="text-center">
                            <td colspan="4"><b>Jumlah</b></td>
                            <td colspan="3"><b><?= 'Rp. '.number_format($total); ?></b></td>
                </tr>
            </table>
    </div>
</div>
</div>

</div>
</div> 
<!-- End of Main Content -->

                <script>
                    function pilih_barang(){
                        var kode_barang = $("#kode_barang").val();
                        $.ajax({
                            url : "<?php echo base_url() ?>Transaksi/menampilkan_harga",
                            data : "kode_barang=" + kode_barang,
                            method : 'post',
                            dataType : 'json',
                            success: function(data){
                                $("#harga_satuan").val(data.harga_s);
                            }
                        });
                    }

                    $('#kode_barang').change(function(){
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
                </script>