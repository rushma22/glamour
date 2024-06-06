<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="resources/logo.svg" type="image/x-icon">
</head>
<body>



<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">
      <div class="col-md-3 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
        <a href="home.php"><div class="col-4 logo mt-3" style="height:80px;"></div></a>
        </a>
      </div>

      <ul class="nav col-12 col-md-auto justify-content-center mb-md-0">
        <li><a href="home.php" class="nav-link px-3 link-secondary  fs-5" style="color:purple;">Home</a></li>
        <!-- <li><a href="#" class="nav-link px-3  fs-5" style="color:purple;">Blog</a></li> -->
        <li><a href="cart.php" class="nav-link px-3  fs-5" style="color:purple;"> My Cart</a></li>
        <li><a href="watchlist.php" class="nav-link px-3  fs-5" style="color:purple;">Wishlist</a></li>
        <li><a href="contact.php" class="nav-link px-3  fs-5" style="color:purple;">Contact</a></li>
        
      </ul>

      <div class="col-md-3 text-center">
      
      <?php

if(isset($_SESSION["u"])){
    $session_data = $_SESSION["u"];

    ?>
    <span class="text-lg-start fs-5"><b class="fs-5">Welcome </b>
    <?php echo $session_data["fname"]." ";?> !
</span> 
    <?php

}else{
    ?>
    
    <a href="index.php" class="text-decoration-none text-warning fw-bold fs-5">
        Sign In or Register
    </a>

    <?php
}

?>
<ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="userprofile.php" class="nav-link px-3  fs-5" style="color:purple;">My Profile</a></li>
        
      </ul>
      </div>
    </header>
  </div>





















 <!-- <div class="row text-danger" id="header" style="width:100%">
    <div class="col-lg-4">
    <a href="home.php"><div class="col-4 logo mt-3 mb-3" style="height:80px;"></div></a>
    </div>

    <div class=" col-lg-4 offset-sm-2 offset-2 offset-lg-3 mt-5 fs-2 ">
    <nav class="navbar navbar-expand-lg" style="">
  <div class="container-fluid" >
   
    <div class="collapse navbar-collapse"  id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 " style="font-size:20px;">
        <li class="nav-item active">
          <a class="nav-link" style="color:purple; font-size:15px;" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" style="color:purple; font-size:15px;" href="#">Blog</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link active " aria-current="page"  style="color:purple; font-size:15px;" href="#">Contact</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle me-5 " style="color:purple; font-size:15px;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Shop Now
          </a>
          <ul class="dropdown-menu" style="color:purple; font-size:20px;">
            <li><a class="dropdown-item" href="#">Men's</a></li>
            <li><a class="dropdown-item" href="#">Women's</a></li>
            <li><a class="dropdown-item" href="#">Kids and Babies</a></li>
          </ul>
        </li>

        <li class="nav-item"  style="height:10px" >
          <a class="nav-link active  me-3"aria-current="page" style="color:purple; font-size:15px;" href="cart.php"><i class="bi bi-cart3 fs-5"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active  me-3" aria-current="page" style="color:purple; font-size:15px;" href="watchlist.php"><i class="bi bi-heart fs-5"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active  me-3" aria-current="page" style="color:purple; font-size:15px;" href="userprofile.php"><i class="fs-5 bi bi-person-circle"></i></a>
        </li>
        <li class="nav-item col-4">
          <a class="nav-link active" style="color:purple; font-size:15px;" aria-current="page" href="#">
          <?php

                if(isset($_SESSION["u"])){
                    $session_data = $_SESSION["u"];

                    ?>
                    <span class="text-lg-start"><b>Welcome </b>
                    <?php echo $session_data["fname"]." ";?> !
                </span> 
                    <?php

                }else{
                    ?>
                    
                    <a href="index.php" class="text-decoration-none text-warning fw-bold">
                        Sign In or Register
                    </a>

                    <?php
                }

                ?>
                        </a>
        </li>

        
      </ul>
      
    </div>
  </div>
</nav>
    </div>
<hr>
    
 </div> -->
</body>
</html>


