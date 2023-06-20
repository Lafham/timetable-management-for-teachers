<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Change Horaire </title>
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

    if (isset($_GET['remove'])) {
        $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
        $removeUser = $users->deleteUserById($remove);
    }

    if (isset($removeUser)) {
        echo $removeUser;
    }
    if (isset($_GET['desactiver'])) {
        $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['desactiver']);
        $deactiveId = $users->userDesactiveByAdmin($deactive);
    }

    if (isset($deactiveId)) {
        echo $deactiveId;
    }
    if (isset($_GET['activer'])) {
        $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['activer']);
        $activeId = $users->userActiveByAdmin($active);
    }

    if (isset($activeId)) {
        echo $activeId;
    }


    ?>
    <div class="card ">
        <div class="card-header">
            <h3><i class="fas fa-users mr-2"></i>liste des utilisateurs <span class="float-right">Bienvenue! <strong>
                        <span class="badge badge-lg badge-secondary text-white">
                            <?php
                            $username = Session::get('username');
                            if (isset($username)) {
                                echo $username;
                            }
                            ?></span>

                    </strong></span></h3>
        </div>
        <div class="card-body pr-2 pl-2 ">

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Nom Complet</th>
                        <th class="text-center">Nom d'utilisateur</th>
                        <th class="text-center">Adresse email</th>
                        <th class="text-center">Telephone</th>
                        <th class="text-center">Mot de passe</th>
                        <th class="text-center">Activation</th>
                        <th class="text-center">Date de creation</th>
                        <th width='25%' class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $allUser = $users->selectAllUserData();

                    if ($allUser) {
                        $i = 0;
                        foreach ($allUser as  $value) {
                            $i++;

                    ?>

                            <tr class="text-center" <?php if (Session::get("id") == $value->id) {
                                                        echo "style='background:#d9edf7' ";
                                                    } ?>>

                                <td><?php echo $value->name; ?></td>
                                <td><?php echo $value->username; ?> <br>
                                    <?php if ($value->roleid  == '1') {
                                        echo "<span class='badge badge-lg badge-info text-white'>Chef departement</span>";
                                    } elseif ($value->roleid == '2') {
                                        echo "<span class='badge badge-lg badge-warning text-white'>Chef filiere</span>";
                                    } elseif ($value->roleid == '3') {
                                        echo "<span class='badge badge-lg badge-dark text-white'>Enseignant</span>";
                                    } ?></td>
                                <td><?php echo $value->email; ?></td>

                                <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->mobile; ?></span></td>
                                <td><?php echo md5($value->password); ?></td>

                                <td>
                                    <?php if ($value->isActive == '0') { ?>
                                        <span class="badge badge-lg badge-success text-white">Active</span>
                                    <?php } else { ?>
                                        <span class="badge badge-lg badge-danger text-white">Desactive</span>
                                    <?php } ?>

                                </td>


                                <td><span class="badge badge-lg badge-secondary text-white"><?php echo $users->formatDate($value->created_at);  ?></span></td>

                                <td>
                                    <?php if (Session::get("roleid") == '1') { ?>
                                        <a class="btn btn-info btn-sm " href="editUser.php?id=<?php echo $value->id; ?>">Modifier</a>
                                        <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger
                    <?php if (Session::get("roleid") == $value->roleid) {
                                            echo "disabled";
                                        } ?>
                             btn-sm " href="?remove=<?php echo $value->id; ?>">Supprimer</a>

                                        <?php if ($value->isActive == '0') {  ?>
                                            <a onclick="return confirm('Are you sure To Desactive ?')" class="btn btn-warning
                       <?php if (Session::get("roleid") == $value->roleid) {
                                                echo "disabled";
                                            } ?>
                                btn-sm " href="?desactiver=<?php echo $value->id; ?>">Disactiver</a>
                                        <?php } elseif ($value->isActive == '1') { ?>
                                            <a onclick="return confirm('Are you sure To Active ?')" class="btn btn-secondary
                       <?php if (Session::get("roleid") == $value->roleid) {
                                                echo "disabled";
                                            } ?>
                                btn-sm " href="?activer=<?php echo $value->id; ?>">Activer</a>
                                    <?php }
                                    } ?>

                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr class="text-center">
                            <td>La liste d'utilisateurs est vide !</td>
                        </tr>
                    <?php } ?>
                    <div>
                        <form action="" method="POST">
                            <div class="form-group">
                                <a class="btn btn-primary" href="addUser.php">Ajouter Utilisateur</a>
                            </div>
                        </form>
                    </div>
                </tbody>

            </table>


        </div>
    </div>
    <?php
    include 'inc/footer.php';

    ?>
</body>

</html>