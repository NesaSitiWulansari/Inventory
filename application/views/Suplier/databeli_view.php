
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                        <a href="<?= base_url('Transaksi/pembelian')?>" class="btn btn-info"><i class="fa fa-arrow-circle-left text-white-50"></i> Kembali</a>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= $this->session->flashdata('message');?>                          
                        </div>
                    </div>

                     <!-- DataTales Example -->
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pembelian Barang</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>    
                                            <th>Nama Suplier</th>
                                            <th>Metode</th>
                                            <th>Tanggal Pembelian</th>
                                            <th>Status</th>
                                            <th>Bukti</th>
                                            <th>User</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach($beli as $b) :?>
                                            <tr class="text-center">
                                                <th scope="row"><?= $i; ?></th>
                                                    <td><?= $b['nama_sup']?></td>
                                                    <td><?= $b['metode']?></td>
                                                    <td><?= $b['tgl_pembelian']?></td>
                                                    <td><button class="btn btn-success btn-sm"><?= $b['status']?></button></td>
                                                    <td><a href="#"><?= $b['bukti']?></a></td>
                                                    <td><?= $b['name']?></td>
                                                    <td>
                                                        <a href="<?php echo base_url('Transaksi/detailbeli/'.$b['id_pembelian']) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                        <a href="<?php echo base_url('Transaksi/beli_ubah/'.$b['id_pembelian']) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="<?php echo base_url('Transaksi/beli_hapus/'.$b['id_pembelian']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                                    </td>
                                            </tr>
                                        <?php $i++; ?>                            
                                        <?php endforeach; ?>
                                    </tbody>
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

                    function transfer(){
                    var nama_jur = document.getElementById("metode").value
                    document.getElementById("transferku").innerHTML=`<div class="row col-lg">
                                                    <div class="col-md-6">
                                                        <label for="" class="col-form-label">Atas Nama Rekening : </label>
                                                        <input type="text" class="form-control" id="nama_rekening" name="nama_rekening" readonly>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="" class="col-form-label">No Rekening : </label>
                                                        <input type="text" class="form-control" id="no_rekening" name="no_rekening" readonly>
                                                    </div>
                                                </div>`;
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


           