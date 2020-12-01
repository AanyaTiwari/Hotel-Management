<?php
include_once 'include/class.user.php'; 
$user=new User(); 
 

if(isset($_REQUEST[ 'submit2'])) 
{ 
    extract($_REQUEST); 
    if($foodtype==""||$foodprice=="")
    {
        echo "<script type='text/javascript'>
              alert('Enter foodtype / foodprice.');
         </script>";
    }
    else
    {
        $result=$user->update_food($foodname, $foodtype, $foodprice);
        if($result)
        {
            echo "<script type='text/javascript'>
                  alert('Food Item Updated Succesfully');
             </script>";
        }
        else
        {
             echo $result;
        }
    }
   
}

if(isset($_REQUEST[ 'submit1'])) 
{ 
    extract($_REQUEST); 
    $result=$user->delete_food($foodname);
    if($result)
    {
        echo "<script type='text/javascript'>
              alert('Food Item Deleted Succesfully');
         </script>";
    }
    else
    {
         echo $result;
    }
   
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
    <title>Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/reg.css" type="text/css">
    
</head>

<body>
    <div class="container" style="margin-top:80px">
        <div class="well">
            <h2>Update Food Items</h2>
            <hr>
            <form action="" method="post" name="add_food" autocomplete="off">
                <div class="form-group">
                    <label>Food Name</label>
				    <select name="foodname" type="text" class="form-control" style="width:20%">
                    <?php 
                    for($j=0;$j<$total_elmt;$j++)
                    {
                    ?><option><?php 
                    echo $roll[$j];
                    ?></option><?php
                    }
                    ?>
                    </select>
                </div>
                 <div class="form-group">
                    <label for="ftype">Food Type:</label>&nbsp;
                    <input type="text" class="form-control" name="foodtype" >
                </div>
                <div class="form-group">
                    <label for="fprice">Food Price:</label>&nbsp;
                    <input type="text" class="form-control" name="foodprice">
                </div>

                
                <button type="submit" class="btn btn-lg btn-primary button" name="submit2" value="Update Food">Update</button>
                <button type="submit" class="btn btn-lg btn-primary button" name="submit1" value="Delete Food" style="margin-right:20px">Delete</button>

               <br><br>
                <div id="click_here">
                    <a href="../admin.php">Back to Admin Panel</a>
                </div>


            </form>
        </div>
    </div>

</body>

</html>