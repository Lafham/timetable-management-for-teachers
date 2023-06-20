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
    $remove = preg_replace('/[^0-9]/', '', $_GET['remove']);
    $removeUser = $users->deleteRoleByNum($remove);
}
if (isset($removeUser)) {
    echo $removeUser;
}

?>
<div class="card ">
    <div class="card-header">
        <h3 class='text-center'>Les Roles Adminisratifs </h3>
    </div>
    <div class="card-body pr-2 pl-2">

        <table id="example" class="table table-striped table-bordered" >
            <thead>
                <tr>
                    <th width='15%' class="text-center" >Professeur</th>
                    <th width='15%' class="text-center">Role administratif </th>
                    <th width='15%' class="text-center">Nombre heure </th>
                    <th width='15%' class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $allUser = $users->selectRole();

                if ($allUser) {
                    $i = 0;
                    foreach ($allUser as  $value) {
                        $i++;

                ?>
                        <td><?php echo $value->professeur; ?></td>
                        <td><?php echo $value->role; ?></td>
                        <td><?php echo $value->nombre_heure; ?></td>
                        <td>
                            <?php if (Session::get("roleid") == '1') { ?>
                                <a class="btn btn-info btn-sm " href="editRole.php?num=<?php echo $value->num; ?>">Modifier</a>
                                <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger btn-sm " href="?remove=<?php echo $value->num; ?>">Supprimer</a>
                            <?php } ?>


                        </td>

                        </tr>

                    <?php }
                } else { ?>
                    <tr class="text-center">
                        <td> vide !!</td>
                    </tr>
                <?php } ?>
                <div>
                    <?php if (Session::get("roleid") == '1') { ?>
                        <form action="" method="POST">
                            <div class="form-group">
                            <a class="btn btn-primary" href="addRole.php">Ajouter un role</a>
                                <a href="ajout.php" class="btn btn-primary">Retour</a>
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