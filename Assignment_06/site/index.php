<?php
require_once __DIR__ . '\..\vendor\autoload.php';
require_once "FilmClass.php";

use Twig\Environment;
use Twig\Extension\StringLoaderExtension;
use Twig\TwigFilter;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader('.');
$twig = new Environment($loader);
$twig->addExtension(new StringLoaderExtension());



session_start();

if (isset($_POST["deleteSession"])) {
    deleteSession();
}

if (isset($_SESSION['filme'])) {
    $filme = $_SESSION['filme'];
} else {
    $filme = array(
        new FilmClass("The Grudge", "Takashi Shimizu", "2005", "91", "16"),
        new FilmClass("Lucy", "Luc Besson", "2014", "89", "12"),
        new FilmClass("Pulp Fiction", "Quentin Tarantino", "1994", "154", "16"),
        new FilmClass("Inglorious Bastards", "Quentin Tarantino", "2009", "153", "16"),
        new FilmClass("Reservoir Dogs", "Quentin Tarantino", "2005", "99", "18"),
        new FilmClass("Blade Runner", "Ridley Scott", "1982", "117", "16"),
    );
    $_SESSION['filme'] = $filme;
}

if (isset($_POST["submitEntry"])) {
    addMovie();
}

if (isset($_POST["delete"])) {
    // echo "delete";
    deleteMovie();
}

if (isset($_POST["title"])) {
    sortEntries("title");
}

if (isset($_POST["producer"])) {
    sortEntries("producer");
}

if (isset($_POST["year"])) {
    sortEntries("year");
}

if (isset($_POST["playtime"])) {
    sortEntries("playtime");
}

if (isset($_POST["fsk"])) {
    sortEntries("fsk");
}

function deleteMovie(): void
{
    $filme = $_SESSION['filme'];
    $index = $_GET["delete"];
    unset($filme[$index]);
    // reorganize array
    $filme = array_values($filme);
    $_SESSION['filme'] = $filme;
    header("Location: index.php");
}

function addMovie(): void {
    global $filme;
    $title = $_POST['title'];
    $producer = $_POST['producer'];
    $year = $_POST['year'];
    $playtime = $_POST['playtime'];
    $fsk = $_POST['fsk'];
    $newMovie = new FilmClass($title, $producer, $year, $playtime, $fsk);
    $filme[] = $newMovie;
    $_SESSION['filme'] = $filme;
}

function deleteSession(): void {
    unset($_SESSION['filme']);
    session_destroy();
}

function sortEntries($sort): void
{
    $filme = $_SESSION['filme'];
    if ($sort == "title") {
        usort($filme, function ($a, $b) {
            return strcmp(strtolower($a->title), strtolower($b->title));
        });
    } elseif ($sort == "producer") {
        usort($filme, function ($a, $b) {
            return strcmp(strtolower($a->producer), strtolower($b->producer));
        });
    } elseif ($sort == "year") {
        usort($filme, function ($a, $b) {
            return $a->year <=> $b->year;
        });
    } elseif ($sort == "playtime") {
        usort($filme, function ($a, $b) {
            return $a->playtime <=> $b->playtime;
        });
    } elseif ($sort == "fsk") {
        usort($filme, function ($a, $b) {
            return strcmp(strtolower($a->fsk), strtolower($b->fsk));
        });
    }
    $_SESSION['filme'] = $filme;
    header("Location: index.php");
}

$twig->addGlobal('filme', $filme);
echo $twig->render('template/index.html.twig', []);


