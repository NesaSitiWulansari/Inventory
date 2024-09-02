

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title;?></h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            
                            <?= $this->session->flashdata('message');?>    
                            
                        </div>
                    </div>
                    
                    <a href="<?= base_url('Transaksi/databeli')?>" type="button" class="btn btn-info mb-3 mt-3"><i class="fas fa-eye"></i> Lihat Data</a>
                    <br/ >
                    <br/ >

                    <div class="col-sm-12">
                        <div class="card mb-5">
                            <div class="card-header bg-info text-white">Tambah Data Pembelian</div>
                            <div class="card-body">
                                <form class="form-horizontal" action="<?= base_url('Transaksi/pembelian')?>" method="post" enctype="multipart/form-data" role="form">
                                    <div class="modal-body">
                                            <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?= $login['id']; ?>" readonly>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">ID User : </label>
                                                    <input type="text" class="form-control" id="name" name="name" value="<?= $login['name']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Tanggal : </label>
                                                    <input type="date" class="form-control" id="tgl_pembelian" name="tgl_pembelian">
                                                    <?= form_error('tgl_pembelian', '<small class="text-danger pl-3">', '</small>');?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <Label>Metode Pembayaran : </Label>
                                                        <select name="metode" id="metode" class="form-control" onchange="transfer()">
                                                            <option value="">-- Pilih Metode --</option>
                                                            <option value="Tunai">Tunai</option>
                                                            <option value="Transfer">Transfer</option>
                                                        </select>
                                                        <?= form_error('metode', '<small class="text-danger pl-3">', '</small>');?>
                                                </div>
                                            </div>
                                            <div class="form-group" id="transferku" name="transferku">
                                                
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                        <label for="" class="col-form-label">Nama Suplier : </label>
                                                        <select name="id_suplier" id="id_suplier" class="form-control" onchange="pilih_suplier()">
                                                            <option value="">-- Pilih Suplier --</option>
                                                            <?php foreach ($suplier as $s) : ?>
                                                                <option value="<?= $s['id_suplier'];?>" class=""><?= $s['nama_sup'];?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <?= form_error('id_suplier', '<small class="text-danger pl-3">', '</small>');?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <Label>Kategori Barang : </Label>
                                                        <select name="id_kategori" id="id_kategori" class="form-control" onchange="kategori()">
                                                            <option value="">-- Pilih Kategori --</option>
                                                            <?php foreach($kategori as $k) :?>
                                                                    <option value="<?= $k['id_kategori']?>"><?= $k['nama_kategori']?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                </div>
                                            </div>
                                            <div class="form-group" id="show">
                                                <div class="row col-lg">
                                                <input type="hidden" class="form-control" id="kode" name="id_kategori[]">
                                                    <div class="col-md-4">
                                                        <label for="" class="col-form-label">Nama Barang : </label>
                                                        <select name="id_barang[]" id="id_barang" class="form-control" onchange='pilih_barang()'>
                                                            <option value="">-- Pilih Barang --</option>
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
                                                        <button type="submit" class="btn btn-success tambah"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <Label>Status : </Label>
                                                    <input type="text" class="form-control" id="status" name="status" value="Dibeli" readonly>
                                                    <?= form_error('status', '<small class="text-danger pl-3">', '</small>');?>
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
                        </div>
                    </div>
                          
            <!-- End of Main Content -->

            <script>
                    $(document).ready(function(){
                        $(".tambah").click(function(e){
                            e.preventDefault();
                            $("#show").prepend(`<div class="row col-lg append_item">
                                                    <input type="hidden" class="form-control" id="kode" name="id_kategori[]">
                                                    <div class="col-md-4">
                                                        <label for="" class="col-form-label">Nama Barang : </label>
                                                        <select name="id_barang[]" id="id_barang" class="form-control" onchange='pilih_barang()'>
                                                            <option value="">-- Pilih Barang --</option>
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

                    $("#id_kategori").change(function(){
                        var id_kategori = $(this).val();
                        $.ajax({
                        url : "<?php echo base_url() ?>Transaksi/menampilkan_barang1",
                        data : {
                            id_kategori:id_kategori
                        },
                        type : 'post',
                        dataType : 'json',
                        success: function(data){
                            $('#id_barang').html(data);
                        }
                    });
                    });  
                });

                function kategori() {
                    var tes = document.getElementById("id_kategori").value;
                        document.getElementById("kode").value=tes;
                }


                function pilih_barang(){
                    var id_barang = $("#id_barang").val();
                    $.ajax({
                        url : "<?php echo base_url() ?>Transaksi/menampilkan_harga",
                        data : "id_barang=" + id_barang,
                        method : 'post',
                        dataType : 'json',
                        success: function(data){
                            $("#harga_satuan").val(data.harga_satuan);
                            $("#id_bar").val(data.id_barang);
                            $("#id_kat").val(data.id_kategori);
                        }
                    });
                }

                function transfer(){
                    var nama_jur = document.getElementById("metode");
                    if(nama_jur.value == 'Transfer'){
                    // document.getElementById("transferku").innerHTML= nama_jur.value;
                    document.getElementById("transferku").innerHTML= `<div class="row col-lg">
                                                    <div class="col-md-4">
                                                        <label for="" class="col-form-label">Atas Nama Rekening : </label>
                                                        <input type="text" class="form-control" id="nama_rekening" name="nama_rekening" readonly>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="" class="col-form-label">No Rekening : </label>
                                                        <input type="text" class="form-control" id="no_rekening" name="no_rekening" readonly>
                                                    </div>
                                                </div>`;
                    } else {
                        document.getElementById("transferku").innerHTML= ``;
                    }
                }

                function pilih_suplier(){
                    var id_suplier = $("#id_suplier").val();
                    $.ajax({
                        url : "<?php echo base_url() ?>Transaksi/menampilkandata",
                        data : "id_suplier=" + id_suplier,
                        method : 'post',
                        dataType : 'json',
                        success: function(data){
                            $("#nama_rekening").val(data.nama_rekening);
                            $("#no_rekening").val(data.no_rekening);
                        }
                    });
                }
                
            </script>