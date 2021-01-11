<body class="bg-gradient-primary">

    <div class="container" style="margin-top: 100px;">

        <?php if ($this->session->flashdata('message')) { ?>
            <?php echo $this->session->flashdata('message') ?>
        <?php } ?>

        <!-- <?php echo validation_errors(); ?> -->
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
                                        <h1 class="h4 text-gray-900 mb-4">Lupa password?</h1>
                                    </div>
                                    <form class="user" method="post" action="<?= base_url('forgot-password') ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="row">
                                        <div class="col table-option-row">
                                            <a href="<?= base_url('login') ?>">Back to Login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>