<?php
require_once('./config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `activity_list` where id = '{$_GET['id']}'");
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
        width:100%;
        object-fit: scale-down;
        object-position:center center;
    }
    #uni_modal .modal-footer{
        display:none;
    }
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12">
            <img src="<?= validate_image(isset($image_path) ? $image_path : "") ?>" alt="activity Image" class="img-thumbnail bg-gradient-dark" id="banner-img">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <dl>
                <dt class="text-muted">Atracción</dt>
                <dd class='pl-4 fs-4 fw-bold'><?= isset($name) ? $name : 'N/A' ?></dd>
            </dl>
        </div>
        <div class="col-md-6">
            <dl>
                <dt class="text-muted">Estado</dt>
                <dd class='pl-4 fs-4 fw-bold'>
                    <?php 
                        if(isset($status)){
                            switch($status){
                                case '1':
                                    echo '<span class="px-4 badge badge-success rounded-pill">Activa</span>' ;
                                    break;
                                case '0':
                                    echo '<span class="px-4 badge badge-danger rounded-pill">Inactiva</span>' ;
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
            <small class="text-muted">Description</small>
            <div><?= isset($description) ? html_entity_decode($description) : "N/A" ?></div>
        </div>
    </div>
    <div class="text-right">
        <button class="btn btn-dark btn-sm btn-flat" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
    </div>
</div>