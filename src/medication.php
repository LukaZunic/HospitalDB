<?php
    require 'database.php';
    $data = $_POST["search"];


    $sql = 'SELECT drug_id "ID", drug_name "DRUG NAME", drug_amount "UNITS AVAILABLE" 
            FROM medication 
            WHERE drug_name LIKE"' .$data.'%"
            OR drug_id = "' .$data.'%"';

    $result = mysqli_query($conn, $sql);   
    if (mysqli_num_rows($result) > 0) {

      $json_array = array();

      while($row = mysqli_fetch_assoc($result)){   
          $json_array[] = $row;
      }
  
      echo json_encode($json_array);

      /*

        echo "MEDICATION UNITS_AVAILABLE";
        while($row = mysqli_fetch_assoc($result)) {
           echo ",". $row["drug_name"] ." ". $row["drug_amount"];
        }

      */
     } else {
        echo "0 results";
     }
     mysqli_close($conn);
?>
