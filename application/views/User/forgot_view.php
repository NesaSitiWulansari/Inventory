

    

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
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="<?= base_url('User/change'); ?>" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Password Saat Ini">
                                        <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="new_password1" name="new_password1" placeholder="Password Baru">
                                        <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="Ulangi Password Baru">
                                        <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-info">Change Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                </div>
            <!-- End of Main Content -->

            

