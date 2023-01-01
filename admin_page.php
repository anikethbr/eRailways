<?php
require('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
if (array_key_exists('adminlogin', $_POST)) {
    if (isset($_SESSION['signedup']) || isset($_SESSION['loggedin']) || isset($_SESSION['pid'])) {
        unset($_SESSION['pid']);
        unset($_SESSION['signedup']);
        unset($_SESSION['loggedin']);
    }
    $uname = $_POST['uname'];
    $password = $_POST['password'];
    if ($uname == "admin" && $password == "root") {
        $_SESSION['admin'] = 1;
        echo '<script>alert("admin login successful");</script>';
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

    <section id="inserttrain">
        <div class="container-md  align-items-center mt-5 p-3 justify-content-center">
            <div class="display-6 text-muted">
                <h2>Insert Train</h2>
            </div>
            <form action="" method="post">
                <label for="trainid" class="form-label">Train Id</label>
                <input type="number"class="form-control"  id="trainid" name="trainid">
                <label for="trainname" class="form-label">Train Name</label>
                <input type="text" class="form-control" id="trainname" name="trainname">
                <label for="source" class="form-label">Source</label>
                <input type="text" class="form-control" id="source" name="source">
                <label for="destination" class="form-label">Destination</label>
                <input type="text" class="form-control" id="destination" name="destination">
                <label for="totalseat"  class="form-label">Number of seats</label>
                <input type="number" class="form-control" id="totalseat" name="totalseat">
                <div class="text-center mt-3">
                    <input type="submit" name="addtrain" class = "btn btn-outline-primary">
                </div>
            </form>
        </div>
    </section>
    <?php
        if(array_key_exists('addtrain',$_POST)){
            $trainid = (int)$_POST['trainid'];
            $trainname = $_POST['trainname'];
            $source = $_POST['source'];
            $destination = $_POST['destination'];
            $totalseat = (int)$_POST['totalseat'];
            $sql = "insert into train values($trainid,'$trainname','$source','$destination',$totalseat);";
            $res = mysqli_query($con,$sql);
            if($res){
                echo "<script>alert('inserted train successfully');</script>";
            }else{
                echo "<scipt>alert('error in insertion of train to the database');</script>";
            }
        }
    ?>

    <section id="bookings" class="section-styling">
        <div class="container-md  align-items-center mt-5 p-3 justify-content-center">
            <div class="display-6 text-muted">
                <h2>Bookings</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <th>Sl. No</th>
                        <th>Booking id</th>
                        <th>Seat Number</th>
                        <th>Train id</th>
                        <th>Date</th>
                        <th>Passenger id</th>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $sql = "select * from booking";
                        $res = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($res)) {
                            $bid = $row['bid'];
                            $seatno = $row['seatno'];
                            $trainid = $row['trainid'];
                            $date = $row['date'];
                            $pid = $row['pid'];
                            echo "<tr>";
                            echo "<td>$i</td>";
                            echo "<td>$bid</td>";
                            echo "<td>$seatno</td>";
                            echo "<td>$trainid</td>";
                            echo "<td>$date</td>";
                            echo "<td>$pid</td>";
                            echo "</tr>";
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section id="passengers" class="section-styling">
        <div class="container-md  align-items-center mt-5 p-3 justify-content-center">
            <div class="display-6 text-muted">
                <h2>Passengers</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <th>Passenger id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Phone</th>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $sql = "select * from passenger";
                        $res = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($res)) {
                            $pid = $row['pid'];
                            $fname = $row['fname'];
                            $lname = $row['lname'];
                            $gender = $row['gender'];
                            $age = $row['age'];
                            $phone = $row['phone'];
                            echo "<tr>";
                            echo "<td>$i</td>";
                            echo "<td>$fname</td>";
                            echo "<td>$lname</td>";
                            echo "<td>$gender</td>";
                            echo "<td>$age</td>";
                            echo "<td>$phone</td>";
                            echo "</tr>";
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    <section id="trains" class="section-styling">
        <div class="container-md  align-items-center mt-5 p-3 justify-content-center">
            <div class="display-6 text-muted">
                <h2>Trains</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <th>Sl. No</th>
                        <th>Train id</th>
                        <th>Train Name</th>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Total Seat</th>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $sql = "select * from train";
                        $res = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($res)) {
                            $trainid = $row['trainid'];
                            $trainname = $row['trainname'];
                            $source = $row['source'];
                            $destination = $row['destination'];
                            $totalseat = $row['totalseat'];
                            echo "<tr>";
                            echo "<td>$i</td>";
                            echo "<td>$trainid</td>";
                            echo "<td>$trainname</td>";
                            echo "<td>$source</td>";
                            echo "<td>$destination</td>";
                            echo "<td>$totalseat</td>";
                            echo "</tr>";
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>




    <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>-->
    <script src="https://kit.fontawesome.com/a4e2abdcac.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>