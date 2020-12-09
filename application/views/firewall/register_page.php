<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>STC </title>
<link rel="stylesheet" href="<?=base_url('uploads/css/font.css')?>">
<link rel="stylesheet" href="<?=base_url('uploads/css/bootstrap.min.css')?>">
<link rel="stylesheet" href="<?=base_url('uploads/css/dataTables.bootstrap.min.css')?>">
<script src="<?=base_url('uploads/js/jquery-3.3.1.js')?>"></script>
<script src="<?=base_url('uploads/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('uploads/js/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('uploads/js/dataTables.bootstrap.min.js')?>"></script>
<script src="<?=base_url('uploads/js/jquery.form.min.js')?>"></script>
<style type="text/css">
	body {
        color: #999;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
	}
    .header {
        color: #434343;
        border-radius: 1px;
        background: #fff;
        border: 1px solid #f3f3f3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 10px;
    }
    .header-title {
        font-size: 20px;
        margin-left: 20px;
    }

    .register-form {
        width: 350px;
        margin: 0 auto;
        padding: 30px 0;
    }
    .register-form form {
        color: #434343;
        border-radius: 1px;
        margin-bottom: 15px;
        background: #fff;
        border: 1px solid #f3f3f3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .register-form h4 {
        text-align: center;
        font-size: 22px;
        margin-bottom: 20px;
    }
    .register-form .avatar {
        color: #fff;
        margin: 0 auto 30px;
        text-align: center;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        z-index: 9;
        background: #703081;
        padding: 15px;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }
    .register-form .avatar i {
        font-size: 62px;
    }
    .register-form .form-group {
        margin-bottom: 20px;
    }
    .register-form .form-control, .register-form .btn-stc {
        min-height: 40px;
        border-radius: 2px; 
        transition: all 0.5s;
    }
    .register-form .close {
        position: absolute;
        top: 15px;
        right: 15px;
    }
    .register-form .btn-stc {
        background: #703081;
        border: none;
        line-height: normal;
    }
    .register-form .btn-stc:hover, .register-form .btn-stc:focus {
        background: #5a1d6b;
    }
    .register-form .checkbox-inline {
        float: left;
    }
    .register-form input[type="checkbox"] {
        margin-top: 2px;
    }
    .register-form .forgot-link {
        float: right;
    }
    .register-form .small {
        font-size: 13px;
    }
    .register-form a {
        color: #703081;
    }
    .register-form .glyphicon.input-group-addon {
        top: 0px;
        border-top-left-radius: 2px;
        border-bottom-left-radius: 2px;
    }
    textarea {
        resize: none;
    }
</style>
<script type="text/javascript">
	$(document).ready(function(){
		
        $('#ipsrc-btn').click(function(){

        });

        $('#ipdest-btn').click(function(){

        });

        $('#porttcp-btn').click(function(){

        });

        $('#portudp-btn').click(function(){

        });

	});
</script>
</head>
<body>
    <div class="header">
	    <a href="<?=site_url('Firewall/connection')?>"><img src="<?=base_url('uploads/stc_logo.jpg')?>" style="width: 75px;"/></a>
	    <span class="header-title"><?=$this->config->item('app_name')?></span>
	</div>
	<div class="register-form">
        <form method="post" accept-charset="utf-8" action="<?=site_url('Firewall/register')?>">
            <div class="avatar"><span class="glyphicon glyphicon-fire" aria-hidden="true" style="font-size: 4.5em"></span></div>
            <h4 class="modal-title">Register New Firewall</h4>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <input type="text" id="firewall" name="firewall" class="form-control" placeholder="Firewall" required="required" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6">
                        <input type="text" id="port" name="port" class="form-control" placeholder="Port" required="required">
                    </div>
                    <div class="col-xs-6">
                        <input type="text" id="vdom" name="vdom" class="form-control" placeholder="Vdom">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <button type="button" id="ipsrc-btn" class="btn btn-primary btn-xs" style="margin-right: 5px;">{#IPSRC}</button>
                        <button type="button" id="ipdest-btn" class="btn btn-primary btn-xs">{#IPDEST}</button>
                    </div>
                    <div class="col-xs-12" style="margin-top: 5px;">
                        <button type="button" id="porttcp-btn" class="btn btn-primary btn-xs" style="margin-right: 5px;">{#PORTTCP}</button>
                        <button type="button" id="portudp-btn" class="btn btn-primary btn-xs">{#PORTUDP}</button>
                    </div>
                </div>
                
                
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <textarea class="form-control" name="setup_command_template" rows="4" placeholder="Your Setup Rule Template Command Here.."></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <textarea class="form-control" name="spesial_command_template" rows="4" placeholder="Your Spesial Command Template Here.."></textarea>
                    </div>
                </div>      
            </div>
            <?php if(isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <?=$error_message?>
            </div>
            <?php endif; ?>
            <button type="submit" name="submit" class="btn-stc btn btn-primary btn-block btn-lg" value="register">Register</button>              
        </form>
    </div>
</body>