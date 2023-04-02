<?php 
    include('../includes/header-admin.php'); 
    include('../../classes/CRUD.php');

    
    $crud = new CRUD;
    $category = $crud->read('categories', ["column" => "id", "value" => $_GET["id"]], 1);

    if(isset($_POST["update-category-button"])){ 
        $title = $_POST["title"];
        $id = $_POST["id"];

        if(empty($title)){
            $errors = "You should enter a category name";
        }

        if(empty($id)){
            header("Location: index.php");
        }

        if($crud->update("categories", ["title" => $title], ["column" => "id", "value" => $id]) === true) {
            header("Location: index.php?action=update&status=success");
        }else{
            $errors = "Something went wrong";
        }
    }
    
?>


<section class="container" style="width: 50%">
    <div><h1 class="text-center my-3">Update category</h1></div>
    <?php if(isset($category) && is_array($category[0])): ?>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Category name</label>
            <input type="title" class="form-control" id="title" name="title" value="<?= $category[0]["title"] ?>">
        </div>
        <input type="hidden" value="<?= $category[0]["id"] ?>" name="id">
        <button type="submit" class="btn btn-primary" name="update-category-button">Update</button>
    </form>
    <?php endif; ?>
</section>


<?php include('../../includes/footer.php'); ?>