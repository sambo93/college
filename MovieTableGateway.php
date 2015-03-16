<?php
//Accesses the table and database so that information can be altered, updated, viewed and deleted.
class MovieTableGateway {
 
    private $connection;
    
    public function __construct($c) {
        $this->connection = $c;
        
    }
    
    public function getMovies() {
        //executes query to get movies
        $sqlQuery = "SELECT * FROM movies";
        
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();
        
        if (!$status) {
            die("Unable to retrieve movies");
        }
        
        return $statement;
        
    }
    
     public function getMovieById($movieID) {
        // execute a query to get the movie with the specified id
        $sqlQuery = "SELECT * FROM movies WHERE movieID = :movieID";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "movieID" => $movieID
        );
        
        $status = $statement->execute($params);
        
        if (!$status) {
            die("Could not retrieve movie");
        }
        
        return $statement;
    }
    
    public function insertMovie($t, $yr, $rt, $ac, $d) {
        $sqlQuery = "INSERT INTO movies " .
                "(title, yearOfRelease, runningTime, ageClassification, director) " .
                "VALUES (:title, :yearOfRelease, :runningTime, :ageClassification, :director)";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "title" => $t,
            "yearOfRelease" => $yr,
            "runningTime" => $rt,
            "ageClassification" => $ac,
            "director" => $d
        );
        
        $status = $statement->execute($params);
        
        if (!$status) {
            die("Unable to insert movie");
        }
        
       $id = $this->connection->lastInsertId();

        return $id;
    }
    
     public function deleteMovie($id) {
        $sqlQuery = "DELETE FROM movies WHERE movieID = :movieID";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "movieID" => $id
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete movie");
        }

        return ($statement->rowCount() == 1);
    }
    
    public function updateMovie($id, $s, $f, $se, $pr) {
        $sqlQuery =
                "UPDATE movies SET " .
                "title = :title, " .
                "yearOfRelease = :yearOfRelease, " .
                "runningTime = :runningTime, " .
                "ageClassification = :ageClassification " .
                "director = :director " .
                "WHERE movieID = :movieID";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "movieID" => $id,
            "title" => $t,
            "yearOfRelease" => $yr,
            "runningTime" => $rt,
            "ageClassification" => $ac,
            "director" => $d,
        );
        
        /*echo '<pre>';
        print_r($_POST);
        print_r($params);
        print_r($sqlQuery);
        echo '</pre>';*/

        $status = $statement->execute($params);

        return ($statement->rowCount() == 1);
    
    
    }
    
   
}
