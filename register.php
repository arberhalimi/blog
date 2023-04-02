<?php 
    include('includes/header.php'); 
    include('classes/CRUD.php'); 

    $errors = [];
    $crud = new CRUD;


    if(isset($_POST["register-button"])){ 
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $avatar = $_POST["avatar"];

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



        if(count($errors) === 0) {
            $data = [
                "firstname" => $firstname,
                "lastname" => $lastname,
                "username" => $username,
                "email" => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                "avatar" => $avatar
            ];
    
            if($crud->create('users', $data)) {
                header('Location: login.php?action=register&status=1');
            } 
        }
    }
?>
    


<div class="container my-5 d-block" style="width:400px">
<h2>Register</h2>
    <?php if($errors): ?>
        <?php foreach($errors as $error): ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    <?php endif; ?>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="firstname" class="form-control" id="name" placeholder="Name">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" name="lastname" class="form-control" id="surname" placeholder="Surname">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Username">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="example@email.com">
            <label for="avatar" class="col-sm-5 col-form-label">Choose your avatar</label>
            <input type="file" name="avatar" class="form-control" id="avatar" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
        </div>
        <div class="mb-3">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password">
            <label for="inputPassword" class="col-sm-5 col-form-label">Comfirm password</label>
            <input type="password" name="comfirm-password" class="form-control" id="comfirm-password">
        </div>
        <button type="submit" name="register-button" class="btn btn-primary mb-3">Register</button>
    </form>
</div>



<?php include('includes/footer.php'); ?>