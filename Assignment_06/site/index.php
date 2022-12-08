<?php
require_once "Movie.php";
require_once "vendor/autoload.php";
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\StringLoaderExtension;
ini_set('display_errors', 1);
$loader = new FilesystemLoader('.');
$twig = new Environment($loader);
$twig->addExtension(new StringLoaderExtension());

session_start();
if (isset($_REQUEST["reset_session"]))
    session_unset();

$movies = $_SESSION["movies"] ?? [
        new Movie("The Grudge", "Takashi Shimizu", "2005", "91", "16"),
        new Movie("Lucy", "Luc Besson", "2014", "89", "12"),
        new Movie("Pulp Fiction", "Quentin Tarantino", "1994", "154", "16"),
        new Movie("Inglorious Bastards", "Quentin Tarantino", "2009", "153", "16"),
        new Movie("Reservoir Dogs", "Quentin Tarantino", "2005", "99", "18"),
        new Movie("Blade Runner", "Ridley Scott", "1982", "117", "16") ];
$_SESSION["movies"] = $movies;

if (isset($_REQUEST["delete_movie"])) {
    $index = $_REQUEST["delete_movie"];
    array_splice($movies, $index, 1);
    $_SESSION["movies"] = $movies;
}

if (isset($_REQUEST["add_movie"])) {
    $movies[] = new Movie(
        $_REQUEST["title"],
        $_REQUEST["producer"],
        $_REQUEST["year"],
        $_REQUEST["playtime"],
        $_REQUEST["fsk"]);
    $_SESSION["movies"] = $movies;
}

$sort_criterion = $_REQUEST["sort_criterion"] ?? "title";
$_SESSION["sort_criterion"] = $sort_criterion;
uasort($movies, 'compare_movies');

function compare_movies($movie1, $movie2): int {
    if ($movie1->equals($movie2))
        return 0;
    global $sort_criterion;
    $valid_values = ["title", "producer", "year", "playtime", "fsk"];
    if (!in_array($sort_criterion, $valid_values))
        throw new InvalidArgumentException("Illegal argument: Sort criterion=" . $sort_criterion);
    return $movie1->$sort_criterion > $movie2->$sort_criterion ? 1 : -1;
}

$twig->addGlobal('movies', $movies);
try {
    echo $twig->render('index.html.twig', ['movies' => $movies]);
} catch (LoaderError|RuntimeError|SyntaxError $e) {
    http_response_code(500);
}