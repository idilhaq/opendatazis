<script src="<?php echo base_url('assets/plugins/highcharts/exporting.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/highcharts/highcharts.js'); ?>"></script>
<script type="text/javascript">
    var options = {
        chart: {
            renderTo: 'grafik-kota',
            type: 'column'
        },
        title: {
            text: 'Data Keuangan Masjid',
            x: -20 //center
        },
        subtitle: {
            text: 'Perbandingan Rata-rata Keuangan Masjid per-Kota Bulan <?php echo $p_bulan; ?>',
            x: -20
        },
        xAxis: {
            categories: [],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah (Rp)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>Rp. {point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: []
    }
        series: []

    $.getJSON("<?php echo base_url(); ?>index.php/KeuanganMasjid/grafikKeuanganKota/<?php echo $p_prov; ?>/<?php echo $p_bulan; ?>", function (json) {
        options.xAxis.categories = json[0]['data'];
        options.series[0] = json[1];
        options.series[1] = json[2];
        options.series[2] = json[3];
        chart = new Highcharts.Chart(options);
    });

    var optionsBulan = {
        chart: {
            renderTo: 'grafik-bulan',
            type: 'column'
        },
        title: {
            text: 'Data Keuangan Masjid',
            x: -20 //center
        },
        subtitle: {
            text: 'Perbandingan Keuangan Masjid per-Bulan Bulan <?php echo $p_bulan; ?>',
            x: -20
        },
        xAxis: {
            categories: [],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah (Rp)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>Rp. {point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: []
    }

    $.getJSON("<?php echo base_url(); ?>index.php/KeuanganMasjid/grafikKeuanganBulan/<?php echo $p_prov; ?>/<?php echo $p_bulan; ?>", function (json) {
        optionsBulan.xAxis.categories = json[0]['data'];
        optionsBulan.series[0] = json[1];
        optionsBulan.series[1] = json[2];
        optionsBulan.series[2] = json[3];
        chart = new Highcharts.Chart(optionsBulan);
    });

    var optionsMinggu = {
        chart: {
            renderTo: 'grafik-minggu',
            type: 'column'
        },
        title: {
            text: 'Data Keuangan Masjid',
            x: -20 //center
        },
        subtitle: {
            text: 'Perbandingan Keuangan Masjid per-Minggu Bulan <?php echo $p_bulan; ?> Minggu ke-<?php echo $p_minggu; ?>',
            x: -20
        },
        xAxis: {
            categories: [],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah (Rp)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>Rp. {point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: []
    }

    $.getJSON("<?php echo base_url(); ?>index.php/KeuanganMasjid/grafikKeuanganMinggu/<?php echo $p_minggu; ?>/<?php echo $p_bulan; ?>/<?php echo $p_prov; ?>", function (json) {
        optionsMinggu.xAxis.categories = json[0]['data'];
        optionsMinggu.series[0] = json[1];
        optionsMinggu.series[1] = json[2];
        optionsMinggu.series[2] = json[3];
        chart = new Highcharts.Chart(optionsMinggu);
    });

    var optionsVerified = {
        chart: {
            renderTo: 'grafik-verified',
            type: 'column'
        },
        title: {
            text: 'Data Keuangan Masjid yang Terverifikasi',
            x: -20 //center
        },
        subtitle: {
            text: 'Perbandingan Keuangan Masjid yang Terverifikasi Bulan <?php echo $p_bulan; ?> Minggu ke-<?php echo $p_minggu; ?>',
            x: -20
        },
        xAxis: {
            categories: [],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah (Rp)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>Rp. {point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: []
    }

    $.getJSON("<?php echo base_url(); ?>index.php/KeuanganMasjid/grafikKeuanganVerified/<?php echo $p_minggu; ?>/<?php echo $p_bulan; ?>/<?php echo $p_prov; ?>", function (json) {
        optionsVerified.xAxis.categories = json[0]['data'];
        optionsVerified.series[0] = json[1];
        optionsVerified.series[1] = json[2];
        optionsVerified.series[2] = json[3];
        chart = new Highcharts.Chart(optionsVerified);
    });
</script>
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
                <li><a href="#"><i class="fa fa-dashboard"></i> Data</a></li>
                <li class="active">Keuangan Masjid</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">                
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
                            <?php echo form_open('KeuanganMasjid'); ?>                                
                            <div class="form-group">                                    
                                <label>Pilih Provinsi</label>
                                <select name="inputProvinsi" id="inputProvinsi" class="form-control">
                                    <option value="">Pilih Provinsi</option>
                                    <?php foreach ($provinsi as $prov): ?>
                                        <option value="<?php echo $prov->ID_PROVINSI; ?>" <?php echo set_select('inputProvinsi', $prov->ID_PROVINSI); ?> ><?php echo $prov->NAMA; ?></option>
                                    <?php endforeach; ?>
                                </select>                              
                            </div>
<!--                            <div class="form-group">
                                <label>Pilih Kota/Kabupaten</label>
                                <select name="inputKotaKab" id="inputKotaKab" class="form-control">
                                    <option value="">Pilih Kota/Kabupaten</option>
                                </select>                              
                            </div>-->
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
                    <div class="callout callout-success">
                        <center>
                            <h4>Sudahkah Keuangan Masjid di Sekitar Anda Dilaporkan disini?</h4>
                            <a href="<?php echo base_url(); ?>index.php/InputKas" class="small-box-footer">Yuk laporkan keuangan masjid di sekitar kamu sekarang! <i class="fa fa-arrow-circle-right"></i></a>
                        </center>
                    </div>
                </section>
                <section class="col-lg-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs pull-right ui-sortable-handle">
                            <li class="active"><a href="#grafik-kota" data-toggle="tab" aria-expanded="true">Kota</a></li>
                            <li><a href="#grafik-bulan" data-toggle="tab" aria-expanded="false">Bulan</a></li>
                            <li><a href="#grafik-minggu" data-toggle="tab" aria-expanded="false">Minggu</a></li>
                            <li><a href="#grafik-verified" data-toggle="tab" aria-expanded="false">Verified Data</a></li>
                            <li class="pull-left header"><i class="fa fa-inbox"></i> Grafik Keuangan Kas Masjid</li>
                        </ul>
                        <div class="tab-content no-padding">
                            <div class="chart tab-pane active" id="grafik-kota" style="position: relative; width:100%; height: 400px;"></div>
                            <div class="chart tab-pane" id="grafik-bulan" style="position: relative; width:72.5%; height: 400px;"></div>
                            <div class="chart tab-pane" id="grafik-minggu" style="position: relative; width:72.5%; height: 400px;"></div>
                            <div class="chart tab-pane" id="grafik-verified" style="position: relative; width:72.5%; height: 400px;"></div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
</div>