<?php
session_start();
// error_reporting(0); // Comment out or remove this line for error reporting
include('config.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, mobile, password) VALUES (:name, :email, :mobile, :password)";
    $query = $db->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

    $query->execute();
    $lastInsertId = $db->lastInsertId();

    if ($lastInsertId) {
        $_SESSION['login'] = $email;
        echo "<script>alert(' Registerd successfully!')</script>";
      
    } else {
        echo "<script>alert('Please Fill All Valid Detail')</script>";
    }
    echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
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
    <link rel="stylesheet" href="./css/style.css">
</head>

<body style="background: linear-gradient(to bottom, #99ccff 0%, #ffffff 100%);">

    <section>
        <?php include('./inc/header.php'); ?>

        <div class="row justify-content-md-center ">
            <div class="col-4 bor">
                <form class="text-center border border-dark p-5" method="post">
                    <p class="h4 mb-4">Sign up</p>
                    <input name="name" type="text" class="form-control mb-4" placeholder="Name" required>
                    <input name="email" type="email" class="form-control mb-4" placeholder="Email" required>
                    <input name="mobile" type="number" class="form-control mb-4" placeholder="Mobile" required>
                    <input name="password" type="password" class="form-control mb-4" placeholder="Password" required>

                    <input class="btn btn-dark btn-block my-4" name="submit" type="submit" value="Register">
                    <p>Already Registerd?
                        <a href="login.php">Login</a>
                    </p>
                </form>
            </div>
        </div>
        <?php include('./inc/footer.php'); ?>
    </section>



</body>

</html>
<style>
  



</style>