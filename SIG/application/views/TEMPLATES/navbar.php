<style type="text/css">
    .dropbtn {
        height: 100%;
        /*background-color: #000000;*/

        color: black;
        padding: 16px;
        margin-left: 10px;
        margin-right: 10px;
        font-size: 16px;
        border: none;
        width: 90px;
    }

    .dropdown {
        border-left: 1px solid white;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #416270;
        color: white;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropdown {
        background-color: #007bff;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark " style=" background-color: white; position: fixed; width: 100%; padding-left: 0; z-index: 100;   font-family: Georgia, serif;">

<!-- <nav class="navbar navbar-expand-lg navbar-light " style=" position: fixed; width: 100%; padding-left: 0; z-index: 100; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.3); }"> -->

    <a class="navbar-brand" href="<?= base_url(''); ?>" style="margin-left: 20px; color: black; margin-right: 20px;">Home</a>
    <!--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button> -->
<!--     <div class="dropdown">
    <a href="<?php echo site_url('properti/index'); ?>">
        <button class="dropbtn">Properti
        </button>
    </a>
    </div> -->

     <div class="dropdown">
        <button class="dropbtn" disabled>Properti</button>
        <div class="dropdown-content">
            <a href="<?php echo site_url('properti/map'); ?>">Peta Properti</a>
            <a href="<?php echo site_url('properti/index'); ?>">Daftar Properti</a>
                <?php if (isset($user['ROLE'])) : ?>
                <?php if ($user['ROLE'] == 'Admin') : ?>
            <a href="<?php echo site_url('properti/add'); ?>">Tambah Properti</a>
                <?php endif;?>
                <?php endif;?>
        </div>
    </div>

    <?php if (isset($user['ROLE'])) : ?>
    <?php if ($user['ROLE'] == 'Admin') : ?>
    <div class="dropdown">
        <button class="dropbtn" disabled>User</button>
        <div class="dropdown-content">
            <a href="<?php echo site_url('user'); ?>">Daftar User</a>
            <a href="<?php echo site_url('user/add'); ?>">Tambah user</a>
        </div>
    </div>
    <?php endif;?>
    <?php endif;?>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="nav-item dropdown ml-auto">
                <?php if ($this->session->userdata('username')==NULL) : ?>
                    <a href="<?php echo site_url('user/login'); ?>" class="nav-link ">Login</a>
                <?php endif;?>
            <?php if ($this->session->userdata('username')!=NULL) : ?>
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration: none; margin-right: 70px; color: black;">
                <?= $this->session->userdata('username'); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <!-- <div class="dropdown-divider"></div> -->
                <a class="dropdown-item" href="<?= site_url('user/logout'); ?>"><img src="<?php echo base_url() . 'assets/image/logout.png' ?>" style="width: 15px;"><b> Logout</b></a>
            </div>
            <?php endif;?>
        </div>
    </div>
</nav>