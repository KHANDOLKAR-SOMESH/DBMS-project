<?php
session_start();
// error_reporting(0); // Comment out or remove this line for error reporting
include('config.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, name, email, password FROM users WHERE email=:email";
    $query = $db->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {

        echo "<script>alert('Invalid email or password');</script>";
        
    } else {
        $_SESSION['login'] = $user['name'];
        $_SESSION['user'] = $user['id'];
        echo "<script>alert('Login successful')</script>";
        echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
       
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProjecT | Online Store for Latest Trends</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/loginstyle.css">
</head>

<body style="background: linear-gradient(to bottom, #99ccff 0%, #ffffff 100%);">

    <section>
        <?php include('./inc/header.php'); ?>

        <div class="row justify-content-md-center">
            <div class="col-4">
                <form class="text-center border border-light p-5" method="post">
                    <p class="h4 mb-4">Sign in</p>
                    <input type="email" name="email" class="form-control mb-4" placeholder="E-mail" required>
                    <input type="password"  name="password" class="form-control mb-4" placeholder="Password" required>

                    <div class="d-flex justify-content-around">
                        <div>
                            <div class="custom-control custom-checkbox">
                                
                            </div>
                        </div>
                        <div>
                            <a href="">Forgot password?</a>
                        </div>
                    </div>
                    <input class="btn btn-dark btn-block my-4" name="submit" type="submit" value="Sign In">
                    <p>
                        <a href="register.php">click to register</a>
                    </p>
                </form>
            </div>
        </div>
        <?php include('./inc/footer.php'); ?>
    </section>

</body>

<style>
    .btn{
      font-size:2.8 vm;
        color:white;
        background-color:blue;
    }
    .btn:hover{
        color:white;
        background-color:black;
    }
</style>
</html>