<?php
  session_start();
    if(!$_SESSION['user_id'])
    {
        header('location:login.php');
    }

    $conn = mysqli_connect('localhost', 'root', '', 'web');
    if(@$_POST['submit'])
    {
        $name =$_POST['name'];
        $phone =$_POST['phone'];
        $email =$_POST['email'];
        $password =$_POST['password'];

        $insert = "insert into `student`(`name`,`phone`,`email`,`password`)VALUES('$name','$phone','$email','$password')";
        $result =mysqli_query($conn,$insert);

    }
$select = "SELECT * FROM student where id=".$_SESSION['user_id'];

$result =mysqli_query($conn,$select);
?>


<!DOCTYPE html>
<html>
<head>
  <title>Add Records in Database</title>
</head>
<body>
<h3>Fill the Form</h3>

<form action="" method="POST" enctype="multipart/form-data" >
    Name : <input type="text" name="name" placeholder="Enter Full Name" Required>
    phone : <input type="text" name="phone" placeholder="Enter Age" Required>
    email : <input type="text" name="email" placeholder="Enter Full Name" Required>
    password : <input type="text" name="password" placeholder="Enter Full Name" Required>
    <input type="submit" name="submit" value="Submit">
</form>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
<div class="container">
<table class="table table-hover">
    <tr>
        <td class="alert alert-success">
            <strong>ID.</strong>
        </td>
        <td class="alert alert-success">
            <strong>Name</strong>
        </td>
        <td class="alert alert-success">
            <strong>Number</strong>
        </td>
         <td class="alert alert-success">
            <strong>email</strong>
        </td>
         <td class="alert alert-success">
            <strong>password</strong>
        </td>
        
        <td class="alert alert-success" colspan="2">
          <Strong>Controls</Strong>
        </td>
    </tr>
    <?php $count=1; while($array = mysqli_fetch_array($result)){ ?>
    <tr>
        <td><?php echo $array['id']; ?></td>
        <td><?php echo $array['name']; ?></td>
        <td><?php echo $array['phone']; ?></td>
        <td><?php echo $array['email']; ?></td>
         <td><?php echo $array['password']; ?></td>
        <td>
            <a href="delete.php?action=delete&id=<?php echo $array['id']; ?>">delete</a>
            <a href="edit.php?action=edit&id=<?php echo $array['id']?>">edit</a>
        </td>
        
    </tr>
    <?php } ?>
</table>
 <a href="logout.php">logout</a>
</div>
</body>
</html>

 
