<?php if(isset($resultSetupCommand) && $resultSetupCommand): ?>
<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
    <span class="sr-only">Success:</span> The policy/rule has been successfully added into the firewall.
</div>
<?php elseif(isset($resultSetupCommand) && !$resultSetupCommand): ?>
<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span> The policy/rule has been failure added into the firewall.
</div>
<?php endif; ?>

<?php if(isset($resultAddressCommand) && $resultAddressCommand): ?>
<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
    <span class="sr-only">Success:</span> The address IP has been successfully added into the firewall.
</div>
<?php elseif(isset($resultAddressCommand) && !$resultAddressCommand): ?>
<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>  The address IP has been failure added into the firewall.
</div>
<?php endif; ?>

<?php if(isset($resultPortCommand) && $resultPortCommand): ?>
<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
    <span class="sr-only">Success:</span>The service Port has been successfully added into the firewall.
</div>
<?php elseif(isset($resultPortCommand) && !$resultPortCommand): ?>
<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span> The service Port has been failure added into the firewall.
</div>
<?php endif; ?>
<div id="div-log">
    <pre>
        <code class="language-html" data-lang="html"><?=isset($resultLogSetupCommand) && !empty($resultLogSetupCommand) ? nl2br($resultLogSetupCommand) : '';?><?=isset($resultLogAddressCommand) && !empty($resultLogAddressCommand) ? nl2br($resultLogAddressCommand) : '';?><?=isset($resultLogPortCommand) && !empty($resultLogPortCommand) ? nl2br($resultLogPortCommand) : '';?></code>
    </pre>
</div>


