<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>STC</title>
<link rel="stylesheet" href="<?=base_url('uploads/css/font.css')?>">
<link rel="stylesheet" href="<?=base_url('uploads/css/bootstrap.min.css')?>">
<script src="<?=base_url('uploads/js/jquery-3.3.1.js')?>"></script>
<script src="<?=base_url('uploads/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('uploads/js/bootstrap-autocomplete.min.js')?>"></script>
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
    .menu-area {
        max-width: 500px;
        margin: 0 auto;
        padding: 100px 0;
    }
    .menu-item {
        color: #434343;
        border-radius: 1px;
        margin-bottom: 15px;
        background: #fff;
        border: 1px solid #f3f3f3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .menu-item:hover {
        background: #f4e9f7;
        cursor: pointer;
    }
    .menu-icon {
        color: #fff;
        margin: 0 auto 25px;
        text-align: center;
        width: 100px;
        height: 100px;
        border-radius: 20%;
        z-index: 9;
        background: #703081;
        padding: 15px;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }
    .menu-title {
        text-align: center;
        font-size: 1.5em;
    }

</style>
<script type="text/javascript">
    
    $(document).ready(function(){
        
    });

</script>
</head>
<body>
<div class="header">
    <a href="<?=site_url('Firewall/connection')?>"><img src="<?=base_url('uploads/stc_logo.jpg')?>" style="width: 75px;"/></a>
    <span class="header-title"><?=$this->config->item('app_name')?></span>
</div>
<div class="menu-area">
    <div class="row">
        <div class="col-md-6">
            <a href="<?=site_url('Firewall/parser_excel')?>">
                <div class="menu-item">
                    <div class="menu-icon"><span class="glyphicon glyphicon-check" aria-hidden="true" style="font-size: 4.5em"></span></div>
                    <div class="menu-title">Setup Rule</div>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="<?=site_url('Firewall/parser_excel')?>">
                <div class="menu-item">
                    <div class="menu-icon"><span class="glyphicon glyphicon-trash" aria-hidden="true" style="font-size: 4.5em"></span></div>
                    <div class="menu-title">Cleanup Rule</div>
                </div>
            </a>
        </div>
    </div>
</div>

</body>
</html>