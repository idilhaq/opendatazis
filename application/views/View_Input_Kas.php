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
                            x: - 20 //center
                    },
                    subtitle: {
                    text: 'Perbandingan Keuangan Masjid per-Kota',
                            x: - 20
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

    $.getJSON("<?php echo base_url(); ?>index.php/InputKas/grafikKeuanganKota", function (json) {
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
                            x: - 20 //center
                    },
                    subtitle: {
                    text: 'Perbandingan Keuangan Masjid per-Bulan',
                            x: - 20
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

    $.getJSON("<?php echo base_url(); ?>index.php/InputKas/grafikKeuanganBulan", function (json) {
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
                            x: - 20 //center
                    },
                    subtitle: {
                    text: 'Perbandingan Keuangan Masjid per-Minggu',
                            x: - 20
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

    $.getJSON("<?php echo base_url(); ?>index.php/InputKas/grafikKeuanganMinggu", function (json) {
    optionsMinggu.xAxis.categories = json[0]['data'];
            optionsMinggu.series[0] = json[1];
            optionsMinggu.series[1] = json[2];
            optionsMinggu.series[2] = json[3];
            chart = new Highcharts.Chart(optionsMinggu);
    });
            var el = document.getElementById('myCoolForm');
            el.addEventListener('submit', function () {
            return confirm('Are you sure you want to submit this form?');
            }, false);</script> 
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
                <li><a href="#"><i class="fa fa-dashboard"></i> Keuangan Masjid</a></li>
                <li class="active">Input Data Keuangan</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <section class="col-lg-12">
                    <?php echo validation_errors(); ?>
                    <?php echo $sukses; ?>
                </section>
            </div>
            <div class="row">
                <section class="col-lg-3">
                    <div class="box box-solid bg-light-blue-gradient">
                        <div class="box-header">
                            <h3 class="box-title">
                                Input Data Keuangan Kas Masjid
                            </h3>
                        </div>
                        <div class="box-body">
<?php
$attributes = array('onsubmit' => "return confirm('Apakah data yang Anda masukkan sudah benar?')");
echo form_open('InputKas', $attributes);
?>
                            <div class="form-group">
                                <script type="text/javascript">
                                            $(document).ready(function () {
                                    $("#inputProvinsi").change(function () {
                                    /*dropdown post *///  
                                    $.ajax({
                                    url: "<?php echo base_url(); ?>index.php/InputKas/getKabKota",
                                            data: {id_prov: $(this).val()},
                                            type: "POST",
                                            success: function (data) {
                                            $("#inputKotaKab").html(data);
                                            }
                                    });
                                    });
                                            $("#inputKotaKab").change(function () {
                                    /*dropdown post *///  
                                    $.ajax({
                                    url: "<?php echo base_url(); ?>index.php/InputKas/getKec",
                                            data: {id_kabkota: $(this).val()},
                                            type: "POST",
                                            success: function (data) {
                                            $("#inputKecamatan").html(data);
                                            }
                                    });
                                    });
                                    });                                </script>
                                <script type="text/javascript">
                                            $(function () {
                                            $.ajax({
                                            url: "<?php echo base_url(); ?>index.php/InputKas/GetNamaMasjid",
                                                    data: {id: 1},
                                                    dataType: "json",
                                                    success: function (response) {
                                                    var data = $(response).map(function () {
                                                    return {id: this.ID_MASJID, value: this.NAMA};
                                                    }).get();
                                                            $('#namaMasjid').autocomplete({
                                                    source: data,
                                                            minLength: 3
                                                    });
                                                    }
                                            });
                                            });                                </script>
                                <script type="text/javascript" src="<?php echo base_url('assets/rupiah.js'); ?>"></script>
                                <label>Pilih Provinsi</label>
                                <select name="inputProvinsi" id="inputProvinsi" class="form-control">
<?php foreach ($provinsi as $prov): ?>
                                        <option value="<?php echo $prov->ID_PROVINSI; ?>"><?php echo $prov->NAMA; ?></option>
<?php endforeach; ?>
                                </select>
                                <label>Pilih Kota/Kabupaten</label>
                                <select name="inputKotaKab" id="inputKotaKab" class="form-control">
                                    <option value="">Pilih Kota/Kabupaten</option>
                                </select>
                                <label>Pilih Kecamatan</label>
                                <select name="inputKecamatan" id="inputKecamatan" class="form-control">
                                    <option value="">Pilih Kecamatan</option>
                                </select>                                
                            </div>
                            <div class="form-group">
                                <label>Pilih Jenis Masjid</label>
                                <select name="inputJenis" class="form-control">
                                    <option>Masjid Raya</option>
                                    <option>Masjid Agung</option>
                                    <option>Masjid Besar</option>
                                    <option>Masjid Jami</option>
                                    <option>Masjid Bersejarah</option>
                                    <option>Masjid di Tempat Publik</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="namaMasjid">Nama Masjid</label>
                                <input type="text" name="inputNamaMasjid" class="form-control" id="namaMasjid" placeholder="Nama Masjid">
                            </div>
                            <div class="form-group">
                                <label for="AlamatMasjid">Alamat Masjid</label>
                                <textarea type="text" name="inputAlamatMasjid" class="form-control" id="alamatMasjid" placeholder="Alamat Masjid"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pemasukan">Pemasukan</label>
                                <input type="text" name="inputPemasukan" class="form-control" id="pemasukan" placeholder="Pemasukan Masjid Minggu Ini" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                            </div>
                            <div class="form-group">
                                <label for="pengeluaran">Pengeluaran</label>
                                <input type="text" name="inputPengeluaran" class="form-control" id="pengeluaran" placeholder="Pengeluaran Masjid Minggu Ini" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this); >
                                                    < /div>
                                                    < div class ="form-group">
                                       <label for="saldo">Saldo</label>
                                <input type="text" name="inputSaldo" class="form-control" id="saldo" placeholder="Saldo Terakhir Masjid" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this); >
                                                    < /div>
                                                    < div class ="form-group">
                                       <center><button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button></center>
                            </div>
                            </form>
                        </div>
                    </div>
                </section>
                <section class="col-lg-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs pull-right ui-sortable-handle">
                            <li class="active"><a href="#preview" data-toggle="tab" aria-expanded="true">Kota</a></li>
                            <li><a href="#grafik-bulan" data-toggle="tab" aria-expanded="false">Bulan</a></li>
                            <li><a href="#grafik-minggu" data-toggle="tab" aria-expanded="false">Minggu</a></li>
                            <li class="pull-left header"><i class="fa fa-inbox"></i> Grafik Keuangan Kas Masjid</li>
                        </ul>
                        <div class="tab-content no-padding">
                            <div class="chart tab-pane active" id="grafik-kota" style="position: relative; width:100%; height: 400px;"></div>
                            <div class="chart tab-pane" id="grafik-bulan" style="position: relative; width:72.5%; height: 400px;"></div>
                            <div class="chart tab-pane" id="grafik-minggu" style="position: relative; width:72.5%; height: 400px;"></div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
</div>