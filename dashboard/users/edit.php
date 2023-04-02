<?php 
    include('../../includes/header-admin.php'); 
    include('../../classes/CRUD.php');

    $errors = [];
    $crud = new CRUD;
    $user = $crud->read('users', ["column" => "id", "value" => $_GET["id"]], 1);

    if(isset($_POST["update-user-button"])){ 
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $avatar = $_POST["avatar"];
        $is_admin = $_POST["is_admin"];
        $id = $_POST["id"];

        if(empty($id)){
            $errors = "empty id";
        }

        if(empty($firstname)){
            $errors = "You should enter firstname";
        }

        if(empty($lastname)){
            $errors = "You should enter lastname";
        }

        if(empty($username)){
            $errors = "You should enter your username";
        }

        if(empty($email)){
            $errors = "You should enter your email";
        }

        if(empty($password)){
            $errors = "You should enter your password";
        }

        $data = [
            "firstname" => $firstname,
            "lastname" => $lastname,
            "username" => $username,
            "email" => $email,
            "password" => $password,
            "avatar" => $avatar
        ];

        if($crud->update("users", $data, ["column" => "id", "value" => $id]) === true) {
            header("Location: index.php?action=update&status=success");
        }else{
            $errors = "Something went wrong";
        }
    }
    
?>


<section class="container" style="width: 50%">
    <div><h1 class="text-center my-3">Edit user</h1></div>
    <?php if(isset($user) && is_array($user[0])): ?>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="firstname" value="<?= $user[0]["firstname"] ?>">
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" class="form-control" id="surname" name="surname" value="<?= $user[0]["lastname"] ?>">
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $user[0]["username"] ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="<?= $user[0]["email"] ?>">
        </div>
        <div class="mb-3">
            <label for="Body" class="form-label">Password</label>
            <input type="password" class="form-control" id="Body" name="password" value="<?= $user[0]["password"] ?>">
        </div>
        <label for="Body" class="form-label">Is Admin</label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Yes
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked name="avatar" >
            <label class="form-check-label" for="flexCheckChecked">
                No
            </label>
         </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Default file input example</label>
            <input class="form-control" type="file" id="formFile" value="<?= $user[0]["avatar"] ?>">
        </div>
        <input type="hidden" value="<?= $user[0]["id"] ?>" name="id">
        <button type="submit" class="btn btn-primary" name="update-user-button">Update</button>
    </form>
    <?php endif; ?>
</section>


<?php include('../../includes/footer.php'); ?>