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

- Im Verzeichnis von composer.json: 'php composer.phar install'
    Es entsteht ein neues Verzeichnis namens vendor.

- Repo klonen und Webserver starten (z.B. php -S localhost:8080).
