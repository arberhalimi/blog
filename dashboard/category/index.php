<?php 
    include('../includes/header-admin.php');
    include('../../classes/CRUD.php');

    
    $crud = new CRUD;
    $categories = $crud->read('categories');

    if((isset($_GET["action"]) && $_GET["action"] == "delete")){
        if($crud->delete('categories', ["column" => "id", "value" => $_GET["id"]])){
            header("Location: index.php");
        }else{
            $errors = "Something went wrong";
        }
    }
?>

<div class="container text-center my-4">
    <a href="./create.php"><button type="button" class="btn btn-primary">Add Category</button></a>
</div>

<section class="container">
    <?php if($categories && count($categories)): ?>
        <?php if(isset($_GET["action"]) && isset($_GET["status"])): ?>
            <?php if(($_GET["action"] == "create") && ($_GET["status"] == "success")): ?>
                <div class="alert alert-success" role="alert">
                    Category added succesfuly!
                </div>
            <?php endif; ?>
        <?php endif; ?>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($categories as $category):?>
                    <tr>
                    <th scope="row"><?= $category["id"] ?></th>
                    <td><?= $category["title"] ?></td>
                    <td>
                        <a href="./edit.php?id=<?= $category["id"] ?>" style="margin-right:10px">Edit</a>
                        <a href="?action=delete&id=<?= $category["id"] ?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>


<?php include('../../includes/footer.php'); ?>
