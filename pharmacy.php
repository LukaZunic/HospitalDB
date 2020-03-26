<?php
    require 'database.php';
    require 'credentialCheck.php';
?>

<DOCTYPE html>
<html>
<head>
    <title>Pharmacy</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tableStyle.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/topStyle.css">
    <link rel="stylesheet" href="css/buttonStyle.css">
    <script src="parse.js"></script>
</head>

<body onload="medSearch()">

    <div class="topnav">
        <img src="resources/who.png" id="who">
        <div id="nav">
            <a href="index.php">Home</a>
            <a href="pharmacy.php" class="active">Pharmacy</a>
            <a href="bloodBank.php">Blood Bank</a>
        </div>
        <div id="con">
            <a href="logout.php">Log Out</a>
            <a href="index.php">Contacts</a>
        </div>

        <style>
            #con{
                margin-left: 80%;
            }
        </style>
    </div>

    <div class="wrap">
        <div class="back">
            <div id="main">

                <input type="text" name="name" class="mainInput" id="ph" required autocomplete="off" />
                <label for="nme"><span>Enter drug</span></label>
                <button onclick="medSearch()" id="buttph">Submit</button>
                      
            </div>
        </div>
        
    </div>


    <table id="tab" class="tab"></table>
    <style>
        #tab{
            margin-left: 200px;
            margin-top: 45px;
            padding-top: 200px;
        }
    </style>

    <script>
        function medSearch(){
            let search = document.getElementById("ph").value;
            let xhr = new XMLHttpRequest();

            xhr.open("POST", "/medical/medication.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("search=" + search);

            xhr.onreadystatechange = function () {
                if (this.readyState != 4) return;
                if (this.status == 200){
                    let data = this.responseText;
                    parseIntoTable(data);
                }
            };
        }
        var input = document.getElementById("ph");
        input.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("buttph").click();
            }
        });
    </script>

</body>
</html>