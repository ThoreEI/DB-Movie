<?php
require "Film.php";
$entries = array(
    new Film("The Grudge", "Takashi Shimizu", "2005", "91", "16"),
    new Film("Lucy", "Luc Besson", "2014", "89", "12"),
    new Film("Pulp Fiction", "Quentin Tarantino", "1994", "154", "16"),
    new Film("Inglorious Bastards", "Quentin Tarantino", "2009", "153", "16"),
    new Film("Reservoir Dogs", "Quentin Tarantino", "2005", "99", "18"),
    new Film("Blade Runner", "Ridley Scott", "1982", "117", "16")
);

init();
if (isset($_POST["save"])) {
    // go to the previous page
    echo "lol";
    //header("Location: " . $_SERVER["HTTP_REFERER"]);
    addMovie();
}


function addMovie(){
    if (isset($_POST['save'])) {
        global $entries;
        $title = $_REQUEST['title'];
        $producer = $_REQUEST['producer'];
        $year = $_REQUEST['year'];
        $playtime = $_REQUEST['playtime'];
        $fsk = $_REQUEST['fsk'];
        $newMovie = new Film($title, $producer, $year, $playtime, $fsk);

        $entries->array_push($newMovie);
    }
}

function createMovieTable(){
    global $entries;
    foreach ($entries as $entry) {
        echo "<tr>";
        echo "<td>" . $entry->title . "</td>";
        echo "<td>" . $entry->producer . "</td>";
        echo "<td>" . $entry->year . "</td>";
        echo "<td>" . $entry->playtime . "</td>";
        echo "<td>" . $entry->fsk . "</td>";
        echo "</tr>";
    }
}

/**
 * @throws DOMException
 */
function init(){
    global $entries;
    global $table;
    global $table_body;
    foreach ($entries as $rowData) {
        $rowBody = (new DOMDocument)->createElement("tr");
        forEach($rowData as $key => $value){
            $cell = (new DOMDocument)->createElement("td");
            $cell->nodeValue = $value;
            $textNodeValue = (new DOMDocument)->createTextNode($value);
            $cell->appendChild($textNodeValue);
            $rowBody->appendChild($cell);
            $table_body->appendChild($rowBody);
            if ($textNodeValue == ""){
                addCloseButton();
            }
        }
    }
    $table->appendChild($table_body);
    (new DOMDocument)->appendChild($table);
}

function addCloseButton(){
    $closeButton = DOMDocument::createElement("button");
    $closeButton->setAttribute("id", "close");
    $closeButton->addEventListener("click", function() use ($closeButton) {
        $closeButton->parentNode->remove();
    });
    $closeButton->nodeValue = "Close";
    DOMDocument::appendChild($closeButton);
}







