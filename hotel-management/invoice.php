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
            width: 80%
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
        <div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center"><strong>Invoice</strong></h3>
							<br><br>
							<div style="margin-top: -40px">
                            <strong> Invoice No. 7656 <br>
                            XYZ HOTEL</strong><br>
                            Shanthi Nagar, Bengaluru, Pin- 560090
                            </div><br>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
        $result2=mysqli_query($user->db,$query) or die("Query Failed : ".mysqli_error($conn));
        $total = 0;
        while($rows=mysqli_fetch_array($result2))
        {
                $total += $rows['amount'];
        }
     ?>	
</tr>
<tr>
    <td colspan="3" style="text-align: center">Total amount </td>
    <?php
       echo "<td>".$total."</td>";
    ?>
</tr>					
</table>	
 <?php
$query = "SELECT * FROM cart";
$result=mysqli_query($user->db,$query) or die("Query Failed : ".mysqli_error($user->db));
while($rows=mysqli_fetch_array($result))
{
	$fname=$rows['fname'];
	$price=$rows['price'];
	$qty=$rows['qty'];
	$amount=$rows['amount'];
    $today = date("Y-m-d");
    
    
    $query5 = "SELECT * FROM sale";
    $result5=mysqli_query($user->db,$query5) or die("Query Failed : ".mysqli_error($user->db));
    $flag=0;
    while($row=mysqli_fetch_array($result5))
    {
            $date=$row['date'];
            if(($row['fname']==$fname) AND ($today==$date)){
                $qty2=$row['qty'];
                $qty3=$qty+$qty2;
                $date=$row['date'];
                $amount2=$row['amount'];
                $amount3=$amount+$amount2;
                $query2="UPDATE sale SET qty=$qty3,amount=$amount3 WHERE fname='$fname' AND date='$today'";
                $result2=mysqli_query($user->db,$query2) or die("Query Failed : ".mysqli_error($user->db));
                $flag=1;
                $query4 = "DELETE FROM `cart` WHERE fname='$fname'";
                $result4 = mysqli_query($user->db,$query4); 
                $qty=0;
                $amount=0;
                break;
            }
            
    }
    if($flag==0)
    {
        $query3 = "INSERT INTO `sale` (fname, qty, price, amount, date) VALUES ('$fname','$qty','$price','$amount','$today')";
        $result3 = mysqli_query($user->db,$query3);
        $query4 = "DELETE FROM `cart` WHERE fname='$fname'";
        $result4 = mysqli_query($user->db,$query4); 
    }
}

?>							
<!--		DELETE FROM sale WHERE date='2019-10-27'					-->
							
							
						</div>
					</div>

				</div>
				
			</article>
        </div>
    </div>
    <div>
        <table></table>
    </div>
    </body>
</html>