<?php 
    include('../includes/header-admin.php');
    include('../../classes/CRUD.php');

    
    $crud = new CRUD;
    $posts = $crud->read('posts');

    if((isset($_GET["action"]) && $_GET["action"] == "delete")){
        if($crud->delete('posts', ["column" => "id", "value" => $_GET["id"]])){
            header("Location: index.php");
        }else{
            $errors = "Something went wrong";
        }
    }
?>

<div class="container text-center my-4">
    <a href="./create.php"><button type="button" class="btn btn-primary">Add Post</button></a>
</div>

<section class="container">
    <?php if($posts && count($posts)): ?>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Body</th>
            <th scope="col">Image</th>
            <th scope="col">Date</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($posts as $post) : ?>
            <tr>
                <th scope="row"><?= $post["id"] ?></th>
                <td><?= $post["title"] ?></td>
                <td style="width: 50%"><?= substr($post["body"], 0, 200) ?></td>
                <td><?= $post["image"] ?></td>
                <td>23/03/2023</td>
                <td>
                    <a href="./edit.php?id=<?= $post["id"] ?>" style="margin-right:10px">Edit</a>
                    <a href=".?action=delete&id=<?= $post["id"] ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</section>


<?php include('../../includes/footer.php'); ?>