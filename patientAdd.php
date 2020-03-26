<?php
    require 'database.php';
    $data = $_POST["add"]; 
    $dataFinal = explode(",",$data);
    $sql = 'INSERT INTO patient VALUES ("","'.$dataFinal[1].'","'.$dataFinal[2].'","'.$dataFinal[3].'","'.$dataFinal[4].'","'.$dataFinal[5].'","'.$dataFinal[6].'","'.$dataFinal[7].'","'.$dataFinal[8].'","'.$dataFinal[9].'","'.$dataFinal[10].'","'.$dataFinal[11].'","'.'1'.'")';
    //echo $sql;
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_warning_count($conn)>0){
        echo(mysqli_error($conn));
    }
    mysqli_close($conn);
?>
