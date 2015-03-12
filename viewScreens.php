<?php
require_once 'Screen.php';
require_once 'Connection.php';
require_once 'ScreenTableGateway.php';

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new ScreenTableGateway($connection);

$statement = $gateway->getScreens();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href=css/style.css>
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/screen.js"></script>
        <title></title>
    </head>
    <body>
        <img src ="images/cinema.jpg" alt="Logo">
         <?php require 'toolbar.php' ?>
        <?php 
        if (isset($message)) {
            echo '<p>'.$message.'</p>';
        }
        ?>
        <div id="container">
            <h1><u>Cinema Database</u> </h1>
        <table border="1" width="75%"> 
            <thead>
                <tr>
                    <th>Screen</th>
                    <th>Fire Exits</th>
                    <th>Number of Seats</th>
                    <th>Projector Type</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                while ($row) {
                    
                    
                    echo '<td>' . $row['screenNumber'] . '</td>';
                    echo '<td>' . $row['noOfFireExits'] . '</td>';
                    echo '<td>' . $row['noOfSeats'] . '</td>';
                    echo '<td>' . $row['projectorType'] . '</td>';
                    echo '<td>'
                    . '<a href="viewScreen.php?id='.$row['screenID'].'">View</a> '
                    . '<a href="editScreenForm.php?id='.$row['screenID'].'">Edit</a> '
                    . '<a class="deleteScreen" href="deleteScreen.php?id='.$row['screenID'].'">Delete</a> '
                    . '</td>';
                    echo '</tr>';
                    
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                }
                ?>
            </tbody>
        </table>
        </div>
        <p><a href="createScreenForm.php">Create Screen</a></p>
    </body>
</html>
