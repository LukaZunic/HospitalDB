<?php
    require 'database.php';
    $data = $_POST["search"];
    $sql = 'SELECT * FROM medication INNER JOIN pharmacy WHERE pharmacy.pharmacy_id=medication.pharmacy_id AND name LIKE"' .$data.'%"';
    $result = mysqli_query($conn, $sql);   
    if (mysqli_num_rows($result) > 0) {
        echo "MEDICATION UNITSAVAILABLE";
        while($row = mysqli_fetch_assoc($result)) {
           echo ",". $row["name"] ." ". $row["amount"];
        }
     } else {
        echo "0 results";
     }
     mysqli_close($conn);
?>
