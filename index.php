<?php
function CalculeTotal($val1, $val2, $val3)
{
  $total = ($val1 * 2) + ($val2 * 1.5) + $val3;
  return $total;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/style.css">
  <title>Charge Horaire</title>
</head>

<body>
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



  if (isset($_GET['num']) && isset($_GET['type']) && isset($_GET['email']) ) {
    $remove = preg_replace('/[^a-zA-Z0-9]/', '', (int)$_GET['num']);
    $type = preg_replace('/[^a-zA-Z0-9]/', '', (int)$_GET['type']);
    $Prof = preg_replace('/[^a-zA-Z0-9@_.]/', '', $_GET['email']);

    $removeUser = $users->deleteUserByNumeroModule($remove, $Prof, $type);
  }

  if (isset($removeUser)) {
    echo $removeUser;
  }



  ?>

  <div class="card ">
    <div class="card-header">
      <h3><i class="fas fa-users mr-2"></i>La charge horaire <span class="float-right">Bienvenue! <strong>
            <span class="badge badge-lg badge-secondary text-white">
              <?php
              $username = Session::get('username');
              if (isset($username)) {
                echo $username;
              }
              ?></span>

          </strong></span>
        <br>
      </h3>
      <?php if (Session::get("roleid") == '1') { ?>
        <h4>
          <a class="btn btn-secondary" href="ajout.php">L'ajout</a>
        </h4><?php } ?>
    </div>
    <div class="card-body pr-2 pl-2 ">

      <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th class="text-center">Professeur</th>
            <th class="text-center">Grade</th>
            <th class="text-center">Module</th>
            <th class="text-center">filiere</th>
            <th class="text-center">semestre</th>
            <th class="text-center">session</th>
            <th class="text-center">cours</th>
            <th class="text-center">TD</th>
            <th class="text-center">TP</th>
            <th class="text-center">total (en Heure TP)</th>
            <th width='15%' class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $allUser = $users->Remplissage();

          if ($allUser) {
            foreach ($allUser as  $value) {


          ?>

              <td><?php echo $value->Nom_Complet; ?></td>
              <td><?php echo $value->Grade; ?></td>
              <td><?php echo $value->Nom_Module; ?></td>
              <td><?php echo $value->Nom_filiere; ?></td>
              <td><?php echo $value->Nom_Semestre; ?></td>
              <td><?php echo $value->Nom_Session; ?></td>
              <td><span class="badge badge-lg badge-secondary text-white">
                  <?php echo $value->Nombre_Heure_Cours;

                  ?></span></td>
              <td><span class="badge badge-lg badge-secondary text-white">
                  <?php echo $value->Nombre_Heure_TD;
                  ?></span></td>
              <td> <span class="badge badge-lg badge-secondary text-white">
                  <?php echo $value->Nombre_Heure_TP;
                  ?></span></td>
              <td><?php echo CalculeTotal($value->Nombre_Heure_Cours, $value->Nombre_Heure_TD, $value->Nombre_Heure_TP) ?> </td>

              <td>
                <?php if (Session::get("roleid") == '1') { ?>
                  <a class="btn btn-info btn-sm " href="editCharge.php?Email=<?php echo $value->Email; ?>&type=<?php echo $value->Num_Type; ?>&module=<?php echo $value->num;?>">Modifier</a>
                  <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger btn-sm " href="?num=<?php echo $value->num; ?>&type=<?php echo $value->Num_Type;?>&email=<?php echo $value->Email;?>">Supprimer</a>

                <?php  } elseif (Session::get("roleid") == '2') { ?>
                  <a class="btn btn-info btn-sm " href="editCharge.php?Email=<?php echo $value->Email; ?>&type=<?php echo $value->Num_Type; ?>&module=<?php echo $value->num;?>">Modifier</a>
                <?php  } else { ?>
                  <a class="btn btn-success btn-sm
                          <?php if ((Session::get("id") != $value->id)) {
                            echo "disabled";
                          } ?>
                          " href="editCharge.php?Email=<?php echo $value->Email; ?>&type=<?php echo $value->Num_Type; ?>&module=<?php echo $value->num;?>">Modifier</a>

                <?php } ?>




              </td>
              </tr>
            <?php }
          } else { ?>
            <tr class="text-center">
              <td>La charge horaire est vide !</td>
            </tr>
          <?php } ?>
          <?php if (Session::get("roleid") == '1' || Session::get("roleid") == '2') { ?>
            <div>
              <div>
                <nav class="navbar navbar-expand-md navbar-white bg-white card-header mw-100">
                  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav ml-auto">
                      <li class="nav-item">
                        <a class="btn btn-info" href="add.php">Remplir la charge horaire !!</a>
                      </li>

                  </div>

              </div>
            <?php } ?>
        </tbody>

      </table>









    </div>
  </div>
  <?php
  include 'inc/footer.php';

  ?>
</body>

</html>