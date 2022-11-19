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
    var rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    switching = true;

    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        switching = false;
        rows = table.getElementsByTagName("tr");

        for (i = 2; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("td")[n];
            y = rows[i + 1].getElementsByTagName("td")[n];
            if(n === "0") {
                if (parseFloat(x.innerHTML.toLowerCase()) > parseFloat(y.innerHTML.toLowerCase())) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            } else {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            }
        }
    }

    if (shouldSwitch) {
        /*If a switch has been marked, make the switch
        and mark that a switch has been done:*/
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        //Each time a switch is done, increase this count by 1:
        switchcount ++;
    } else {
        /*If no switching has been done AND the direction is "asc",
        set the direction to "desc" and run the while loop again.*/
        if (switchcount === 0 && dir === "asc") {
            dir = "desc";
            switching = true;
        }
    }
}