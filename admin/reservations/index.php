<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Reservas</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped table-bordered">
				<colgroup>
					<col width="5%">
					<col width="10%">
					<col width="25%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Código</th>
						<th>Cliente</th>
						<th>Ingreso</th>
						<th>Salida</th>
						<th>Estado</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT * from `reservation_list` order by `status` asc, unix_timestamp(`date_created`) desc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?= $i++ ?></td>
							<td><?php echo ($row['code']) ?></td>
							<td class=""><p class="truncate-1"><?php echo ucwords($row['fullname']) ?></p></td>
							<td class=""><?php echo date("Y-m-d",strtotime($row['check_in'])) ?></td>
							<td class=""><?php echo date("Y-m-d",strtotime($row['check_out'])) ?></td>
							<td class="text-center">
								<?php 
									switch ($row['status']){
										case 0:
											echo '<span class="rounded-pill badge badge-secondary col-6">Pendiente</span>';
											break;
										case 1:
											echo '<span class="rounded-pill badge badge-primary col-6">Confirmada</span>';
											break;
										case 2:
											echo '<span class="rounded-pill badge badge-danger col-6">Cancelado</span>';
											break;
									}
								?>
							</td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Acción
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-window-restore text-gray"></span> Ver</a>
									<div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Eliminar</a>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.view_data').click(function(){
			uni_modal("Reseva","reservations/view_details.php?id="+$(this).attr('data-id'),"mid-large")
		})
		$('.delete_data').click(function(){
			_conf("Realmente deseas cancelar esta reserva?","delete_reservation",[$(this).attr('data-id')])
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: [6] }
            ],
        });
	})
	function delete_reservation($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_reservation",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("Ocurrió un error.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("Ocurrió un error.",'error');
					end_loader();
				}
			}
		})
	}
</script>