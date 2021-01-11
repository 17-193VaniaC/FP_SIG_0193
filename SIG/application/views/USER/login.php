<body>
    <div class="container" style="margin-top: 100px; font-family: Georgia, serif; ">
        <?php if ($this->session->flashdata('message')) { ?>
            <?php echo $this->session->flashdata('message') ?>
        <?php } ?>
        <?php echo validation_errors(); ?>
        <div class="row justify-content-center ">
            <div class="col-xl-7 col-lg-7 col-md-7">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5 bg-light text-black">
                                    <div class="text-center">
                                        <h1 class="h4 text-black-900 mb-4">L O G I N</h1>
                                    </div>
                                    <form class="user" method="post" action="<?= site_url('login') ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= set_value('username') ?>">
                                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block ">
                                            LOGIN
                                        </button>
                                    </form><br>
                                    <div class="row" style="text-align: center;">
                                        <div class="col table-option-row">
                                            <a href="<?= base_url('forgot-password') ?>">Lupa Password</a>
                                            <p>Belum punya akun? <a href="<?php echo site_url('user/add'); ?>">Daftar di sini</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>