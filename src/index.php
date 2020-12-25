
<?php
    require 'credentialCheck.php';
    require 'database.php';
?>

<!DOCTYPE html>
<html>
<head>

    <title>l'hospital</title>

    <meta charset="utf-8">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tableStyle.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/topStyle.css">
    <link rel="stylesheet" href="css/buttonStyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="parseTable.js"></script>
    <script src="checkAd.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

   
</head>

<body>


    <div class="topnav">
       
        <img src="resources/whoWhite.png" id="who" >
        <div id="nav">
            <a href="index.php" class="active">Home</a>
            <a href="pharmacy.php">Pharmacy</a>
            <a href="bloodBank.php">Blood Bank</a>
        </div>
    
        <div id="ad"></div>
        <div id="con"></div>

        <style>
            .topnav a:hover{ color: white !important; }
            #ad{ margin-left: 60%; }
            #con{ margin-left: 80%; }
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
                <label for="nme"><span>Search Doctors</span></label>
                <button onclick="process()" id="butt">Submit</button>
                
                <input type="text" name="name" class="mainInput"  id="subpat" required autocomplete="off" />
                <label for="nme"><span>Search Patients</span></label>
                <button onclick="patientSearch()" id="butt2">Submit</button>
        
            </div>
        </div>
    </div>

    
    <div class="table-y">
        <table id="tab" class="table table-striped table-hover"></table>
    </div>
    <style>
        .table-y{
            position: relative;
            height: 40%;
            overflow: auto;
            display: block;
        }

        #tab{
            margin: auto;
            margin-top: 30px;
            width: 80%;
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
                    
                    document.getElementById("tab").innerHTML = parseTable(JSON.parse(data)); 
                    
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
                    
                    console.table(data);
                    
                    let returnedDataIntoJSON = JSON.parse(data);
                    console.table(returnedDataIntoJSON);

                    let html = parseTable(returnedDataIntoJSON);

                    document.getElementById("tab").innerHTML = html;
                    
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