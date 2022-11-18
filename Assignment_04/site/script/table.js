const table = document.getElementById("movie-table")
// const entries = [["Pulp Fiction", "Quentin Tarantino", "1994", "154", "16", ""],
//     ["Inglorious Bastards", "Quentin Tarantino", "2009", "153", "16", ""],
//     ["Reservoir Dogs", "Quentin Tarantino", "1992", "99", "18", ""],
//     ["Blade Runner", "Ridley Scott", "1982", "117", "16", ""]];
const headings = ["Titel", "Regisseur", "Jahr", "Spielzeit", "FSK", ""]


let entries = {
    "a": {
        "producer": "A",
        "year": "100",
        "playtime": "154",
        "fsk": "16"
    },
    "b": {
        "producer": "B",
        "year": "200",
        "playtime": "153",
        "fsk": "16"
    },
    "c": {
        "producer": "C",
        "year": "300",
        "playtime": "99",
        "fsk": "18"
    },
    "d": {
        "producer": "D",
        "year": "400",
        "playtime": "117",
        "fsk": "16"
    }
}


buttonPressed();

function init() {
    // get the keyset of the Json object entries
    let keys = Object.keys(entries);
    // create a new array with the values of the Json object entries
    let newEntries = [];
    keys.forEach(function (key) {
        let entry = [];
        entry.push(key.replace("_", " "));
        entry.push(entries[key]["producer"]);
        entry.push(entries[key]["year"]);
        entry.push(entries[key]["playtime"]);
        entry.push(entries[key]["fsk"]);
        entry.push("");
        newEntries.push(entry);

    });
    entries = newEntries;
    createMovieTable();
}


// function that gets the input from the form and adds it to the table when pressing enter
function addMovie() {
    let movieName = document.getElementById("inputTitel").value;
    let movieProducer = document.getElementById("inputProducer").value;
    let movieYear = document.getElementById("inputYear").value;
    let moviePlaytime = document.getElementById("inputPlaytime").value;
    let movieFsk = document.getElementById("inputFSK").value;

    if (movieName === "" || movieProducer === "" || movieYear === "" || moviePlaytime === "" || movieFsk === "") {
        alert("Bitte alle Felder ausfüllen!");
        return;
    }

    let newEntry = [movieName, movieProducer, movieYear, moviePlaytime, movieFsk, ""];

    const tableBody = document.getElementById("tableBody");
    const rowBody = document.createElement("tr");
    newEntry.forEach(function createCell(cellData) {
        const cell = document.createElement("td");
        cell.appendChild(document.createTextNode(cellData));
        rowBody.appendChild(cell);

        if (cellData === "") {
            let closeButton = document.createElement("button");
            closeButton.innerHTML = "X";
            closeButton.setAttribute("id", "close");
            closeButton.addEventListener("click", function () {
                this.parentElement.parentElement.style.display = 'none';
            });
            closeButton.name = "X"
            cell.appendChild(closeButton)
        }
    });

    tableBody.appendChild(rowBody);
    document.table.appendChild(table);
}

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
    //Set the sorting direction to ascending:
    dir = "asc";
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.getElementsByTagName("TR");
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 2; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /*check if the two rows should switch place,
            based on the direction, asc or desc:*/
            if(n === "0") {
                if (dir === "asc") {
                    if (parseFloat(x.innerHTML.toLowerCase()) > parseFloat(y.innerHTML.toLowerCase())) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch= true;
                        break;
                    }
                } else if (dir === "desc") {
                    if (parseFloat(x.innerHTML.toLowerCase()) < parseFloat(y.innerHTML.toLowerCase())) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch= true;
                        break;
                    }
                }
            } else {
                if (dir === "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch= true;
                        break;
                    }
                } else if (dir === "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
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
}


function createMovieTable() {

    const tableBody = document.getElementById("tableBody");
    entries.forEach(function createRow(rowData) {
        const rowBody = document.createElement("tr");
        rowData.forEach(function createCell(cellData) {
            let cell = document.createElement("td");
            cell.appendChild(document.createTextNode(cellData));
            tableBody.appendChild(rowBody).appendChild(cell);


            if (cellData === "") {
                let closeButton = document.createElement("button");
                closeButton.innerHTML = "X";
                closeButton.setAttribute("id", "close");
                closeButton.addEventListener("click", function () {
                    this.parentElement.parentElement.style.display = 'none';
                });
                closeButton.name = "X"
                cell.appendChild(closeButton)
            }
        });
    });

    table.appendChild(tableBody);
    document.table.appendChild(table);
}