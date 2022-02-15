<?php
$from = isset($_GET['from']) ? $_GET['from'] : date('Y-m-d',strtotime(date("Y-m-d").'-1 week'));
$to = isset($_GET['to']) ? $_GET['to'] : date('Y-m-d');
?>
<style>
    #show-print{
        display:none !important;
    }
</style>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Reporte Reservas</h3>
	</div>
	<div class="card-body">
        <fieldset>
            <legend class="text-muted">Filtro</legend>
            <form action="" id="filter-report">
                <div class="row align-items-end">
                    <div class="form-group col-md-3">
                        <small class="text-muted mx-2">Desde</small>
                        <input type="date" name="from" value="<?= $from ?>" class="form-control form-control-sm rounded-0" required>
                    </div>
                    <div class="form-group col-md-3">
                        <small class="text-muted mx-2">Hasta</small>
                        <input type="date" name="to" value="<?= $to ?>" class="form-control form-control-sm rounded-0" required>
                    </div>
                    <div class="form-group col-md-3">
                        <button class="btn btn-primary btn-flat btn-sm"><i class="fa fa-filter"></i> Filtro</button>
                        <button class="btn btn-success btn-flat btn-sm" type="button" id="print"><i class="fa fa-print"></i> Imprimir</button>
                    </div>
                </div>
            </form>
        </fieldset>
        <div class="container-fluid" id="outprint">
            <style>
                #logo{
                    width:5em;
                    height:5em;
                    top:0;
                    left:2.5em;
                    object-fit:cover;
                    object-position:center center;
                }
            </style>
            <div id="show-print">
                <div class="w-100 position-relative">
                    <img src="<?= validate_image($_settings->info('logo')) ?>" id="logo" alt="Logo" class="img-circle position-absolute border">
                    <h3 class="m-0 text-center"><?= $_settings->info('name') ?></h3>
                    <h4 class="text-center"><b>Reporte de Reservas - ConfiguroWeb</b></h4>
                    <center><small>
                        <?php 
                        if($from == $to){
                            echo date("F d, Y",strtotime($from));
                        }else{
                            echo date("M d, Y",strtotime($from)). " - " .date("M d, Y",strtotime($to));

                        }
                        ?>
                    </small></center>
                </div>
            </div>
			<table class="table table-hover table-striped table-bordered">
				<colgroup>
					<col width="5%">
					<col width="10%">
					<col width="20%">
					<col width="25%">
					<col width="25%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Código</th>
						<th>Cliente</th>
						<th>Reserva</th>
						<th>Información de Cuarto</th>
						<th>Estado</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT r.*,rr.name as room_name, rr.type as room_type from `reservation_list` r inner join `room_list` rr on r.room_id = rr.id where ( (date(`check_in`) Between '{$from}' and '{$to}') or (date(`check_out`) Between '{$from}' and '{$to}') ) order by r.`status` asc, unix_timestamp(r.`date_created`) desc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?= $i++ ?></td>
							<td class="px-2"><?php echo ($row['code']) ?></td>
							<td class="px-2"><p class="truncate-1 m-0"><?php echo ucwords($row['fullname']) ?></p></td>
							<td class="px-0">
                                <div class="border-bottom px-2"><span class="text-muted"><i class="fa fa-calendar"></i> Ingreso: </span><?= $row['check_in'] ?></div>
                                <div class="px-2"><span class="text-muted"><i class="fa fa-calendar"></i> Salida: </span><?= $row['check_out'] ?></div>
                            </td>
							<td class="px-0">
                                <div class="border-bottom px-2"><span class="text-muted">Cuarto: </span><?= $row['room_name'] ?></div>
                                <div class="px-2"><span class="text-muted">Tipo: </span><?= $row['room_type'] ?></div>
                            </td>
							<td class="text-center">
								<?php 
									switch ($row['status']){
										case 0:
											echo '<span class="rounded-pill badge badge-secondary col-6">Pendiente</span>';
											break;
										case 1:
											echo '<span class="rounded-pill badge badge-primary col-6">Confirmado</span>';
											break;
										case 2:
											echo '<span class="rounded-pill badge badge-danger col-6">Cancelado</span>';
											break;
									}
								?>
							</td>
						</tr>
					<?php endwhile; ?>
                    <?php if($qry->num_rows <= 0): ?>
                        <tr>
                            <th class="text-center" colspan="6">Sin información que mostrar</th>
                        </tr>
                    <?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#filter-report').submit(function(e){
            e.preventDefault();
            location.href = './?page=reports&'+$(this).serialize()
        })
        $('#print').click(function(){
            var _h = $('head').clone()
            var _p = $('#outprint').clone()
            var _el = $('<div>').clone()
            _h.find('title').text('Reporte de Reservas - ConfiguroWeb')
            _el.append(_h)
            _el.append(_p)
            start_loader();
            var nw = window.open('','_blank','width=1100,height=900,top=100,left=100')
                    nw.document.write(_el.html())
                    nw.document.close()
                    setTimeout(() => {
                        nw.print()
                        setTimeout(() => {
                            nw.close()
                            end_loader()
                        }, 300);
                    }, (700));
        })
	})
</script>