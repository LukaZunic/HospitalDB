<?php
    require 'database.php';
    $data = $_POST["search"];
    $sql = 'SELECT * FROM patient WHERE first_name LIKE"'.$data.'%"';
    $result = mysqli_query($conn, $sql);   
    if (mysqli_num_rows($result) > 0) {
        echo "Name Surname";
        while($row = mysqli_fetch_assoc($result)) {
           echo ",".$row["first_name"]." ".$row["surname"];
        }
    }else {
        echo "0 results";
    }
     mysqli_close($conn);

?>
