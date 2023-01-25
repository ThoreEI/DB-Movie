<?php
namespace php;
use Movie;
use PDO;
class DatabaseAbstractionLayer {
    private static PDO $pdo;

    public function __construct() {
        self::$pdo = new PDO("sqlite:".join(DIRECTORY_SEPARATOR,[__DIR__,"..","database","movies.db"]));
        self::create_table();
        if (empty(self::load_movies()))
            $this->insert_default_movies();
    }

    public static function create_table(): void {
        self::$pdo->exec("CREATE TABLE IF NOT EXISTS t_movies (
                                    movieID INTEGER PRIMARY KEY AUTOINCREMENT,
                                    title VARCHAR(150) NOT NULL, 
                                    director VARCHAR(150) NOT NULL,
                                    'year' YEAR NOT NULL,
                                    playtime INTEGER NOT NULL,
                                    fsk INTEGER NOT NULL);");
    }

    public static function load_movies($sort_criterion = "title", $order="asc"): bool|array {
        $sort_criterion = in_array($sort_criterion, ["director", "year", "playtime", "fsk"]) ? $sort_criterion : "title";
        $order = $order == "asc" ?  "ASC" : "DESC";
        return self::$pdo->query("SELECT * FROM t_movies ORDER BY $sort_criterion $order")->fetchAll();
    }

    public static function insert_default_movies(): void {
        $movies = [
            new Movie("The Grudge", "Takashi Shimizu", "2005", "91", "16"),
            new Movie("Lucy", "Luc Besson", "2014", "89", "12"),
            new Movie("Pulp Fiction", "Quentin Tarantino", "1994", "154", "16"),
            new Movie("Inglorious Bastards", "Quentin Tarantino", "2009", "153", "16"),
            new Movie("Reservoir Dogs", "Quentin Tarantino", "2005", "99", "18"),
            new Movie("Blade Runner", "Ridley Scott", "1982", "117", "16")
        ];
        foreach ($movies as $movie)
            self::insert_record($movie->title, $movie->director, $movie->year, $movie->playtime, $movie->fsk);
    }

    public static function insert_record(string $title, string $director, int $year, int $playtime, int $fsk): void {
        self::$pdo->prepare("INSERT INTO t_movies (title, director, 'year', playtime, fsk) VALUES (:title,:director,:year,:playtime,:fsk);")->execute(["title"=>$title,"director"=>$director,"year"=>$year,"playtime"=>$playtime,"fsk"=>$fsk]);
    }

    public static function delete_movie(string $movieID): void {
        self::$pdo->prepare("DELETE FROM t_movies WHERE movieID = :movieID;")->execute([":movieID"=>$movieID]);
    }

    public static function delete_table(): void {
        self::$pdo->exec("DROP TABLE t_movies;");
    }
}