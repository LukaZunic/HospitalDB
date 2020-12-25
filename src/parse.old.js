function parseIntoTable(array){

    console.log(array);
    var table = document.getElementById('tab');
    table.innerHTML = "";
    array = array.split(',');
    
    for(let i = 0; i < array.length; i++){
        array[i] = array[i].split(' ');
    }

    var header = table.createTHead();
    let hRow = header.insertRow();
    for(let headInd = 0; headInd < array[0].length; headInd++){
        let hCell = hRow.insertCell();
        hCell.innerHTML = array[0][headInd];
    }

    for(let row = 1; row < array.length; row++){
        let tableRow = table.insertRow();
        for(let i = 0; i < array[row].length; i++){
            let rowCell = tableRow.insertCell();
            rowCell.innerHTML = array[row][i];
        }
    }
    
}

