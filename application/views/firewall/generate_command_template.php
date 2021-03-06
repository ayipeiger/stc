<?php if($firewall instanceof FirewallObject): ?>

	<?php if(!$mappingNotFound): ?>
	<h5>Setup Command Template</h5>
	<pre><code class="language-html" data-lang="html"><?=nl2br($firewall->getSetupCommandTemplate());?></code></pre>
	<form id="form-execute" method="post" accept-charset="utf-8" action="<?=site_url('Firewall/execute_command_template')?>">
		<input type="hidden" name="firewall" value="<?=$firewall->getCode();?>"/>
		<input type="hidden" name="request_number" value="<?=$requestNumber?>"/>
		<input type="hidden" name="setup_command" value="<?=$firewall->getSetupCommandTemplate()?>"/>
		<button type="submit" name="submit" class="btn btn-warning btn-block btn-lg" value="execute">Execute</button>
	</form>
	<?php else: ?>
	<h5>Spesial Command Template</h5>
	<div class="alert alert-warning" role="alert">
	    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	    <span class="sr-only">Warning:</span> Found not exist address or service :</br>
	    <?=nl2br($mappingNotFoundDesc);?>
	</div>

	<?php if($firewall->getSpesialCommandAddressTemplate() !== ""): ?>
		<pre><code class="language-html" data-lang="html"><?=nl2br($firewall->getSpesialCommandAddressTemplate());?></code></pre>
	<?php endif; ?>

	<?php if($firewall->getSpesialCommandPortTemplate() !== ""): ?>
		<pre><code class="language-html" data-lang="html"><?=nl2br($firewall->getSpesialCommandPortTemplate());?></code></pre>
	<?php endif; ?>
	<form id="form-execute" method="post" accept-charset="utf-8" action="<?=site_url('Firewall/execute_command_template')?>">
		<input type="hidden" name="firewall" value="<?=$firewall->getCode();?>"/>
		<input type="hidden" name="request_number" value="<?=$requestNumber?>"/>
		<input type="hidden" name="arr_not_found_ipsource" value='<?=json_encode($arrNotFoundIpSource)?>'/>
		<input type="hidden" name="arr_not_found_ipdestination" value='<?=json_encode($arrNotFoundIpDestination)?>'/>
		<input type="hidden" name="arr_not_found_tcpport" value='<?=json_encode($arrNotFoundTcpPort)?>'/>
		<input type="hidden" name="arr_not_found_udpport" value='<?=json_encode($arrNotFoundUdpPort)?>'/>
		<input type="hidden" name="address_command" value="<?=$firewall->getSpesialCommandAddressTemplate()?>"/>
		<input type="hidden" name="port_command" value="<?=$firewall->getSpesialCommandPortTemplate()?>"/>
		<button type="submit" name="submit" class="btn btn-warning btn-block btn-lg" value="execute">Execute</button>
	</form>
	<?php endif; ?>

<?php else: ?>
	<div class="alert alert-danger" role="alert">
	    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	    <span class="sr-only">Error:</span>Firewall was not found on this system. Please register it first.
	</div>
<?php endif; ?>