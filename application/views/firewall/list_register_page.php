<script type="text/javascript">
	$(document).ready(function(){
		$('#tableData').DataTable();
	});
</script>
<?php if(isset($arr_firewall) && is_array($arr_firewall) && count($arr_firewall) > 0): ?>
	<table id="tableData" class="table table-striped table-bordered" style="font-size: 12px; width:100%;">
		<thead>
			<tr>
				<th>Host</th>
				<th>Port</th>
				<th>Use Vdom</th>
				<th>Vdom Name</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($arr_firewall) && count($arr_firewall)>0): ?>
				<?php foreach($arr_firewall as $row): ?>
					<tr>
						<td align="right"><?=$row['ip']?></td>
						<td align="right"><?=$row['port']?></td>
						<td align="center"><?=$row['is_vdom'] ? 'true' : 'false'?></td>
						<td align="center"><?=$row['vdom_name'] && !empty($row['vdom_name']) ? $row['vdom_name'] : 'n/a'?></td>
						<td align="center" style="color: #838383;"><button class="btn btn-sm btn-danger btn-delete" value="<?=$row['ip'].'|'.$row['port'].'|'.trim($row['is_vdom']).'|'.trim($row['vdom_name'])?>" style="width: 100px">Delete</button></td>
					</tr>
				<?php endforeach?>
			<?php endif; ?>
		</tbody>
		<thead>
			<tr>
				<th>Host</th>
				<th>Port</th>
				<th>Use Vdom</th>
				<th>Vdom name</th>
				<th>Delete</th>
			</tr>
		</thead>
	</table>
<?php else: ?>

<?php endif; ?>