<?php
   require 'database.php';
   $data = $_POST["search"];
   $sql = 'SELECT * FROM patient WHERE first_name LIKE"'.$data.'%"';
   //$sql = 'SELECT * FROM patient INNER JOIN doctor WHERE first_name LIKE"'.$data.'%"';
   $result = mysqli_query($conn, $sql);   
   if (mysqli_num_rows($result) > 0) {
      echo "NAME MIDDLE_NAME SURNAME AGE GENDER ADDRESS CITY COUNTRY PERSONAL_ID DOB BLOOD_TYPE CURRENTLY_ADMITTED";
      while($row = mysqli_fetch_assoc($result)) {
         if($row["admitted"] == 0){$admitted = "no";}else{$admitted = "yes";}
         echo ",".$row["first_name"]." ".$row["middle_name"]." ".$row["surname"]." ".$row["age"]." ".$row["sex"]." ".$row["address"]." ".$row["city"]." ".$row["country"]." ".$row["personal_id"]." ".$row["date_of_birth"]." ".$row["blood_type"]." ".$admitted;
      }
   } else {
      echo "0 results";
   }
   mysqli_close($conn);
?>

