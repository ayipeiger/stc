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
</style>
<script type="text/javascript">
    
    $(document).ready(function(){

        var divbar = $('#progress');
        var bar = $('#progress-bar');
        var percent = $('#progress-percent');
        var result = $('#result-content');
        
        $('#form-upload').ajaxForm({
            beforeSend: function() {
                divbar.show();
                result.hide();
                result.empty();
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
                result.html(xhr.responseText);
                result.show();
                bar.hide();
                percent.hide();
            }
        });

        $('#btn-logout').click(function(){
            if(confirm('Are you sure to disconnect this machine?')) {
                document.location = '<?=site_url('Firewall/disconnect')?>';
            }
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
                <a href="<?=site_url('Firewall/connection')?>"><img src="<?=base_url('uploads/stc_logo.jpg')?>" style="width: 75px;"/></a>
                <span class="header-title"><?=$this->config->item('app_name')?></span>
            </div>
            <div class="col-lg-4 col-md-4 text-right">
                <span style="margin-right: 15px; font-size: 12px;">Logged As <?=$this->session->userdata('firewall_user')?></span>
                <button type="button" id="btn-logout" class="btn btn-info btn-sm">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Disconnect
                </button>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="top-content">
            <form id="form-upload" class="navbar-form" role="upload" method="post" enctype="multipart/form-data" action="<?=site_url('Firewall/parsed_excel')?>">
                <span>Please input your firewall report here :</span>
                <div class="form-group">
                    <input type="file" name="file_report" class="form-control" placeholder="File report" style="height: auto; width: 470px;">
                </div>
                <button type="submit" class="btn btn-primary">Submit File</button>
                <button type="button" class="btn btn-warning" onclick="location.href='<?=site_url('Firewall/history_log')?>'">Log Result</button>
            </form>
        </div>
        <div class="main-content">
            <div id="progress" class="progress" style="margin-bottom: 0px; visibility: hidden;">
                <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    <span id="progress-percent">0%</span>
                </div>
            </div>
            <div id="result-content" style="font-size: 11px;">
            </div>
        </div>
    </div>
</body>
</html>