<?php
    include('includes/header.php'); 
    include('classes/CRUD.php');

    $crud = new CRUD;
    $post = $crud->read('posts', ["column" => "id", "value" => $_GET["id"]], 1);

?>

<div class="container d-flex">
    <div class="my-5" style="width: 60rem;">
        <img src="dashboard/posts/post_images/<?= $post[0]["image"] ?>" class="card-img-top">
        <div class="card-footer text-body-secondary my-2">
            <?= $post[0]["date_time"] ?>
        </div>
        <div class="card-body">
            <h5 class="card-title mx-3 my-5"><?= $post[0]["title"] ?></h5>
            <p class="card-text my-3"><?= $post[0]["body"] ?></p>
        </div>
    </div>
</div>