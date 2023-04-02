<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TECH-B</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="./assets/css/style.css" rel="stylesheet">
</head>
<body>

<header class="bg-body-tertiary d-flex">
    <div class="container">
        <a href="index.php"><img src="./assets/images/logo.png" class="my-5 " style="width: 200px"></a>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">   
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="login.php">Sign In</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="register.php">Register</a>
                </li>
            </ul>
            </div>
        </div>
        </nav>
    </div>
</header>
