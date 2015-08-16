<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="<?php echo base_url(); ?>index.php/Home" class="navbar-brand"><b>OpenData</b>ZIS</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo base_url(); ?>index.php/Home">Beranda <span class="sr-only">(current)</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="<?php echo base_url(); ?>index.php/KeuanganMasjid">Keuangan Masjid</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url(); ?>index.php/InputKas">Input Data</a></li>
                                </ul>
                            </li>                            
                            <li><a href="#">Qurban</a></li>
                            <li><a href="#">Zakat</a></li>
                        </ul>
                    </li>
                    <li class="active"><a href="<?php echo base_url(); ?>index.php/PetaMasjid">Peta Masjid</a></li>
                    <li class="active"><a href="<?php echo base_url(); ?>index.php/LinkedData">Linked Data</a></li>
                    <li class="active"><a href="<?php echo base_url(); ?>index.php/Petunjuk">Petunjuk</a></li>
                    <li class="active"><a href="<?php echo base_url(); ?>index.php/Tentang">Tentang Kami</a></li>
                </ul>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                    </div>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">User <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo base_url(); ?>index.php/Login">Login</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>