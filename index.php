<?php

require_once './vendor/autoload.php';
use src\Controllers\UserController;
$errors= [];
$username='';
$email='';
$password='';
$password_confirm='';
$cv_url='';
$users = UserController::getAll();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $cv_url = $_POST['cv_url'];
    $result = json_decode(UserController::add(),true);
    if($result['status'] == 'error'){
        global $errors;
        $errors = $result['message'];
    }else{
        echo $result['status'];
    }
}



?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Document</title>
</head>

<div class="m-5" >
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" novalidate>
        <div class="row mb-3">
            <div class="col">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input  id="username" value="<?php echo $username; ?>"  name="username" type="text" class="form-control <?php echo $errors['username'] ? 'is-invalid' : '' ?>"   placeholder="Enter Username" aria-describedby="usernameHelp" >
                    <small id="usernameHelp" class="form-text text-muted">Username should be min 6 and max 16.</small>
                    <div class="invalid-feedback">
                        <small><?php echo $errors['username'] ?> </small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input  id="email" value="<?php echo $email; ?>" name="email" type="text" class="form-control <?php echo $errors['email'] ? 'is-invalid' : '' ?>"   placeholder="Enter email" aria-describedby="emailHelp" >
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    <div class="invalid-feedback">
                        <small><?php echo $errors['email'] ??  '' ?></small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" value="<?php echo $password; ?>" name="password" type="Password" class="form-control <?php echo $errors['password']  ? 'is-invalid'  : '' ?>"   placeholder="Enter password">
                    <div class="invalid-feedback">
                        <small><?php echo $errors['password']  ?? '' ?></small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="password_confirm">password_confirm</label>
                    <input id="password_confirm" value="<?php echo $password_confirm; ?>" name="password_confirm" type="password" class="form-control <?php echo $errors['password_confirm']  ? 'is-invalid'  : '' ?>"   placeholder="Enter password confirm    ">
                    <div class="invalid-feedback">
                        <small><?php echo $errors['password_confirm']  ?? '' ?></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="cv_url">CV url</label>
                    <input id="cv_url" value="<?php echo $cv_url; ?>" name="cv_url" type="text" class="form-control <?php echo $errors['cv_url']  ? 'is-invalid'  : '' ?>"  placeholder="Enter cv url">
                    <div class="invalid-feedback">
                        <small><?php echo $errors['cv_url']  ??  '' ?></small>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <hr>
    <br>

    <table class="table table-dark">
        <thead class="thead">
        <tr>
            <th scope="col">username</th>
            <th scope="col">email</th>
            <th scope="col">cv_url</th>
        </tr>
        </thead>
        <?php foreach ($users as $user): ?>
            <tbody>
            <tr>
                <th scope="row"><?= $user['username']; ?></th>
                <td ><?= $user['email']; ?></td>
                <td ><?= $user['cv_url']; ?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
