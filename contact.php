<?php 

session_start();

require "connection.php";  

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="icon" href="resources/logo.svg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Glamour</title>

</head>
<body>
  
<div class="container-fluid">
    <?php
    require "header.php";

    ?>
    <div class="container my-5">
  <div class="p-5 text-center bg-body-tertiary rounded-3">
    
    <h1 class="text-body-emphasis">Get In Touch</h1>
    <p class="col-lg-8 mx-auto fs-5 text-muted">
      We provide uniqure and latest fahshion clothes and we deliver to your home.
      Experience the uniqueness <code>
    </p>
    <div class="d-inline-flex gap-2 mb-5">
      <button class="d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill" type="button">
       Call Now : +94 112 623 654
      </button>
    </div>
  </div>
</div>
    
    
    
    <?php

    require "footer.php";
    ?>
</div>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>
</html>
