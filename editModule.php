<?php
include 'inc/header.php';
Session::CheckSession();

?>

<?php

if (isset($_GET['num'])) {
  $num = preg_replace('/[^0-9]/', '', $_GET['num']);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateModule'])) {
  $updateModule = $users->updateModuleByNum($num, $_POST);
}

if (isset($updateModule)) {
  echo $updateModule;
}



?>

<div class="card ">
  <div class="card-header">
    <h3>Modification<span class="float-right"> <a href="ConsulterFilieres.php" class="btn btn-primary">Retour</a> </h3>
  </div>
  <div class="card-body">

    <?php
    $getUinfo = $users->getModuleInfo($num);
    if ($getUinfo) {






    ?>


      <div style="width:600px; margin:0px auto">

        <form class="" action="" method="POST">
          <div class="form-group">
            <label for="name">Nom de module</label>
            <input type="text" name="Nom" value="<?php echo $getUinfo->Nom_Module; ?>" class="form-control">
          </div>
          <div class="form-group">
                  <label for="filiere">Nom de filiere</label>
                  <select class="form-control" name="Filiere" id="filiere">
                  <?php $allFiliere = $users->selectFiliereName();
                        foreach ($allFiliere as  $value) :
                        ?>
                            <option value=<?php echo $value->id; ?>><?php echo $value->Nom_filiere; ?></option>
                        <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
                  <label for="Responsable">Responsable de module</label>
                  <select class="form-control" name="Responsable" id="Responsable">
                  <?php $allProf = $users->selectEnseignantEmail();
                        foreach ($allProf as  $value) :
                        ?>
                            <option value=<?php echo $value->Email; ?>><?php echo $value->Nom_Complet; ?></option>
                        <?php endforeach; ?>
            </select>
          </div>


                <div class="form-group">

                  <button type="submit" name="updateModule" class="btn btn-success">Modifier</button>
                </div>
              


        </form>
      </div>

    <?php } ?>



  </div>
</div>


<?php
include 'inc/footer.php';

?>