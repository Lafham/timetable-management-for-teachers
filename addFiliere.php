<?php
include 'inc/header.php';
Session::CheckSession();

Session::set("msg", NULL);
$sId =  Session::get('roleid');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {

    $addFiliere = $users->addFiliere($_POST);
}


if (isset($addFiliere)) {
    echo $addFiliere;
}
if ($sId == '1') {
?>

        <div class="card-body pr-2 pl-2 ">
        </div>
        <div class="card-header">
            <h3 class='text-center'>Ajouter une filiere<span class="float-right"> <a href="ConsulterFilieres.php" class="btn btn-primary">Retour</a> </h3>
        </div>
        </div>
        <div style="width:600px; margin:0px auto">

            <form class="" action="" method="POST">
                <div class="form-group">
                    <label for="Nom">Nom de filiere</label>
                    <input type="text" name="Nom" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="Type">Type de formation </label>
                    <input type="text" name="Type_de_formation" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="Description">Description</label>
                    <input type="text" name="Description" value="" class="form-control">
                </div>
                <div class="form-group ">
                    <label for="Responsable">Responsable</label>
                    <select class="form-control" name="Email" id="Responsable">
                        <?php $allProf = $users->selectEnseignantEmail();
                        foreach ($allProf as  $value) :
                        ?>
                            <option value=<?php echo $value->Email; ?>><?php echo $value->Nom_Complet; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" name="add" class="btn btn-success">Ajouter</button>
                </div>


            </form>
        </div>

<?php } ?>
<?php
include 'inc/footer.php';

?>