<?php 
$from = isset($_GET['from']) ? date("Y-m-d", strtotime($_GET['from'])) : "";
$to = isset($_GET['to']) ? date("Y-m-d", strtotime($_GET['to'])) : "";
?>
<style>
    .room-holder{
        width:20vw;
    }
    .room-img{
        object-fit: cover;
        object-position:center center;
        transition: transform .3s ease;
    }
    .room-item:hover .room-img{
        transform:scale(1.2);
    }
</style>
<div class="content py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-outline card-primary rounded-0 shadow">
                <div class="card-body">
                    <div class="list-group" id="room-list">
                        <?php 
                        $rooms = $conn->query("SELECT * FROM `room_list` where delete_flag =0 and `status` = 1 order by `name` asc");
                        while($row = $rooms->fetch_assoc()):
                            $row['description'] = strip_tags(html_entity_decode($row['description']));
                        ?>
                        <a href="./?page=view_room&id=<?= $row['id'] ?>" class="text-decoration-none text-dark room-item list-group-item list-group-item-action">
                            <div class="d-flex align-items-top">
                                <div class="col-auto">
                                    <div class="room-holder overflow-hidden">
                                    <img src="<?= validate_image($row['image_path']) ?>" class="img-thumbnail rounded-0 room-img" alt="<?= $row['name'] ?> Image">
                                    </div>
                                </div>
                                <div class="col-auto flex-grow-1 flex-shrink-1">
                                    <h3 class="text-navy mb-0"><b><?= $row['name'] ?></b></h3>
                                    <div class='text-muted'><span class="mr-3"><i class="fa fa-bed"></i></span><?= $row['type'] ?></div>
                                    <div class="truncate-5">
                                        <?= html_entity_decode($row['description']) ?>
                                    </div>
                                    <h4 class='text-success'><small><span class="tex-muted mr-3"><i class="fa fa-tag"></i></span></small><?= number_format($row['price'],2) ?>/<small>day</small></h4>
                                </div>
                            </div>
                        </a>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#filter-schedule').submit(function(e){
            e.preventDefault();
            location.href = "./?page=schedules&"+$(this).serialize();
        })
    })
</script>