<body class="bg-gradient-primary">

    <div class="container" style="margin-top: 100px;">

        <?php if ($this->session->flashdata('message')) { ?>
            <?php echo $this->session->flashdata('message') ?>
        <?php } ?>

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-7 col-lg-7 col-md-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Ubah password</h1>
                                    </div>
                                    <form class="user" method="post" action="<?= base_url('auth/changePassword') ?>">
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Masukkan password baru">
                                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi password">
                                            <!-- <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?> -->
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Ubah password
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>