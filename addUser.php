<?php
include 'inc/header.php';
Session::CheckSession();
$sId =  Session::get('roleid');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUSer'])) {

  $register = $users->addNewUserByAdmin($_POST);
}

if (isset($register)) {
  echo $register;
}
if ($sId == '1') { ?>




  <div class="card ">
    <div class="card-header">
    </div>
    <div class="card-header">
      <h3 class='text-center'>Ajouter un nouveau utilisateur<span class="float-right"> <a href="utilisateurs.php" class="btn btn-primary">Back</a> </h3>
    </div>
    <div class="cad-body">



      <div style="width:600px; margin:0px auto">

        <form class="" action="" method="post">
          <div class="form-group pt-3">
            <label for="name">Nom Complet</label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Address email</label>
            <input type="email" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="mobile">Telephone</label>
            <input type="text" name="mobile" class="form-control">
          </div>
          <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" class="form-control">
          </div>
          <div class="form-group">
            <div class="form-group">
              <label for="sel1">Selectionner le role d'utilisateur</label>
              <select class="form-control" name="roleid" id="roleid">
                <option value="2">Chef filiere</option>
                <option value="3">Enseignant</option>

              </select>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" name="addUSer" class="btn btn-success">Enregistrer</button>
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