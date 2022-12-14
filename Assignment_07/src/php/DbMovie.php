<?php
namespace php;
use PDO;

class DbMovie {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = new PDO("sqlite:" . __DIR__ . DIRECTORY_SEPARATOR . "movies.db");
        $this->create_table();
        $entries = $this->pdo->query("SELECT * FROM t_movies")->fetchAll();
        if (sizeof($entries) == 0)
            $this->insert_default_movies();
    }

    public function create_table() {
        $this->pdo->prepare(
            "CREATE TABLE IF NOT EXISTS t_movies (
                                     movieID INTEGER  PRIMARY KEY AUTOINCREMENT,
                                    title VARCHAR(150) NOT NULL, 
                                    director VARCHAR(150) NOT NULL,
                                    'year' YEAR NOT NULL,
                                    playtime INTEGER NOT NULL,
                                    fsk INTEGER NOT NULL);"
        )->execute();
    }

    public function insert_record(string $title, string $director, int $year, int $playtime, int $fsk) {
        $statement = $this->pdo->prepare(
            "INSERT INTO t_movies (title, director, 'year', playtime, fsk)
                   VALUES (:title, :director, :year, :playtime, :fsk);");
        $statement->bindParam(":title", $title);
        $statement->bindParam(":director", $director);
        $statement->bindParam(":year", $year);
        $statement->bindParam(":playtime", $playtime);
        $statement->bindParam(":fsk", $fsk);
        $statement->execute();
    }

    public function insert_default_movies() {
        $movies = [
            new Movie("The Grudge", "Takashi Shimizu", "2005", "91", "16"),
            new Movie("Lucy", "Luc Besson", "2014", "89", "12"),
            new Movie("Pulp Fiction", "Quentin Tarantino", "1994", "154", "16"),
            new Movie("Inglorious Bastards", "Quentin Tarantino", "2009", "153", "16"),
            new Movie("Reservoir Dogs", "Quentin Tarantino", "2005", "99", "18"),
            new Movie("Blade Runner", "Ridley Scott", "1982", "117", "16")
        ];
        foreach ($movies as $movie)
            $this->insert_record($movie->title, $movie->director, $movie->year, $movie->playtime, $movie->fsk);
    }

    public function load_movies($sort_criterion) {
        if (!in_array($sort_criterion, ["title", "director", "year", "playtime", "fsk"]))
            $sort_criterion = "title";
        return $this->pdo->query("SELECT * FROM t_movies ORDER BY $sort_criterion")->fetchAll();
    }

    public function delete_movie(string $movieID) {
        $statement = $this->pdo->prepare("DELETE FROM t_movies WHERE movieID = :movieID");
        $statement->bindParam(":movieID", $movieID);
        $statement->execute();
    }
}