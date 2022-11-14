const tableEntries = [["Pulp Fiction", "Quentin Tarantino", "1994", "154", "16", ""],
    ["Inglorious Bastards", "Quentin Tarantino", "2009", "153", "16", ""],
    ["Reservoir Dogs", "Quentin Tarantino", "1992", "99", "18", ""],
    ["Blade Runner", "Ridley Scott", "1982", "117", "16", ""]];

const tableHeadInformation = ["Title", "Regisseur", "Jahr", "Spielzeit", "FSK"]


function createAndRenderMovieTable() {
    const table = document.getElementById("movie-table")
    const tableHead = document.createElement("thead");
    const tableHeadRow = document.createElement("tr")

    tableHeadInformation.forEach(function createHead(headData) {
        const tableHeadCell = document.createElement("th")
        tableHeadCell.appendChild(document.createTextNode(headData))
        tableHeadRow.appendChild(tableHeadCell)
        tableHead.appendChild(tableHeadRow)
    });

    const tableBody = document.createElement("tbody");
    tableEntries.forEach(function createRow (rowData) {
        const tableBodyRow = document.createElement("tr");
        rowData.forEach(function createCell (cellData) {
            const tableBodyCell = document.createElement("td")
            tableBodyCell.appendChild(document.createTextNode(cellData))
            tableBodyRow.appendChild(tableBodyCell)

            if (cellData === "") {
                const addButton = document.createElement("button");
                addButton.innerHTML = "Add"
                addButton.setAttribute("class", "delete");
                addButton.setAttribute("onclick", "deleteRow(this)")
                tableBodyCell.appendChild(addButton);
            }
        });
        tableBody.appendChild(tableBodyRow);
    });

    table.appendChild(tableHead)
    table.appendChild(tableBody);

    document.body.appendChild(table);
}

