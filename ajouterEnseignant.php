<?php
include 'inc/header.php';
Session::CheckSession();
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);
$sId =  Session::get('roleid');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addEnseignant'])) {

  $enseignant = $users->AjouterEnseignant($_POST);
}


if (isset($enseignant)) {
  echo $enseignant;
}
if ($sId == '1') { ?>




  <div class="card ">
    <div class="card-header">
      <h3 class='text-center'>Ajouter un nouveau enseignant <span class="float-right"> <a href="enseignant.php" class="btn btn-primary">Back</a> </h3>
    </div>
    <div class="cad-body">



      <div style="width:600px; margin:0px auto">

        <form class="" action="" method="post">
          <div class="form-group pt-3">
            <label for="Nom">Nom Complet</label>
            <input type="text" name="Nom_Complet" class="form-control">
          </div>
          <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" name="Email" class="form-control">
          </div>
          <div class="form-group">
            <label for="Telephone">Telephone</label>
            <input type="text" name="Telephone" class="form-control">
          </div>
          <div class="form-group">
            <label>Civilite</label><br>
            <select class="form-control" name="Civilite" id="Civilite">
              <option value="Homme">Homme</option>
              <option value="Femme">Femme</option>
            </select>
          </div>
          <div class="form-group">
            <label for="Grade">Grade</label>
            <select class="form-control" name="Grade" id="Grade">
              <?php $allGrade = $users->selectGrade();
              foreach ($allGrade as  $value) :
              ?>
                <option value=<?php echo $value->Grade; ?>><?php echo $value->Grade; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="users">Nom d'utilisateur correspond</label>
            <select class="form-control" name="users" id="users">
              <?php $allusers = $users->selectUsername();
              foreach ($allusers as  $value) :
              ?>
                <option value=<?php echo $value->id; ?>><?php echo $value->username; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <button type="submit" name="addEnseignant" class="btn btn-success">Enregistrer</button>
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