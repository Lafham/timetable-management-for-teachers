<?php
include 'inc/header.php';
Session::CheckSession();



Session::set("msg", NULL);
$sId =  Session::get('roleid');
if ($sId == '1') {
?>

    <div class="card-body pr-2 pl-2 ">
        <div class="row" style="width: 100vw;">
            <div class="col-xl-4 col-sm-6 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-comments"></i>
                        </div>

                        <div class="mr-5">Module</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="ConsulterModules.php">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6 mb-3">
                <div class="card text-white bg-secondary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-comments"></i>
                        </div>

                        <div class="mr-5">Filiere</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="ConsulterFilieres.php">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6 mb-3">
                <div class="card text-white bg-success o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-comments"></i>
                        </div>

                        <div class="mr-5">Departement</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="ConsulterDep.php">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-fw fa-comments"></i>
                        </div>

                        <div class="mr-5">Administration</div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="ConsulterRole.php">
                        <span class="float-left">View Details</span>
                        <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    </a>
                </div>
            </div>      
        </div>
    </div>

<?php } ?>
<?php
include 'inc/footer.php';

?>