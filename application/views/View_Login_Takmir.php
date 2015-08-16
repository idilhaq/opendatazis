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
                <?php
                echo form_open('LoginTakmir/loginTakmir');
                    if (validation_errors() || $this->session->flashdata('result_login')) {
                        ?>
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Warning!</strong>
                            <?php echo validation_errors(); ?>
                            <?php echo $this->session->flashdata('result_login'); ?>
                        </div>    
                    <?php } ?>
                    <div class="form-group has-feedback">
                        <input type="text" name="username" class="form-control" placeholder="Username"/>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">    
                            <div class="checkbox icheck">
                                <label>
                                    <a href="">Daftar sebagai Takmir!</a>
                                </label>
                            </div>                        
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div><!-- /.col -->
                    </div>
                </form>
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