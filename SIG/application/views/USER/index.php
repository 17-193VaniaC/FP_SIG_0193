<br>
<div class="container-xl" style="margin-top: 50px; padding: 25px;">
    <?php if ($this->session->flashdata('message')) { ?>
        <?php echo $this->session->flashdata('message') ?>
    <?php }
    if (!empty($this->session->flashdata('search_user'))) {
        empty($this->session->set_flashdata(array('search_user' => $search)));
    }
    ?>
    <!-- <div class="container-xl"> -->
    <div class="container-half">
        <h2><a href="<?= base_url('list'); ?>" style="text-decoration: none; color: black;">Daftar <b>Akun</b></a></h2>
        <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
            <p> <a href="<?= base_url('register'); ?>" class="btn btn-success">+ Tambah Akun</a></p>
        <?php endif; ?>
    </div>
    <div class="container-half right">
        <div class="form-group">
            <form method="post" action="<?php echo site_url('auth/seeAllUser') ?>" class="form-inline" style="float: right;">
                <input type="text" placeholder="Cari Username" name="searchById" id="searchById" class="form-control" style="width: auto; " />
                <span class=" input-group-btn">
                    <input type="submit" name="Search" class="btn btn-primary" value="Cari" />
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <div class="table-wrapper">
            <table class="table table-striped table-hover table-bordered">
                <thead style="background-color: #204d95; color: white;">
                    <tr class="text-center">
                        <td style="width: 25%">Username</td>
                        <td style="width: 25%">Nama</td>
                        <td style="width: 20%">Email</td>
                        <td style="width: 20%">Role</td>
                        <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
                            <td>Opsi</td>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <div id="result"></div>
                    <?php foreach ($list as $row) : ?>
                        <tr>
                            <td><?= $row->USERNAME ?></td>
                            <td><?= $row->NAMA ?></td>
                            <td><?= $row->EMAIL ?></td>
                            <td><?= $row->ROLE ?></td>
                            <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
                                <td class="table-option-row">
                                    <div class="btn-group">
                                        <!-- <a href="<?php echo site_url('auth/edit/' . $row->USERNAME); ?>"><button class="btn btn-info">Edit</button></a> -->
                                        <a href="<?php echo site_url('auth/delete/' . $row->USERNAME); ?>" style="margin-left: 3px;"><button class="btn btn-danger">Hapus</button></a>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if ($pagination) : ?>
        <div class="row">
            <div class="col">
                <!--Tampilkan pagination-->
                <?php echo $pagination; ?>
            </div>
        </div>
    <?php endif; ?>
</div>