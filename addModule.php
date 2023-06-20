<?php
include 'inc/header.php';
Session::CheckSession();



Session::set("msg", NULL);
$sId =  Session::get('roleid');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addModule'])) {

    $addModule = $users->addModule($_POST);
}


if (isset($addModule)) {
    echo $addModule;
}
if ($sId == '1') {
?>

    <body>
        <div class="card-body pr-2 pl-2 ">
        </div>
        <div class="card-header">
            <h3><a href="ConsulterModules.php" class="btn btn-secondary">Les modules !</a></h3>
            <h3 class='text-center'>Ajouter un module<span class="float-right"> </h3>
        </div>
        <div style="width:600px; margin:0px auto">

            <form class="" action="" method="POST">
                <div class="form-group">
                    <label for="name">Nom de Module</label>
                    <input type="text" name="Nom_Module" value="" class="form-control">
                </div>

       
                <div class="form-group pt-3">
                    <label for="Filiere">Filiere</label>
                    <select class="form-control" name="Nom_Filiere" id="Filiere">
                        <?php $allfiliere = $users->selectFiliereName();

                        foreach ($allfiliere as  $value) :
                        ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->Nom_filiere; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <div class="form-group pt-3">
                    <label for="Nom">Responsable</label>
                    <select class="form-control" name="Responsable" id="Responsable">
                        <?php $allProf = $users->selectEnseignantEmail();
                        foreach ($allProf as  $value) :
                        ?>
                            <option value="<?php echo $value->Email; ?>"><?php echo $value->Nom_Complet; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                        <button type="submit" name="addModule" class="btn btn-success">Ajouter</button>
                    </div>


            </form>
        </div>
    </body>
<?php } ?>