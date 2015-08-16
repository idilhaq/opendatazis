<?php echo $map['js']; ?>
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
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo $jml_laporan; ?></h3>
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
                            <h3><?php echo $jml_masjid; ?></h3>
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
                            <h3><?php echo $jml_user; ?></h3>
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
                </div>
            </div>
            <div class="row">
                <section class="col-lg-3">
                    <div class="callout callout-success">
                        <center>
                            <h4>Takmir?</h4>
                            <a href="<?php echo base_url(); ?>index.php/Validasi" class="small-box-footer">Cek Keuangan Masjid Anda! <i class="fa fa-arrow-circle-right"></i></a>
                        </center>
                    </div>
                </section>
                <section class="col-lg-9">
                    <div class="callout callout-success">
                        <center>
                            <h4>Sudahkah Keuangan Masjid di Sekitar Anda Dilaporkan disini?</h4>
                            <a href="<?php echo base_url(); ?>index.php/InputKas" class="small-box-footer">Yuk laporkan keuangan masjid di sekitar kamu sekarang! <i class="fa fa-arrow-circle-right"></i></a>
                        </center>
                    </div>
                </section>
            </div>
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
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#inputProvinsi").change(function () {
                                        /*dropdown post *///  
                                        $.ajax({
                                            url: "<?php echo base_url(); ?>index.php/Home/getKabKota",
                                            data: {id_prov: $(this).val()},
                                            type: "POST",
                                            success: function (data) {
                                                $("#inputKotaKab").html(data);
                                            }
                                        });
                                    });
                                });
                            </script>
                            <?php echo form_open('Home'); ?> 
                            <div class="form-group">
                                <label>Pilih Informasi</label>
                                <select name="inputInfo" class="form-control">
                                    <option value="10pemasukanterbesar" <?php echo set_select('inputInfo', "10pemasukanterbesar"); ?> >Top 10 Masjid dengan Jumlah Pemasukan Terbesar</option>
                                    <option value="10pengeluaranterbesar" <?php echo set_select('inputInfo', "10pengeluaranterbesar"); ?> >Top 10 Masjid dengan Jumlah Pengeluaran Terbesar</option>
                                    <option value="10saldoterbesar" <?php echo set_select('inputInfo', "10saldoterbesar"); ?> >Top 10 Masjid dengan Jumlah Saldo Terbesar</option>
                                    <option value="10pemasukanterkecil" <?php echo set_select('inputInfo', "10pemasukanterkecil"); ?> >Top 10 Masjid dengan Jumlah Pemasukan Terkecil</option>
                                    <option value="10pengeluaranterkecil" <?php echo set_select('inputInfo', "10pengeluaranterkecil"); ?> >Top 10 Masjid dengan Jumlah Pengeluaran Terkecil</option>
                                    <option value="10saldoterkecil" <?php echo set_select('inputInfo', "10saldoterkecil"); ?> >Top 10 Masjid dengan Jumlah Saldo Terkecil</option>
                                </select>
                            </div>                               
                            <div class="form-group">                                    
                                <label>Pilih Provinsi</label>
                                <select name="inputProvinsi" id="inputProvinsi" class="form-control">
                                    <option value="">Pilih Provinsi</option>
                                    <?php foreach ($provinsi as $prov): ?>
                                        <option value="<?php echo $prov->ID_PROVINSI; ?>"><?php echo $prov->NAMA; ?></option>
                                    <?php endforeach; ?>
                                </select>                              
                            </div>
                            <div class="form-group">
                                <label>Pilih Kota/Kabupaten</label>
                                <select name="inputKotaKab" id="inputKotaKab" class="form-control">
                                    <option value="">Pilih Kota/Kabupaten</option>
                                </select>                              
                            </div>
                            <div class="form-group">
                                <label>Pilih Tahun</label>
                                <select name="inputTahun" class="form-control">
                                    <option value="">Pilih Tahun</option>
                                    <?php foreach ($tahun as $t): ?>
                                        <option value="<?php echo $t->TAHUN; ?>" <?php echo set_select('inputTahun', $t->TAHUN); ?> ><?php echo $t->TAHUN; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Pilih Bulan</label>
                                <select name="inputBulan" class="form-control">
                                    <option value="">Pilih Bulan</option>
                                    <?php foreach ($bulan as $b): ?>
                                        <option value="<?php echo $b->BULAN; ?>" <?php echo set_select('inputBulan', $b->BULAN); ?> ><?php echo $b->BULAN; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Pilih Minggu</label>
                                <select name="inputMinggu" class="form-control">
                                    <option value="">Pilih Minggu</option>
                                    <option value="1" <?php echo set_select('inputMinggu', "1"); ?> >1</option>
                                    <option value="2" <?php echo set_select('inputMinggu', "2"); ?> >2</option>
                                    <option value="3" <?php echo set_select('inputMinggu', "3"); ?> >3</option>
                                    <option value="4" <?php echo set_select('inputMinggu', "4"); ?> >4</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <center><button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button></center>
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
                                Peta Masjid - <?php echo $info; ?>
                            </h3>
                        </div>
                        <div class="box-body">
                            <!--<div id="world-map" style="height: 400px; width: 100%;"></div>-->
                            <?php echo $map['html']; ?>
                        </div><!-- /.box-body-->
                    </div>
                    <!-- /.box -->

                </section><!-- right col -->
            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> Beta
        </div>
        <strong>Copyright &copy; 2015 <a href="http://opendatazis.org">OpenDataZIS</a>.</strong> All rights reserved.
    </footer>
</div><!-- ./wrapper -->