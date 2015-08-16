<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>OpenDataZIS | Login</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" >
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/dist/css/font-awesome.min.css'); ?>" rel="stylesheet">  
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>" rel="stylesheet">        
        <!-- iCheck -->
        <link href="<?php echo base_url('assets/plugins/iCheck/flat/blue.css'); ?>" rel="stylesheet"> 

    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#" ><b>OpenData</b>ZIS</a>                
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Silahkan Login untuk Melanjutkan</p>
                <div class="social-auth-links text-center">
                    <a href="HAuth/login/Facebook" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Log in Mengggunakan Facebook</a>
                    <br>
                    <a href="HAuth/login/Twitter" class="btn btn-block btn-social btn-twitter btn-flat"><i class="fa fa-twitter"></i> Log in Mengggunakan Twitter</a>
                    <br>
                    <a href="HAuth/login/Google" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Log in Mengggunakan Google+</a>
                </div>
            </div>
        </div>

        <!-- jQuery 2.1.3 -->
        <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script> 
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script> 
        <!-- iCheck -->
        <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js'); ?>"></script>       
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>