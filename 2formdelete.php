<?php
$conn= mysqli_connect('localhost','root','','web');
    $delete = "DELETE FROM reg2 where reg_id='".$_GET["id"]."'" ;
    $delete2 ="DELETE FROM reg1 where id='".$_GET['id']."'";
    $result =mysqli_query($conn,$delete);
    $result2 =mysqli_query($conn,$delete2);
//echo $result;
if($delete){
    header('location:index.php');
    echo '<script>alert("Data Succesfully DELETE")</script>';
}
else{
    echo '<script>alert("somthing is worng")</script>';
}

?>