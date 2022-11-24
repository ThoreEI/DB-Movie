const table = document.getElementById("movie-table");
const tableBody = document.getElementById("tableBody");
let entries = {
    "The_Grudge": {
        "producer": "Takashi Shimizu",
        "year": "2005",
        "playtime": "91",
        "fsk": "16"
    },
    "Lucy": {
        "producer": "Luc Besson",
        "year": "2014",
        "playtime": "89",
        "fsk": "12"
    },
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

const arrowDown = "▼";
const arrowUp = "▲";
const prevHeader = -1;
let currentYear = new Date().getFullYear();

const digits = new RegExp(/\d/)
const letters = new RegExp(/\D/)
const validYear = new RegExp(/\d{4}/)


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
    // creates the standard table with the entries from the Json object
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
}

function addMovie() {
    // get the input values
    let title = document.getElementById("inputTitle").value;
    let producer = document.getElementById("inputProducer").value;
    let year = document.getElementById("inputYear").value;
    let playtime = document.getElementById("inputPlaytime").value;
    let fsk = document.getElementById("inputFSK").value;

    // check if all input fields are correctly filled
    if (title === "" || producer === "" || year === "" || playtime === "" || fsk === "") {
        alert("Please fill out all fields!");
        return;
    }

    if (producer.match(digits)) {
        alert("Invalid input for producer.")
        return;
    }

    if (playtime.match(letters) || playtime <= 0) {
        alert("Invalid input for playtime.")
        return;
    }

    if (!year.match(validYear) || year < 1888 || year > currentYear) {
        alert("Invalid input for year.")
        return;
    }

    if (fsk !== "0" && fsk !== "6" && fsk !== "12" && fsk !== "16" && fsk !== "18") {
        alert("Invalid input for FSK.")
        return;
    }

    // create a new row with the input values
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

    // clear the input fields and set the focus to the title input field
    clearInputs();
    document.getElementById("inputTitle").select();
}

function clearInputs() {
    // clear the input fields
    document.getElementById("tableBody").value = ""
    document.getElementById("inputTitle").value = "";
    document.getElementById("inputProducer").value = "";
    document.getElementById("inputYear").value = "";
    document.getElementById("inputPlaytime").value = "";
    document.getElementById("inputFSK").value = "";
}

function addCloseButton(cell) {
    // create a new button element and add it to the cell
    let closeButton = document.createElement("button");
    closeButton.innerHTML = "X";
    closeButton.setAttribute("id", "close");
    closeButton.addEventListener("click", function () {
        this.parentElement.parentElement.style.display = 'none';
    });
    cell.appendChild(closeButton)
}


// checks if the Enter Key is pressed and then calls the addMovie function
buttonPressed();
function buttonPressed() {
    document.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            addMovie();
        }
    });
}


function spawnArrow(direction, currentHeader) {
    // removes the arrow from the previous column
    if (prevHeader !== -1) {
        document.getElementsByTagName("th")[prevHeader].getElementsByTagName("i")[0].remove();
    }
    prevHeader = currentHeader;

    // creates a new arrow element and adds it to the column header
    if (direction === "asc") {
        let arrow = document.createElement("i");
        arrow.innerHTML = arrowUp;
        document.getElementsByTagName("th")[currentHeader].appendChild(arrow);

    } else if (direction === "desc") {
        let arrow = document.createElement("i");
        arrow.innerHTML = arrowDown;
        document.getElementsByTagName("th")[currentHeader].appendChild(arrow);
        
    }
}


function sortTable(currentRow) {
    let rows, switching, index, currentEntry, nextEntry, shouldSwitch, direction, switchCount = 0;
    switching = true;
    direction = "asc";

    while (switching) {
        switching = false;
        rows = table.rows;
        for (index = 2; index < (rows.length - 1); index++) {
            shouldSwitch = false;
            currentEntry = rows[index].getElementsByTagName("td")[currentRow];
            nextEntry = rows[index + 1].getElementsByTagName("td")[currentRow];
            if (currentRow > 1) {
                if (direction === "asc") {
                    if (Number(currentEntry.innerHTML.toLowerCase()) > Number(nextEntry.innerHTML.toLowerCase())) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (direction === "desc") {
                    if (Number(currentEntry.innerHTML.toLowerCase()) < Number(nextEntry.innerHTML.toLowerCase())) {
                        shouldSwitch = true;
                        break;
                    }
                }
            } else {
                if (direction === "asc") {
                    if (currentEntry.innerHTML.toLowerCase() > nextEntry.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (direction === "desc") {
                    if (currentEntry.innerHTML.toLowerCase() < nextEntry.innerHTML.toLowerCase()) {
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
    spawnArrow(direction, currentRow);
}