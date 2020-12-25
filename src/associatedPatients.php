<?php
  require 'database.php';
  $data = $_POST["search"];
  
  $sql = 'SELECT patient_name "NAME", middle_name "MIDDLE NAME", surname "SURNAME" 
          FROM medical_staff INNER JOIN mdrelation USING (employee_id)
          INNER JOIN patient USING (patient_id) 
          WHERE employee_id = "'.$data.'%"';


  $result = mysqli_query($conn, $sql);   
  if (mysqli_num_rows($result) > 0) {

    $json_array = array();

    while($row = mysqli_fetch_assoc($result)){   
        $json_array[] = $row;
    }

    echo json_encode($json_array);

  } else {
    echo "0 results";
  }
    mysqli_close($conn);
?>