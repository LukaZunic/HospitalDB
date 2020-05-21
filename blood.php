<?php
  require 'database.php';
  $data = $_POST["search"];
  
  $sql = 'SELECT blood_type "BLOOD TYPE", amount "AMOUNT", urgent "URGENT" FROM blood WHERE blood_type LIKE "%'.$data.'%"';

  $result = mysqli_query($conn, $sql);   

  if (mysqli_num_rows($result) > 0) {
    
    $json_array = array();

    while($row = mysqli_fetch_assoc($result)){   
        $json_array[] = $row;
    }

    echo json_encode($json_array);

    }else {
        echo "0 results";
  }
  mysqli_close($conn);
