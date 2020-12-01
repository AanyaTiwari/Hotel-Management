<?php
include_once 'staff/include/class.user.php'; 
$user=new User();
if(isset($_GET['q'])) 
{ 
    $user->user_logout();
 header("location:index.php"); 
}
if (isset($_POST['fname'])){
	    $fname = $_POST['fname'];
        $query2 = "SELECT * FROM food";
        $result2=mysqli_query($user->db,$query2) or die("Query Failed : ".mysqli_error($user->db));
        while($rows=mysqli_fetch_array($result2))
        {
            if(isset($_POST['fname'])==$fname){
                $query="DELETE FROM `cart` WHERE fname='$fname'";  
                $result = mysqli_query($user->db,$query);
                if($result){
                    echo "<script type='text/javascript'>
                            alert('Food removed from cart.')
                        </script>";
//                  echo "<span style='color:red'>Food removed from cart</span>";
                    header("location:cart.php"); 
                }else{
                    echo "<script type='text/javascript'>
                            alert('Item was not removed.');
                        </script>";
                }
        }

    }
}

$query = "SELECT * FROM cart";
$result=mysqli_query($user->db,$query) or die("Query Failed : ".mysqli_error($user->db));
$i=0;
if(mysqli_num_rows($result) > 0)
{
while($rows=mysqli_fetch_array($result))
{
$roll[$i]=$rows['fname'];
$i++;
}
$total_elmt=count($roll);
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
        #cart{
            width: 80%;
            margin: 50px;
            color: white;
            text-align: center
        }
        
        #cart:hover{
            color: black
        }
        
        th{
            text-align: center
        }
        
        .remove{
        background: rgba(0,0,0,0.5);
        padding:20px;
        margin: 20px 120px 20px 110px;
        color: white
        }
        
        .tbl2,th,td{
            background: rgba(0, 0, 0, 0.4);
            text-align: center;
            padding: 10px;
            border: 1px gray solid;
            color: white;
            font-weight: 100
        }
        
        th{
            background: rgba(0, 0, 0, 0.9);
        }
        
        .tbl2{
            padding: 40px;
            margin-left: 100px;
            width: 80%
        }
        
        .btn-green{
            margin:-10px;
            color:white;
            background-color:#48a248
        }
        
        .btn-green:hover{
            background-color:#387e38;
            color: white
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
                       <li><a href="foods.php">Foods</a></li>
                       <li><a href="staff.php">Staff</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                       <li>
                            <a href="invoice.php">
                                <button type="button" class="btn btn-green"> Genrate Invoice</button>
                            </a>
                       </li>
                       
                        <li>
                            <a href="foods.php">
                                <button type="button" class="btn btn-green"  >Back</button>
                            </a>
                       </li>
                       <li>
                            <a href="admin.php?q=logout">
                                <button type="button" class="btn btn-danger" style="margin:-10px" >Logout</button>
                            </a>
                        </li>
                </ul>
            </div>
        </nav>
        
        

<div class="container">
<center>
<table class="tbl2" id="cart">
 <thead>
 <tr>
 <th>Food Name</th>
 <th>Quantity</th>
 <th>Price</th>
 <th>Amount</th>
 </tr>
 </thead>
 <tbody>
 <tr>
 <?php
$query = "SELECT * FROM cart";
$result=mysqli_query($user->db,$query) or die("Query Failed : ".mysqli_error($user->db));
while($rows=mysqli_fetch_array($result))
{
	echo"<td>".$rows['fname']."</td>";
	echo"<td>".$rows['qty']."</td>";
    echo"<td>".$rows['price']."</td>";
	echo"<td>".$rows['amount']."</td>";
	echo "</tr>";
}

        mysqli_close($user->db);
     ?>
     
</tr>
</table>
</center>

<div class="remove">
        <form method="POST" action="cart.php">
        <center>
				<label>Item Name<span class="text-danger">*</span></label>
				<select name="fname" type="text" class="form-control" style="width:20%">
                    <?php 
                        for($j=0;$j<$total_elmt;$j++)
                        {
                            ?><option><?php 
                            echo $roll[$j];
                            ?></option><?php
                        }
                    ?>
                </select>
				<br>
				<div class="row" >
				<div class="col-lg-12 text-center">
				<button class="btn btn-info" type="submit">Remove</button>
				</div>
				</div>
        </center>
        </form>
    </div>
</div>