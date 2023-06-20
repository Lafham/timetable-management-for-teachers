<?php
include 'inc/header.php';
Session::CheckSession();



Session::set("msg", NULL);
$sId =  Session::get('roleid');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addRole'])) {

    $addRole = $users->addRole($_POST);
}


if (isset($addRole)) {
    echo $addRole;
}
if ($sId == '1') {
?>

    <body>
    <div class="card-body pr-2 pl-2 ">
        </div>
    <div class="card-header">
      <h3 class='text-center'>Ajouter un role administratif<span class="float-right"> <a href="ConsulterRole.php" class="btn btn-primary">Retour</a> </h3>
    </div>
        <div style="width:600px; margin:0px auto">

            <form class="" action="" method="POST">
                <div class="form-group">
                    <label for="role">Role administratif</label>
                    <input type="text" name="role" value="" class="form-control">
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre Heure</label>
                    <input type="number" name="nombre" value="" class="form-control">
                </div>

                <div class="form-group pt-3">
                    <label for="Nom">Professeur</label>
                    <select class="form-control" name="Professeur" id="Professeur">
                        <?php $allProf = $users->selectEnseignantEmail();
                        foreach ($allProf as  $value) :
                        ?>
                            <option value="<?php echo $value->Email; ?>"><?php echo $value->Nom_Complet; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" name="addRole" class="btn btn-success">Ajouter</button>
                </div>


            </form>
        </div>
    </body>
<?php } ?>