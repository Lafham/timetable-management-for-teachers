<?php
include 'inc/header.php';
Session::CheckSession();

 ?>

<?php

if (isset($_GET['Email'])) {
  $userEmail = preg_replace('/[^a-zA-Z0-9@_.]/', '', $_GET['Email']);

}




 ?>

 <div class="card ">
   <div class="card-header">
          <h3>Profile d'Enseignant<span class="float-right"> <a href="enseignant.php" class="btn btn-primary">Back</a> </h3>
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
              <label for="sel1">Civilite</label>
                  <select class="form-control" name="Civilite" id="Civilite">
                  <option value="1" selected='selected'>Homme</option>
                  <option value="2">Femme</option>
                <input type="hidden" id="Civilite" name="Civilite" value="<?php echo $getUinfo->Civilite; ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="mobile">Grade</label>
                <select class="form-control" name="Grade" id="Grade">
                <option value="1" selected='selected'>PES</option>
                  <option value="2">PH</option>
                  <option value="3">PA</option>   
                <input type="hidden" id="Grade" name="Grade" value="<?php echo $getUinfo->Grade; ?>" class="form-control">
              </div>

              <?php if (Session::get("roleid") == '1') { ?>

              <div class="form-group
              <?php if (Session::get("roleid") == '1' && Session::get("Email") == $getUinfo->Email) {
                echo "d-none";
              } ?>
              ">
                <div class="form-group">
                  <label for="sel1">Select user Role</label>
                  <select class="form-control" name="roleid" id="roleid">

                  <?php

                if($getUinfo->roleid == '1'){?>
                  <option value="1" selected='selected'>Chef departement</option>
                  <option value="2">Chef filiere</option>
                  <option value="3">Enseignant</option>
                <?php }elseif($getUinfo->roleid == '2'){?>
                  <option value="1">Chef departement</option>
                  <option value="2" selected='selected'>Chef filiere</option>
                  <option value="3">Enseignant</option>
                <?php }elseif($getUinfo->roleid == '3'){?>
                  <option value="1">Chef departement</option>
                  <option value="2">Chef filiere</option>
                  <option value="3" selected='selected'>Enseignant</option>


                <?php } ?>


                  </select>
                </div>
              </div>

          <?php }else{?>
            <input type="hidden" name="roleid" value="<?php echo $getUinfo->roleid; ?>">
          <?php } ?>
                  <div class="form-group">

                    <a class="btn btn-primary" href="enseignant.php">Ok</a>
                  </div>


          </form>
        </div>

      <?php }?>



      </div>
    </div>


  <?php
  include 'inc/footer.php';

  ?>
