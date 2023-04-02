<?php 
    include('includes/header-admin.php');
    
?>


<nav class="navbar sticky-top bg-body-tertiary my-3 ">
  <div class="container justify-content-center">
        <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="./posts/index.php">Posts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./users/index.php">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./category/index.php">Categories</a>
        </li>
        </ul>
  </div>
</nav>

<section class="container my-5 px-5 text-center" style="">
    <div class="row">
        <div class="box col py-3" style="border: 1px solid gray;">
            <h1>Posts</h1>
            <h2>42</h2>
        </div>
        <div class="box col py-3" style="border: 1px solid gray;">
            <h1>Users</h1>
            <h2>2</h2>
        </div>
        <div class="box col py-3" style="border: 1px solid gray;">
            <h1>Categories</h1>
            <h2>5</h2>
        </div>
    </div>
</section>


<?php include('../includes/footer.php'); ?>