<?php
include 'inc/header.php';
Session::CheckSession();

?>

<?php

if (isset($_GET['id'])) {
  $id = preg_replace('/[^a-zA-Z0-9_.]/', '', $_GET['id']);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateDep'])) {
  $updateDep = $users->updateDepById($id, $_POST);
}

if (isset($updateDep)) {
  echo $updateDep;
}



?>

<div class="card ">
  <div class="card-header">
    <h3>Modification<span class="float-right"> <a href="ConsulterDep.php" class="btn btn-primary">Back</a> </h3>
  </div>
  <div class="card-body">

    <?php
    $getUinfo = $users->getDepInfo($id);
    if ($getUinfo) {






    ?>


      <div style="width:600px; margin:0px auto">

        <form class="" action="" method="POST">
          <div class="form-group">
            <label for="name">Nom de departement</label>
            <input type="text" name="Nom" value="<?php echo $getUinfo->nom_departement; ?>" class="form-control">
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

                  <button type="submit" name="updateDep" class="btn btn-success">Modifier</button>
                </div>
              


        </form>
      </div>

    <?php } ?>



  </div>
</div>


<?php
include 'inc/footer.php';

?>