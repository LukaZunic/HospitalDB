
var isPatientSearch = false;

function parseTable(data, remove = false){

    var cols = [];
    for (var k in data) {
        for (var c in data[k]) { if (cols.indexOf(c)===-1) cols.push(c); }
    }


    //(window.location.pathname in {'/medical/':0,'/medical/index.php':1}) ? cols.push('GET ASSOCIATED') : '';

    isPatientSearch = ('EMPLOYEE ID' in data[0] ? false : true);
    var id = (isPatientSearch) ? 'PATIENT ID' : 'EMPLOYEE ID';
    var add = (window.location.pathname in {'/medical/':0,'/medical/index.php':1}) ? '<td><button type="button" class="btn btn-primary" onclick = "getMore(id)">GET ASSIGNED</button></td>' : '';

    var html = '<table><tr>' + cols.map(function(c){ return '<th>'+c+'</th>' }).join('')+'</tr>';
    for (var l in data) {
        console.log(remove);

        let pl = !remove ? add.replace('id', data[l][id]) : ''
        

        html += '<tr>'+ cols.map(function(c){ return '<td>'+(data[l][c]||'')+'</td>' }).join('')+ pl + '</tr>';
        //console.log(pl);
       
    }

    html += '</table>';

    return html;

}

function getMore(id){

    console.log(isPatientSearch);

    let search = id;
    console.log(search);
    let xhr = new XMLHttpRequest();

    let lnk = "/medical/placeholder.php".replace('placeholder', (isPatientSearch) ? 'associatedDoctors' : 'associatedPatients');
    
    xhr.open("POST", lnk, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("search=" + search);

    xhr.onreadystatechange = function () {
        if (this.readyState != 4) return;
        if (this.status == 200){
            let data = this.responseText;
            //console.log(data);
            
            document.getElementById("tab").innerHTML = parseTable(JSON.parse(data),true); 
            
        }
    };
    
    
    
}