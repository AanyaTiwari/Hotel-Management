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
    

if (isset($_POST['qty'])&&isset($_POST['fname'])&& isset($_POST['fprice']))
{
		$qty = $_POST['qty'];
		$price = $_POST['fprice'];
		$fname = $_POST['fname'];
        if($qty<0)
        {
            echo "<script>
                        alert('Quantity cannot be negative.');
                        window.location.href='foods.php';
                  </script>";
            return;
        }
        $query = "SELECT * FROM cart";
        $result=mysqli_query($user->db,$query) or die("Query Failed : ".mysqli_error($user->db));
        while($row=mysqli_fetch_array($result))
        {
            if($row['fname']==$fname){
                $qty2=$row['qty'];
                $qty3=$qty2-$qty;
                if($qty3<0)
                {
                    $str="Quantity entered exceeds than cart quantity";
                    echo "<script>
                        alert('$str');
                        window.location.href='carts.php';
                  </script>";
                    
                  return;
                }
                else if($qty3==0)
                {
                    $query2="DELETE FROM cart WHERE fname = '$fname'";
                    $result2=mysqli_query($user->db,$query2) or die("Query Failed : ".mysqli_error($user->db));
                    if($result2){
                    echo "<script>
                        alert('Item removed succesfully');
                        window.location.href='carts.php';
                        </script>";
                    }
                    else
                    {
                        echo "<script>alert('Something went wrong!!!');</script>";
                    }
                    return;
                }
                else
                {    
                    $amount = $qty3 * $price;
                    $query3="UPDATE cart SET qty=$qty3,amount=$amount WHERE fname = '$fname'";
                    $result3=mysqli_query($user->db,$query3) or die("Query Failed : ".mysqli_error($user->db));
                    if($result3){
                        echo "<script>
                            alert('Item updated succesfully');
                            window.location.href='carts.php';
                            </script>";
                    }
                    else
                    {
                        echo "<script>alert('Something went wrong!!!');</script>";
                    }
                    return;
                }
            }
        }
        
	
//        $query = "INSERT INTO `cart` (fname, qty, price, amount) VALUES ('$fname','$qty','$price','$amount')";
//        $result=mysqli_query($user->db,$query) or die("Query Failed : ".mysqli_error($user->db));
//        if($result){
//            echo "<script type='text/javascript'>
//                alert('Item added succesfully');
//                </script>";
//        }
//        else
//        {
//            echo "<script>alert('Item not added');</script>";
//        }
}


$query = "SELECT * FROM food";
$result=mysqli_query($user->db,$query) or die("Query Failed : ".mysqli_error($user->db));
$i=0;
while($rows=mysqli_fetch_array($result))
{
$roll[$i]=$rows['fname'];
$i++;
}
$total_elmt=count($roll);
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
            width: 30%;
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
        
        .row-dark{
            background: rgba(0,0,0,0.9);
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
                    <li class="active"><a href="foods.php">Foods</a></li>
                    <li><a href="staff.php">Staff</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                            <a href="invoice.php">
                                <button type="button" class="btn btn-green"> Generate Invoice</button>
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
    
        <table class="tbl2" width="100%">
	   <tr>
		<th width="20%">Food Name</th>
		<th width="20%">Price</th>
        <th width="10%">Amount</th>
        <th width="20%">Quantity</th>
	   </tr>
       <?php
        
        $sql="SELECT * FROM cart";
        $result = mysqli_query($user->db, $sql);
        $total=0;
        if($result)
        {
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                    echo '<form method="POST" action="" autocomplete="off">';
                    echo "<tr>";
                    echo '<td><input class="inp2" name="fname" class="form-control" value="'.$row['fname'].'" readonly></td>';
                    echo '<td><input class="inp2" name="fprice" class="form-control" value="'.$row['price'].'" readonly></td>';
                    echo "<td>".$row['amount']."</td>";
                    echo '<td>
                    <input class="inp" type="number" name="qty" class="form-control" value="'.$row['qty'].'" required>
                    <button class="btn btn-info" type="submit">Remove</button>
                    </td>';
                    echo "</tr>";
                    echo "</form>";
                    $total+=$row['amount'];
                }
            }
        }
        ?>   
       <tr class="row-dark">
           <td colspan="2"><b>Total cart value:</b></td>
           <td><b><?php echo $total?></b></td>
           <td>&nbsp;</td>
       </tr>     
       </table>

    
    </div>
    
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>