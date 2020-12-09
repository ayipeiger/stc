<?php if($result): ?>
	<style type="text/css">
		.pagination > .active > a,
		.pagination > .active > span,
		.pagination > .active > a:hover,
		.pagination > .active > span:hover,
		.pagination > .active > a:focus,
		.pagination > .active > span:focus {
		  z-index: 3;
		  color: #fff;
		  cursor: default;
		  background-color: #703081;
		  border-color: #703081;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#tableData').DataTable();

			$('#formData').off('click', '#tableData input[type=checkbox]');
			$('#formData').on('click', '#tableData input[type=checkbox]', function(){
				if($('#tableData input[type=checkbox]:checked').length > 0) {
					$('#btn-disable-all').removeClass('disabled');
					$('#btn-delete-all').removeClass('disabled');
				} else if($('#tableData input[type=checkbox]:checked').length == 0) {
					$('#btn-disable-all').addClass('disabled');
					$('#btn-delete-all').addClass('disabled');
				}
			});

			$('#formData').off('click', '#btn-select-all');
			$('#formData').on('click', '#btn-select-all', function(){
				$('#tableData input[type=checkbox]').prop("checked", true);
				$('#btn-disable-all').removeClass('disabled');
				$('#btn-delete-all').removeClass('disabled');
			});

			$('#formData').off('click', '#btn-unselect-all');
			$('#formData').on('click', '#btn-unselect-all', function(){
				$('#tableData input[type=checkbox]').prop("checked", false);
				$('#btn-disable-all').addClass('disabled');
				$('#btn-delete-all').addClass('disabled');
			});

			$('#formData').off('click', '.btn-disable');
			$('#formData').on('click', '.btn-disable', function(){
				if(confirm('Are you sure to disable this policy?')) {
					var obj = $(this);
					$.ajax({
						url: '<?=site_url('Firewall/disable_single')?>',
						type: 'post',
						dataType: 'json',
						data: 'param='+obj.val(),
						beforeSend: function() {
							$('#ajax-loader').show();
						},
						error: function() {
							$('#ajax-loader').hide();
						},
						success: function(data) {
							if(data.result) {
								obj.parent().html('Disabled');
								$('#tableData input[type=checkbox]').prop("checked", false);
							}
							$('#ajax-loader').hide();
						}
					});
				}
				return false;
			});

			$('#formData').off('click', '#btn-disable-all');
			$('#formData').on('click', '#btn-disable-all', function(){
				if($('#tableData input[type=checkbox]:checked').length > 0) {
					if(confirm('Are you sure to disable this several policy')) {
						var obj = $(this);
						$.ajax({
							url: '<?=site_url('Firewall/disable_multiple')?>',
							type: 'post',
							dataType: 'json',
							data: $('#formData').serialize(),
							beforeSend: function() {
								$('#ajax-loader').show();
							},
							error: function() {
								$('#ajax-loader').hide();
							},
							success: function(data) {
								if(data.result) {
									if(data.arr_success_id.length > 0) {
										for(i=0; i < data.arr_success_id.length; i++) {
											$('#btn-disable-'+data.arr_success_id[i]).parent().html('Disabled');
										}	
									}
									$('#tableData input[type=checkbox]').prop("checked", false);
								}
								$('#ajax-loader').hide();
							}
						});
					}
				} else {
					alert('None of selected!');
				}
				return false;
			});

			$('#formData').off('click', '.btn-delete');
			$('#formData').on('click', '.btn-delete', function(){
				if(confirm('Are you sure to delete this policy?')) {
					var obj = $(this);
					$.ajax({
						url: '<?=site_url('Firewall/delete_single')?>',
						type: 'post',
						dataType: 'json',
						data: 'param='+obj.val(),
						beforeSend: function() {
							$('#ajax-loader').show();
						},
						error: function() {
							$('#ajax-loader').hide();
						},
						success: function(data) {
							if(data.result) {
								obj.parent().html('Deleted');
								$('#tableData input[type=checkbox]').prop("checked", false);
							}
							$('#ajax-loader').hide();
						}
					});
				}				
				return false;
			});
			
			$('#formData').off('click', '#btn-delete-all');
			$('#formData').on('click', '#btn-delete-all', function(){
				if($('#tableData input[type=checkbox]:checked').length > 0) {
					if(confirm('Are you sure to delete this several policy')) {
						var obj = $(this);
						$.ajax({
							url: '<?=site_url('Firewall/delete_multiple')?>',
							type: 'post',
							dataType: 'json',
							data: $('#formData').serialize(),
							beforeSend: function() {
								$('#ajax-loader').show();
							},
							error: function() {
								$('#ajax-loader').hide();
							},
							success: function(data) {
								if(data.result) {
									if(data.arr_success_id.length > 0) {
										for(i=0; i < data.arr_success_id.length; i++) {
											$('#btn-delete-'+data.arr_success_id[i]).parent().html('Deleted');
										}
									}
									$('#tableData input[type=checkbox]').prop("checked", false);
								}
								$('#ajax-loader').hide();
							}
						});
					}
				} else {
					alert('None of selected!');
				}
				return false;
			});
		});
	</script>
	<form id="formData" method="post">
		<table id="tableData" class="table table-striped table-bordered" style="font-size: 10px; width:100%;">
			<thead>
				<tr>
					<th>#</th>
					<th>Policy Id</th>
					<th>Source</th>
					<th>Destination</th>
					<th>Services</th>
					<th>Action</th>
					<th>Hit</th>
					<th>Disable</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($arr_policy) && count($arr_policy)>0): ?>
					<?php foreach($arr_policy as $row): ?>
						<tr>
							<td><input type="checkbox" name="param[]" value="<?=$row['policy_id'].';'.$row['src_resolved'].';'.$row['dest_resolved'].';'.$row['service_resolved'].';'.$row['action'].';'.$row['hit']?>"/></td>
							<td align="center"><?=$row['policy_id']?></td>
							<td><?=substr($row['src_resolved'], 0, 40)?></td>
							<td><?=substr($row['dest_resolved'], 0, 40)?></td>
							<td><?=substr($row['service_resolved'], 0, 40)?></td>
							<td><?=$row['action']?></td>
							<td><?=$row['hit']?></td>
							<td align="center" style="color: #838383;"><button id="btn-disable-<?=$row['policy_id']?>" class="btn btn-sm btn-warning btn-disable" value="<?=$row['policy_id'].';'.$row['src_resolved'].';'.$row['dest_resolved'].';'.$row['service_resolved'].';'.$row['action'].';'.$row['hit']?>">Disable</button></td>
							<td align="center" style="color: #838383;"><button id="btn-delete-<?=$row['policy_id']?>" class="btn btn-sm btn-danger btn-delete" value="<?=$row['policy_id'].';'.$row['src_resolved'].';'.$row['dest_resolved'].';'.$row['service_resolved'].';'.$row['action'].';'.$row['hit']?>">Delete</button></td>
						</tr>
					<?php endforeach?>
				<?php endif; ?>
			</tbody>
			<thead>
				<tr>
					<th>#</th>
					<th>Policy Id</th>
					<th>Source</th>
					<th>Destination</th>
					<th>Services</th>
					<th>Action</th>
					<th>Hit</th>
					<th>Disable</th>
					<th>Delete</th>
				</tr>
			</thead>
		</table>
		<div class="text-right" style="margin-top: 10px;">
			<button id="btn-select-all" type="button" class="btn btn-sm btn-default">Select All</button>
			<button id="btn-unselect-all" type="button" class="btn btn-sm btn-default">Unselect All</button>
			<button id="btn-disable-all" type="button" class="btn btn-sm btn-warning disabled">Disable Selected</button>
			<button id="btn-delete-all" type="button" class="btn btn-sm btn-danger disabled">Delete Selected</button>
		</div>
	</form>	
<?php else: ?>
<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    <?=$result_message?>
</div>
<?php endif; ?>