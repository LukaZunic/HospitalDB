<?php
    require 'database.php';
?>

<DOCTYPE html>
<html>
<head>

    <title>l'hospital</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tableStyle.css">
    <!--<link rel="stylesheet" href="styles.css">-->
    <link rel="stylesheet" href="css/topStyle.css">
    <link rel="stylesheet" href="css/buttonStyle.css">
    <script src="parse.js"></script>
    <script src="checkAd.js"></script>

</head>

<body>

    <div class="topnav">
        <img src="resources/who.png" id="who">
        <div id="nav">
            <a href="index.php" class="active">Home</a>
            <a href="pharmacy.php">Pharmacy</a>
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
            </div>
        </div>
    </div>

    <div id="patInp">
        <input placeholder="Name" type="text" id="pName">
        <input placeholder="Middle name" type="text" id="pMidname">
        <input placeholder="Surname" type="text" id="pSurname">
        <input placeholder="Age" type="text" id="pAge">
        <input placeholder="Personal ID" type="text" id="pID">
        <input placeholder="Address" type="text" id="pAddr">
        <input placeholder="City" type="text" id="pCity">
        <input placeholder="Country" type="text" id="pCountry">
        <input placeholder="Gender" type="text" id="sex">
        <input type="date" placeholder="Date Of Birth" id="dob">
        <input placeholder="Blood Type" type="text" id="bl">

        <button onclick="patientAdd()" id="addPat">ADMIT PATIENT</button>
    </div>

    <style type="text/css">
        #patInp{
            max-width: 500px;
            padding: 10px 20px;
            background: #f4f7f8;
            margin: 10px auto;
            padding: 20px;
            background: #f4f7f8;
            border-radius: 8px;
            font-family: Georgia, "Times New Roman", Times, serif;
        }
        #patInp fieldset{
            border: none;
        }
        #patInp legend {
            font-size: 1.4em;
            margin-bottom: 10px;
        }
        #patInp label {
            display: block;
            margin-bottom: 8px;
        }
        #patInp input[type="text"],
        #patInp input[type="date"],
        #patInp input[type="datetime"],
        #patInp input[type="email"],
        #patInp input[type="number"],
        #patInp input[type="search"],
        #patInp input[type="time"],
        #patInp input[type="url"],
        #patInp textarea,
        #patInp select {
            font-family: Georgia, "Times New Roman", Times, serif;
            background: rgba(255,255,255,.1);
            border: none;
            border-radius: 4px;
            font-size: 15px;
            margin: 0;
            outline: 0;
            padding: 10px;
            width: 100%;
            box-sizing: border-box; 
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box; 
            background-color: #e8eeef;
            color:#8a97a0;
            -webkit-box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
            box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
            margin-bottom: 30px;
        }
        #patInp input[type="text"]:focus,
        #patInp input[type="date"]:focus,
        #patInp input[type="datetime"]:focus,
        #patInp input[type="email"]:focus,
        #patInp input[type="number"]:focus,
        #patInp input[type="search"]:focus,
        #patInp input[type="time"]:focus,
        #patInp input[type="url"]:focus,
        #patInp textarea:focus,
        #patInp select:focus{
            background: #d2d9dd;
        }
        #patInp select{
            -webkit-appearance: menulist-button;
            height:35px;
        }
        #patInp .number {
            background: #1abc9c;
            color: #fff;
            height: 30px;
            width: 30px;
            display: inline-block;
            font-size: 0.8em;
            margin-right: 4px;
            line-height: 30px;
            text-align: center;
            text-shadow: 0 1px 0 rgba(255,255,255,0.2);
            border-radius: 15px 15px 15px 0px;
        }

        #patInp input[type="submit"],
        #patInp input[type="button"]
        {
            position: relative;
            display: block;
            padding: 19px 39px 18px 39px;
            color: #FFF;
            margin: 0 auto;
            background: #1abc9c;
            font-size: 18px;
            text-align: center;
            font-style: normal;
            width: 100%;
            border: 1px solid #16a085;
            border-width: 1px 1px 3px;
            margin-bottom: 10px;
        }
        #patInp input[type="submit"]:hover,
        #patInp input[type="button"]:hover
        {
            background: #109177;
        }
    </style>

    
    <script>
        function patientAdd(){
            let add = ["",document.getElementById("pName").value,document.getElementById("pMidname").value,document.getElementById("pSurname").value,document.getElementById("pAge").value,document.getElementById("pID").value,document.getElementById("pAddr").value,document.getElementById("pCity").value,document.getElementById("pCountry").value,document.getElementById("sex").value,document.getElementById("dob").value,document.getElementById("bl").value];
            console.log(add);
            let xhr = new XMLHttpRequest();

            xhr.open("POST", "/medical/patientAdd.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("add=" + add);

            xhr.onreadystatechange = function () {
                if (this.readyState != 4) return;
                if (this.status == 200){
                    let data = this.responseText;
                    //console.log(data);
                }
            };
            location.reload();
        }
    </script>



</body>

</html>