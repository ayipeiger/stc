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
<script src="<?=base_url('assets/js/bootstrap-autocomplete.min.js')?>"></script>
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
        border-radius: 2px; 
        transition: all 0.5s;
        background: #703081;
        border: none;
        line-height: normal;
    }
    .btn-stc:hover, .btn-stc:focus {
        background: #5a1d6b;
    }
    .btn-stc-reset {
        border-radius: 2px; 
        transition: all 0.5s;
        background: #f0af50;
        border: none;
        line-height: normal;
    }
    .btn-stc-reset:hover, .btn-stc-reset:focus {
        background: #dd8a12;
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
    .register-form .form-control, .register-form {
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

    #ajax-loader{
        background: #000;
        opacity:0.4;
        filter: alpha(opacity=40);
        top:0;
        left:0;
        width: 100%;
        height: 100%;
        position: fixed !important;
        position: absolute; /*ie6 and above*/
        z-index: 9999;
        padding: 0px;
        text-align:center;
        color: #010080;
        letter-spacing: 2px;
    }
    .loader-container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      display: flex;
    }

    .dash {
      margin: 0 15px;
      width: 35px;
      height: 15px;
      border-radius: 8px;
      background: #703081;
      box-shadow: 0 0 10px 0 #FECDFF;
    }

    .uno {
      margin-right: -18px;
      transform-origin: center left;
      animation: spin 3s linear infinite;  
    }

    .dos {
      transform-origin: center right;
      animation: spin2 3s linear infinite;
      animation-delay: .2s;
    }

    .tres {
      transform-origin: center right;
      animation: spin3 3s linear infinite;
      animation-delay: .3s;
    }

    .cuatro {
      transform-origin: center right;
      animation: spin4 3s linear infinite;
      animation-delay: .4s;
    }

    .toggle-log {
        cursor: pointer;
        color: #337ab7
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }
      25% {
        transform: rotate(360deg);
      }
      30% {
        transform: rotate(370deg);
      }
      35% {
        transform: rotate(360deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }

    @keyframes spin2 {
      0% {
        transform: rotate(0deg);
      }
      20% {
        transform: rotate(0deg);
      }
      30% {
        transform: rotate(-180deg);
      }
      35% {
        transform: rotate(-190deg);
      }
      40% {
        transform: rotate(-180deg);
      }
      78% {
        transform: rotate(-180deg);
      }
      95% {
        transform: rotate(-360deg);
      }
      98% {
        transform: rotate(-370deg);
      }
      100% {
        transform: rotate(-360deg);
      }
    }

    @keyframes spin3 {
      0% {
        transform: rotate(0deg);
      }
      27% {
        transform: rotate(0deg);  
      }
      40% {
        transform: rotate(180deg);
      }
      45% {
        transform: rotate(190deg);
      }
      50% {
        transform: rotate(180deg);
      }
      62% {
        transform: rotate(180deg);
      }
      75% {
        transform: rotate(360deg);
      }
      80% {
        transform: rotate(370deg);
      }
      85% {
        transform: rotate(360deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }

    @keyframes spin4 {
      0% {
        transform: rotate(0deg);
      }
      38% {
        transform: rotate(0deg);
      }
      60% {
        transform: rotate(-360deg);
      }
      65% {
        transform: rotate(-370deg);
      }
      75% {
        transform: rotate(-360deg);
      }
      100% {
        transform: rotate(-360deg);
      }
    }

</style>
<script type="text/javascript">
	$(document).ready(function(){

		var lastTextAreaFocused;

        $('#firewall-code').autoComplete({
            resolverSettings: {
                url: '<?=site_url('Firewall/list_firewallcode')?>'
            },
            formatResult: function (item) {
                return {
                    value: 0,
                    text: item
                };
            },
            minLength: 3,
            noResultsText: "No data found"
        });
        
        $('#firewall-code').on('autocomplete.select', function (evt, value) {
            var arrObj = value.split('|');
            var firewallCode = arrObj[0].trim();
            var firewallIp = arrObj[1].trim();
            var firewallPort = arrObj[2].trim();
            var firewallVdom = arrObj[3].trim();

            $.ajax({
                url: '<?=site_url('Firewall/get_firewall')?>',
                type: 'post',
                dataType: 'json',
                data: 'firewall_code='+firewallCode,
                beforeSend: function() {
                    $('#ajax-loader').show();
                },
                error: function() {
                    $('#ajax-loader').hide();
                },
                success: function(response) {
                    $('#ajax-loader').hide();
                    $('#firewall-code').val(response.code);
                    $('#firewall').val(response.ip);
                    $('#port').val(response.port);
                    $('#vdom').val(response.nameVdom);
                    $('#txtarea-setup-template').val(response.setupCommandTemplate);
                    var arrSpesialCommandAddressTemplate = response.spesialCommandAddressTemplate.split('~~');
                    $('#txtarea-spesial-address-1-template').val(arrSpesialCommandAddressTemplate[0].trim());
                    $('#txtarea-spesial-address-2-template').val(arrSpesialCommandAddressTemplate[1].trim());
                    $('#txtarea-spesial-address-3-template').val(arrSpesialCommandAddressTemplate[2].trim());
                    var arrSpesialCommandPortTemplate = response.spesialCommandPortTemplate.split('~~');
                    $('#txtarea-spesial-port-tcp-template').val(arrSpesialCommandPortTemplate[0].trim());
                    $('#txtarea-spesial-port-udp-template').val(arrSpesialCommandPortTemplate[1].trim());
                }
            });
        });

        $('#btn-reset').click(function() {
            $('#firewall-code').val('');
            $('#firewall').val('');
            $('#port').val('');
            $('#vdom').val('');
            $('#txtarea-setup-template').val('');
            $('#txtarea-spesial-address-1-template').val('');
            $('#txtarea-spesial-address-2-template').val('');
            $('#txtarea-spesial-address-3-template').val('');
            $('#txtarea-spesial-port-tcp-template').val('');
            $('#txtarea-spesial-port-udp-template').val('');
        });

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

        $('#btn-vdom').click(function(){
            var area   = lastTextAreaFocused;
            var curPos = area.prop('selectionEnd');
            area.val( area.val().substring(0, curPos) + '{#VDOM}' + area.val().substring(curPos) ).focus().prop({'selectionStart': curPos+7, 'selectionEnd': curPos+7});
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
    <div id="ajax-loader" style="display: none;">
        <div class="loader-container">
          <div class="dash uno"></div>
          <div class="dash dos"></div>
          <div class="dash tres"></div>
          <div class="dash cuatro"></div>
        </div>
    </div>
    <div class="header">
        <div class="row">
            <div class="col-lg-8 col-md-8 text-left">
                <a href="<?=site_url('Firewall/connection')?>"><img src="<?=base_url('assets/stc_logo.jpg')?>" style="width: 75px;"/></a>
                <span class="header-title"><?=$this->config->item('app_name')?></span>
            </div>
            <div class="col-lg-4 col-md-4 text-right">
                <a href="<?=site_url('Firewall/connection')?>" id="btn-show-registered-fw" class="btn-stc btn btn-info btn-sm">
                    <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home
                </a>
                <a href="<?=site_url('Firewall/registered')?>" id="btn-show-registered-fw" class="btn-stc btn btn-info btn-sm">
                    <span class="glyphicon glyphicon-fire" aria-hidden="true"></span> Show Registered
                </a>
            </div>
        </div>
	</div>
	<div class="register-form">
        <form method="post" accept-charset="utf-8" action="<?=site_url('Firewall/register')?>" onsubmit="return confirm('Are you sure you want to register this firewall?');">
            <div class="avatar"><span class="glyphicon glyphicon-fire" aria-hidden="true" style="font-size: 4.5em"></span></div>
            <h4 class="modal-title">Register New Firewall</h4>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <input type="text" id="firewall-code" name="firewall_code" class="form-control" placeholder="Firewall Code" required="required" autocomplete="off">
                    </div>
                </div>
            </div>
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
                        <button type="button" id="btn-vdom" class="btn btn-primary btn-xs" style="margin-right: 5px;">{#VDOM}</button>
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
                        <textarea class="form-control spesial-address-command" id="txtarea-spesial-address-1-template" name="spesial_command_address1_template" rows="5" placeholder="Your Spesial Command Template For IP Single Digit Here.."></textarea>
                        <textarea class="form-control spesial-address-command" id="txtarea-spesial-address-2-template" name="spesial_command_address2_template" rows="5" placeholder="Your Spesial Command Template For IP with Subnet Here.."></textarea>
                        <textarea class="form-control spesial-address-command" id="txtarea-spesial-address-3-template" name="spesial_command_address3_template" rows="5" placeholder="Your Spesial Command Template For IP with Range Here.."></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <textarea class="form-control spesial-port-command" id="txtarea-spesial-port-tcp-template" name="spesial_command_port_tcp_template" rows="5" placeholder="Your Spesial Command Template For Port Tcp Here.."></textarea>
                        <textarea class="form-control spesial-port-command" id="txtarea-spesial-port-udp-template" name="spesial_command_port_udp_template" rows="5" placeholder="Your Spesial Command Template For Port Udp Here.."></textarea>
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
            <button type="reset" id="btn-reset" name="reset" class="btn-stc-reset btn btn-primary btn-block btn-lg" value="reset" style="margin-top: 15px;">Reset</button>            
            <button type="submit" name="submit" class="btn-stc btn btn-primary btn-block btn-lg" value="register" style="margin-top: 15px;">Register</button>              
        </form>
    </div>
</body>