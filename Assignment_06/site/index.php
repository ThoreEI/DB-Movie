<?php
require_once __DIR__ . '\..\vendor\autoload.php';

use Twig\Environment;
use Twig\TwigFilter;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader('.');
$twig = new Environment($loader);
$filme = array("123", "456", "789");
echo $twig->render('template/index.html.twig', [ 'a_variable' => "asd" ]);