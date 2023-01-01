<!DOCTYPE html>
<html lang="en">
<?php
if(array_key_exists('adminlogin',$_POST)){
    if (isset($_SESSION['signedup']) || isset($_SESSION['loggedin']) ||isset($_SESSION['pid'])) {
        unset($_SESSION['pid']);
        unset($_SESSION['signedup']);
        unset($_SESSION['loggedin']);
    }
    $uname = $_POST['uname'];
    $password = $_POST['password'];
    if($uname=="admin" && $password=="root"){
        $_SESSION['admin']=1;
        echo'<script>alert("admin login successful");</script>';
        echo'<script> window.location.replace("admin_page.php"); </script>';
        die();
    }else{
        echo'<script>alert("invalid username and password");</script>';
    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Railways Management System</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=McLaren&family=Merriweather&family=Montserrat&family=Poppins&family=Roboto:wght@300;400&family=Sacramento&family=Titillium+Web:wght@300;400;600&family=Ubuntu:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg bg-light">
        <div class="container">
            <div class="justify-content-end d-l-btn">
                <i class="fas fa-solid fa-train fa-2x"></i>
            </div>
            <a class="navbar-brand" href="#Home"><span class="navbar-name"><span class="navbar-name-segment">e</span>Railways</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto w-100 justify-content-end">
                    <li class="nav-item active">
                        <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./login.php">Login</a>
                    <li class="nav-item">
                        <a class="nav-link" href="./signup.php">SignUp</a>
                    <li class="nav-item">
                        <a class="nav-link" href="./admin.php">Admin</a>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php">Logout</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <section id="Home">
        <div class="login">
            <h1>Administrator Login</h1>
            <form action="" method = "post">
                <div class="form-group pt-3">
                    <label for="uname">User Name</label><br>
                    <input class= "form-control" type="text" id= "uname" name="uname" placeholder="Enter your user name">
                </div>
                <div class="form-group pt-3">
                    <label for="password">Password</label><br>
                    <input class= "form-control" type="password" id= "password" name="password" placeholder="Enter password">
                </div>
                <div class="text-center mt-3">
                    <button type="submit" name='adminlogin' class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </section>



    <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>-->
    <script src="https://kit.fontawesome.com/a4e2abdcac.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>