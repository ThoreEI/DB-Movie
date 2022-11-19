const table = document.getElementById("movie-table")
const tableBody = document.getElementById("tableBody");
let entries = {
    "Pulp_Fiction": {
        "producer": "Quentin Tarantino",
        "year": "1994",
        "playtime": "154",
        "fsk": "16"
    },
    "Inglorious_Bastards": {
        "producer": "Quentin Tarantino",
        "year": "2009",
        "playtime": "153",
        "fsk": "16"
    },
    "Reservoir_Dogs": {
        "producer": "Quentin Tarantino",
        "year": "1992",
        "playtime": "99",
        "fsk": "18"
    },
    "Blade_Runner": {
        "producer": "Ridley Scott",
        "year": "1982",
        "playtime": "117",
        "fsk": "16"
    }
}


function init() {
    // get the key set of the Json object entries
    let keys = Object.keys(entries);
    // create a new array with the values of the Json object entries
    let tempEntries = [];
    keys.forEach(function (key) {
        let entry = [];
        entry.push(key.replace("_", " "));
        entry.push(entries[key]["producer"]);
        entry.push(entries[key]["year"]);
        entry.push(entries[key]["playtime"]);
        entry.push(entries[key]["fsk"]);
        entry.push("");
        tempEntries.push(entry);
    });
    entries = tempEntries;
    createMovieTable();
}

function createMovieTable() {
    entries.forEach(function createRow(rowData) {
        const rowBody = document.createElement("tr");
        rowData.forEach(function createCell(cellData) {
            let cell = document.createElement("td");
            cell.appendChild(document.createTextNode(cellData));
            tableBody.appendChild(rowBody).appendChild(cell);
            if (cellData === "")
                addCloseButton(cell);
        });
    });

    table.appendChild(tableBody);
    document.table.appendChild(table);
}

function addMovie() {
    let title = document.getElementById("inputTitle").value;
    let producer = document.getElementById("inputProducer").value;
    let year = document.getElementById("inputYear").value;
    let playtime = document.getElementById("inputPlaytime").value;
    let fsk = document.getElementById("inputFSK").value;

    let digits = new RegExp(/\d/)
    let letters = new RegExp(/\D/)
    let validYear = new RegExp(/\d{4}/)

    if (title === "" || producer === "" || year === "" || playtime === "" || fsk === "") {
        alert("Please fill out all fields!");
        return;
    }

    if (producer.match(digits)) {
        alert("Invalid input for producer.")
        return;
    }

    if (playtime.match(letters) && playtime > 0) {
        alert("Invalid input for playtime.")
        return;
    }

    if (!year.match(validYear) && year >= 1888) {
        alert("Invalid input for year.")
        return;
    }

    if (fsk !== "0" && fsk !== "6" && fsk !== "12" && fsk !== "16" && fsk !== "18") {
        alert("Invalid input for FSK.")
        return;
    }

    let newEntry = [title, producer, year, playtime, fsk, ""];
    const tableBody = document.getElementById("tableBody");
    const rowBody = document.createElement("tr");
    newEntry.forEach(function createCell(cellData) {
        const cell = document.createElement("td");
        cell.appendChild(document.createTextNode(cellData));
        rowBody.appendChild(cell);
        if (cellData === "")
            addCloseButton(cell);
    });
    tableBody.appendChild(rowBody);
    document.table.appendChild(table);
}

function addCloseButton(cell) {
    let closeButton = document.createElement("button");
    closeButton.innerHTML = "X";
    closeButton.setAttribute("id", "close");
    closeButton.addEventListener("click", function () {
        this.parentElement.parentElement.style.display = 'none';
    });
    cell.appendChild(closeButton)
}

buttonPressed();
function buttonPressed() {
    document.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            addMovie();
        }
    });
}

function sortTable(n) {
    let rows, switching, index, x, y, shouldSwitch, direction, switchCount = 0;
    switching = true;
    direction = "asc";
    while (switching) {
        switching = false;
        rows = table.rows;
        for (index = 2; index < (rows.length - 1); index++) {
            shouldSwitch = false;
            x = rows[index].getElementsByTagName("TD")[n];
            y = rows[index + 1].getElementsByTagName("TD")[n];
            if (n > 1) {
                if (direction === "asc") {
                    if (Number(x.innerHTML.toLowerCase()) > Number(y.innerHTML.toLowerCase())) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (direction === "desc") {
                    if (Number(x.innerHTML.toLowerCase()) < Number(y.innerHTML.toLowerCase())) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            else {
                if (direction === "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (direction === "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
        }

        if (shouldSwitch) {
            rows[index].parentNode.insertBefore(rows[index + 1], rows[index]);
            switching = true;
            switchCount++;
        } else {
            if (switchCount === 0 && direction === "asc") {
                direction = "desc";
                switching = true;
            }
        }
    }
}