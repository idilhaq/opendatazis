<div class="wrapper">
    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="../../index2.html" class="navbar-brand"><b>OpenData</b>ZIS</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Beranda <span class="sr-only">(current)</span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Keuangan Masjid</a></li>
                                <li><a href="#">Qurban</a></li>
                                <li><a href="#">Zakat</a></li>
                            </ul>
                        </li>
                        <li class="active"><a href="#">Peta Masjid</a></li>
                        <li class="active"><a href="#">Linked Data</a></li>
                        <li class="active"><a href="#">Petunjuk</a></li>
                        <li class="active"><a href="#">Tentang Kami</a></li>
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
                                <li><a href="#">Login</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Register</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                OpenDataZIS
                <small>Portal Informasi Keuangan Masjid, Qurban dan Zakat</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>23.053</h3>
                            <p>Laporan Diterima</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">Informasi Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>17.235</h3>
                            <p>Masjid Terdaftar</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">Informasi Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>3.596</h3>
                            <p>User Berpartisipasi</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">Cara Berpartisipasi <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>Get</h3>
                            <p>Linked Data</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">Download Linked Data <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            </div><!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-3">
                    <!-- Map box -->
                    <div class="box box-solid bg-light-blue-gradient">
                        <div class="box-header">
                            <!-- tools box -->
                            <h3 class="box-title">
                                Navigasi Data
                            </h3>
                        </div>
                        <div class="box-body">
                            <form action="<?php echo site_url('#'); ?>" method="post">
                                <?php
                                if (validation_errors() || $this->session->flashdata('result_login')) {
                                    ?>
                                    <div class="alert alert-error">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Warning!</strong>
                                        <?php echo validation_errors(); ?>
                                        <?php echo $this->session->flashdata('result_login'); ?>
                                    </div>    
                                <?php } ?>
                                <div class="form-group">
                                    <label>Pilih Provinsi</label>
                                    <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Kota/Kabupaten</label>
                                    <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Jenis Masjid</label>
                                    <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Tahun</label>
                                    <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Bulan</label>
                                    <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8">                      
                                    </div><!-- /.col -->
                                    <div class="col-xs-4">
                                        <center><button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button></center>
                                    </div><!-- /.col -->
                                </div>
                            </form>
                        </div><!-- /.box-body-->
                    </div>
                    <!-- /.box -->
                </section><!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-9">
                    <!-- Map box -->
                    <div class="box box-solid bg-light-blue-gradient">
                        <div class="box-header">
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range"><i class="fa fa-calendar"></i></button>
                                <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                            </div><!-- /. tools -->

                            <i class="fa fa-map-marker"></i>
                            <h3 class="box-title">
                                Peta Masjid
                            </h3>
                        </div>
                        <div class="box-body">
                            <div id="world-map" style="height: 400px; width: 100%;"></div>
                        </div><!-- /.box-body-->
                    </div>
                    <!-- /.box -->

                </section><!-- right col -->
            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
    </footer>
</div><!-- ./wrapper -->