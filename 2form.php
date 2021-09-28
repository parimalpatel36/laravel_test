<?php
    $conn = mysqli_connect('localhost','root','','web');
    if(@$_POST['submit']){

        $name = $_POST['name'];
        $number = $_POST['number'];
        $cgpa = $_POST['cgpa'];
        $rank = $_POST['rank'];
        //for validation purpose
        $select = "select * from reg1 where name=' $name'";
        $result = mysqli_query($conn,$select);
        $rows = mysqli_num_rows($result);
        if($rows){
            echo '<script>alert("This name is Allready Taken")</script>';
        }
        //end 

        $insert1 = "INSERT INTO `reg1` (`name`,`number`)VALUES('$name','$number')";
        $result1 = mysqli_query($conn,$insert1);
      
        //-------------------------------

        $insert2 = "INSERT INTO reg2 SET cgpa = ".number_format($cgpa).", rank = ".number_format($rank).",
         reg_id = (SELECT id FROM reg1 WHERE name= '$name' and number = ".$number.")";
        // die($insert2);
        $result2 = mysqli_query($conn,$insert2);

        //========================================
        if($result1 && $result2){
            echo '<script>alert("Data add Succesfully")</script>';
        }
        else{
            echo '<script>alert("eoorrs")</script>';
        }
    }
   // SELECT table2.id,table2.name,table2.number, table1.cgpa,table1.rank from reg2 table1 INNER JOIN reg1 table2 on table1.reg_id = table2.id;
    $select = "SELECT table2.id,table2.name,table2.number, table1.cgpa,table1.rank from 
    reg2 table1 INNER JOIN reg1 table2 on table1.reg_id = table2.id";
    $result =mysqli_query($conn,$select);
   // die($result);
?>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
    <script>  
        function validateform()
        {  
            var name=document.myform.name.value;  
            var number=document.myform.number.value;  
        
             if (name==null || name=="")
            {  
                 alert("Name can't be blank");  
                 return false;  
            }
            else if(number.length<10)
            {  
                 alert("number must be at least 6 characters long.");  
                return false;  
            }  
        }  
</script>  
    <form action="" method="POST" enctype="multipart/form-data" name="myform" onsubmit="return validateform()" >
        <center>Student form</center>
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" class="form-control"  name="name"  placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="number">number</label>
            <input type="number" class="form-control" name="number"  placeholder="number">
        </div>
        <div class="form-group">
            <label for="cgpa">CGPA</label>
            <input type="number" class="form-control" name="cgpa" placeholder="CGPA">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Rank</label>
            <input type="number" class="form-control" name="rank" placeholder="rank">
        </div>
        
        <input type="submit" name="submit" value="Submit">
    </form>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">name</th>
      <th scope="col">Number</th>
      <th scope="col">CGPA</th>
      <th scope="col">Rank</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php $count=1; while($arr=mysqli_fetch_array($result)) {?>
    <tr>
      <th scope="row"><?php echo $count++?></th>
      <td><?php echo $arr['name'];?></td>
      <td><?php echo $arr['number'];?></td>
      <td><?php echo $arr['cgpa'];?></td>
      <td><?php echo $arr['rank'];?></td>
      <td>
          <a href="delete.php?action=delete&id=<?php echo $arr['id'] ?>">DELETE</a>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/x.y.z/underscore-min.js"></script>

    </html>