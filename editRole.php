<?php
include 'inc/header.php';
Session::CheckSession();

?>

<?php

if (isset($_GET['num'])) {
    $num = preg_replace('/[^a-zA-Z0-9_.]/', '', $_GET['num']);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateRole'])) {
    $updateDep = $users->updateroleBynum($num, $_POST);
}

if (isset($updateDep)) {
    echo $updateDep;
}



?>

<div class="card ">
    <div class="card-header">
        <h3>Modification<span class="float-right"> <a href="ConsulterRole.php" class="btn btn-primary">Retour</a> </h3>
    </div>
    <div class="card-body">

        <?php
        $getUinfo = $users->getroleInfo($num);
        if ($getUinfo) {






        ?>


            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="POST">
                    <div class="form-group">
                        <label for="Prof">Professeur</label>
                        <select class="form-control" name="Prof" id="Prof">
                            <?php $allGrade = $users->selectEnseignantEmail();
                            foreach ($allGrade as  $value) :
                            ?>
                                <option value=<?php echo $value->Email; ?>><?php echo $value->Nom_Complet; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Role">Role</label>
                        <input type="text" name="role" value="<?php echo $getUinfo->role; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Nombre">Nombre Heure</label>
                        <input type="text" name="nombre" value="<?php echo $getUinfo->nombre_heure; ?>" class="form-control">
                    </div>


                    <div class="form-group">

                        <button type="submit" name="updateRole" class="btn btn-success">Modifier</button>
                    </div>



                </form>
            </div>

        <?php } ?>



    </div>
</div>


<?php
include 'inc/footer.php';

?>