<?php
require_once 'Screen.php';
require_once 'Connection.php';
require_once 'ScreenTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset($_GET) || !isset($_GET['id'])) {
    die('Invalid request');
}
$id = $_GET['id'];

$connection = Connection::getInstance();
$gateway = new ScreenTableGateway($connection);

$statement = $gateway->getScreenById($id);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/screen.js"></script>
        <link rel="stylesheet" type="text/css" href=css/style.css>
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <title></title>
    </head>
    <body>
        <?php require "toolbar.php" ?>
        <?php require "header.php" ?>
        <?php require "mainMenu.php" ?>
        <div id ="container">
        <?php require 'toolbar.php' ?>
        <?php 
        if (isset($message)) {
            echo '<p>'.$message.'</p>';
        }
        ?>
        <table>
            <tbody>
                <?php
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                    echo '<tr>';
                    echo '<td>Screen Number</td>'
                    . '<td>' . $row['screenNumber'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Fire Exits</td>'
                    . '<td>' . $row['noOfFireExits'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Seats</td>'
                    . '<td>' . $row['noOfSeats'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Projector Type</td>'
                    . '<td>' . $row['projectorType'] . '</td>';
                    echo '</tr>';
                ?>
            </tbody>
        </table>
        <p>
            <a href="editScreenForm.php?id=<?php echo $row['screenID']; ?>">
                Edit Screen</a>
            <a class="deleteScreen" href="deleteScreen.php?id=<?php echo $row['screenID'];   ?>">
                Delete Screen</a>
        </p>
        </div>
        <?php require "footer.php" ?>
        <?php require "scripts.php" ?> 
    </body>
</html>
