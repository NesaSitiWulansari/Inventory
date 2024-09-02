

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title;?></h1>
                        <?php foreach($beli as $b):?>
                            <a href="<?= base_url('Transaksi/detailbeli/'.$b['id_pembelian'])?>" class="btn btn-info"><i class="fa fa-arrow-circle-left text-white-50"></i> Kembali</a>
                            
                            <?php endforeach; ?>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            
                            <?= $this->session->flashdata('message');?>    
                            
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header bg-info text-white">Tambah Detail Data Pembelian</div>
                            <div class="card-body">
                            <?php foreach($beli as $b):?>
                                <form class="form-horizontal" action="<?php echo base_url('Transaksi/tambahdetailbeli/'.$b['id_pembelian'])?>" method="post" enctype="multipart/form-data" role="form">
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">ID : </label>
                                                    <input type="text" class="form-control" id="id_pembelian" name="id_pembelian" value="<?= $b['id_pembelian']?>" readonly>
                                                </div>
                                            </div>
                                            <?php endforeach;?>
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
                });

                function pilih_barang(){
                    var id_barang = $("#id_barang").val();
                    $.ajax({
                        url : "<?php echo base_url() ?>Transaksi/menampilkan_harga",
                        data : "id_barang=" + id_barang,
                        method : 'post',
                        dataType : 'json',
                        success: function(data){
                            $("#harga_satuan").val(data.harga_satuan);
                    
                        }
                    });
                }

                    function kategori() {
                    var tes = document.getElementById("id_kategori").value;
                        document.getElementById("kode").value=tes;
                }

                    
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
                
            </script>