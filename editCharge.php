<?php
include 'inc/header.php';
Session::CheckSession();

?>
<?php


if (isset($_GET['Email'])&&isset($_GET['type'])&&isset($_GET['module'])) {
  $numModule = preg_replace('/[^a-zA-Z0-9]/', '', (int)$_GET['module']);
  $numType = preg_replace('/[^a-zA-Z0-9]/', '', (int)$_GET['type']);
  $ProfEmail = preg_replace('/[^a-zA-Z0-9@_.]/', '', $_GET['Email']);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
  $updateCharge = $users->updateChargeByProfEmail($ProfEmail,$numType,$numModule,$_POST);
}
if (isset($updateCharge)) {
  echo $updateCharge;
}
?>
<div class="card ">
  <div class="card-header">
    <h3> Charge Horaire<span class="float-right"> <a href="index.php" class="btn btn-primary">Retour</a> </h3>
  </div>
  <div class="card-body">

    <?php
    $getUinfo = $users->getChargeInfoByProfEmail($ProfEmail);
    if ($getUinfo) {






    ?>


      <div style="width:600px; margin:0px auto">

        <form class="" action="" method="POST">
          <div class="form-group">
            <label for="module">Module</label>
            <select class="form-control" name="Nom_Module" id="Nom_Module">
              <?php $allModule = $users->selectModuleName();

              foreach ($allModule as  $value) :
              ?>
                <option value="<?php echo $value->num; ?>"><?php echo $value->Nom_Module; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="Semestre">Semestre</label>
            <select class="form-control" name="Nom_Semestre" id="Nom_Semestre">
              <?php $allSemestre = $users->selectSemestreName();

              foreach ($allSemestre as  $value) :
              ?>
                <option value="<?php echo $value->Nom_Semestre; ?>"><?php echo $value->Nom_Semestre; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="Cours">Cours</label>
            <input type="text" id="Cours" name="Nombre_Heure_Cours" value="<?php echo $getUinfo->Nombre_Heure_Cours; ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="TD">TD</label>
            <input type="text" id="TD" name="Nombre_Heure_TD" value="<?php echo $getUinfo->Nombre_Heure_TD; ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="TP">TP</label>
            <input type="text" id="TP" name="Nombre_Heure_TP" value="<?php echo $getUinfo->Nombre_Heure_TP; ?>" class="form-control">
          </div>


          <div class="form-group">
            <button type="submit" name="update" class="btn btn-success">Update</button>
          </div>

        </form>
      </div>

    <?php } ?>



  </div>
</div>


<?php
include 'inc/footer.php';

?>