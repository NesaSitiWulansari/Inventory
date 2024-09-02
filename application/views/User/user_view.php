

    

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                        
                    </div>
                    

                    <!-- Content Row -->
                    <div class="row">
                                    <div class="col-lg-6">
                                        <?= $this->session->flashdata('message'); ?>
                                    </div>
                                </div>
                    <div class="row">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?= base_url('assets/img/') . $login['image'];?>" class="img-fluid rounded-start" >
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $login['name']; ?></h5>
                                        <p class="card-text">Email : <?= $login['email']; ?></p>
                                        <p class="card-text">Jenis Kelamin : <?= $login['jenkel']; ?></p>
                                        <p class="card-text">Alamat : <?= $login['alamat']; ?></p>
                                        <p class="card-text">No Hp : <?= $login['no_hp']; ?></p>
                                        <?php foreach($role as $r):?>
                                            <?php if($r['id'] == $login['role_id']):?>
                                                <p class="card-text"><small class="text-body-secondary"><?= $r['role'];?> since <?= date('d F Y', $login['date_created']);?></small></p>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>
                </div>
            <!-- End of Main Content -->

            

