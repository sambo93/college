<?php
//Accesses the table and database so that information can be altered, updated, viewed and deleted.
class ScreenTableGateway {
 
    private $connection;
    
    public function __construct($c) {
        $this->connection = $c;
        
    }
    
    public function getScreens() {
        //executes query to get screens
        //"SELECT p.*, m.name AS managerName
               //  FROM programmers p
               //  LEFT JOIN managers m ON m.id = p.manager_id";
        $sqlQuery = "SELECT * FROM screen";
        
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();
        
        if (!$status) {
            die("Unable to retrieve screens");
        }
        
        return $statement;
        
    }
    
    /*public function getScreenByMovieId($moviesID) {
        // execute a query to get all screens
        $sqlQuery =
                "SELECT s.*, m.title AS movieID
                 FROM screen s
                 LEFT JOIN movies m ON m.id = s.movieID
                 WHERE s.movieID = :movieID";
        $params = array(
            'movieID' => $movieID
        );
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute($params);
        if (!$status) {
            die("Could not retrieve screens");
        }
        return $statement;
    }*/
    
     public function getScreenById($screenID) {
        // execute a query to get the user with the specified id
        $sqlQuery = "SELECT * FROM screen WHERE screenID = :screenID";
       /* $sqlQuery =
                "SELECT s.*, m.title AS movieID
                 FROM screen s
                 LEFT JOIN movies m ON m.id = s.movieID
                 WHERE s.id = :id";*/
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "screenID" => $screenID
        );
        
        $status = $statement->execute($params);
        
        if (!$status) {
            die("Could not retrieve screen");
        }
        
        return $statement;
    }
    
    public function insertScreen($s, $f, $se, $pr) {
        $sqlQuery = "INSERT INTO screen " .
                "(screenNumber, noOfFireExits, noOfSeats, projectorType) " .
                "VALUES (:screenNumber, :noOfFireExits, :noOfSeats, :projectorType)";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "screenNumber" => $s,
            "noOfFireExits" => $f,
            "noOfSeats" => $se,
            "projectorType" => $pr
        );
        
        $status = $statement->execute($params);
        
        if (!$status) {
            die("Unable to insert screen");
        }
        
       $id = $this->connection->lastInsertId();

        return $id;
    }
    
     public function deleteScreen($id) {
        $sqlQuery = "DELETE FROM screen WHERE screenID = :screenID";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "screenID" => $id
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete screen");
        }

        return ($statement->rowCount() == 1);
    }
    
    public function updateScreen($id, $s, $f, $se, $pr, $mId) {
        $sqlQuery =
                "UPDATE screen SET " .
                "screenNumber = :screenNumber, " .
                "noOfFireExits = :noOfFireExits, " .
                "noOfSeats = :noOfSeats, " .
                "projectorType = :projectorType " .
                "WHERE screenID = :screenID";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "screenID" => $id,
            "screenNumber" => $s,
            "noOfFireExits" => $f,
            "noOfSeats" => $se,
            "projectorType" => $pr
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
