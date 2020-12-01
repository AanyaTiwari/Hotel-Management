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
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Foods</title>

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
            width: 80%;
            font-family: monospace
        }
        
        .btn-order{
            background: rgba(0, 0, 0, 0.9);
            border: 1px black;
            padding: 5px
        }
        
        .btn-order:hover{
            color:blue
        }
        
        input{
        text-align: center;
        width:50%;
        color:black;
        }
        
        button{
            color: black
        }
        
        .top-margin .row{
            margin: 50px
        }
        
        input{
            width: 30%
        }
        
        .cart{
            background: rgba(0,0,0,0.5);
            padding:20px;
            margin: 20px 120px 20px 110px;
            color: white
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
        
        .inp{
            width: 50%;
            padding: 2px;
            padding-bottom: 5px
        }
        
        .inp2{
            background: rgba(0,0,0,0);
            color: white;
            width: 60%;
            border: none;
            text-align: center
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
                    <li><a href="rooms.php">Room &amp; Facilities</a></li>
                    <li><a href="foods.php">Foods</a></li>
                    <li><a href="staff.php">Staff</a></li>
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
    
       <table class="tbl2" width="100%">
	   <tr>
		<th width="20%">Food Name</th>
		<th width="20%">Quantity</th>
		<th width="20%">Price</th>
        <th width="15%">Amount</th>
	   </tr>
       <?php
        
        $sql="SELECT * FROM sale";
        $result = mysqli_query($user->db, $sql);
        if($result)
        {
            $today = date("Y-m-d");
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                    if($today==$row['date'])
                    {
                        echo "<tr>";
                        echo "<td>".$row['fname']."</td>";
                        echo "<td>".$row['qty']."</td>";
                        echo "<td>".$row['price']."</td>";
                        echo "<td>".$row['amount']."</td>";
                        echo "</tr>";
                    }
                }
            }
        }
        ?>        
       </table>
    
    
        </div>
    
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>