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
    .content {
        width: 1024px;
        margin: 0 auto;
        padding: 30px 0;
    }
    .top-content {
        color: #434343;
        border-radius: 1px;
        margin-bottom: 15px;
        background: #fff;
        border: 1px solid #f3f3f3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
        margin-bottom: 30px;
    }
    .main-content {
        color: #434343;
        border-radius: 1px;
        margin-bottom: 15px;
        background: #fff;
        border: 1px solid #f3f3f3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
	.form-control {
		box-shadow: none;
		border-color: #ddd;
	}
	.form-control:focus {
		border-color: #4aba70; 
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

        $('#btn-logout').click(function(){
            if(confirm('Are you sure to disconnect this machine?')) {
                document.location = '<?=site_url('Firewall/disconnect')?>';
            }
        });

        $('#btn-menu').click(function(){
            document.location = '<?=site_url('Firewall/sub_menu')?>';
        });

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
            if(arrObj[0] != 'undefined') {
                $('#firewall-code').val(arrObj[0].trim());
            }
        });

        $('#firewall-code').dblclick(function(){
            $(this).removeAttr('readonly');
        });

        $('.content').off('submit', '#form-generate');
        $('.content').on('submit', '#form-generate', function(){

            $.ajax({
                url: $('#form-generate').attr('action'),
                type: 'post',
                dataType: 'html',
                data: $('#form-generate').serialize(),
                beforeSend: function() {
                    $('#ajax-loader').show();
                },
                error: function() {
                    $('#ajax-loader').hide();
                },
                success: function(response) {
                    $('#template-content').html(response);
                    $('#ajax-loader').hide();
                }
            });

            return false;
        });

        $('.content').off('submit', '#form-execute');
        $('.content').on('submit', '#form-execute', function(){

            if(confirm("Are you sure to execute this command?")) {
                $.ajax({
                    url: $('#form-execute').attr('action'),
                    type: 'post',
                    dataType: 'html',
                    data: $('#form-execute').serialize(),
                    beforeSend: function() {
                        $('#ajax-loader').show();
                    },
                    error: function() {
                        $('#ajax-loader').hide();
                    },
                    success: function(response) {
                        $('#template-content').html(response);
                        $('#ajax-loader').hide();
                    }
                });
            }
            
            return false;
        });

        $('.content').off('click', '#toggle-log');
        $('.content').on('click', '#toggle-log', function(){
            if($(this).html().search('Show') != -1) {
                $(this).html('Hide Log &gt;&gt;');
                $('#div-log').show();
            } else if($(this).html().search('Hide') != -1) {
                $(this).html('Show Log &gt;&gt;');
                $('#div-log').hide();
            }
        });

        $('#btn-switch').click(function(){
            var contentSrc = $('#ip_source').val();
            var contentDest = $('#ip_destination').val();
            $('#ip_source').val(contentDest);
            $('#ip_destination').val(contentSrc);
            $(this).remove();
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
                <span style="margin-right: 15px; font-size: 12px;">Logged As <?=$this->session->userdata('firewall_user')?></span>
                <button type="button" id="btn-menu" class="btn btn-info btn-sm">
                    <span class="glyphicon glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
                </button>
                <button type="button" id="btn-logout" class="btn btn-info btn-sm">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Disconnect
                </button>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="top-content">
            <div class="row">
                <div class="col-sm-6">
                    <form id="form-generate" method="post" accept-charset="utf-8" action="<?=site_url('Firewall/generate_command_template')?>">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="text" id="request_number" name="request_number" class="form-control" placeholder="SCR Request No" required="required" value="<?=$requestNumber?>" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="text" id="ip_source" name="ip_source" class="form-control" placeholder="Source IP #" required="required" value="<?=$ipSource?>" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="text" id="ip_destination" name="ip_destination" class="form-control" placeholder="Destination IP #" required="required" value="<?=$ipDestination?>" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="text" id="tcp_port" name="tcp_port" class="form-control" placeholder="TCP Port"  value="<?=$tcpPort?>" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="text" id="udp_port" name="udp_port" class="form-control" placeholder="UDP Port" value="<?=$udpPort?>" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="text" id="firewall-code" name="firewall_code" class="form-control" placeholder="Firewall" required="required" value="<?=$firewallCode?>" <?php if(isset($firewallCode) && !empty($firewallCode)):?>readonly
                                    <?php endif; ?> autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <?php if(isset($bidirectional) && !empty($bidirectional)): ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12">
                                    <button id="btn-switch" type="button" class="btn btn-warning btn-block btn-md"><span class=" glyphicon glyphicon-refresh" aria-hidden="true"></span> Switch</button>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg" value="generate">Generate</button>
                    </form> 
                </div>
                <div class="col-sm-6">
                    <div id="template-content">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>