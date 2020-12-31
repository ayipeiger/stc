<?php if(!$mappingNotFound): ?>
<h5>Setup Command Template</h5>
<pre><?=nl2br($firewall->getSetupCommandTemplate());?></pre>
<button type="submit" name="submit" class="btn btn-warning btn-block btn-lg" value="execute">Execute Setup Cmd</button>
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

<button type="submit" name="submit" class="btn btn-warning btn-block btn-lg" value="execute">Execute Spesial Cmd</button>
<?php endif; ?>