<?php
//Establishes the connection to the server host Daneel and the database which holds the tables
class Connection {
    
    private static $connection = NULL;
    
    public static function getInstance() {
        if (Connection::$connection === NULL) {
            
            //$host = "daneel";
            //$database = "N00132599";
            //$username = "N00132599";
            //$password = "N00132599";
            $host = "localhost";
            $database = "n00132599";
            $username = "root";
            $password = "";
            
            $dsn ="mysql:host=" . $host . ";dbname=" . $database;
            Connection::$connection = new PDO($dsn, $username, $password);
            if (!Connection::$connection) {
                die("Could not connect to database");
                    
        }
    }
    
    return Connection::$connection;
    
    }
}
