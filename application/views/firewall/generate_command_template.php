<?php if(!$mappingNotFound): ?>
<h5>Setup Command Template of <?=$firewall->getIp();?></h5>
<pre><?=nl2br($firewall->getSetupCommandTemplate());?></pre>
<button type="submit" name="submit" class="btn btn-warning btn-block btn-lg" value="execute">Execute Setup Cmd</button>
<?php else: ?>
<h5>Spesial Command Template of <?=$firewall->getIp();?></h5>
<div class="alert alert-warning" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Warning:</span>
    <?=$mappingNotFoundDesc;?>
</div>
<pre><?=nl2br($firewall->getSpesialCommandTemplate());?></pre>
<button type="submit" name="submit" class="btn btn-warning btn-block btn-lg" value="execute">Execute Spesial Cmd</button>
<?php endif; ?>