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
    $removeUser = $users->deleteFiliereById($remove);
}
if (isset($removeUser)) {
    echo $removeUser;
}

?>
<div class="card ">
    <div class="card-header">
        <h3 class='text-center'>Les Filieres </h3>
    </div>
    <div class="card-body pr-2 pl-2">

        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Nom de filiere</th>
                    <th class="text-center">Type de formation</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Responsable de filiere</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $allUser = $users->selectFiliere();

                if ($allUser) {
                    $i = 0;
                    foreach ($allUser as  $value) {
                        $i++;

                ?>
                        <td><?php echo $value->Nom_filiere; ?></td>
                        <td><?php echo $value->Type_de_formation; ?></td>
                        <td><?php echo $value->Description; ?></td>
                        <td><?php echo $value->Responsable; ?></td>
                        <td>
                            <?php if (Session::get("roleid") == '1') { ?>
                                <a class="btn btn-info btn-sm " href="editFiliere.php?id=<?php echo $value->id; ?>">Modifier</a>
                                <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger btn-sm " href="?remove=<?php echo $value->id; ?>">Supprimer</a>
                            <?php } ?>


                        </td>

                        </tr>

                    <?php }
                } else { ?>
                    <tr class="text-center">
                        <td>la liste de filiere est vide !!</td>
                    </tr>
                <?php } ?>
                <div>
                    <?php if (Session::get("roleid") == '1') { ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <a class="btn btn-primary" href="addFiliere.php">Ajouter une filiere</a>
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