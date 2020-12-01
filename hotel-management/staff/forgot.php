<?php 
session_start(); 
include_once 'include/class.user.php';
$user=new User(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css" type="text/css">

    <script language="javascript" type="text/javascript">
        function submitlogin() {
            var form = document.login;
            if (form.username.value == "") {
                alert("Enter email or username.");
                return false;
            } else if (form.mno.value == "") {
                alert("Enter Mobile No.");
                return false;
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <h2>Confirm Phone Number</h2>
            
            <hr>
            <form action="" method="post" name="login">
                <div class="form-group">
                    <label for="username">Enter Username or Email:</label>
                    <input type="text" name="username" class="form-control"  required>
                </div>
                <div class="form-group">
                    <label for="mno">Enter phone no:</label>
                    <input type="tel" name="mno" class="form-control" required>
                </div>
                <!--For showing error for wrong input  -->
                <center><p id="wrong_id" style=" color:red; font-size:12px; "></p></center>


                <button type="submit" name="submit" value="Login" onclick="retrun(submitlogin());" class="btn btn-lg btn-primary btn-block">Confirm</button>
                
                <br>
                <p style="text-align: center; font-size: 14px;"><a href="../index.php">Back To Home</a></p>
                
                

                <?php if(isset($_REQUEST[ 'submit'])) 
                      { 
                        extract($_REQUEST);
                        $query = "SELECT * FROM `staff` WHERE uname='$username' and phone='$mno'";
                        $result = mysqli_query($user->db,$query) or die(mysqli_error($user->db));
                        $count = mysqli_num_rows($result);
                        if ($count == 1){
                        header('Location: changepw.php');
                        }
                        else
                        {
                            echo '<script type="text/javascript">
                                document.getElementById("wrong_id").innerHTML = "Wrong username or password";
                                </script>';
                        }
                    }
                ?>

            </form>
        </div>
    </div>

</body>

</html>