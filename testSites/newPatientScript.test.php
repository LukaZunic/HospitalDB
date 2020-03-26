<!-----------------------------CREATE NEW PATIENT-------------------------------------->

<!--
<div id="patInp">
    <input placeholder="Name" type="text" id="pName">
    <input placeholder="Middle name" type="text" id="pMidname">
    <input placeholder="Surname" type="text" id="pSurname">
    <input placeholder="Age" type="text" id="pAge">
    <br>
    <input placeholder="Personal ID" type="text" id="pID">
    <input placeholder="Address" type="text" id="pAddr">
    <input placeholder="Gender" type="text" id="sex">
    <input type="date" placeholder="Date Of Birth" id="dob">
    <input placeholder="Blood Type" type="text" id="bl">

    <button onclick="patientAdd()" id="addPat">Submit</button>
</div>
<style>

    #patInp{
        z-index: 30;
        width: 100px;
        position: fixed;
        margin-left: 60%;
        margin-top: 0px;
    }

    #pName{
        margin-left: 200px;
        margin-top: 300px;
    }
    #pID{
        margin-left: 200px;  
    }
</style>

<script>
    function patientAdd(){
        let add = ["",document.getElementById("pName").value,document.getElementById("pMidname").value,document.getElementById("pSurname").value,document.getElementById("pAge").value,document.getElementById("pID").value,document.getElementById("pAddr").value,document.getElementById("sex").value,document.getElementById("dob").value,document.getElementById("bl").value];
        let xhr = new XMLHttpRequest();

        xhr.open("POST", "/medical/patientAdd.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("add=" + add);

        xhr.onreadystatechange = function () {
            if (this.readyState != 4) return;
            if (this.status == 200){
                let data = this.responseText;
                console.log(data);
                //document.getElementById("output").innerHTML = data;
            }
        };
    }
</script>

-->
<!---------------------------------------------------------------------------------------------->
