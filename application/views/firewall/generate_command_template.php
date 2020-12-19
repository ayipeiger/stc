<h5>Setup Command Template of <?=$firewall->getIp();?></h5>
<pre><?=nl2br($firewall->getSetupCommandTemplate());?></pre>
<button type="submit" name="submit" class="btn btn-warning btn-block btn-lg" value="execute">Execute</button>