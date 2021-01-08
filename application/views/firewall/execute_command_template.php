<?php if(isset($resultSetupCommand) && $resultSetupCommand): ?>
<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
    <span class="sr-only">Success:</span><?=$resultOutSetupCommand;?>
</div>
<?php elseif(isset($resultSetupCommand) && !$resultSetupCommand): ?>
<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span><?=$resultErrSetupCommand;?>
</div>
<?php endif; ?>

<?php if(isset($resultAddressCommand) && $resultAddressCommand): ?>
<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
    <span class="sr-only">Success:</span><?=$resultOutAddressCommand;?>
</div>
<?php elseif(isset($resultAddressCommand) && !$resultAddressCommand): ?>
<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span><?=$resultErrAddressCommand;?>
</div>
<?php endif; ?>

<?php if(isset($resultPortCommand) && $resultPortCommand): ?>
<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
    <span class="sr-only">Success:</span><?=$resultOutPortCommand;?>
</div>
<?php elseif(isset($resultPortCommand) && !$resultPortCommand): ?>
<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span><?=$resultErrPortCommand;?>
</div>
<?php endif; ?>