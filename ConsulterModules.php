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
    $remove = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['remove']);
    $removeUser = $users->deleteModuleByNum($remove);
}
if (isset($removeUser)) {
    echo $removeUser;
}

?>
<div class="card ">
    <div class="card-header">
        <h3 class='text-center'>Les Modules </h3>
    </div>
    <div class="card-body pr-2 pl-2">

        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th width='15%' class="text-center">Numero</th>
                    <th width='25%' class="text-center">Nom de module</th>
                    <th  width='20%' class="text-center">Nom de filiere</th>
                    <th width='25%' class="text-center">Responsable de module</th>
                    <th width='15%' class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $allUser = $users->selectModule();

                if ($allUser) {
                    $i = 0;
                    foreach ($allUser as  $value) {
                        $i++;

                ?>
                        <td><?php echo $value->num; ?></td>
                        <td><?php echo $value->Nom_Module; ?></td>
                        <td><?php echo $value->Nom_filiere; ?></td>
                        <td><?php echo $value->Responsable; ?></td>
                        <td>
                            <?php if (Session::get("roleid") == '1') { ?>
                                <a class="btn btn-info btn-sm " href="editModule.php?num=<?php echo $value->num; ?>">Modifier</a>
                                <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger btn-sm " href="?remove=<?php echo $value->num; ?>">Supprimer</a>
                            <?php } ?>


                        </td>

                        </tr>

                    <?php }
                } else { ?>
                    <tr class="text-center">
                        <td>la liste de module est vide !!</td>
                    </tr>
                <?php } ?>
                <div>
                    <?php if (Session::get("roleid") == '1') { ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <a class="btn btn-primary" href="addModule.php">Ajouter un module</a>
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