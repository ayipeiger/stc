<?php if(!$mappingNotFound): ?>
<h5>Setup Command Template</h5>
<pre><?=nl2br($firewall->getSetupCommandTemplate());?></pre>
<form id="form-execute" method="post" accept-charset="utf-8" action="<?=site_url('Firewall/execute_command_template')?>">
	<input type="hidden" name="setup_command" value="<?=$firewall->getSetupCommandTemplate()?>"/>
	<button type="submit" name="submit" class="btn btn-warning btn-block btn-lg" value="execute">Execute</button>

</form>
<?php else: ?>
<h5>Spesial Command Template</h5>
<div class="alert alert-warning" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Warning:</span>
    <?=$mappingNotFoundDesc;?>
</div>

<?php if($firewall->getSpesialCommandAddressTemplate() !== ""): ?>
	<pre><?=nl2br($firewall->getSpesialCommandAddressTemplate());?></pre>
<?php endif; ?>

<?php if($firewall->getSpesialCommandPortTemplate() !== ""): ?>
	<pre><?=nl2br($firewall->getSpesialCommandPortTemplate());?></pre>
<?php endif; ?>
<form id="form-execute" method="post" accept-charset="utf-8" action="<?=site_url('Firewall/execute_command_template')?>">
	<input type="hidden" name="firewall" value="<?=$firewall->getIp();?>"/>
	<input type="hidden" name="arr_not_found_ipsource" value='<?=json_encode($arrNotFoundIpSource)?>'/>
	<input type="hidden" name="arr_not_found_ipdestination" value='<?=json_encode($arrNotFoundIpDestination)?>'/>
	<input type="hidden" name="arr_not_found_tcpport" value='<?=json_encode($arrNotFoundTcpPort)?>'/>
	<input type="hidden" name="arr_not_found_udpport" value='<?=json_encode($arrNotFoundUdpPort)?>'/>
	<input type="hidden" name="address_command" value="<?=$firewall->getSpesialCommandAddressTemplate()?>"/>
	<input type="hidden" name="port_command" value="<?=$firewall->getSpesialCommandPortTemplate()?>"/>
	<button type="submit" name="submit" class="btn btn-warning btn-block btn-lg" value="execute">Execute</button>
</form>
<?php endif; ?>