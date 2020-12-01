<?php
include_once 'admin/include/class.user.php'; 
$user=new User();
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
    <title>Hotel Booking</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

        <style>
          
        .well {
            background: rgba(0, 0, 0, 0.7);
            border: none;
            height: 280px;
            width: 50%
        }
        
        body {
            background-image: url('images/home_bg.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        
        h4 {
            color: #ffbb2b;
        }
        h6
        {
            color: navajowhite;
            font-family:  monospace;
        }

        .column{
            float: left
        }
        
        .column img{
            height: 150px;
            margin: 20px;
            margin-left: 80px;
        }
        
        marquee{
            color: red
        }
        
        textarea{
            background: rgba(0, 0, 0, 0.5);
            color: white;
            font-size:12px;
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
                    <li class="active"><a href="room.php">Room &amp; Facilities</a></li>
                    <li><a href="fooda.php">Foods</a></li>
                    <li><a href="staff.php">Staff</a></li>
                    <li><a href="admin.php">Admin</a></li>
                </ul>
            </div>
        </nav>
        
        
        
        <?php
        
        $sql="SELECT * FROM room_category";
        $result = mysqli_query($user->db, $sql);
        if($result)
        {
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                    $str2=$row['roomname'];
                    $str="<img src='uploads/$str2.jpg'>";
                    $room=$row['available']; 
                    echo "
                            <div class='row'>
                            <div class='col-md-3'></div>                    
                            
                            <div class='col-md-6 well'> 
                            <div class='column'>  
                                <h4>".$row['roomname']."</h4><hr>
                                <h6>No of Beds: ".$row['no_bed']." ".$row['bedtype']." bed.</h6>
                                <textarea rows='3' cols='20'>Facilities: ".$row['facility']."</textarea>
                                <h6>Price: ".$row['price']."/day.</h6>
                            </div>
                            <div class='column'>
                            ".$str."
                            </div>
                            <marquee behavior='scroll' direction='left'>$room room left </marquee>
                            </div>
                            
                            </div>
                            
                            
                        
                    
                         "; //echo end
                    
                    
                }
                
                
                          
            }
            else
            {
                echo "NO Data Exist";
            }
        }
        else
        {
            echo "Cannot connect to server".$result;
        }
        
        
        
        
        
        ?>


    </div>
    
    


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>