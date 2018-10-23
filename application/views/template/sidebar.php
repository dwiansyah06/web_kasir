<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="<?= base_url().'dashboard' ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <?php if($this->session->userdata('level') == 'pelayan'){ ?>
            <li>
                <a href="<?= base_url().'pelayan/menu' ?>"><i class="fa fa-archive fa-fw"></i> Daftar Menu</a>
            </li>
            <li>
                <a href="<?= base_url().'pelayan/laporan/' ?>"><i class="fa fa-file-text-o fa-fw"></i> Laporan</a>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>