<?php
session_start();
if(isset($_SESSION['user_id']))
{
    header('location:index.php');
}
$conn = mysqli_connect('localhost', 'root', '', 'web');
if(@$_POST['submit'])
{
  $email = $_POST['email'];
  $password = $_POST['password'];
  $select = "SELECT * FROM student WHERE `email`='$email' AND `password`='$password'";
  $res= mysqli_query($conn,$select);
  $arr = mysqli_fetch_array($res);
  $row = mysqli_num_rows($res);

  if($email==$arr['email'] && $password==$arr['password'])
  {
    if($row==1)
    {
      $_SESSION['user_id']=$arr['id'];
      header('location:index.php');
    }
  }
}
?>





<form action="" method="POST" enctype="multipart/form-data" >
    email : <input type="email" name="email" placeholder="Enter Full Name" Required>
    password : <input type="password" name="password" placeholder="Enter Full Name" Required>
    <input type="submit" name="submit" value="Submit">
</form>