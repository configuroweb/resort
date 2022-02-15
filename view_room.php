<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `room_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<style>
    #banner-img{
        object-fit: scale-down;
        object-position:center center;
    }
</style>
<div class="card card-outline card-primary rounded-0 shadow mb-5">
    <div class="card-header">
        <h4 class="card-title"><b>Información del Cuarto</b></h4>
        <div class="card-tools">
            <button class="btn btn-primary btn-sm btn-flat" type="button" id="reserve_room"><i class="fa fa-edit"></i> Reserva</button>
            <a class="btn btn-light border btn-sm btn-flat" href="./?page=rooms" ><i class="fa fa-angle-left"></i> Volver</a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8 col-sm-12">
                    <img src="<?= validate_image(isset($image_path) ? $image_path : "") ?>" alt="Room Image" class="img-thumbnail bg-gradient-dark" id="banner-img">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <dl>
                        <dt class="text-muted">Nombre del Cuarto</dt>
                        <dd class='pl-4 fs-4 fw-bold'><?= isset($name) ? $name : 'N/A' ?></dd>
                        <dt class="text-muted">Tipo de Cuarto</dt>
                        <dd class='pl-4 fs-4 fw-bold'><?= isset($type) ? $type : 'N/A' ?></dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <dl>
                        <dt class="text-muted">Precio</dt>
                        <dd class='pl-4 fs-4 fw-bold'><?= isset($price) ? number_format($price,2) : '0.00' ?></dd>
                        <dt class="text-muted">Status</dt>
                        <dd class='pl-4 fs-4 fw-bold'>
                            <?php 
                                if(isset($status)){
                                    switch($status){
                                        case '1':
                                            echo '<span class="px-4 badge badge-success rounded-pill">Activo</span>' ;
                                            break;
                                        case '0':
                                            echo '<span class="px-4 badge badge-danger rounded-pill">Inactivo</span>' ;
                                            break;
                                    }
                                }
                            
                            ?>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <small class="text-muted">Descripción</small>
                    <div><?= isset($description) ? html_entity_decode($description) : "N/A" ?></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(function(){
        $('#reserve_room').click(function(){
            uni_modal("Reserva del <?= $name ?>","reserve.php?rid=<?= isset($id) ? $id : '' ?>",'mid-large')
        })
        
    })
</script>