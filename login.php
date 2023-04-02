<?php 
    include('includes/header.php'); 
    include('classes/CRUD.php');

    $errors = [];
    $crud = new CRUD;

    if(isset($_POST['login_btn'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($email)) {
            $errors[] = 'Email is required!';
        }

        if(empty($password)) {
            $errors[] = 'Password is required!';
        }


        if(count($errors) === 0) {
            $user = $crud->read('users', ['column' => 'email', 'value' => $email], 1);

            if(count($user)) {
                $user = $user[0];
                if(password_verify($password, $user['password'])) {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['email'] = $email;
                    $_SESSION['is_loggedin'] = true;
                    $_SESSION['is_admin'] = $user['is_admin'];

                    header('Location: dashboard/');
                    
                } else {
                    $errors[] = 'Username or/and password was incorrect!';
                }
            }
        }
    }

?>
<div class="auth py-5">
    <div class="container my-5 d-block" style="width:400px">
        <div class="row">
            <div class="d-flex justify-content-center" >
                <div class="login w-100" >
                    <h2>Login</h2>
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group my-4">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" />
                        </div>
                        <div class="form-group my-4">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" />
                        </div>
                        <button type="submit" name="login_btn" class="btn btn-sm">Login</button>
                        <a href="register.php" class="btn btn-sm btn-link">Register</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>