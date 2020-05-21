<?php
  require 'database.php';
  $data = $_POST["search"];
  
  $sql = 'SELECT employee_id "EMPLOYEE ID", employee_name "NAME", employee_middle_name "MIDDLE NAME", employee_surname "SURNAME", sex "SEX", age "AGE", personal_id "PERSONAL ID", medical_staff.address "ADDRESS", city "CITY", country "COUNTRY", DOB "DATE OF BIRTH"
          FROM medical_staff INNER JOIN specialization USING (specialization_id) 
          WHERE employee_name LIKE "'.$data.'%" OR employee_surname LIKE "'.$data.'%"
          OR specialty LIKE "'.$data.'%"
          OR employee_id LIKE "'.$data.'%"
          ORDER BY employee_id';


  $result = mysqli_query($conn, $sql);   
  if (mysqli_num_rows($result) > 0) {
    
    /*
    echo "EMPLOYEE_ID SPECIALIZATION NAME MIDDLE_NAME SURNAME SEX AGE PERSONAL_ID ADDRESS CITY DATE_OF_BIRTH";
    while($row = mysqli_fetch_assoc($result)) {
      echo ",".$row["employee_id"]." ".$row["specialty"]." ".$row["employee_name"]." ".$row["employee_middle_name"]." ".$row["employee_surname"]." ".$row["sex"]." ".$row["age"]." ".$row["personal_id"]." ".$row["address"]." ".$row["city"]." ".$row["DOB"];
    }
    */

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

