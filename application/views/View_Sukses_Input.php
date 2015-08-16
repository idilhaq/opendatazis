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
                <li><a href="#"><i class="fa fa-dashboard"></i> Input Data Keuangan</a></li>
                <li class="active">Input Data</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <section class="col-lg-3"></section>
                <section class="col-lg-6">
                    <div class="box box-solid bg-light-blue-gradient">
                        <div class="box-header">
                            <h3 class="box-title">Konfirmasi Data Keuangan Kas Masjid</h3>
                        </div>
                        <div class="box-body">
                            <h4><center>Anda telah menginputkan data berikut:</center></h4>
                            <center>
                                <table>
                                    <tr style="font-size: 16px">
                                        <td>Nama Masjid</td>
                                        <td>: <?php echo $TEMP_MASJID; ?></td>
                                    </tr>
                                    <tr style="font-size: 16px">
                                        <td>Jenis Masjid</td>
                                        <td>: <?php echo $TEMP_JENIS; ?></td>
                                    </tr>
                                    <tr style="font-size: 16px">
                                        <td>Alamat Masjid</td>
                                        <td>: <?php echo $TEMP_ALAMAT; ?></td>
                                    </tr>
                                    <tr style="font-size: 16px">
                                        <td>Pemasukan</td>
                                        <td>: <?php echo $TEMP_PEMASUKAN; ?></td>
                                    </tr>
                                    <tr style="font-size: 16px">
                                        <td>Pengeluaran</td>
                                        <td>: <?php echo $TEMP_PENGELUARAN; ?></td>
                                    </tr>
                                    <tr style="font-size: 16px">
                                        <td>Saldo</td>
                                        <td>: <?php echo $TEMP_SALDO; ?></td>
                                    </tr>
                                </table>
                            </center>
                        </div>
                </section>
                <section class="col-lg-3"></section>
            </div>
        </section>
    </div>
</div>