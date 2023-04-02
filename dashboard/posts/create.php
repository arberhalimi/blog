<?php 
    include('../includes/header-admin.php'); 
    include('../../classes/CRUD.php');

    $errors = [];
    $crud = new CRUD;
    $categories = $crud->read('categories');

    if(isset($_POST["create-post-button"])){ 
        $category_id = $_POST["category"];
        $title = $_POST["title"];
        $body = $_POST["body"];
        $image = $_FILES["image"];


        $data = [
            "user_id" => $_SESSION["id"], 
            "category_id" => $category_id, 
            "title" => $title, 
            "body" => $body, 
            "image" => $image
        ];

        if(empty($title)){
            $errors = "You should enter a post title";
        }

        if(empty($body)) {
            $errors = "Your post shuld contain some text";
        }

        if(empty($image)) {
            $errors = "You should upload an image";
        }

        
        function imageIsValid($image) { 
            $ext = end(explode('.', $image)); 
            $allowed_extensions = ['png', 'jpg', 'jpeg', 'webp'];
            return in_array($ext, $allowed_extensions);
        }

        if(!empty($image['name']) || imageIsValid($image['name'])) {
            $data['image'] = time().$image['name'];
        }

        if($crud->create("posts", $data ) === true) {
            if(isset($image['name']) && imageIsValid($image['name'])) {
                move_uploaded_file($image['tmp_name'], './post_images/'.time().$image['name']);
            }
            header("Location: index.php?action=create&status=success");
        }else{
            $errors[] = "Something went wrong";
        }
    }
?>


<section class="container" style="width: 50%">
    <div><h1 class="text-center my-3">Create a post</h1></div>
    <?php if($errors): ?>
        <?php foreach($errors as $error): ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    <?php endif; ?>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data">
        <select class="form-select my-3" name="category" aria-label="Default select example">
            <option selected>Select your category</option>
            <?php foreach($categories as $category): ?>
                <option value="<?= $category["id"] ?>"><?= $category["title"] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="title" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="Body" class="form-label">Body</label>
            <input type="text" class="form-control" id="body" name="body">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Default file input example</label>
            <input class="form-control" type="file" id="formFile" name="image">
        </div>
        <button type="submit" class="btn btn-primary" name="create-post-button">Submit</button>
    </form>
</section>


<?php include('../../includes/footer.php'); ?>