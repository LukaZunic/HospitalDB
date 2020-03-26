<!-------------------------TESTING OUT TABLE PARSING------------------------------------

<input placeholder="Search table" type="text" id="pars">
<button onclick="testingParse()" id="par">Submit</button>

<script>
    function testingParse(){
        let search = document.getElementById("pars").value;
        let xhr = new XMLHttpRequest();

        xhr.open("POST", "/medical/testingParse.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("search=" + search);

        xhr.onreadystatechange = function () {
            if (this.readyState != 4) return;
            if (this.status == 200){
                let data = this.responseText;
                parseIntoTable(data);
                //document.getElementById("output").innerHTML = data;
            }
        };
    }
</script>
--------------------------------------------------------------------------------------->
