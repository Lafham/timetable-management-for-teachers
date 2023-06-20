<?php
include 'inc/header.php';
Session::CheckSession();

?>

<?php

if (isset($_GET['id'])) {
  $id = preg_replace('/[^a-zA-Z0-9_.]/', '', $_GET['id']);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateFiliere'])) {
  $updateFiliere = $users->updateFiliereById($id, $_POST);
}

if (isset($updateFiliere)) {
  echo $updateFiliere;
}



?>

<div class="card ">
  <div class="card-header">
    <h3>Modification<span class="float-right"> <a href="ConsulterFilieres.php" class="btn btn-primary">Retour</a> </h3>
  </div>
  <div class="card-body">

    <?php
    $getUinfo = $users->getFiliereInfo($id);
    if ($getUinfo) {






    ?>


      <div style="width:600px; margin:0px auto">

        <form class="" action="" method="POST">
          <div class="form-group">
            <label for="name">Nom de filiere</label>
            <input type="text" name="Nom" value="<?php echo $getUinfo->Nom_filiere; ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="name">Type de formation</label>
            <input type="text" name="TypeFormation" value="<?php echo $getUinfo->Type_de_formation; ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="Description">Description</label>
            <input type="text" id="Description" name="Description" value="<?php echo $getUinfo->Description; ?>" class="form-control">
          </div>
          <div class="form-group">
                  <label for="Responsable">Responsable</label>
                  <select class="form-control" name="Responsable" id="Responsable">
                  <?php $allGrade = $users->selectEnseignantEmail();
                        foreach ($allGrade as  $value) :
                        ?>
                            <option value=<?php echo $value->Email; ?>><?php echo $value->Nom_Complet; ?></option>
                        <?php endforeach; ?>
            </select>
          </div>


                <div class="form-group">

                  <button type="submit" name="updateFiliere" class="btn btn-success">Modifier</button>
                </div>
              


        </form>
      </div>

    <?php } ?>



  </div>
</div>


<?php
include 'inc/footer.php';

?>