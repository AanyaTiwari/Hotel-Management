<?php
    include_once 'staff/include/class.user.php'; 
    $user=new User(); 

    $roomname=$_GET['roomname'];

    
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
  <link rel="stylesheet" href="admin/css/reg.css" type="text/css">
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker({
                  dateFormat : 'yy-mm-dd'
                });
  } );
  </script>

</head>
<style>
    h2,h3 {
    text-align: center;
    color: #ffbb2b;
    }
</style>
<body>
    <div class="container">
      
      
       <img class="img-responsive" src="images/home_banner.jpg" style="width:100%; height:180px;">      
        
<!--
      <?php
                $sql="SELECT * FROM room_category WHERE roomname='$roomname'";
                $result = mysqli_query($user->db, $sql);
                $row = mysqli_fetch_array($result);
                $room=$row['available'];  
      ?>
-->
      <div class="well">
            <h2>Book Now: <?php echo $roomname; ?></h2>
<!--            <h3>No. of rooms available: <?php echo $room; ?></h3>-->
            <hr>
            <form action="" method="post" name="room_category">
              
              
               <div class="form-group">
                    <label for="checkin">Check In :</label>&nbsp;&nbsp;&nbsp;
                    <input type="text" class="datepicker" name="checkin" required autocomplete="off">

                </div>
               
               <div class="form-group">
                    <label for="checkout">Check Out:</label>&nbsp;
                    <input type="text" class="datepicker" name="checkout" required autocomplete="off">
                </div>
                
                <div class="form-group">
                    <label for="name">Enter Your Full Name:</label>
                    <input type="text" class="form-control" name="name" placeholder="Jhon Wicky" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Enter Your Phone Number:</label>
                    <input type="number" maxlength="10" minlength="10" class="form-control" name="phone" placeholder="018XXXXXXX" required>
                </div>
                
                <p id="wrong_id" style=" color:red; font-size:16px; "></p>
                
                <button type="submit" class="btn btn-lg btn-primary button" name="submit">Book Now</button>
                
<?php  
    if(isset($_REQUEST[ 'submit'])) 
    { 
        // mobile no. validation
        function validate_mobile($mobile)
        {
            return preg_match('/^[0-9]{10}+$/', $mobile);
        }
        // booking days should not be more than 7 days.
        function dateDiffInDays($date1, $date2)  
        {  
            $diff = strtotime($date2) - strtotime($date1); 
            return abs(round($diff / 86400)); 
        }   
        extract($_REQUEST); 
        $res=validate_mobile($phone);
        $days = dateDiffInDays($checkin, $checkout);  
        $today = date("Y-m-d");
        if($today>$checkin)
        {
            echo '<script type="text/javascript">
              document.getElementById("wrong_id").innerHTML = "Checkin date shouldn\'t be smaller than today\'s date.";
         </script>';
        }
        else if($checkin>$checkout)
        {
            echo '<script type="text/javascript">
              document.getElementById("wrong_id").innerHTML = "Checkin date should be smaller than checkout date.";
         </script>';
        }
        else if($days>7)
        {
            echo '<script type="text/javascript">
              document.getElementById("wrong_id").innerHTML = "Booking period should not be more than 7 days.";
         </script>';
        }
        else if(!$res)
        {
            echo '<script type="text/javascript">
              document.getElementById("wrong_id").innerHTML = "Invalid mobile number.";
         </script>';
            
        }
        else{
                    $amount=($days+1)*$price;
                    $result=$user->booknow($checkin, $checkout, $name, $phone,$roomname);
                    if($result)
                    {
                        echo "<script type='text/javascript'>
                              alert('".$result."'+'\\n'+'Booking amount is ".$amount."'); 
                         </script>";
                        
                    }
        } 
          
    }
                
                ?>    
               <br>
                <div id="click_here">
                    <a href="rooms.php">Back to Home</a>
                </div>

            </form>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
</body>

</html>