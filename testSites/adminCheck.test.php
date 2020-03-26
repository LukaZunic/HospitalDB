<?php

if($_SESSION["username"] == "admin"){
    header("Location: indexAdmin.php");
    exit;
}
