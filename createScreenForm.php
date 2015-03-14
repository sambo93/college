<?php
require_once 'Connection.php';
require_once 'movieTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$conn = Connection::getInstance();
$movieGateway = new MovieTableGateway($conn);

$movies = $movieGateway->getMovies();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href=css/style.css>
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/screen.js"></script>
    </head>
    <body>
        <?php require "toolbar.php" ?>
        <?php require "header.php" ?>
        <?php require "mainMenu.php" ?>
        <div id="container">
        <?php require 'toolbar.php' ?>
        <h1>Create Screen Information Form</h1>
        <?php
        if (isset($errorMessage)) {
            echo '<p>Error: ' . $errorMessage . '</p>';
        }
        ?>
        <form id="createScreenForm"
              name="createScreenForm"
              action="createScreen.php" 
              method="POST">
            <table border="0">
                <tbody>
                    <tr>
                        <td>Screen Number</td>
                        <td>
                            <input type="text" name="screenNumber" value="" />
                            <span id="screenNumberError" class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Fire Exits</td>
                        <td>
                            <input type="text" name="noOfFireExits" value="" />
                            <span id="fireExitsError" class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Number of Seats</td>
                        <td>
                            <input type="text" name="noOfSeats" value="" />
                            <span id="seatsError" class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Projector Type (35mm, 70mm)</td>
                        <td>
                            <input type="text" name="projectorType" value="" />
                            <span id="projectorError" class="error"></span>
                        </td>
                    </tr>
                    <tr>
                            <td>Movie</td>
                            <td>
                                <select name="movieID">
                                    <option value="-1">No manager</option>
                                    <?php
                                    $m = $movies->fetch(PDO::FETCH_ASSOC);
                                    while ($m) {
                                        echo '<option value="' . $m['id'] . '">' . $m['title'] . '</option>';
                                        $m = $movies->fetch(PDO::FETCH_ASSOC);
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Create Screen" name="createScreen" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
        </div>
        <?php require "footer.php" ?>
        <?php require "scripts.php" ?>
    </body>
</html>
