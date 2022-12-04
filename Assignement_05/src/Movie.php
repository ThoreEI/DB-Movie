<?php
require "Film.php";

session_start();

if (isset($_SESSION['entries'])) {
    $entries = $_SESSION['entries'];
} else {
    $entries = array(
        new Film("The Grudge", "Takashi Shimizu", "2005", "91", "16"),
        new Film("Lucy", "Luc Besson", "2014", "89", "12"),
        new Film("Pulp Fiction", "Quentin Tarantino", "1994", "154", "16"),
        new Film("Inglorious Bastards", "Quentin Tarantino", "2009", "153", "16"),
        new Film("Reservoir Dogs", "Quentin Tarantino", "2005", "99", "18"),
        new Film("Blade Runner", "Ridley Scott", "1982", "117", "16"),
    );
    $_SESSION['entries'] = $entries;
}

if (isset($_POST["submitEntry"])) {
    addMovie();
    init();
}

if (isset($_POST["delete"])) {
    deleteRow();
    init();
}

function addMovie(): void {
    global $entries;
    $title = $_POST['title'];
    $producer = $_POST['producer'];
    $year = $_POST['year'];
    $playtime = $_POST['playtime'];
    $fsk = $_POST['fsk'];
    $newMovie = new Film($title, $producer, $year, $playtime, $fsk);
    $entries[] = $newMovie;
    $_SESSION['entries'] = $entries;
}

function deleteRow(): void {
    global $entries;
    // get the entries from the session
    $entries = $_SESSION['entries'];
    $del = $_POST['delete'];
    unset($entries[$del]);
    $_SESSION['entries'] = $entries;
}

/**
 * @throws DOMException
 */
function init(): void {
    global $entries;
    $dom = new DOMDocument();
    $dom->loadHTMLFile("../site/template.html");
    $tableBody = $dom->getElementById("tableBody");

    foreach ($entries as $entry => $val) {
        $tr = $dom->createElement("tr");
        foreach ($val as $key => $value) {
            $num = $dom->createElement("td", $entry);

            if ($key == "title")
                $tr->appendChild($num);

            $td = $dom->createElement("td");
            $td->nodeValue = $value;
            $tr->appendChild($td);
            if ($key == "fsk") {

                // create a new form element
                $form = $dom->createElement("form");
                $form->setAttribute("method", "post");
                $form->setAttribute("action", "../src/Movie.php");

                $td = $dom->createElement("td");
                $button = $dom->createElement("button");
                $button->setAttribute("type", "submit");
                $button->setAttribute("name", "delete");
                $button->setAttribute("value", $entry);

                $button->nodeValue = "Delete";
                $td->appendChild($button);
                $form->appendChild($td);
                $tr->appendChild($form);
            }
        }
        $tableBody->appendChild($tr);
    }
    echo $dom->saveHTML();
}
