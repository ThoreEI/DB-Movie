- Twig einbinden
   Erstellen Sie eine composer.json-Datei im src-Ordner.
   {
    "require": {
      "twig/twig": "^3.0",
      "ext-pdo": "*",
      "ext-sqlite3": "*"
    }
  }

- Download: https://getcomposer.org/download/ (composer.phar)

- Im Verzeichnis in dem die composer.json liegt, folgt: 'php composer.phar install'
    Es entsteht ein neues Verzeichnis namens vendor.

- An Anfang des PHP-Skriptes muss folgendes eingebunden werden:
    require_once __DIR__ . '/vendor/autoload.php';
    use Twig\Environment;
    use Twig\TwigFilter;
    use Twig\Loader\FilesystemLoader;

- Das Rendern der Filme mit Hilfe von Twig klappt jetzt:
    $twig = new Environment(new FilesystemLoader('../src/'));
    $twig->addExtension(new StringLoaderExtension());
    try { echo $twig->render('index.html.twig', ['movies' => $movies]);

- Clonen Sie das Repo und starten einen Webserver (z.B. php -S localhost:8080). 
    Die Webanwendung sollte bedienbar sein.
