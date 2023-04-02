<?php 
    include('../includes/header-admin.php'); 
    include('../../classes/CRUD.php');

    $errors = [];
    $crud = new CRUD;

    if(isset($_POST["create-category-button"])){ 
        $title = $_POST["title"];

        if(empty($title)){
            $errors = "You should enter a category name";
        }

        if($crud->create("categories", ["title" => $title] ) === true) {
            header("Location: index.php?action=create&status=success");
        }else{
            $errors = "Something went wrong";
        }
    }
?>


<section class="container" style="width: 50%">
    <div><h1 class="text-center my-3">Create a category</h1></div>
    <?php if($errors): ?>
        <?php foreach($errors as $error): ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    <?php endif; ?>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Category name</label>
            <input type="title" class="form-control" id="title" name="title">
        </div>
        <button type="submit" class="btn btn-primary" name="create-category-button">Submit</button>
    </form>
</section>


<?php include('../../includes/footer.php'); ?>