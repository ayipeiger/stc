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
    .bottom-content {
        color: #434343;
        border-radius: 1px;
        margin-top: 15px;
        background: #fff;
        border: 1px solid #f3f3f3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
        margin-bottom: 30px;
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

    .pagination > .active > a,
	.pagination > .active > span,
	.pagination > .active > a:hover,
	.pagination > .active > span:hover,
	.pagination > .active > a:focus,
	.pagination > .active > span:focus {
	  z-index: 3;
	  color: #fff;
	  cursor: default;
	  background-color: #703081;
	  border-color: #703081;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
        var divbar = $('#progress');
        var bar = $('#progress-bar');
        var percent = $('#progress-percent');
        var response = $('#response');

		$('#tableData').DataTable();

		$('.content').off('click', '.btn-delete');
		$('.content').on('click', '.btn-delete', function(){
			if(confirm('Are you sure to delete this firewall?')) {
				var val = $(this).val();
                var row = $(this).parents('tr:first');

				$.ajax({
					url: '<?=site_url('Firewall/delete_registered')?>',
					type: 'post',
					dataType: 'json',
					data: 'ip='+val,
					beforeSend: function() {
						$('#ajax-loader').show();
					},
					error: function() {
						$('#ajax-loader').hide();
					},
					success: function(response) {
						if(response.status) {
                            row.remove();
                        }
						$('#ajax-loader').hide();
					}
				});
			}
			return false;
		});

        $('.content').off('click', '.btn-show-template');
        $('.content').on('click', '.btn-show-template', function(){
            if(confirm('Are you sure to show template rule for this firewall?')) {
                window.open("<?=site_url('Firewall/registered_template')?>?ip="+$(this).val(),"_self");
            }
            return false;
        });

        $('.content').off('click', '.btn-upload-address');
        $('.content').on('click', '.btn-upload-address', function(){
            if(confirm('Do you want to upload object address for this firewall?')) {
                $('.bottom-content').show();
                $('#form-upload-address').show();
                $('#ip-address-object').val($(this).val());
                $('#response').hide().empty().val('');
            }
            return false;
        });

        $('.content').off('click', '.btn-show-address');
        $('.content').on('click', '.btn-show-address', function(){
            if(confirm('Are you sure to show object address for this firewall?')) {
                window.open("<?=site_url('Firewall/registered_address')?>?ip="+$(this).val(),"_self");
            }
            return false;
        });

        $('.content').off('click', '.btn-upload-service');
        $('.content').on('click', '.btn-upload-service', function(){
             if(confirm('Do you want to upload object address for this firewall?')) {
                $('.bottom-content').show();
                $('#form-upload-service').show();
                $('#ip-services-object').val($(this).val());
                $('#response').hide().empty().val('');
            }
            return false;
        });

        $('.content').off('click', '.btn-show-service');
        $('.content').on('click', '.btn-show-service', function(){
            if(confirm('Are you sure to show object service for this firewall?')) {
                window.open("<?=site_url('Firewall/registered_service')?>?ip="+$(this).val(),"_self");
            }
            return false;
        });

        $('#form-upload-address,#form-upload-service').ajaxForm({
            beforeSend: function() {
                divbar.show();
                var percentVal = '0%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            success: function() {
                var percentVal = '100%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            complete: function(xhr) {
                $('#form-upload-address').hide();
                $('#form-upload-service').hide();
                $('#file-address-object').val('');
                $('#file-service-object').val('');

                divbar.hide();
                bar.width('0%');
                percent.html('');

                response.empty();
                var resultObj = JSON.parse(xhr.responseText);
                if(resultObj.status) {
                    response.removeClass('alert-danger').addClass('alert-success');
                    response.html(resultObj.status_desc);
                } else {
                    response.removeClass('alert-success').addClass('alert-danger');
                    response.html(resultObj.status_desc);
                }
                response.show();
            }
        });

		function reloadList() {
			$.ajax({
				url: '<?=site_url('Firewall/list_register')?>',
				type: 'post',
				dataType: 'html',
				data: '',
				beforeSend: function() {
					$('#ajax-loader').show();
				},
				error: function() {
					$('#ajax-loader').hide();
				},
				success: function(data) {
					$('.main-content').html(data);
					$('#ajax-loader').hide();
				}
			});
		}
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
                <a href="<?=site_url('Firewall/register')?>" id="btn-show-registered-fw" class="btn-stc btn btn-info btn-sm">
                    <span class="glyphicon glyphicon-fire" aria-hidden="true"></span> New Register
                </a>
            </div>
        </div>
	</div>
	<div class="content">
		<div class="main-content">
        	<?php if(isset($arrFirewall) && is_array($arrFirewall) && count($arrFirewall) > 0): ?>
        		<table id="tableData" class="table table-striped table-bordered" style="font-size: 12px; width:100%;">
					<thead>
						<tr>
							<th>Host</th>
							<th>Port</th>
							<th>Use Vdom</th>
							<th>Vdom Name</th>
                            <th align="center">Template</th>
							<th align="center">Addresses</th>
                            <th align="center">Services</th>
                            <th align="center">Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($arrFirewall) && count($arrFirewall)>0): ?>
							<?php foreach($arrFirewall as $firewallObj): ?>
								<tr>
									<td align="right"><?=$firewallObj->getIp()?></td>
									<td align="right"><?=$firewallObj->getPort()?></td>
									<td align="center"><?=$firewallObj->getIsVdom() ? 'true' : 'false'?></td>
									<td align="center"><?=$firewallObj->getNameVdom() && !empty($firewallObj->getNameVdom()) ? $firewallObj->getNameVdom() : 'n/a'?></td>
									<td align="center">
                                        <button class="btn btn-sm btn-warning btn-show-template" value="<?=$firewallObj->getIp()?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View</button>
                                    </td>
                                    <td align="center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button class="btn btn-sm btn-success btn-upload-address" value="<?=$firewallObj->getIp()?>"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                                            <button class="btn btn-sm btn-success btn-show-address" value="<?=$firewallObj->getIp()?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Show</button>
                                        </div>
                                    </td>
                                    <td align="center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button class="btn btn-sm btn-success btn-upload-service" value="<?=$firewallObj->getIp()?>"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                                            <button class="btn btn-sm btn-success btn-show-service" value="<?=$firewallObj->getIp()?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Show</button>
                                        </div>
                                    </td>
                                    <td align="center"><button class="btn btn-sm btn-danger btn-delete" value="<?=$firewallObj->getIp()?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>  Delete</button></td>
								</tr>
							<?php endforeach?>
						<?php endif; ?>
					</tbody>
					<thead>
						<tr>
							<th>Host</th>
							<th>Port</th>
							<th>Use Vdom</th>
							<th>Vdom name</th>
                            <th align="center">Addresses</th>
                            <th align="center">Services</th>
                            <th align="center">Delete</th>
						</tr>
					</thead>
				</table>
        	<?php else: ?>

        	<?php endif; ?>
        </div>
        <div class="bottom-content" style="display: none;">
            <form id="form-upload-address" class="navbar-form" role="upload" method="post" enctype="multipart/form-data" action="<?=site_url('Firewall/save_file_address_object')?>" style="display: none;">
                <span>Please input your firewall addresses file here :</span>
                <div class="form-group">
                    <input type="hidden" id="ip-address-object" name="ip_address_object" value="">
                    <input type="file" id="file-address-object" name="file_address_object" class="form-control" placeholder="File Address Object" style="height: auto; width: 470px;">
                </div>
                <button type="submit" class="btn btn-primary">Submit File</button>
            </form>
            <form id="form-upload-service" class="navbar-form" role="upload" method="post" enctype="multipart/form-data" action="<?=site_url('Firewall/save_file_service_object')?>" style="display: none;">
                <span>Please input your firewall services file here :</span>
                <div class="form-group">
                    <input type="hidden" id="ip-services-object" name="ip_service_object" value="">
                    <input type="file" id="file-service-object" name="file_service_object" class="form-control" placeholder="File Service Object" style="height: auto; width: 470px;">
                </div>
                <button type="submit" class="btn btn-primary">Submit File</button>
            </form>
            <div id="progress" class="progress" style="margin-bottom: 0px; display: none;">
                <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    <span id="progress-percent">0%</span>
                </div>
            </div>
            <div id="response" class="alert alert-danger" role="alert" style="margin-bottom: 0; display: none;">
            </div>
        </div>
    </div>
</body>