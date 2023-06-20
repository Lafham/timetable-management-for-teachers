<?php
include 'inc/header.php';
Session::CheckSession();

 ?>

<?php

if (isset($_GET['id'])) {
  $userid = $_GET['id'];

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
  $updateUser = $users->updateUserProfileByIdInfo($userid, $_POST);

}
if (isset($updateUser)) {
  echo $updateUser;
}




 ?>

 <div class="card ">
   <div class="card-header">
          <h3 class="text-center">Profile d'utilisateur</h3>
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


              <div class="form-group">
                <button type="submit" name="update" class="btn btn-success">Modifier</button>
                <a class="btn btn-primary" href="changepass.php?id=<?php echo $getUinfo->id;?>">Changer le mot de passe</a>
              </div>

          </form>
        </div>

      <?php } ?>



      </div>
    </div>


  <?php
  include 'inc/footer.php';

  ?>
