<?php
include_once 'staff/include/class.user.php'; 
include_once 'cart.php'; 
    
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
                }else{
                    echo "<script type='text/javascript'>
                            alert('Food was not added.');
                        </script>";
                }
        }

    }
}
?>