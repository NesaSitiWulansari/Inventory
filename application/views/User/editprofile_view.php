
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-8">
                            <?= form_open_multipart('User/edit'); ?>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email" name="email" value="<?= $login['email']?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $login['name']?>">
                                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $login['alamat']?>">
                                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">No Handphone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $login['no_hp']?>">
                                        <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <?php if($login['jenkel'] == 'Laki-Laki') : ?>    
                                                    <input type="radio" class="" value="Laki-Laki" id="jenkel" name="jenkel" checked>
                                                    <label for="jenkel">Laki-Laki</label>
                                                <?php else : ?>
                                                    <input type="radio" class="" value="Laki-Laki" id="jenkel" name="jenkel">
                                                    <label for="jenkel">Laki-Laki</label>
                                                <?php endif ?>

                                                <?php if($login['jenkel'] == 'Perempuan') : ?>    
                                                    <input type="radio" class="" value="Perempuan" id="jenkel" name="jenkel" checked>
                                                    <label for="jenkel">Perempuan</label>
                                                <?php else : ?>
                                                    <input type="radio" class="" value="Perempuan" id="jenkel" name="jenkel">
                                                    <label for="jenkel">Perempuan</label>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                </div>
                                <div class="form-group row">
                                <div class="col-sm-2">Gambar</div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <img src="<?= base_url('assets/img/'). $login['image']; ?>" class="img-thumbnail">
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="costum-file">
                                                    <input type="file" class="custom-file-input" id="image" name="image">
                                                    <label for="image" class="custom-file-label"><?= $login['image']?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-info">Ubah</button>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>

                </div>
            <!-- End of Main Content -->

            

