<?php session_start();
include_once 'admin/include/class.user.php';
$user=new User();
$uid=$_SESSION[ 'uid']; 
if(!$user->get_session()) 
{ 
    header("location:admin/login.php"); 
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
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

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
        
        .row2{
            background: rgba(0, 0, 0, 0.9);
            width: 15%;
            float: right;
            margin-top: -750px;
/*            margin-left: -1000px;*/
            color: white;
            text-align: center;
            position: fixed;
            margin-left: 1000px
        }
        
        .row3{
            background: rgba(0, 0, 0, 0.9);
            width: 15%;
            float: left;
            margin-top: -600px;
            margin-left: -150px;
            color: white;
            text-align: center;
            position: fixed
        }
        
        .row4{
            background: rgba(0, 0, 0, 0.9);
            width: 15%;
            float: left;
            margin-top: -880px;
            margin-left: -150px;
            color: white;
            text-align: center;
            position: fixed
        }
        
        .tbl2,th,td,caption{
            background: rgba(0, 0, 0, 0.9);
            text-align: center;
            padding: 10px;
            border: 1px gray solid;
            color: white;
            font-weight: 100
        }
        
        .tbl2{
            padding: 40px;

        }
        
    </style>


</head>

<body>
   
    <div class="container">

        <img class="img-responsive" src="images/home_banner.jpg" style="width:100%; height:180px;">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="room.php">Room &amp; Facilities</a></li>
                    <li><a href="food.php">Foods</a></li>
                    <li class="active"><a href="admin.php">Admin</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="admin.php?q=logout">
                            <button type="button" class="btn btn-danger" style="margin:-10px" >Logout</button>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="row">
           <div class="col-md-3"></div>
            <div class="col-md-6 well">
                <h4>Room Category</h4>
                <hr>
                <ul>
                    <li><a href="admin/addroom.php">Add Room Category</a></li>
                    <li><a href="show_room_cat.php">Show All Room Category</a></li>
                    <li><a href="show_room_cat.php">Edit Room Category</a></li>
                </ul>
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="row">
           <div class="col-md-3"></div>
            <div class="col-md-6 well">
                <h4>Bookings</h4>
                <hr>
                <ul>
                    <li><a href="show_all_room.php">Show All Booked Rooms</a></li>
                    
                </ul>
            </div>
            <div class="col-md-3"></div>
        </div>
        
        <div class="row">
           <div class="col-md-3"></div>
            <div class="col-md-6 well">
                <h4>Foods</h4>
                <hr>
                <ul>
                    <li><a href="admin/addfood.php">Add Food Items</a></li>
                    <li><a href="admin/del.php">Update/Delete Food Items</a></li>
                </ul>
            </div>
            <div class="col-md-3"></div>
        </div>
        
        <div class="row">
           <div class="col-md-3"></div>
            <div class="col-md-6 well">
                <h4>Add Users</h4>
                <hr>
                <ul>
                    <li><a href="admin/registration2.php">Add Admin</a></li>
                    <li><a href="admin/registration.php">Add Staff</a></li>
                </ul>
            </div>
            <div class="col-md-3"></div>
        </div>


    <div class="row2">
       <table class="tbl2" width="130%">
       <caption>Today's Food Order</caption>
           <tr >
            <th width="30%">Name</th>
            <th width="20%">Qty</th>
           </tr>
                <?php 
                    $today = date("Y-m-d");
                    $query="SELECT * FROM sale WHERE date='$today'";
                    $result=mysqli_query($user->db,$query) or die("Query Failed : ".mysqli_error($user->db));
//                    $number=mysqli_num_rows($result);
//                    echo "$number";
                if(mysqli_num_rows($result) > 0)
                {
                    while($row=mysqli_fetch_array($result))
                    {
                        $fname=$row['fname'];
                        $qty=$row['qty'];
                        echo "<tr>";
                        echo "<td>$fname</td>";
                        echo "<td>$qty</td>";
                        echo "</tr>";
                    }
                }
                else
                {
                        echo "<td colspan='2'>No food order today</td>";
                }
                ?>
        </table>
    </div>
    
    
    <div class="row4">
       <table class="tbl2" width="130%">
       <caption>Today's Checkin</caption>
           <tr >
            <th width="30%">Room Category</th>
            <th width="20%">No.</th>
           </tr>
                <?php 
                    $today = date("Y-m-d");
                    $query="SELECT room_cat,COUNT(*) FROM rooms WHERE checkin='$today' GROUP BY room_cat";
                    $result=mysqli_query($user->db,$query) or die("Query Failed : ".mysqli_error($user->db));
//                    $number=mysqli_num_rows($result);
//                    echo "$number";
                
                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row=mysqli_fetch_array($result))
                        {
                            $rname=$row['room_cat'];
                            $number=$row['COUNT(*)'];
                            echo "<tr>";
                            echo "<td>$rname</td>";
                            echo "<td>$number</td>";
                            echo "</tr>";
                        }
                    }
                    else
                    {
                        echo "<td colspan='2'>No checkins today</td>";
                    }
                ?>
        </table>
    </div>
    
    
    <div class="row3">
       <table class="tbl2" width="130%">
       <caption>Today's Checkout</caption>
           <tr >
            <th width="30%">Room Category</th>
            <th width="20%">No.</th>
           </tr>
                <?php 
                    $today = date("Y-m-d");
                    $query="SELECT room_cat,COUNT(*) FROM rooms WHERE checkout='$today' GROUP BY room_cat";
                    $result=mysqli_query($user->db,$query) or die("Query Failed : ".mysqli_error($user->db));
//                    $number=mysqli_num_rows($result);
//                    echo "$number";
                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row=mysqli_fetch_array($result))
                        {
                            $rname=$row['room_cat'];
                            $number=$row['COUNT(*)'];
                            echo "<tr>";
                            echo "<td>$rname</td>";
                            echo "<td>$number</td>";
                            echo "</tr>";
                        }
                    }
                    else
                    {
                        echo "<td colspan='2'>No checkouts today</td>";
                    }
                ?>
        </table>
    </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>