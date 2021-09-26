<?php
session_start();
    if(!$_SESSION['user_id'])
    {
        header('location:login.php');
    }
$conn = mysqli_connect('localhost', 'root', '', 'web');
$id = number_format($_GET['id']);

$select =  "SELECT * FROM student WHERE `id` = '$id' ";
$result =mysqli_query($conn,$select);
$row = mysqli_fetch_array($result);

if(@$_POST['submit'])
    {
        $name =$_POST['name'];
        $phone =$_POST['phone'];
        $email =$_POST['email'];
        $password =$_POST['password'];
        if(isset($name) && isset($phone) && isset($email) && isset($password))
        {
	        $update = "UPDATE student SET `name`='$name',`phone`='$phone',`email`='$email',`password`='$password' WHERE `id`='$id'"; 
	        $result =mysqli_query($conn,$update);

	        if($result){
	        	header('location:index.php');
	        }
	        else{
    		echo "Wrong data enterd";
    	}
    	}
    	else{
    		echo "Wrong data enterd";
    	}
    }


?>





<!DOCTYPE html>
<html>
<head>
  <title>Add Records in Database</title>
</head>
<body>
<h3>update the Form</h3>

<form action="" method="POST" enctype="multipart/form-data" >
    Name : <input type="text" name="name" value="<?php echo $row['name']; ?>" placeholder="Enter Full Name" Required>
    phone : <input type="text" name="phone" value="<?php echo $row['phone']; ?>" placeholder="Enter Age" Required>
    email : <input type="text" name="email" value="<?php echo $row['email']; ?>" placeholder="Enter Full Name" Required>
    password : <input type="text" name="password" value="<?php echo $row['password']; ?>" placeholder="Enter Full Name" Required>
    <input type="submit" name="submit" value="update">
</form>
</body>
</html>
