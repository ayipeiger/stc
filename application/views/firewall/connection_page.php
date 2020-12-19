<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>STC </title>
<link rel="stylesheet" href="<?=base_url('assets/css/font.css')?>">
<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css')?>">
<script src="<?=base_url('assets/js/jquery-3.3.1.js')?>"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/js/bootstrap-autocomplete.min.js')?>"></script>
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
	.login-form {
        width: 500px;
		margin: 0 auto;
		padding: 30px 0;
	}
    .login-form form {
        color: #434343;
		border-radius: 1px;
    	margin-bottom: 15px;
        background: #fff;
		border: 1px solid #f3f3f3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
	}
	.login-form h4 {
		text-align: center;
		font-size: 22px;
        margin-bottom: 20px;
	}
    .login-form .avatar {
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
    .login-form .avatar i {
        font-size: 62px;
    }
    .login-form .form-group {
        margin-bottom: 20px;
    }
	.login-form .form-control, .login-form .btn {
		min-height: 40px;
		border-radius: 2px; 
        transition: all 0.5s;
	}
	.login-form .close {
        position: absolute;
		top: 15px;
		right: 15px;
	}
	.login-form .btn {
		background: #703081;
		border: none;
		line-height: normal;
	}
	.login-form .btn:hover, .login-form .btn:focus {
		background: #5a1d6b;
	}
    .login-form .checkbox-inline {
        float: left;
    }
    .login-form input[type="checkbox"] {
        margin-top: 2px;
    }
    .login-form .forgot-link {
        float: right;
    }
    .login-form .small {
        font-size: 13px;
    }
    .login-form a {
        color: #703081;
    }
    .login-form .glyphicon.input-group-addon {
        top: 0px;
        border-top-left-radius: 2px;
        border-bottom-left-radius: 2px;
    }
</style>
<script type="text/javascript">
    
    $(document).ready(function(){
        $('#firewall').autoComplete({
            resolverSettings: {
                url: '<?=site_url('Firewall/list_firewall')?>'
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
        $('#firewall').on('autocomplete.select', function (evt, value) {
            var arrObj = value.split('|');
            if(arrObj[0] != 'undefined') {
                $('#firewall').val(arrObj[0].trim());
            }
            if(arrObj[1] != 'undefined') {
                $('#port').val(arrObj[1].trim());
            }
            if(arrObj[2] != 'undefined') {
                $('#vdom').val(arrObj[2].trim());
            }
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
    <div class="login-form">
        <form method="post" accept-charset="utf-8" action="<?=site_url('Firewall/connection')?>">
    		<div class="avatar"><span class="glyphicon glyphicon-fire" aria-hidden="true" style="font-size: 4.5em"></span></div>
        	<h4 class="modal-title">Connect to Your Firewall</h4>
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
            <div class="form-group input-group">
                <span class="glyphicon glyphicon-user input-group-addon" id="addon-username"></span>
                <input type="text" name="username" class="form-control" placeholder="Username" aria-describedby="addon-username">
            </div>
            <div class="form-group input-group">
                <span class="glyphicon glyphicon-lock input-group-addon" id="addon-password"></span>
                <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="addon-password">
            </div>
            <?php if(isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <?=$error_message?>
            </div>
            <?php endif; ?>
            <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg" value="login">Connect</button>
        </form>			
        <div class="text-center small">Any firewall not registered yet? <a href="<?=site_url('Firewall/register')?>">Register Now</a></div>
    </div>
</body>
</html>