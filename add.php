<?php
include 'inc/header.php';
Session::CheckSession();
$DB_HOST = "localhost";
$DB_NAME = "db_admin";
$DB_USER = "root";
$DB_PASS = "";

Session::set("msg", NULL);
$sId =  Session::get('roleid');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addModule'])) {

    $addModule = $users->AddModuleChargeHoraire($_POST);
}


if (isset($addModule)) {
    echo $addModule;
}
if ($sId == '1') {
?>


    <div class="card ">
        <div class="card-header">
            <h3 class='text-center'>Ajouter <span class="float-right"> <a href="index.php" class="btn btn-primary">Retour</a> </h3>
        </div>
        <div class="cad-body">
            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="post">
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
                    <div class="form-group pt-3">
                        <label for="Module">Module</label>
                        <select class="form-control" name="Module" id="Module">
                            <?php $allModule = $users->selectModuleName();

                            foreach ($allModule as  $value) :
                            ?>
                                <option value="<?php echo $value->num; ?>"><?php echo $value->Nom_Module; ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>


                    <div class="form-group pt-3">
                        <label for="Semestre">Semestre</label>
                        <select class="form-control" name="Semestre" id="Semestre">
                            <?php $allSemestre = $users->selectSemestreName();

                            foreach ($allSemestre as  $value) :
                            ?>
                                <option value="<?php echo $value->Nom_Semestre; ?>"><?php echo $value->Nom_Semestre; ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>

                    <div class="form-group pt-3">
                        <label for="type">Type d'enseignement</label>
                        <select class="form-control" name="type" id="type">
                            <?php $allType = $users->selectAllTypeEnseignement();

                            foreach ($allType as  $value) :
                            ?>
                                <option value="<?php echo $value->numero; ?>"><?php echo $value->label; ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>




                    <div class="form-group">
                        <label>Nombre d'heure du cous</label>
                        <input type="number" name="Nombre_Heure_Cours" id="Nombre_Heure_Cours" placeholder="ex: 65.98 or 100" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nombre d'heure du TD</label>
                        <input type="number" name="Nombre_Heure_TD" id="Nombre_Heure_TD" placeholder="ex: 65.98 or 100" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nombre d'heure du TP</label>
                        <input type="number" name="Nombre_Heure_TP" id="Nombre_Heure_TP" placeholder="ex: 65.98 or 100" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="addModule" class="btn btn-success">Enregistrer</button>
                    </div>


                </form>
            </div>


        </div>
    </div>


<?php
}
?>
<?php
include 'inc/footer.php';

?>