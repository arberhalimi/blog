<?php 
    include('../includes/header-admin.php'); 
    include('../../classes/CRUD.php');

    
    $crud = new CRUD;
    $post = $crud->read('posts', ["column" => "id", "value" => $_GET["id"]], 1);
    $categories = $crud->read('categories');
    $errors = [];


    if(isset($_POST["update-post-button"])){ 
        $category_id = $_POST["category"];
        $title = $_POST["title"];
        $body = $_POST["body"];
        $image = $_POST["image"];
        $id = $_POST["id"];



        $data = [
            'user_id' => $_SESSION['id'], 
            'category_id' => $category_id,
            "title" => $title, 
            "body" => $body, 
            "image" => $image
        ];


        if(empty($title)){
            $errors = "You should enter a category name";
        }

        if(empty($body)){
            $errors = "You should enter a body";
        }

        if(empty($image)){
            $errors = "You should insert an image";
        }

        if(empty($id)){
            header("Location: index.php");
        }

        if($crud->update("posts", $data, ["column" => "id", "value" => $id]) === true) {
            header("Location: index.php?action=update&status=success");
        }else{
            $errors = "Something went wrong";
        }
    }
    
?>



<section class="container" style="width: 50%">
    <div><h1 class="text-center my-3">Update post</h1></div>
    <?php if($errors): ?>
        <?php foreach($errors as $error): ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if(isset($post) && is_array($post[0])): ?>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
        <select class="form-select my-3" name="category" aria-label="Default select example">
            <option selected>Select your category</option>
            <?php foreach($categories as $category): ?>
                <option value="<?= $category["id"] ?>"><?= $category["title"] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="title" name="title" class="form-control" id="title" value="<?= $post[0]["title"] ?>">
        </div>
        <div class="mb-3">
            <label for="Body" class="form-label">Body</label>
            <input type="Body" name="body" class="form-control" id="Body" value="<?= $post[0]["body"] ?>">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Default file input example</label>
            <input class="form-control" name="image" type="file" id="formFile" value="<?= $post[0]["image"] ?>">
        </div>
        <input type="hidden" value="<?= $post[0]["id"] ?>" name="id">
        <button type="submit" class="btn btn-primary" name="update-post-button">Update</button>
    </form>
    <?php endif; ?>
</section>


<?php include('../../includes/footer.php'); ?>