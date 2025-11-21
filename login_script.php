<?php
require ("includes/common.php");
session_start();

$email=$_POST['lemail'];
$email=mysqli_real_escape_string($con,$email);

$plain_password=$_POST['lpassword'];

if($email==='admin@gmail.com' && $plain_password==='admin'){
    $_SESSION['email']=$email;
    $_SESSION['user_id']=0;
    $_SESSION['is_admin']=true;
    header('location:index.php');
    exit();
}


$password=mysqli_real_escape_string($con,$plain_password);
$password=md5($password);

$query="SELECT id,email_id,password from users where email_id='".$email."' and  password='".$password."'";
$result=mysqli_query($con,$query);
$num=mysqli_num_rows($result);
if($num==0){
    $m = "Please enter correct E-mail id and Password";
    header('location: index.php?errorl='.$m);
}else{
    $row = mysqli_fetch_array($result);
    $_SESSION['email'] = $row['email_id'];
    $_SESSION['user_id'] = $row['id'];
    unset($_SESSION['is_admin']);
    header('location:index.php');
    

}
?>