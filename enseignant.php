<?php
include 'inc/header.php';

Session::CheckSession();

$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
  echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);
?>
<?php

if (isset($_GET['supprimer'])) {
  $remove = preg_replace('/[^a-zA-Z0-9@_.]/', '', $_GET['supprimer']);
  $removeUser = $users->deleteProfByEmail($remove);
}
if (isset($removeUser)) {
  echo $removeUser;
}

?>
<div class="card ">
  <div class="card-header">
    <h3><i class="fas fa-users mr-2"></i>Liste des professeurs <span class="float-right">Bienvenue! <strong>
          <span class="badge badge-lg badge-secondary text-white">
            <?php
            $username = Session::get('username');
            if (isset($username)) {
              echo $username;
            }
            ?></span>

        </strong></span></h3>
  </div>
  <div class="card-body pr-2 pl-2">

    <table id="example" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th class="text-center">Professeur</th>
          <th class="text-center">Email</th>
          <th class="text-center">Telephone</th>
          <th class="text-center">Civilite</th>
          <th class="text-center">Grade</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $allUser = $users->selectEnseignant();

        if ($allUser) {
          $i = 0;
          foreach ($allUser as  $value) {
            $i++;

        ?>
            <td><?php echo $value->Nom_Complet; ?></td>
            <td><?php echo $value->Email; ?></td>
            <td><?php echo $value->Telephone; ?></td>

            <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->Civilite; ?></span></td>


            <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->Grade;  ?></span></td>

            <td>
              <?php if (Session::get("roleid") == '1') { ?>
                <a class="btn btn-info btn-sm " href="edit.php?Email=<?php echo $value->Email; ?>">Modifier</a>
                <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger
                    <?php if (Session::get("Email") == $value->Email) {
                      echo "disabled";
                    } ?>
                             btn-sm " href="?supprimer=<?php echo $value->Email; ?>">Supprimer</a>

              <?php  } elseif (Session::get("Email") == $value->Email  && Session::get("roleid") == '2') { ?>
                <a class="btn btn-info btn-sm " href="edit.php?Email=<?php echo $value->Email; ?>">Modifier</a>
              <?php  } elseif (Session::get("roleid") == '2') { ?>
                <a class="btn btn-info btn-sm
                          <?php if ($value->roleid == '1') {
                            echo "disabled";
                          } ?>
                          " href="edit.php?Email=<?php echo $value->Email; ?>">Modifier</a>
              <?php } elseif (Session::get("Email") == $value->Email  && Session::get("roleid") == '3') { ?>
                <a class="btn btn-info btn-sm " href="edit.php?Email=<?php echo $value->Email; ?>">Modifier</a>
              <?php } else { ?>
                <a class="btn btn-success btn-sm
                          <?php if ((Session::get("id") != $value->id_users)) {
                            echo "disabled";
                          } ?>
                          " href="edit.php?Email=<?php echo $value->Email; ?>">Modifier</a>

              <?php } ?>


            </td>

            </tr>

          <?php }
        } else { ?>
          <tr class="text-center">
            <td>No user availabe now !</td>
          </tr>
        <?php } ?>
        <div>
          <?php if (Session::get("roleid") == '1') { ?>
            <form action="" method="POST">
              <div class="form-group">
                <a class="btn btn-primary" href="ajouterEnseignant.php">Ajouter Enseignant</a>
              </div>
            </form>
          <?php } ?>
        </div>

      </tbody>

    </table>









  </div>
</div>



<?php
include 'inc/footer.php';

?>