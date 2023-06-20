<?php
include 'inc/header.php';
Session::CheckSession();

 ?>

<?php

if (isset($_GET['id'])) {
  $userid = $_GET['id'];

}



 ?>

 <div class="card ">
   <div class="card-header">
          <h3>User Profile <span class="float-right"> <a href="utilisateurs.php" class="btn btn-primary">Back</a> </h3>
        </div>
        <div class="card-body">

    <?php
    $getUinfo = $users->getUserInfoById($userid);
    if ($getUinfo) {
     ?>


          <div style="width:600px; margin:0px auto">

          <form class="" action="" method="POST">
              <div class="form-group">
                <label for="name">Nom Complet</label>
                <input type="text" name="name" value="<?php echo $getUinfo->name; ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" value="<?php echo $getUinfo->username; ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="email">Address email</label>
                <input type="email" id="email" name="email" value="<?php echo $getUinfo->email; ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="mobile">Telephone</label>
                <input type="text" id="mobile" name="mobile" value="<?php echo $getUinfo->mobile; ?>" class="form-control">
              </div>

              <?php if (Session::get("roleid") == '1') { ?>

              <div class="form-group
              <?php if (Session::get("roleid") == '1' && Session::get("id") == $getUinfo->id) {
                echo "d-none";
              } ?>
              ">
                <div class="form-group">
                  <label for="sel1">Selection le role</label>
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

                    <a class="btn btn-primary" href="utilisateurs.php">Ok</a>
                  </div>
          </form>
        </div>

      <?php } ?>

      </div>
    </div>


  <?php
  include 'inc/footer.php';

  ?>
