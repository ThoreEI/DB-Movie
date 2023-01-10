- Twig einbinden
  Kopieren Sie Ihre vorhergehende Version der Filmdatenbank und binden Sie Twig ein, indem Sie eine entsprechende       composer.json-Datei schreiben und composer ausführen.

{
    "require": {
        "twig/twig": "^3.0"
    }
}

Laden Sie composer herunter und führen Sie dann folgendes Kommando im Verzeichnis aus, in dem auch die Datei composer.json liegt:

- php composer.phar install

- Es entsteht ein neues Verzeichnis namens vendor.

- An Anfang des PHP-Skriptes muss folgendes eingebunden werden:
  require_once __DIR__ . '/vendor/autoload.php';
  use Twig\Environment;
  use Twig\TwigFilter;
  use Twig\Loader\FilesystemLoader;

- Rendern der Filme mit Hilfe von Twig:
  $twig = new Environment(new FilesystemLoader('../src/'));
  $twig->addExtension(new StringLoaderExtension());
  try { echo $twig->render('index.html.twig', ['movies' => $movies]);

- Clonen Sie das Repo und starten einen Webserver (z.B. php -S localhost:8080). 
  Die Webanwendung sollte bedienbar sein.
