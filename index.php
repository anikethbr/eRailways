<?php
require("connection.php");

if (array_key_exists('book', $_POST)) {
    if (isset($_SESSION['signedup']) || isset($_SESSION['loggedin'])) {
        // if ($_SESSION['signedup'] == 1 || $_SESSION['loggedin'] == 1) {
        //     echo "<script>alert('access granted');</script>";
        //     if (isset($_POST['book'])) {
        //         $source = $_POST['from'];
        //         $dest = $_POST['to'];
        //         $sql = "select trainname from train where source = '$source' and destination = '$dest'";
        //         $res = mysqli_query($con, $sql);
        //         while ($row = mysqli_fetch_assoc($res)) {
        //             $ans = $row['trainname'];
        //             echo "<script>alert('$ans');</script>";
        //             // echo "<script>alert('hello');</script>";
        //         }
        //     }
        // }
        $res = mysqli_query($con,"select max(bid) from booking");
        $row = mysqli_fetch_assoc($res);
        $bid = (int)$row['max(bid)'];
        $bid+=1;
        $seatno = rand(1, 100);
        $date = $_GET['date'];
        $trainid = $_POST['trainid'];
        $pid = $_SESSION['pid'];
        // echo "$seatno<br>$date<br>$trainid<br>$pid";
        $sql = mysqli_query($con, "insert into booking values($bid,$seatno,'$date',$trainid,$pid);");
        if($sql){
            $_SESSION['booked']=1;
        }
        // header("location:./booking.php");
        echo'<script> window.location.replace("booking"); </script>';
        die();
    } else {
        echo "<script>alert('login to book tickets');</script>";
        // header('location:./index.php');
        // die();
    }
}
?>
<!-- <pre>
    <?php
    print_r($_SESSION['loggedin']);
    echo "<br>";
    print_r($_SESSION['signedup']);
    echo "<br>";
    print_r($_SESSION['pid']);
    ?>
</pre> -->
<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="./css/styles.css">
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
                        <a class="nav-link" href="">Home <span class="sr-only">(current)</span></a>
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
        <div class="booking">
            <h1>Book Tickets</h1>
            <form method="get" action="">
                <div class="form-group">
                    <label for="from">From</label><br>
                    <select class="form-select" name="from" id="from">
                        <option selected disabled value="">Select Source</option>
                        <?php
                        $sql = "select distinct source from train order by source;";
                        $res = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($res)) {
                            $ans = $row['source'];
                            echo "<option value = '$ans'>$ans</option>";
                        }
                        ?>
                        <!-- <option value="delhi">Delhi</option>
                        <option value="mumbai">Mumbai</option>
                        <option value="chennai">Chennai</option>
                        <option value="kolkata">Kolkata</option> -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="to">To</label><br>
                    <select class="form-select" name="to" id="to">
                        <option selected disabled value="">Select Destination</option>
                        <?php
                        $sql = "select distinct destination from train order by destination;";
                        $res = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($res)) {
                            $ans = $row['destination'];
                            echo "<option value = '$ans'>$ans</option>";
                        }
                        ?>

                        <!-- <option value="delhi">Delhi</option>
                        <option value="mumbai">Mumbai</option>
                        <option value="chennai">Chennai</option>
                        <option value="kolkata">Kolkata</option> -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Date</label><br>
                    <input type="date" class="input-group date form-control" data-provide="datepicker" name="date" id="date">
                </div>
                <div class="text-center mt-3">
                    <button type="submit" name="search" class="btn btn-primary">Search</button>
                </div>
                
            </form>

            <form action="" method="post">
                <?php
                if (isset($_GET['search'])) {
                    $source = $_GET['from'];
                    $dest = $_GET['to'];
                    $sql = "select trainname,trainid from train where source = '$source' and destination = '$dest'";
                    $res = mysqli_query($con, $sql);
                    echo '<div class="form-group">
                        <label for="from">From</label><br>
                        <select class="form-select" name="trainid" id="trainid">
                            <option selected disabled value="">Select train</option>';
                    while ($row = mysqli_fetch_assoc($res)) {
                        $ans = $row['trainname'];
                        $trainid = $row['trainid'];
                        echo "<option value = '$trainid' >$ans</option>";
                    }
                    echo ' </select>
                        </div>';
                }
                
                // echo "<input type= 'hidden' name = 'date' value = '$date'>";
                ?>
                <?php
                if (array_key_exists('search', $_GET)) {
                    echo '<div class="text-center mt-3">
                        <button type="submit" name="book" class="btn btn-primary">Book</button>
                    </div>';
                }
                ?>
            </form>

        </div>


        <div class="index-img">
            <img src="./assets/train.jpg">
        </div>
    </section>



    <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>-->
    <!-- JavaScript Bundle with Popper -->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>-->
    
    <script src="https://kit.fontawesome.com/a4e2abdcac.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>