<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>STC </title>
<link rel="stylesheet" href="<?=base_url('assets/css/font.css')?>">
<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css')?>">
<link rel="stylesheet" href="<?=base_url('assets/css/dataTables.bootstrap.min.css')?>">
<script src="<?=base_url('assets/js/jquery-3.3.1.js')?>"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/js/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('assets/js/dataTables.bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/js/jquery.form.min.js')?>"></script>
<style type="text/css">
	body {
        color: #999;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
	}
    .form-control {
        box-shadow: none;
        border-color: #ddd;
    }
    .form-control:focus {
        border-color: #4aba70; 
    }
    .btn-stc {
        background: #703081;
        border: none;
        line-height: normal;
    }
    .btn-stc:hover, .btn-stc:focus {
        background: #5a1d6b;
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
        width: 500px;
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

		var lastTextAreaFocused;

        $("textarea").focus(function() {
            lastTextAreaFocused = $(this);
        });

        $("textarea.spesial-address-command").focus(function() {
            lastTextAreaSpesialAddressCmdFocused = $(this);
        });

        $("textarea.spesial-port-command").focus(function() {
            lastTextAreaSpesialPortCmdFocused = $(this);
        });

        $('#btn-reqnum').click(function(){
            var area   = $('#txtarea-setup-template');
            var curPos = area.prop('selectionEnd');
            area.val( area.val().substring(0, curPos) + '{#REQNUM}' + area.val().substring(curPos) ).focus().prop({'selectionStart': curPos+9, 'selectionEnd': curPos+9});
        });

        $('#btn-ipsrc').click(function(){
            var area   = lastTextAreaFocused;
            var curPos = area.prop('selectionEnd');
            area.val( area.val().substring(0, curPos) + '{#IPSRC}' + area.val().substring(curPos) ).focus().prop({'selectionStart': curPos+8, 'selectionEnd': curPos+8});
        });

        $('#btn-ipdest').click(function(){
            var area   = lastTextAreaFocused;
            var curPos = area.prop('selectionEnd');
            area.val( area.val().substring(0, curPos) + '{#IPDEST}' + area.val().substring(curPos) ).focus().prop({'selectionStart': curPos+9, 'selectionEnd': curPos+9});
        });

        $('#btn-porttcp').click(function(){
            var area   = lastTextAreaFocused;
            var curPos = area.prop('selectionEnd');
            area.val( area.val().substring(0, curPos) + '{#PORTTCP}' + area.val().substring(curPos) ).focus().prop({'selectionStart': curPos+10, 'selectionEnd': curPos+10});
        });

        $('#btn-portudp').click(function(){
            var area   = lastTextAreaFocused;
            var curPos = area.prop('selectionEnd');
            area.val( area.val().substring(0, curPos) + '{#PORTUDP}' + area.val().substring(curPos) ).focus().prop({'selectionStart': curPos+10, 'selectionEnd': curPos+10});
        });

        $('#btn-ipnew').click(function(){
            var area   = lastTextAreaSpesialAddressCmdFocused;
            var curPos = area.prop('selectionEnd');
            area.val( area.val().substring(0, curPos) + '{#IPNEW}' + area.val().substring(curPos) ).focus().prop({'selectionStart': curPos+8, 'selectionEnd': curPos+8});
        });

        $('#btn-ipname').click(function(){
            var area   = lastTextAreaSpesialAddressCmdFocused;
            var curPos = area.prop('selectionEnd');
            area.val( area.val().substring(0, curPos) + '{#IPNAME}' + area.val().substring(curPos) ).focus().prop({'selectionStart': curPos+9, 'selectionEnd': curPos+9});
        });

        $('#btn-ipstart').click(function(){
            var area   = $('#txtarea-spesial-address-3-template');
            var curPos = area.prop('selectionEnd');
            area.val( area.val().substring(0, curPos) + '{#IPSTART}' + area.val().substring(curPos) ).focus().prop({'selectionStart': curPos+10, 'selectionEnd': curPos+10});
        });

        $('#btn-ipend').click(function(){
            var area   = $('#txtarea-spesial-address-3-template');
            var curPos = area.prop('selectionEnd');
            area.val( area.val().substring(0, curPos) + '{#IPEND}' + area.val().substring(curPos) ).focus().prop({'selectionStart': curPos+8, 'selectionEnd': curPos+8});
        });

        $('#btn-portnew').click(function(){
            var area   = lastTextAreaSpesialPortCmdFocused;
            var curPos = area.prop('selectionEnd');
            area.val( area.val().substring(0, curPos) + '{#PORTNEW}' + area.val().substring(curPos) ).focus().prop({'selectionStart': curPos+10, 'selectionEnd': curPos+10});
        });

        $('#btn-portname').click(function(){
            var area   = lastTextAreaSpesialPortCmdFocused;
            var curPos = area.prop('selectionEnd');
            area.val( area.val().substring(0, curPos) + '{#PORTNAME}' + area.val().substring(curPos) ).focus().prop({'selectionStart': curPos+11, 'selectionEnd': curPos+11});
        });

	});
</script>
</head>
<body>
    <div class="header">
        <div class="row">
            <div class="col-lg-8 col-md-8 text-left">
                <a href="<?=site_url('Firewall/connection')?>"><img src="<?=base_url('assets/stc_logo.jpg')?>" style="width: 75px;"/></a>
                <span class="header-title"><?=$this->config->item('app_name')?></span>
            </div>
            <div class="col-lg-4 col-md-4 text-right">
                <a href="<?=site_url('Firewall/registered')?>" id="btn-show-registered-fw" class="btn-stc btn btn-info btn-sm">
                    <span class="glyphicon glyphicon-fire" aria-hidden="true"></span> Show Registered
                </a>
            </div>
        </div>
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
                        <button type="button" id="btn-reqnum" class="btn btn-primary btn-xs" style="margin-right: 5px;">{#REQNUM}</button>
                        <button type="button" id="btn-ipsrc" class="btn btn-primary btn-xs" style="margin-right: 5px;">{#IPSRC}</button>
                        <button type="button" id="btn-ipdest" class="btn btn-primary btn-xs" style="margin-right: 5px;">{#IPDEST}</button>
                        <button type="button" id="btn-porttcp" class="btn btn-primary btn-xs" style="margin-right: 5px;">{#PORTTCP}</button>
                        <button type="button" id="btn-portudp" class="btn btn-primary btn-xs">{#PORTUDP}</button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <textarea class="form-control" id="txtarea-setup-template" name="setup_command_template" rows="4" placeholder="Your Setup Rule Template Command Here.."></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <button type="button" id="btn-ipnew" class="btn btn-warning btn-xs" style="margin-right: 5px;">{#IPNEW}</button>
                        <button type="button" id="btn-ipname" class="btn btn-warning btn-xs" style="margin-right: 5px;">{#IPNAME}</button>
                        <button type="button" id="btn-ipstart" class="btn btn-warning btn-xs" style="margin-right: 5px;">{#IPSTART}</button>
                        <button type="button" id="btn-ipend" class="btn btn-warning btn-xs" style="margin-right: 5px;">{#IPEND}</button>
                        <button type="button" id="btn-portnew" class="btn btn-warning btn-xs" style="margin-right: 5px;">{#PORTNEW}</button>
                        <button type="button" id="btn-portname" class="btn btn-warning btn-xs">{#PORTNAME}</button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <textarea class="form-control spesial-address-command" id="txtarea-spesial-address-1-template" name="spesial_command_address1_template" rows="2" placeholder="Your Spesial Command Template For IP Single Digit Here.."></textarea>
                        <textarea class="form-control spesial-address-command" id="txtarea-spesial-address-2-template" name="spesial_command_address2_template" rows="2" placeholder="Your Spesial Command Template For IP with Subnet Here.."></textarea>
                        <textarea class="form-control spesial-address-command" id="txtarea-spesial-address-3-template" name="spesial_command_address3_template" rows="2" placeholder="Your Spesial Command Template For IP with Range Here.."></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <textarea class="form-control spesial-port-command" id="txtarea-spesial-port-tcp-template" name="spesial_command_port_tcp_template" rows="2" placeholder="Your Spesial Command Template For Port Tcp Here.."></textarea>
                        <textarea class="form-control spesial-port-command" id="txtarea-spesial-port-udp-template" name="spesial_command_port_udp_template" rows="2" placeholder="Your Spesial Command Template For Port Udp Here.."></textarea>
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