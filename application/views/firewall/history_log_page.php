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
		$('#tableData').DataTable();

        $('#btn-logout').click(function(){
            if(confirm('Are you sure to disconnect this machine?')) {
                document.location = '<?=site_url('Firewall/disconnect')?>';
            }
        });

        $('[data-toggle="popover"]').popover();
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
                <a href="<?=site_url('Firewall/connection')?>"><img src="<?=base_url('uploads/stc_logo.jpg')?>" style="width: 75px;"/></a>
                <span class="header-title"><?=$this->config->item('app_name')?></span>
            </div>
            <div class="col-lg-4 col-md-4 text-right">
                <span style="margin-right: 15px; font-size: 12px;">Logged As <?=$this->session->userdata('firewall_ip')?></span>
                <button type="button" id="btn-logout" class="btn btn-info btn-sm">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Disconnect
                </button>
            </div>
        </div>
    </div>
	<div class="content">
		<div class="main-content">
        	<?php if(isset($arr_log) && is_array($arr_log) && count($arr_log) > 0): ?>
        		<table id="tableData" class="table table-striped table-bordered" style="font-size: 12px; width:100%;">
					<thead>
						<tr>
							<th>Policy Id</th>
                            <th>Source</th>
							<th>Destination</th>
							<th>Service</th>
							<th>Action</th>
                            <th>Hit</th>
                            <th>History</th>
                            <th>Executed On</th>
							<th>Executed By</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($arr_log) && count($arr_log)>0): ?>
							<?php foreach($arr_log as $row): ?>
								<tr>
									<td align="center"><?=$row['policy_id']?></td>
                                    <td align="left" data-toggle="popover" data-placement="bottom" title="Source Resolved" data-content="<?=str_replace(',', ', ', $row['src_resolved'])?>"><?=substr($row['src_resolved'], 0, 25)?></td>
                                    <td align="left" data-toggle="popover" data-placement="bottom" title="Destination Resolved" data-content="<?=str_replace(',', ', ', $row['dest_resolved'])?>"><?=substr($row['dest_resolved'], 0, 25)?></td>
                                    <td align="left" data-toggle="popover" data-placement="bottom" title="Service Resolved" data-content="<?=str_replace(',', ', ', $row['service_resolved'])?>"><?=substr($row['service_resolved'], 0, 25)?></td>
                                    <td align="center"><?=$row['action']?></td>
                                    <td align="center"><?=$row['hit']?></td>
                                    <td align="center"><?=$row['hits']?></td>
                                    <td align="center"><?=$row['time_execute']?></td>
									<td align="center"><?=$row['user']?></td>
								</tr>
							<?php endforeach?>
						<?php endif; ?>
					</tbody>
					<thead>
						<tr>
                            <th>Policy Id</th>
                            <th>Source</th>
                            <th>Destination</th>
                            <th>Service</th>
                            <th>Action</th>
                            <th>Hit</th>
                            <th>History</th>
                            <th>Executed On</th>
                        </tr>
					</thead>
				</table>
        	<?php else: ?>

        	<?php endif; ?>
        </div>
    </div>
</body>