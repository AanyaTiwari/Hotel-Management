<?php session_start();
include_once 'staff/include/class.user.php';
$user=new User();
$sid=$_SESSION[ 'sid']; 
if(!$user->get_session()) 
{ 
    header("location:staff/logins.php"); 
} 
if(isset($_GET['q'])) 
{ 
    $user->user_logout();
 header("location:index.php"); 
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Panel</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/rooms.css" rel="stylesheet">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
</head>
    <style>
        .well {
            background: rgba(0, 0, 0, 0.7);
            border: none;
            height: 200px;
        }
        
        body {
            background-image: url('images/home_bg.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        
        h4 {
            color: #ffbb2b;
        }
        
        ul {
            color: white;
            font-size: 13px;
        }
    </style>
<body>
    <div class="container">
      <img class="img-responsive" src="images/home_banner.jpg" style="width:100%; height:180px;">
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="rooms.php">Room &amp; Facilities</a></li>
                <li><a href="foods.php">Foods</a></li>
                <li><a href="staff.php">Staff</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="staff.php?q=logout">
                        <button type="button" class="btn btn-danger" style="margin:-10px" >Logout</button>
                    </a>
                </li>
            </ul>
        </div>
      </nav>
      <div class="col-md-3"></div>
    </div>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 well2">
            <h4>Bookings</h4><hr>
            <ul>
                <li><a href="rooms.php">Book Now</a></li>
                <li><a href="show_all_rooms.php">Show All Booked Rooms</a></li>
                <li><a href="show_all_rooms.php">Cancel Booked Room</a></li>
            </ul>
        </div>   
    </div>
    <br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 well2">
            <h4>Foods</h4><hr>
            <ul>
                <li><a href="foods.php">View/Order Food</a></li>
                <li><a href="today_food.php">Today's Food order</a></li>
            </ul>
        </div>   
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>