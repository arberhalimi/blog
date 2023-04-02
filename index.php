<?php 
    include('includes/header.php'); 
    include('classes/CRUD.php');

    $crud = new CRUD;
    $posts = $crud->read('posts');
    $all_categories = $crud->read('categories');
?>

<nav class="navbar sticky-top bg-body-tertiary my-3 ">
  <div class="container justify-content-center">
  <?php foreach($all_categories as $category): ?>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="#"><?= $category["title"] ?></a>
            </li>
        </ul>
    <?php endforeach; ?>
  </div>
</nav>


<div class="container d-flex">
    <?php foreach($posts as $post): ?>
    <div class="card my-5" style="width: 18rem;">
        <img src="dashboard/posts/post_images/<?= $post["image"] ?>" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title"><?= $post["title"] ?></h5>
            <p class="card-text"><?= substr($post["body"], 0, 200) ?> ...</p>
            <a href="blog.php?id=<?= $post["id"] ?>" class="btn btn-primary">Full article</a>
            <div class="card-footer text-body-secondary my-2">
            <?= $post["date_time"] ?>
            </div>
            <!-- <div class="d-flex">
                <a href="#" class="btn "><?= $categories[0]["title"] ?></a>
                <a href="#" class="btn "><?= "@" .$users[0]["username"] ?></a>
            </div> -->
        </div>
    </div>
    <?php endforeach; ?>
</div>



<?php include('includes/footer.php'); ?>
