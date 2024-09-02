

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title;?></h1>
                            <a href="<?= base_url('Master')?>" class="btn btn-info"><i class="fa fa-arrow-circle-left text-white-50"></i> Kembali</a>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            
                            <?= $this->session->flashdata('message');?>    
                            
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header bg-info text-white">Tambah Data Barang</div>
                            <div class="card-body">
                                <form class="form-horizontal" action="<?php echo base_url('Master/tambah')?>" method="post" enctype="multipart/form-data" role="form">
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Nama Barang : </label>
                                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang">
                                                    <?= form_error('nama_barang', '<small class="text-danger pl-3">', '</small>');?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <Label>Kategori Barang : </Label>
                                                        <select name="id_kategori" id="id_kategori" class="form-control" onchange="pilih_kategori()">
                                                            <option value="">-- Pilih Kategori --</option>
                                                            <?php foreach($kategori as $k) :?>
                                                            <option value="<?= $k['id_kategori']?>"><?= $k['nama_kategori']?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                </div>
                                            </div>
                                                    <input type="hidden" class="form-control" id="kode" name="kode_kategori">
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Stok : </label>
                                                    <input type="text" class="form-control" id="stok" name="stok">
                                                    <?= form_error('stok', '<small class="text-danger pl-3">', '</small>');?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Satuan : </label>
                                                    <input type="text" class="form-control" id="nama_satuan" name="nama_satuan">
                                                    <?= form_error('nama_satuan', '<small class="text-danger pl-3">', '</small>');?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg">
                                                    <label for="">Harga : </label>
                                                    <input type="text" class="form-control" id="harga_satuan" name="harga_satuan">
                                                    <?= form_error('harga_satuan', '<small class="text-danger pl-3">', '</small>');?>
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
                          
            <!-- End of Main Content -->

            <script>
                

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

                    function pilih_kategori(){
                    var id_kategori = $("#id_kategori").val();
                    $.ajax({
                        url : "<?php echo base_url() ?>Barang/menampilkan_kat",
                        data : "id_kategori=" + id_kategori,
                        method : 'post',
                        dataType : 'json',
                        success: function(data){
                            $("#kode").val(data.kode_kategori);
                        }
                    });
                    }

                
            </script>