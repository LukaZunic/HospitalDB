<?php
   require 'database.php';
   $data = $_POST["search"];
   
   $sql = 'SELECT patient_id "PATIENT ID", patient_name "NAME", middle_name "MIDDLE NAME", surname "SURNAME", blood_type "BLOOD TYPE", patient.country "COUNTRY"
           FROM patient
           WHERE patient_name LIKE "'.$data.'%"
           OR surname LIKE "'.$data.'%"
           OR patient_id LIKE "'.$data.'%"
           ORDER BY patient_id';
   
           
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

