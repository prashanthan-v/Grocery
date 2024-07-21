<?php

include 'sqlconnect.php';

?>
<?php
$product = $_POST['selectedoption'];

$query = "select* from product_price where product='$product'";

$result = mysqli_query($connection,$query);
   if(mysqli_num_rows($result)>0){
      while($row=mysqli_fetch_assoc($result)){
        echo "<td>";
        echo htmlspecialchars($row['product']);
         echo"</td>";
         echo "<td>";
        echo htmlspecialchars($row['price']);
         echo"</td>";
          echo "<td>";
          echo "<input type='number'>";
         echo"</td>";
      }
   }
   else{
    echo "nocomments";
 }
?>
