

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title;?></h1>
                        <?php foreach($beli as $b):?>
                            <a href="<?= base_url('Transaksi/databeli')?>" class="btn btn-info"><i class="fa fa-arrow-circle-left text-white-50"></i> Kembali</a>
                            
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            
                            <?= $this->session->flashdata('message');?>    
                            
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header bg-info text-white">Ubah Data Pembelian</div>
                            <div class="card-body">
                                <form class="form-horizontal" action="<?php echo base_url('Transaksi/beli_ubah/'.$b['id_pembelian'])?>" method="post" enctype="multipart/form-data" role="form">
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">ID : </label>
                                                    <input type="text" class="form-control" id="id_pembelian" name="id_pembelian" value="<?= $b['id_pembelian']?>" readonly>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Tanggal Pembelian : </label>
                                                    <input type="date" class="form-control" id="tgl_pembelian" name="tgl_pembelian" value="<?= $b['tgl_pembelian']?>" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="" class="col-form-label">Metode : </label>
                                                    <select name="metode" id="metode" class="form-control" onchange="transfer()">
                                                        <option value="Tunai" class="">Tunai</option>
                                                        <option value="Transfer" class="">Transfer</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group" id="transferku" name="transferku">
                                                
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="" class="col-form-label">Nama Suplier : </label>
                                                    <select name="id_suplier" id="id_suplier" class="form-control" onchange="pilih_suplier()" >
                                                        <?php foreach ($suplier as $s) : ?>
                                                            <option value="<?= $s['id_suplier'];?>" class=""><?= $s['nama_sup'];?></option>
                                                        <?php endforeach; ?>
                                                    </select>
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