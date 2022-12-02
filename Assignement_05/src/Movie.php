<?php
require "Film.php";
$entries = array(
    new Film("The Grudge", "Takashi Shimizu", "2005", "91", "16"),
    new Film("Lucy", "Luc Besson", "2014", "89", "12"),
    new Film("Pulp Fiction", "Quentin Tarantino", "1994", "154", "16"),
    new Film("Inglorious Bastards", "Quentin Tarantino", "2009", "153", "16"),
    new Film("Reservoir Dogs", "Quentin Tarantino", "2005", "99", "18"),
    new Film("Blade Runner", "Ridley Scott", "1982", "117", "16"),
);


if (isset($_SESSION['entries'])) {
    session_start();
    $entries = $_SESSION['entries'];
}

if (isset($_POST["submitEntry"])) {
    addMovie();
    init();
}

if (isset($_POST["delSession"])) {
    $_COOKIE = array();
}

if (isset($_POST["delete"])) {
    deleteRow();
    init();
}



function addMovie()
{
    global $entries;
    $title = $_POST['title'];
    $producer = $_POST['producer'];
    $year = $_POST['year'];
    $playtime = $_POST['playtime'];
    $fsk = $_POST['fsk'];
    $newMovie = new Film($title, $producer, $year, $playtime, $fsk);

    array_push($entries, $newMovie);
    $_SESSION['entries'] = $entries;
}

function deleteRow()
{
    global $entries;
    // get the index of the row to delete
    $index = $_POST['value'];
    // remove the row from the array
    array_splice($entries, $index, 1);
    // update the session variable
    $_SESSION['entries'] = $entries;
}

function init()
{
    global $entries;

    $dom = new DOMDocument();
    $dom->loadHTMLFile("../site/template.html");
    $table = $dom->getElementById("movie-table");
    $tbody = $dom->getElementById("tbody");

    foreach ($entries as $entry => $val) {
        $tr = $dom->createElement("tr");
        foreach ($val as $key => $value) {
            $num = $dom->createElement("td", $entry);

            if ($key == "title") {
                $tr->appendChild($num);
            }

            $td = $dom->createElement("td");
            $td->nodeValue = $value;
            $tr->appendChild($td);
            if ($key == "fsk"){

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
        $tbody->appendChild($tr);
    }
    echo $dom->saveHTML();
}

function addCloseButton()
{
    $closeButton = DOMDocument::createElement("button");
    $closeButton->setAttribute("id", "close");
    $closeButton->addEventListener("click", function () use ($closeButton) {
        $closeButton->parentNode->remove();
    });
    $closeButton->nodeValue = "Close";
    DOMDocument::appendChild($closeButton);
}






