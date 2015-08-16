<script type="text/javascript" src="<?php echo base_url('assets/rupiah.js'); ?>"></script>
<div class="wrapper">
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
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- small box -->
                            <div class="small-box bg-blue-gradient">
                                <div class="inner">
                                    <h3><?php echo $laporan; ?></h3>
                                    <p>Verified</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- small box -->
                            <div class="small-box bg-blue-gradient">
                                <div class="inner">
                                    <h3><?php echo $unverified; ?></h3>
                                    <p>Unverified</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Map box -->
                    <div class="box box-solid bg-green-gradient">
                        <div class="box-header">
                            <!-- tools box -->
                            <h3 class="box-title">
                                Informasi Masjid
                            </h3>
                        </div>
                        <div class="box-body">
                            <?php foreach ($user as $u): ?>   
                                <h5>Selamat Datang <?php echo $u->TAKMIR; ?></h5>
                                <p>Berikut adalah informasi terkait masjid Anda!</p>                            
                                <p>Nama Masjid : <?php echo $u->MASJID; ?></p>
                                <p>Alamat Masjid : <?php echo $u->ALAMAT; ?></p>
                                <p>Jenis Masjid : <?php echo $u->JENIS; ?></p>
                                <p>Kecamatan : <?php echo $u->KEC; ?></p>
                                <p>Kabupaten/Kota : <?php echo $u->KABKOTA; ?></p>
                                <p>Provinsi : <?php echo $u->PROV; ?></p>
                                <p>Lokasi : <?php echo $u->LAT . "," . $u->LONG; ?></p>                           
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
                <section class="col-lg-9">                    
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs pull-right ui-sortable-handle">
                            <li class="active"><a href="#pending" data-toggle="tab" aria-expanded="true">Pending</a></li>
                            <li><a href="#verified" data-toggle="tab" aria-expanded="false">Verified</a></li>
                            <li class="pull-left header"><i class="fa fa-list-alt"></i> Verifikasi Data Keuangan</li>
                        </ul>
                        <div class="tab-content no-padding">
                            <div class="chart tab-pane table-responsive no-padding active" id="pending" style="position: relative; width:100%; height: 432px;">
                                <div class="box-footer clearfix">
                                    <center>
                                        <?php echo $this->pagination->create_links(); ?>
                                    </center>
                                </div>
                                <?php
                                $template = array(
                                    'table_open' => '<table class="table table-hover"',
                                    'heading_cell_start' => '<th><center>',
                                    'heading_cell_end' => '</center></th>',
                                    'cell_start' => '<td><center>',
                                    'cell_end' => '</center></td>',
                                    'cell_alt_start' => '<td><center>',
                                    'cell_alt_end' => '</center></td>'
                                );
                                $this->table->set_template($template);

                                $this->table->set_heading(array('No', 'Pemasukan', 'Pengeluaran', 'Saldo', 'Minggu ke-', 'Bulan', 'Tahun', 'Status', 'Option'));
                                $page = $dari + 1;
                                foreach ($pending as $a) {
                                    $this->table->add_row(array($page, "Rp. ".number_format($a->PEMASUKAN, 0, ',', '.'), "Rp. ".number_format($a->PENGELUARAN, 0, ',', '.'), "Rp. ".number_format($a->SALDO, 0, ',', '.'), $a->MINGGU, $a->BULAN, $a->TAHUN, "<span class='label label-warning'>Pending</span>", "<button class='btn btn-block btn-info' data-toggle='modal' data-target='#mpending" . $a->ID_KEUANGAN . "'>Verify</button>"));
                                    ?>
                                    <div id="mpending<?php echo $a->ID_KEUANGAN; ?>" class="modal modal-warning">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <?php echo form_open('Validasi/verify/'.$a->ID_KEUANGAN); ?>
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Verifikasi Data Keuangan</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p><b>Kondisi Keuangan Minggu ke-<?php echo $a->MINGGU; ?> Bulan <?php echo $a->BULAN . " " . $a->TAHUN; ?></b></p>
                                                    <div class="form-group">
                                                        <label for="pemasukan">Pemasukan</label>
                                                        <input type="text" name="inputPemasukan" class="form-control" id="pemasukan" value="<?php echo number_format($a->PEMASUKAN, 0, ',', '.'); ?>"  onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pengeluaran">Pengeluaran</label>
                                                        <input type="text" name="inputPengeluaran" class="form-control" id="pengeluaran" value="<?php echo number_format($a->PENGELUARAN, 0, ',', '.'); ?>"  onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="saldo">Saldo</label>
                                                        <input type="text" name="inputSaldo" class="form-control" id="saldo" value="<?php echo number_format($a->SALDO, 0, ',', '.'); ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                                    </div>                                                    
                                                    <input type="hidden" name="inputMinggu" value="<?php echo $a->MINGGU; ?>">
                                                    <input type="hidden" name="inputBulan" value="<?php echo $a->BULAN; ?>">
                                                    <input type="hidden" name="inputTahun" value="<?php echo $a->TAHUN; ?>">
                                                    <input type="hidden" name="inputIDMasjid" value="<?php echo $a->ID_MASJID; ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">Verify</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $page++;
                                }
                                echo $this->table->generate();
                                ?>
                            </div>
                            <div class="chart tab-pane table-responsive no-padding" id="verified" style="position: relative; width:100%; height: 432px;">
                                <table class="table table-hover">
                                    <tbody><tr>
                                            <th><center>No</center></th>
                                            <th><center>Pemasukan</center></th>
                                            <th><center>Pengeluaran</center></th>
                                            <th><center>Saldo</center></th>
                                            <th><center>Minggu ke-</center></th>
                                            <th><center>Bulan</center></th>
                                            <th><center>Tahun</center></th>
                                            <th><center>Status</center></th>
                                            <th><center>Option</center></th>
                                        </tr>
                                        <?php $i = 1; ?>
                                        <?php foreach ($verified as $ver): ?>                                
                                            <tr>                                             
                                                <td align='center'><?php echo $i; ?></td>
                                                <td align='right'><?php echo "Rp. ".number_format($ver->PEMASUKAN, 0, ',', '.') ?></td>
                                                <td align='right'><?php echo "Rp. ".number_format($ver->PENGELUARAN, 0, ',', '.') ?></td>
                                                <td align='right'><?php echo "Rp. ".number_format($ver->SALDO, 0, ',', '.') ?></td>
                                                <td align='center'><?php echo $ver->MINGGU; ?></td>
                                                <td align='center'><?php echo $ver->BULAN; ?></td>
                                                <td align='center'><?php echo $ver->TAHUN; ?></td>                                        
                                                <td align='center'><span class="label label-success">Verified</span></td>                                                
                                                <td align='center'><button class="btn btn-block btn-info" data-toggle="modal" data-target="#myModal<?php echo $ver->ID_VERIFIED_KEUANGAN; ?>">Edit</button></td>
                                            </tr>

                                        <div id="myModal<?php echo $ver->ID_VERIFIED_KEUANGAN; ?>" class="modal modal-warning">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <?php echo form_open('Validasi/edit/'.$ver->ID_KEUANGAN); ?>
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Edit Data Keuangan</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><b>Kondisi Keuangan Minggu ke-<?php echo $ver->MINGGU; ?> Bulan <?php echo $ver->BULAN . " " . $ver->TAHUN; ?></b></p>
                                                        <div class="form-group">
                                                            <label for="pemasukan">Pemasukan</label>
                                                            <input type="text" name="inputPemasukan" class="form-control" id="pemasukan" value="<?php echo number_format($ver->PEMASUKAN, 0, ',', '.'); ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pengeluaran">Pengeluaran</label>
                                                            <input type="text" name="inputPengeluaran" class="form-control" id="pengeluaran" value="<?php echo number_format($ver->PENGELUARAN, 0, ',', '.'); ?>"  onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="saldo">Saldo</label>
                                                            <input type="text" name="inputSaldo" class="form-control" id="saldo" value="<?php echo number_format($ver->SALDO, 0, ',', '.'); ?>"  onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Edit</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> Beta
        </div>
        <strong>Copyright &copy; 2015 <a href="http://opendatazis.org">OpenDataZIS</a>.</strong> All rights reserved.
    </footer>
</div><!-- ./wrapper -->