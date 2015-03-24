<?php
require_once 'Connection.php';
require_once 'ScreenTableGateway.php';
require_once 'MovieTableGateway.php';

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
$movieGateway = new MovieTableGateway($connection);

$screens = $gateway->getScreenById($id);
if ($screens->rowCount() !== 1) {
    die("Illegal request");
}
$screen = $screens->fetch(PDO::FETCH_ASSOC);

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
        <h1>Edit Screen Form</h1>
        <?php
        if (isset($errorMessage)) {
            echo '<p>Error: ' . $errorMessage . '</p>';
        }
        ?>
        <form id="editScreenForm" name="editScreenForm" action="editScreen.php" method="POST">
            <input type="hidden" name="screenID" value="<?php echo $id; ?>" />
            <table border="0">
                <tbody>
                    <tr>
                        <td>Screen Number</td>
                        <td>
                            <input type="text" name="screenNumber" value="<?php
                                if (isset($_POST) && isset($_POST['screenNumber'])) {
                                    echo $_POST['screenNumber'];
                                }
                                else echo $screen['screenNumber'];
                            ?>" />
                            <span id="screenNumberError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['screenNumber'])) {
                                    echo $errorMessage['screenNumber'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Fire Exits</td>
                        <td>
                            <input type="text" name="noOfFireExits" value="<?php
                                if (isset($_POST) && isset($_POST['noOfFireExits'])) {
                                    echo $_POST['noOfFireExits'];
                                }
                                else echo $screen['noOfFireExits'];
                            ?>" />
                            <span id="fireExitsError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['noOfFireExits'])) {
                                    echo $errorMessage['noOfFireExits'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Seats</td>
                        <td>
                            <input type="text" name="noOfSeats" value="<?php
                                if (isset($_POST) && isset($_POST['noOfSeats'])) {
                                    echo $_POST['noOfSeats'];
                                }
                                else echo $screen['noOfSeats'];
                            ?>" />
                            <span id="seatsError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['noOfSeats'])) {
                                    echo $errorMessage['noOfSeats'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Projector Type</td>
                        <td>
                            <input type="text" name="projectorType" value="<?php
                                if (isset($_POST) && isset($_POST['projectorType'])) {
                                    echo $_POST['projectorType'];
                                }
                                else echo $screen['projectorType'];
                            ?>" />
                            <span id="projectorTypeError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['projectorType'])) {
                                    echo $errorMessage['projectorType'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Update Screen" name="updateScreen" />
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
