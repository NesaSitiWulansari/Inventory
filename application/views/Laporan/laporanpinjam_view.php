
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                             
                            <?= $this->session->flashdata('message');?>    
                            
                        </div>
                    </div>

                     <!-- DataTales Example -->
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Peminjaman Barang</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>    
                                            <th>Nama</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Tanggal Kembali</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach($pinjam as $p) :?>
                                            <tr class="text-center">
                                                <th scope="row"><?= $i; ?></th>
                                                    <td><?= $p['name']?></td>
                                                    <td><?= $p['tgl_pinjam']?></td>
                                                    <td><?= $p['tgl_kembali']?></td>
                                                    <td><?= $p['keterangan']?></td>
                                                    <td><?php if ($p['status'] == 'Pending') : ?>
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myEditModal<?= $p['id_p']?>"><?= $p['status']?></button>
                                                        <?php else :?>    
                                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myEditModal<?= $p['id_p']?>"><?= $p['status'] ?></button>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('Laporan/pdfpinjam/'.$p['id_p'])?>" type="button" class="btn btn-info btn-sm"><i class="fas fa-download"></i></a>
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


           