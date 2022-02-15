<style>
    .activity-holder{
        width:20vw;
    }
    .activity-img{
        object-fit: cover;
        object-position:center center;
        transition: transform .3s ease;
    }
    .activity-item:hover .activity-img{
        transform:scale(1.2);
    }
    a.activity-item.card.rounded-0.shadow.flex-row.text-decoration-none.text-dark {
        background: #8080801c;
    }
</style>
<div class="content py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-outline card-primary rounded-0 shadow">
                <div class="card-body">
                    <div class="row row-cols-sm-1 row-cols-md-2 row-cols-xl-2 gx-2 py-3" id="activity-list">
                        <?php 
                        $activitys = $conn->query("SELECT * FROM `activity_list` where delete_flag =0 and `status` = 1 order by `name` asc");
                        while($row = $activitys->fetch_assoc()):
                            $row['description'] = strip_tags(html_entity_decode($row['description']));
                        ?>
                        <div class="col">
                            <a href="javascript:void(0)" data-id="<?= $row['id'] ?>" class="activity-item card rounded-0 shadow flex-row text-decoration-none text-dark p-0">
                                <div class="col-auto p-0">
                                    <div class="activity-holder overflow-hidden">
                                    <img src="<?= validate_image($row['image_path']) ?>" class="img-top rounded-0 activity-img" alt="<?= $row['name'] ?> Image">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="container-fluid p-1 m-0 h-100 d-flex flex-column justify-content-center">
                                        <h3 class="text-navy mb-0"><b><?= $row['name'] ?></b></h3>
                                        <div class="truncate-5">
                                            <?= html_entity_decode($row['description']) ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
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
        $('.activity-item').click(function(){
            uni_modal("Atracción",'view_activity.php?id='+$(this).attr('data-id'),'mid-large')
        })
    })
</script>