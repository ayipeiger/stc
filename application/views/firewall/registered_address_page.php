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
		$('#tableData').DataTable();
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
	<div class="content">
		<div class="main-content">
    		<table id="tableData" class="table table-striped table-bordered" style="font-size: 12px; width:100%;">
				<thead>
					<tr>
						<th>Ip Name</th>
						<th>Type</th>
						<th>Address</th>
					</tr>
				</thead>
				<tbody>
                    <?php if(isset($arrFirewallAddress) && is_array($arrFirewallAddress) && count($arrFirewallAddress) > 0): ?>
						<?php if(is_array($arrFirewallAddress) && count($arrFirewallAddress)>0): ?>
							<?php foreach($arrFirewallAddress as $firewallAddressObj): ?>
								<tr>
									<td align="right"><?=$firewallAddressObj->getIpname()?></td>
									<td align="center"><?=$firewallAddressObj->getType()?></td>
									<td align="center"><?=$firewallAddressObj->getAddress()?></td>
								</tr>
							<?php endforeach?>
						<?php endif; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" align="center">Data is empty</td>
                        </tr>
                    <?php endif; ?>
				</tbody>
				<thead>
					<tr>
						<th>Ip Name</th>
            <th>Type</th>
            <th>Address</th>
					</tr>
				</thead>
			</table>
        </div>
    </div>
</body>