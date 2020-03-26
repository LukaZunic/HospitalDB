<?php
  require 'database.php';
  $data = $_POST["search"];
  
  $sql = 'SELECT * FROM blood WHERE type LIKE "%'.$data.'%"';

  $result = mysqli_query($conn, $sql);   
  if (mysqli_num_rows($result) > 0) {
    echo "BLOODTYPE UNITSAVAILABLE URGENT?";
      while($row = mysqli_fetch_assoc($result)) {
          if($row["urgent"] == 0){$urgent = "no";}else{$urgent = "yes";}
          echo ",". $row["type"]." ". $row["amount"]." ".$urgent;
        }
    }else {
        echo "0 results";
  }
  mysqli_close($conn);
