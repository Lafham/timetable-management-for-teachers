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
// line 393 in users !!!
// if (isset($_GET['remove'])) {
//     $remove = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['remove']);
//     $removeUser = $users->deleteDepById($remove);
// }
// if (isset($removeUser)) {
//     echo $removeUser;
// }

?>
<div class="card ">
    <div class="card-header">
        <h3 class='text-center'>Departement ! </h3>
    </div>
    <div class="card-body pr-2 pl-2" >

        <table id="example" class="table table-striped table-bordered" >
            <thead>
                <tr >
                    <th class="text-center" >Nom de departement</th>
                    <th class="text-center">Responsable </th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $allUser = $users->selectDep();

                if ($allUser) {
                    $i = 0;
                    foreach ($allUser as  $value) {
                        $i++;

                ?>
                        <td width='30%'><?php echo $value->nom_departement; ?></td>
                        <td><?php echo $value->responsable; ?></td>
                        <td width='30%' class="text-center" >
                            <?php if (Session::get("roleid") == '1') { ?>
                                <a class="btn btn-info btn-sm " href="editDepartement.php?id=<?php echo $value->id; ?>">Modifier</a>
                                <!-- <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger btn-sm " href="?remove=<?php echo $value->id; ?>">Supprimer</a> -->
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