<?php 
    include('../includes/header-admin.php'); 
    include('../../classes/CRUD.php');

    $errors = [];
    $crud = new CRUD;

    if(isset($_POST["create-user-button"])){ 
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $avatar = $_FILES["avatar"];

        if(empty($firstname)){
            $errors[] = "You should enter firstname";
        }

        if(empty($lastname)){
            $errors[] = "You should enter lastname";
        }

        if(empty($username)){
            $errors[] = "You should enter your username";
        }

        if(empty($email)){
            $errors[] = "You should enter your email";
        }

        if(empty($password)){
            $errors[] = "You should enter your password";
        }

        function imageIsValid($avatar) { 
            $ext = end(explode('.', $avatar)); 
            $allowed_extensions = ['png', 'jpg', 'jpeg', 'webp'];
            return in_array($ext, $allowed_extensions);
        }


        $data = [
            "firstname" => $firstname,
            "lastname" => $lastname,
            "username" => $username,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_BCRYPT ),
            "avatar" => $avatar
        ];

        if(!empty($avatar['name']) || imageIsValid($avatar['name'])) {
            $data['avatar'] = time().$avatar['name'];
        }

        if($crud->create("users", $data ) === true) {
            if(isset($avatar['name']) && imageIsValid($avatar['name'])) {
                move_uploaded_file($avatar['tmp_name'], './user_images/'.time().$avatar['name']);
            }
            header("Location: index.php?action=create&status=success");
        }else{
            $errors[] = "Something went wrong";
        }
    }

?>


<section class="container" style="width: 50%">
    <div><h1 class="text-center my-3">Create a user</h1></div>
    <?php if($errors): ?>
        <?php foreach($errors as $error): ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    <?php endif; ?>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Firstname</label>
            <input type="text" class="form-control" id="name" name="firstname">
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Lastname</label>
            <input type="text" class="form-control" id="lastname" name="lastname">
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="Body" class="form-label">Password</label>
            <input type="password" class="form-control" id="Body" name="password">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Default file input example</label>
            <input class="form-control" type="file" id="formFile" name="avatar">
        </div>
        <button type="submit" class="btn btn-primary" name="create-user-button">Submit</button>
    </form>
</section>


<?php include('../../includes/footer.php'); ?>