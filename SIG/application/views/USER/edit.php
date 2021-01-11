<div class="row" style="background-color: #e3e4e6; min-height: 92vh;">
    <div class="col">
        <div class="container">
            <div class="row justify-content-center" style="margin-top: 100px;">
                <div class="col-lg-9">
                    <!-- FLASH MESSAGE -->
                    <?php if ($this->session->flashdata('message')) { ?>
                        <?php echo $this->session->flashdata('message') ?>
                    <?php } ?>
                    <!-- END FLASH MESSAGE -->
                    <div class="card o-hidden border-0 shadow-lg my-5" style="background-color: #fff;">
                        <div class="card-body pb-20">
                            <div class="row justify-content-center" style="margin-top: 20px;">
                                <div class="col-lg">
                                    <div class="text-center">
                                        <h2>Edit Akun</h2>
                                    </div>
                                    <form class="user" method="post" action="<?= base_url('auth/edit/' . $akun->USERNAME) ?>">
                                        <table style="margin-top: 20px; width: 100%">
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="username">Username</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                    <input type="text" name="username" placeholder="Username" class="form-control" value="<?php echo $akun->USERNAME ?>" readonly />
                                                    <small class="text-danger"><?php echo form_error('username') ?></small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="nama">Nama</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                    <input type="text" name="nama" placeholder="Program Kerja" class="form-control" value="<?php echo $akun->NAMA ?>" />
                                                    <small class="text-danger"><?php echo form_error('nama') ?></small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="role">Role</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                    <select class="form-control form-control-user" id="role" name="role" value="<?php echo $akun->ROLE ?>>
                                                        <option value=" IT FINANCE">IT FINANCE</option>
                                                        <option value="GROUP HEAD">GROUP HEAD</option>
                                                    </select>
                                                    <small class="text-danger"><?php echo form_error('role') ?></small>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="row mx-1" style="float:right; margin-top : 3%;">
                                            <div class="col">
                                                <button value="save" type="submit" class="btn btn-success">
                                                    Simpan
                                                </button>
                                            </div>
                                            <div class="col">
                                                <a href="<?php echo site_url("list"); ?>" s class="btn btn-secondary">
                                                    Batal
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>