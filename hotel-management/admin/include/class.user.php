<?php
    include "db_config.php";
        class user
        {
            public $db;
            public function __construct()
            {
                $this->db=new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,'hotel');
                if(mysqli_connect_errno())
                {
                    echo "Error: Could not connect to database.";
                    exit;
                }
            }
            
            
            public function reg_user($name, $username, $password, $email)
            {
                //$password=md5($password);
                $sql="SELECT * FROM staff WHERE uname='$username' OR uemail='$email'";
                $check=$this->db->query($sql);
                $count_row=$check->num_rows;
                if($count_row==0)
                {
                    $sql1="INSERT INTO staff SET uname='$username', upass='$password', fullname='$name', uemail='$email'";
                    $result= mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot inserted");
                    return $result;
                }
                else
                {
                    return false;
                }
            }
            
            
            public function reg_admin($name, $username, $password, $email)
            {
                //$password=md5($password);
                $sql="SELECT * FROM admin WHERE uname='$username' OR uemail='$email'";
                $check=$this->db->query($sql);
                $count_row=$check->num_rows;
                if($count_row==0)
                {
                    $sql1="INSERT INTO staff SET uname='$username', upass='$password', fullname='$name', uemail='$email'";
                    $result= mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot inserted");
                    return $result;
                }
                else
                {
                    return false;
                }
            }
            
            
            public function add_room($roomname, $room_qnty, $no_bed, $bedtype,$facility,$price)
            {
                
                    $available=$room_qnty;
                    $booked=0;
                    
                    $sql="INSERT INTO room_category SET roomname='$roomname', available='$available', booked='$booked', room_qnty='$room_qnty', no_bed='$no_bed', bedtype='$bedtype', facility='$facility', price='$price'";
                    $result= mysqli_query($this->db,$sql) or die(mysqli_connect_errno()."Data cannot inserted");
                
                
                    for($i=0;$i<$room_qnty;$i++)
                    {
                        $sql2="INSERT INTO rooms SET room_cat='$roomname', book='false'";
                        mysqli_query($this->db,$sql2);
                        
                    }
                
                    return $result;
                

            }
            
            
            public function add_food($fid, $fname, $ftype, $fprice)
            {
                    
                    $sql="INSERT INTO food SET fid='$fid', fname='$fname', type='$ftype', price='$fprice' ";
                    $result= mysqli_query($this->db,$sql) or die(mysqli_connect_errno()."Data cannot inserted");
                
                    return $result;
            }
            
            
            public function update_food($fname, $type, $price)
            {
                    $sql="UPDATE food SET fname='$fname', type='$type', price='$price' WHERE fname='$fname'";
                
                    $result= mysqli_query($this->db,$sql) or die(mysqli_connect_errno()."Data was not updated");
                
                    return $result;
            }
            
            
            public function delete_food($fname)
            {
                    $sql="DELETE FROM food WHERE fname='$fname'";
                    $result= mysqli_query($this->db,$sql) or die(mysqli_connect_errno()."Data was not deleted");
                
                    return $result;
            }
            
            
            public function order_inc($fid)
            {
                $sql="SELECT * FROM food WHERE fid='$fid'";
                echo "Sagar"."$fid";
                $result = mysqli_query($this->db, $sql);
                $row = mysqli_fetch_array($result);
                                $count=$row['o_count'];
                                $count=$count+1;
                                $sql2="INSERT INTO food SET o_count='$count' where fid='$fid' ";
                                $result2= mysqli_query($this->db,$sql2);
                return $result2;
            }
            
            
            public function check_available($checkin, $checkout)
            {
                
                
                   $sql="SELECT DISTINCT room_cat FROM rooms WHERE room_id NOT IN (SELECT DISTINCT room_id
   FROM rooms WHERE (checkin <= '$checkin' AND checkout >='$checkout') OR (checkin >= '$checkin' AND checkin <='$checkout') OR (checkin <= '$checkin' AND checkout >='$checkin') )";
                    $check= mysqli_query($this->db,$sql)  or die(mysqli_connect_errno()."Query Doesnt run");;

                
                    return $check;
            
            
            }
            
            
            public function booknow($checkin, $checkout, $name, $phone,$roomname)
            {
                    
//                    $sql="SELECT * FROM rooms WHERE room_cat='$roomname'";
//                    $check= mysqli_query($this->db,$sql)  or die(mysqli_connect_errno()."Data here cannot inserted");
//                
                    $sql="SELECT * FROM room_category WHERE roomname='$roomname'";
                    $result= mysqli_query($this->db,$sql)  or die(mysqli_connect_errno()."Data here cannot inserted");
                    
                
                    if(mysqli_num_rows($result) > 0)
                    {
                        $row = mysqli_fetch_array($result);
                        $book=$row['booked'];
                        $avail=$row['available'];
                        $res="";
                        $send="";
                        if($avail > 0)
                        {
                            $sql2="INSERT INTO rooms SET room_cat='$roomname', checkin='$checkin', checkout='$checkout', name='$name', phone='$phone', book='true'";
                            $send=mysqli_query($this->db,$sql2);
                            
                            if($send)
                            {
                                $result="Your Room has been booked!!";
                                $avail--;
                                $book++;
                                $sql3="UPDATE room_category SET available='$avail',
                                booked='$book' WHERE roomname='$roomname'";
                                $res=mysqli_query($this->db,$sql3);
                            }
                        }
                        else                       
                        {
                            $result = "No Room Is Available";
                        }
                    }
                    return $result;
            }
            
            
            public function booknow2($checkin, $checkout, $name, $phone,$roomname)
            {
                    
                    $sql="SELECT * FROM rooms WHERE room_cat='$roomname' AND (room_id NOT IN (SELECT DISTINCT room_id
   FROM rooms WHERE checkin <= '$checkin' AND checkout >='$checkout'))";
                    $check= mysqli_query($this->db,$sql)  or die(mysqli_connect_errno()."Data here cannot inserted");;
                 
                    if(mysqli_num_rows($check) > 0)
                    {
                        $row = mysqli_fetch_array($check);
                        $id=$row['room_id'];
                        
                        $sql2="UPDATE rooms  SET checkin='$checkin', checkout='$checkout', name='$name', phone='$phone', book='true' WHERE room_id=$id";
                        
                         $send=mysqli_query($this->db,$sql2);
                        if($send)
                        {
                            $result="Your Room has been booked!!";
                        }
                        else
                        {
                            $result="Sorry, Internel Error";
                        }
                    }
                    else                       
                    {
                        $result = "No Room Is Available";
                    }
                    return $result;
            }
             
            
            public function edit_all_room($checkin, $checkout, $name, $phone,$id)
            {
                                
                        $sql2="UPDATE rooms SET checkin='$checkin', checkout='$checkout', name='$name', phone='$phone', book='true' WHERE room_id=$id";
                        $send=mysqli_query($this->db,$sql2)  or die(mysqli_connect_errno()."Data here cannot inserted");
                        if($send)
                        {
                            $result="Your Data has been updated!!";
                        }
                        else
                        {
                            $result="Sorry, Internel Error";
                        }
                    
                
                    return $result;
                

            }
            
            
            public function remove_all_room($roomname, $id)
            {
                                
                $sql="DELETE FROM rooms WHERE room_id=$id";
                $send=mysqli_query($this->db,$sql)  or die(mysqli_connect_errno()."Data here cannot inserted 1");
                
                if($send){
                    
                    $sql2="SELECT * FROM room_category WHERE roomname='$roomname'";
                     $send2=mysqli_query($this->db,$sql2)  or die(mysqli_connect_errno()."Data here cannot inserted 2");
                    
                     $row = mysqli_fetch_array($send2);
                     $available=$row['available'];
                     $booked=$row['booked'];
                     $available++;
                     $booked--;
                    
                     $sql2="UPDATE room_category SET available='$available', booked='$booked' WHERE roomname='$roomname'";
                     $send=mysqli_query($this->db,$sql2)  or die(mysqli_connect_errno()."Data here cannot inserted 3");
                    
                     if($send)
                     {
                        $result="Room canceled succesfully!!";
                     }
                        }
                        else
                        {
                            $result="Sorry, Internel Error";
                        }
                    
                
                    return $result;
                

            }
            
        
            public function edit_room_cat($roomname, $room_qnty, $no_bed, $bedtype,$facility,$price,$room_cat)
            {
                    
                 
                        $sql2="DELETE FROM rooms WHERE room_cat='$room_cat'";
                        mysqli_query($this->db,$sql2);
                 
                 
                        for($i=0;$i<$room_qnty;$i++)
                        {
                            $sql3="INSERT INTO rooms SET room_cat='$roomname', book='false'";
                            mysqli_query($this->db,$sql3);

                        }

                 
                        $available=$room_qnty;
                        $booked=0;
                 
                        $sql="UPDATE room_category  SET roomname='$roomname', available='$available', booked='$booked', room_qnty='$room_qnty', no_bed='$no_bed', bedtype='$bedtype', facility='$facility', price='$price' WHERE roomname='$room_cat'";
                         $send=mysqli_query($this->db,$sql);
                        if($send)
                        {
                            $result="Updated Successfully!!";
                        }
                        else
                        {
                            $result="Sorry, Internel Error";
                        }
  
                    
                
                    return $result;
                

            }
            
            
            public function check_login($emailusername,$password)
            {
                
                $sql2="SELECT uid from admin WHERE uemail='$emailusername' OR uname='$emailusername' and upass='$password'";
                $result=mysqli_query($this->db,$sql2);
                $user_data=mysqli_fetch_array($result);
                $count_row=$result->num_rows;
                
                if($count_row==1)
                {
                    $_SESSION['login']=true;
                    $_SESSION['uid']=$user_data['uid'];
                    return true;    
                }
                else
                {
                    return false;
                }
            }
            
            
            public function check_logins($emailusername,$password)
            {
                //$password=md5($password);
                $sql2="SELECT sid from staff WHERE uemail='$emailusername' OR uname='$emailusername' and upass='$password'";
                $result=mysqli_query($this->db,$sql2);
                $user_data=mysqli_fetch_array($result);
                $count_row=$result->num_rows;
                
                if($count_row==1)
                {
                    $_SESSION['login']=true;
                    $_SESSION['sid']=$user_data['sid'];
                    return true;    
                }
                else
                {
                    return false;
                }
            }   
            
            
            public function get_session()
            {
                return $_SESSION['login'];
            }
            
            
            public function user_logout()
            {
                $_SESSION['login']=false;
                session_destroy();
            }
        }

?>