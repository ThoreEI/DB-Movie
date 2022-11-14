function createTable(tableData) {
    var table = document.getElementById('filmtable');
    var tableBody = document.createElement('tbody');

    tableData.forEach(function(rowData) {
        var row = document.createElement('tr');

        rowData.forEach(function(cellData) {
            var cell = document.createElement('td');
            cell.appendChild(document.createTextNode(cellData));
            row.appendChild(cell);

            // check if the cell is the last one
            if (cellData === "") {
                // add the button
                var button = document.createElement("button");
                button.innerHTML = "X";
                button.setAttribute("class", "delete");
                button.setAttribute("onclick", "deleteRow(this)");
                cell.appendChild(button);
            }
        });

        tableBody.appendChild(row);
    });

    table.appendChild(tableBody);
    document.body.appendChild(table);
}

function create(){
    createTable([["Pulp Fiction", "Quentin Tarantino", "1994", "154", "16", ""],
        ["Inglourious Basterds", "Quentin Tarantino", "2009", "153", "16", ""],
        ["Reservoir Dogs", "Quentin Tarantino", "1992", "99", "18", ""],
        ["Blade Runner", "Ridley Scott", "1982", "117", "16", ""]]);
}