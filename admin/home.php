<h1>Bienvenid@ al <?php echo $_settings->info('name') ?> - Dashboard</h1>
<hr class="border-info">
<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fas fa-bed"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Cuartos Disponibles</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `room_list` where delete_flag = 0 and status = 1 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-maroon elevation-1"><i class="fas fa-bed"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Cuartos no Disponibles</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `room_list` where delete_flag = 0 and status = 0 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-table"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Reservaciones Pendientes</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `reservation_list` where `status` = 0 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-table"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Reservaciones Confirmadas</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `reservation_list` where `status` = 1 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-danger elevation-1"><i class="fas fa-table"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Reservaciones Canceladas</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `reservation_list` where `status` = 2 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-success elevation-1"><i class="fas fa-swimmer"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Atracciones Activas</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `activity_list` where status=1 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-danger elevation-1"><i class="fas fa-swimmer"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Atracciones Inactivas</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `activity_list` where status=0 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-teal elevation-1"><i class="fas fa-question-circle"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Consultas sin Leer</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `message_list` where status=0 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
<hr>
