<?php
  require 'database.php';
  $data = $_POST["search"];
  $sql = 'SELECT * FROM doctor INNER JOIN employee WHERE employee.id=doctor.employee_id AND specialization LIKE"' .$data.'%"'; 
  //$sql = 'SELECT * FROM doctor INNDER JOIN employee WHERE employee.id=doctor.employee_id AND specialization LIKE "'.$data.'%" '.'OR first_name LIKE "'.$data.'%" '; 

  //DODATI DA SE DOKTORE MOZE PRETRAZIVATI PO IMENU I PREZIMENU
  $result = mysqli_query($conn, $sql);   
  if (mysqli_num_rows($result) > 0) {
    echo "NAME SURNAME SPECIALIZATION";
      while($row = mysqli_fetch_assoc($result)) {
          echo ",". $row["first_name"]." ". $row["surname"]." ". $row["specialization"];
        }
    } else {
      echo "0 results";
    }
    mysqli_close($conn);
?>

