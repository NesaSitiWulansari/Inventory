<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    <a href="<?= base_url('Transaksi/databeli')?>" class="btn btn-info"><i class="fa fa-arrow-circle-left text-white-50"></i> Kembali</a>
</div>


<div class="row">
    <div class="col-lg-6">
        <?= $this->session->flashdata('message');?>                          
    </div>
</div>

<?php foreach($beli as $b) :?>
<a href="<?= base_url('Transaksi/tambahdetailbeli/'.$b['id_pembelian'])?>" type="button" class="btn btn-info mb-3 mt-3"><i class="fas fa-plus"></i> Tambah Data</a>
<br/ >
<br/ >
<?php endforeach; ?>

 <!-- DataTales Example -->
 <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Pembelian Barang</h6>
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
                    <?php foreach($detailbeli as $db) :?>
                        <?php 
                            $jumlah = $db['jumlah'] * $db['harga_satuan']; 
                            $total += $jumlah;
                        ?>
                        <tr class="text-center">
                            <th scope="row"><?= $i; ?></th>
                                <td><?= $db['nama_kategori']?></td>
                                <td><?= $db['nama_barang']?></td>
                                <td><?= $db['jumlah']?></td>
                                <td><?= 'Rp. '.number_format($db['harga_satuan']); ?></td>
                                <td><?= 'Rp. '.number_format($jumlah);?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myEditModal<?= $db['id_beli']?>"><i class="fas fa-edit"></i></button>
                                        <a href="<?php echo base_url('Transaksi/hapusdetailbeli/'.$db['id_beli']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                    </td>
                        </tr>
                    <?php $i++; ?>
                    <!-- Modal Edit -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myEditModal<?= $db['id_beli']?>" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Ubah Data</h4>
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                </div>
                                <form class="form-horizontal" action="<?php echo base_url('Transaksi/ubahdetailbeli/'.$db['id_beli']) ?>" method="post" enctype="multipart/form-data" role="form">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <input type="hidden" class="form-control" id="id_beli" name="id_beli" value="<?= $db['id_beli']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <input type="hidden" class="form-control" id="id_pembelian" name="id_pembelian" value="<?= $db['id_pembelian']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <Label>Nama Barang : </Label>
                                            <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= $db['nama_barang']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg">
                                            <label for="">Jumlah : </label>
                                            <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?= $db['jumlah']?>" >
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
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
                    $(document).ready(function(){
                        $(".tambah").click(function(e){
                            e.preventDefault();
                            $("#show").prepend(`<div class="row col-lg append_item">
                                                    <div class="col-md-4">
                                                        <label for="" class="col-form-label">Nama Barang : </label>
                                                        <select name="kode_barang[]" id="kode_barang" class="form-control" onchange='pilih_barang()'>
                                                            <option value="">-- Pilih Barang --</option>
                                                            <?php foreach ($barang as $bar) : ?>
                                                                <option value="<?= $bar['kode_barang'];?>" class=""><?= $bar['nama_barang'];?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="" class="col-form-label">Jumlah : </label>
                                                        <input type="number" class="form-control" id="jumlah" name="jumlah[]">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="" class="col-form-label">Harga : </label>
                                                        <input type="text" class="form-control" id="harga_satuan" name="harga_satuan[]" readonly>
                                                    </div>
                                                <div class="col-md-2 mt-auto">
                                                    <button class="btn btn-danger hapus"><i class="fas fa-times"></i></button>
                                                </div>
                                                </div>`);
                        });
                    $(document).on("click", ".hapus", function(e){
                        e.preventDefault();
                        let row_item = $(this).parent().parent();
                        $(row_item).remove();
                    });
                });

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

                function transfer(){
                    var nama_jur = document.getElementById("metode").value
                    document.getElementById("transferku").innerHTML=`<div class="row col-lg">
                                                    <div class="col-md-4">
                                                        <label for="" class="col-form-label">Atas Nama Rekening : </label>
                                                        <input type="text" class="form-control" id="nama_rekening" name="nama_rekening" readonly>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="" class="col-form-label">No Rekening : </label>
                                                        <input type="text" class="form-control" id="no_rekening" name="no_rekening" readonly>
                                                    </div>
                                                </div>`;
                }

                function pilih_suplier(){
                    var id_suplier = $("#id_suplier").val();
                    $.ajax({
                        url : "<?php echo base_url() ?>Suplier/menampilkan_data",
                        data : "id_suplier=" + id_suplier,
                        method : 'post',
                        dataType : 'json',
                        success: function(data){
                            $("#nama_rekening").val(data.nama_rekening);
                            $("#no_rekening").val(data.no_rekening);
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