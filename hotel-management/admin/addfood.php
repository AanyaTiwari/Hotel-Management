<?php
include_once 'include/class.user.php'; 
$user=new User(); 
 

if(isset($_REQUEST[ 'submit'])) 
{ 
    extract($_REQUEST); 
    $result=$user->add_food($foodname, $foodtype, $foodprice);
    if($result)
    {
        echo "<script type='text/javascript'>
              alert('Food Item Added Succesfully');
         </script>";
    }
    else
    {
         echo $result;
    }
   
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/reg.css" type="text/css">
    
</head>

<body>
    <div class="container" style="margin-top:80px">
        <div class="well">
            <h2>Add Food Items</h2>
            <hr>
            <form action="" method="post" name="add_food">
<!--
                <div class="form-group">
                    <label for="fid">Food ID:</label>
                    <input type="text" class="form-control" name="foodid"  required>
                </div>
-->
                <div class="form-group">
                    <label for="fname">Food Name:</label>
                    <input type="text" class="form-control" name="foodname"  required>
                </div>
                 <div class="form-group">
                    <label for="ftype">Food Type:</label>&nbsp;
                    <input type="text" class="form-control" name="foodtype"  required>
                </div>
                <div class="form-group">
                    <label for="fprice">Food Price:</label>&nbsp;
                    <input type="text" class="form-control" name="foodprice"  required>
                </div>

                
                <button type="submit" class="btn btn-lg btn-primary button" name="submit" value="Add Food">Add</button>

               <br>
                <div id="click_here">
                    <a href="../admin.php">Back to Admin Panel</a>
                </div>


            </form>
        </div>
    </div>

</body>

</html>