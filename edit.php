<?php
include 'inc/header.php';
Session::CheckSession();

?>

<?php

if (isset($_GET['Email'])) {
  $userEmail = preg_replace('/[^a-zA-Z0-9@_.]/', '', $_GET['Email']);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
  $updateUser = $users->updateUserByEmailInfo($userEmail, $_POST);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateEnseignant'])) {
  $updateEnseignant = $users->updateEnseignantByEmailInfo($userEmail, $_POST);
}
if (isset($updateUser)) {
  echo $updateUser;
}

if (isset($updateEnseignant)) {
  echo $updateEnseignant;
}



?>

<div class="card ">
  <div class="card-header">
    <h3>Profile d'Enseignant<span class="float-right"> <a href="enseignant.php" class="btn btn-primary">Retour</a> </h3>
  </div>
  <div class="card-body">

    <?php
    $getUinfo = $users->getUserInfoByEmail($userEmail);
    if ($getUinfo) {






    ?>


      <div style="width:600px; margin:0px auto">

        <form class="" action="" method="POST">
          <div class="form-group">
            <label for="name">Nom Complet</label>
            <input type="text" name="Nom_Complet" value="<?php echo $getUinfo->Nom_Complet; ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="name">Email</label>
            <input type="email" name="Email" value="<?php echo $getUinfo->Email; ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="Telephone">Telephone</label>
            <input type="text" id="Telephone" name="Telephone" value="<?php echo $getUinfo->Telephone; ?>" class="form-control">
          </div>
          <div class="form-group">
            <label>Civilite</label><br>
            <select class="form-control" name="Civilite" id="Civilite">
              <?php

              if ($getUinfo->Civilite == 'Homme') { ?>
                <option value="Homme" selected='selected'>Homme</option>
                <option value="Femme">Femme</option>
              <?php } elseif ($getUinfo->Civilite == 'Femme') { ?>
                <option value="Homme">Homme</option>
                <option value="Femme" selected='selected'>Femme</option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="Grade">Grade</label>
            <select class="form-control" name="Grade" id="Grade">

              <?php

              if ($getUinfo->Grade == 'PES') { ?>
                <option value="PES" selected='selected'>PES</option>
                <option value="PH">PH</option>
                <option value="PA">PA</option>
              <?php } elseif ($getUinfo->Grade == 'PH') { ?>
                <option value="PES">PES</option>
                <option value="PH" selected='selected'>PH</option>
                <option value="PA">PA</option>
              <?php } elseif ($getUinfo->Grade == 'PA') { ?>
                <option value="PES">PES</option>
                <option value="PH">PH</option>
                <option value="PA" selected='selected'>PA</option>
              <?php } ?>
            </select>
          </div>

          <?php if (Session::get("roleid") == '1') { ?>

            <div class="form-group
              <?php if (Session::get("roleid") == '1' && Session::get("Email") == $getUinfo->Email) {
                echo "d-none";
              } ?>
              ">
              <div class="form-group">
            <label for="users">Nom d'utilisateur correspond</label>
            <select class="form-control" name="id_users" id="users">
              <?php $allusers = $users->selectUsername();
              foreach ($allusers as  $value) :
              ?>
                <option value=<?php echo $value->id; ?>><?php echo $value->username; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

              <?php } else { ?>
                <input type="hidden" name="roleid" value="<?php echo $getUinfo->roleid; ?>">
              <?php } ?>

              <?php if (Session::get("Email") == $getUinfo->Email) { ?>


                <div class="form-group">
                  <button type="submit" name="update" class="btn btn-success">Modifier</button>
                </div>
              <?php } elseif (Session::get("roleid") == '1') { ?>


                <div class="form-group">
                  <button type="submit" name="update" class="btn btn-success">Modifier</button>
                </div>
              <?php } elseif (Session::get("roleid") == '2') { ?>


                <div class="form-group">
                  <button type="submit" name="update" class="btn btn-success">Modifier</button>

                </div>

              <?php   } else { ?>
                <div class="form-group">

                  <button type="submit" name="updateEnseignant" class="btn btn-success">Modifier</button>
                </div>
              <?php } ?>


        </form>
      </div>

    <?php } ?>



  </div>
</div>


<?php
include 'inc/footer.php';

?>