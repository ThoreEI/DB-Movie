<?php
require_once __DIR__ . '\..\vendor\autoload.php';
require_once "Film.php";

use Twig\Environment;
use Twig\TwigFilter;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader('.');
$twig = new Environment($loader);

$filme = array(
    new \site\Film("The Grudge", "Takashi Shimizu", "2005", "91", "16"),
    new \site\Film("Lucy", "Luc Besson", "2014", "89", "12"),
    new \site\Film("Pulp Fiction", "Quentin Tarantino", "1994", "154", "16"),
    new \site\Film("Inglorious Bastards", "Quentin Tarantino", "2009", "153", "16"),
    new \site\Film("Reservoir Dogs", "Quentin Tarantino", "2005", "99", "18"),
    new \site\Film("Blade Runner", "Ridley Scott", "1982", "117", "16"),
);

$twig->addGlobal('filme', $filme);
echo $twig->render('template/index.html.twig', []);


