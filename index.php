
<?php
    /*
    $name = "Admin";
    $servername = "localhost";
    $dbname = "test";
    $conn = new mysqli($servername, "root", "", $dbname);
    */
    
    //print out the database(used for testing)
    /*
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    */

    //$result = $conn->query("SELECT * FROM tablica");
    //$result = $conn->query("SELECT * FROM employee");
    //print_r($result);
    /*
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - username: " . $row["username"]. " " . $row["email"]. "<br>";
    }
    */
    /*
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["employee_id"]. " - name: " . $row["first_name"]. " -surname: " . $row["surname"] . " - address: ". $row["address"] . "<br>";
    }
    */
?> 

<?php
    require 'credentialCheck.php';
    require 'database.php';
?>


<DOCTYPE html>
<html>
<head>

    <title>l'hospital</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tableStyle.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/topStyle.css">
    <link rel="stylesheet" href="css/buttonStyle.css">
    <script src="parse.js"></script>
    <script src="checkAd.js"></script>

   
</head>

<body>

        

    <div class="topnav">
       
        <img src="resources/who.png" id="who" >
        <div id="nav">
            <a href="index.php" class="active">Home</a>
            <a href="pharmacy.php">Pharmacy</a>
            <a href="bloodBank.php">Blood Bank</a>
        </div>
    
        <div id="ad"></div>
        <div id="con"></div>

        <style>
            .topnav a:hover{
                color: white !important;
            }

            #ad{
                margin-left: 60%;
            }
            #con{
                margin-left: 80%;
            }
        </style>

        <script>
            var sessionUser = '<?php echo $_SESSION["username"] ?>';
            checkAd(sessionUser);
        </script>

    </div>

    <div class="wrap">
        <div class="back">
            <div id="main">

                <input type="text" name="name" class="mainInput"  id="sub" required autocomplete="off" />
                <label for="nme"><span>Enter doctor name</span></label>
                <button onclick="process()" id="butt">Submit</button>
                
                <input type="text" name="name" class="mainInput"  id="subpat" required autocomplete="off" />
                <label for="nme"><span>Enter patient name</span></label>
                <button onclick="patientSearch()" id="butt2">Submit</button>
        
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

    

   

    <!------------------ DATABASE REQUEST FUNCTIONS ---------------------->

    <script>
        function process(){
            let search = document.getElementById("sub").value;
            let xhr = new XMLHttpRequest();

            xhr.open("POST", "/medical/process.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("search=" + search);

            xhr.onreadystatechange = function () {
                if (this.readyState != 4) return;
                if (this.status == 200){
                    let data = this.responseText;
                    //console.log(data);
                    parseIntoTable(data);
                    
                }
            };
        }

        var input = document.getElementById("sub");
        input.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("butt").click();
            }
        });
    </script>

    <script>
        function patientSearch(){
            let search = document.getElementById("subpat").value;
            let xhr = new XMLHttpRequest();

            xhr.open("POST", "/medical/patient.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("search=" + search);

            xhr.onreadystatechange = function () {
                if (this.readyState != 4) return;
                if (this.status == 200){
                    let data = this.responseText;
                    //console.log(data);
                    parseIntoTable(data);
                }
            };
        }
        var input = document.getElementById("subpat");
        input.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("butt2").click();
            }
        });
    </script>
    

</body>
</html>