<?php 
    include('../includes/header-admin.php');
    include('../../classes/CRUD.php');

    
    $crud = new CRUD;
    $users = $crud->read('users');

    if((isset($_GET["action"]) && $_GET["action"] == "delete")){
        if($crud->delete('users', ["column" => "id", "value" => $_GET["id"]])){
            header("Location: index.php");
        }else{
            $errors = "Something went wrong";
        }
    }
?>

<div class="container text-center my-4">
    <a href="./create.php"><button type="button" class="btn btn-primary">Add User</button></a>
</div>

<section class="container">
    <?php if($users && count($users)): ?>
        <?php if(isset($_GET["action"]) && isset($_GET["status"])): ?>
            <?php if(($_GET["action"] == "create") && ($_GET["status"] == "success")): ?>
                <div class="alert alert-success" role="alert">
                    User added succesfuly!
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Firstname</th>
            <th scope="col">Surname</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Avatar</th>
            <th scope="col">Is Admin</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
            <tr>
                <th scope="row"><?= $user["id"] ?></th>
                <td><?= $user["firstname"] ?></td>
                <td><?= $user["lastname"] ?></td>
                <td><?= $user["username"] ?></td>
                <td><?= $user["email"] ?></td>
                <td><?= $user["avatar"] ?></td>
                <td>Yes</td>
                <td>
                    <a href="./edit.php?id=<?= $user["id"] ?>" style="margin-right:10px">Edit</a>
                    <a href=".?action=delete&id=<?= $user["id"] ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</section>


<?php include('../../includes/footer.php'); ?>