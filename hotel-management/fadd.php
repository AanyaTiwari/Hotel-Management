<?php    
    include_once 'staff/include/class.user.php';
    include_once 'foods.php';
    if (isset($_POST['fname'])&& isset($_POST['qty'])){
	    $fname = $_POST['fname'];
		$qty = $_POST['qty'];
        
        $query2 = "SELECT * FROM food";
        $result2=mysqli_query($user->db,$query2) or die("Query Failed : ".mysqli_error($user->db));
        while($rows=mysqli_fetch_array($result2))
        {
            if($rows['fname']==$fname){
                $price = $rows['price'];
                $amount = $qty * $price;
            }
        }
		$amount = $qty * $price;
        
        
        $query3 = "SELECT * FROM cart";
        $result3=mysqli_query($user->db,$query3) or die("Query Failed : ".mysqli_error($user->db));
        while($row=mysqli_fetch_array($result3))
        {
            if($row['fname']==$fname){
                $qty2=$row['qty'];
                $qty=$qty+$qty2;
                $amount = $qty * $price;
                $query4="UPDATE cart SET qty=$qty,amount=$amount WHERE fname = '$fname'";
                $result2=mysqli_query($user->db,$query4) or die("Query Failed : ".mysqli_error($user->db));
                if($result2){
//                    echo "<script type='text/javascript'>
//                    alert('Item updated succesfully');
//                    </script>";
                      echo "<center><p><span style='color:yellow'>Item updated succesfully</span></p></center>";
                      echo "</div>";
                }
                else
                {
                    echo "<script>alert('Item not added');</script>";
                }
                return;
            }
        }
        
	
        $query = "INSERT INTO `cart` (fname, qty, price, amount) VALUES ('$fname','$qty','$price','$amount')";
        $result=mysqli_query($user->db,$query) or die("Query Failed : ".mysqli_error($user->db));
        if($result){
//            echo "<script type='text/javascript'>
//                alert('Item added succesfully');
//                </script>";
            echo "<center><p><span style='color:yellow'>Item added succesfully</span></p></center>";
        }
        else
        {
            echo "<script>alert('Item not added');</script>";
        }
}
?>