<?php
session_start();
error_reporting(E_ALL);
include('config.php');

$msg = '';
if (isset($_GET['add'])) {
  if (isset($_SESSION['user'])) {
    $productid = $_GET['add'];
    $user = $_SESSION['user'];
    $sql = "INSERT INTO cart(productid,user) VALUES(:productid,:user)";
    $query = $db->prepare($sql);
    $query->bindParam(':productid', $productid, PDO::PARAM_STR);
    $query->bindParam(':user', $user, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $db->lastInsertId();
    if ($lastInsertId) {
      $msg = '<div id="msg" class="alert alert-success"><strong>product added to crt  succesfully!</strong></div>';
    } else {
      $msg = '<div id="msg" class="alert alert-danger"><strong>Unable To Add</strong></div>';
    }
  } else {
     $msg = '<div id="msg" class="alert alert-danger"><strong>Please Login</strong></div>';
  }
} else {
}
// get projects
$sql = "SELECT * from products WHERE category = 'Mens'";
$query = $db->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

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
  <script>
    if (typeof window.history.pushState == 'function') {
      window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF']; ?>');
    }
  </script>
</head>

<body style="background: linear-gradient(to bottom, #99ccff 0%, #ffffff 100%);">

  <section>
    <?php include('./inc/header.php'); ?>

    <div class="container mt-5 my-section">
      <h3 class="py-4">Mens</h3>
      <div class="msg"><?php echo $msg; ?></div>
      <div class="row">

        <?php

        if ($query->rowCount() > 0) {
          foreach ($results as $result) {      
              ?>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card h-100">
                <!-- path url -->
                <a href="#"><img class="card-img-top" src="./img/products/<?php 
                // echo  image using php from source source url 
                echo $result->img; ?>" alt="<?php echo $result->title; ?>" title="<?php echo $result->title; ?>"></a>
                <!-- echo title for type -->
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#"><?php echo $result->title; ?></a>
                    <!-- print tile from database -->
                  </h4>
                  <h5><?php echo CURRENCY ?> <?php echo $result->price; ?></h5>
                  <!-- print price on screen -->
                  <!-- add to cart button -->
                  <a href="mens.php?add=<?php echo $result->id; ?>" class="btn btn-dark mt-2">Add To Cart</a>
                </div>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    </div>

    <?php include('./inc/footer.php'); ?>
  </section>


  </script>
</body>

</html>