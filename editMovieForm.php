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
$gateway = new MovieTableGateway($connection);
$movieGateway = new MovieTableGateway($connection);

$movie = $gateway->getMovieById($id);
if ($movies->rowCount() !== 1) {
    die("Illegal request");
}
$movies = $movies->fetch(PDO::FETCH_ASSOC);

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
        <h1>Edit Movie Form</h1>
        <?php
        if (isset($errorMessage)) {
            echo '<p>Error: ' . $errorMessage . '</p>';
        }
        ?>
        <form id="editMovieForm" name="editMovieForm" action="editMovie.php" method="POST">
            <input type="hidden" name="movieID" value="<?php echo $id; ?>" />
            <table border="0">
                <tbody>
                    <tr>
                        <td>Title</td>
                        <td>
                            <input type="text" name="title" value="<?php
                                if (isset($_POST) && isset($_POST['title'])) {
                                    echo $_POST['title'];
                                }
                                else echo $movies['title'];
                            ?>" />
                            <span id="titleError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['title'])) {
                                    echo $errorMessage['title'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Year Of Release</td>
                        <td>
                            <input type="text" name="yearOfRelease" value="<?php
                                if (isset($_POST) && isset($_POST['yearOfRelease'])) {
                                    echo $_POST['yearOfRelease'];
                                }
                                else echo $movies['yearOfRelease'];
                            ?>" />
                            <span id="yearOfReleaseError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['yearOfRelease'])) {
                                    echo $errorMessage['yearOfRelease'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Running Time</td>
                        <td>
                            <input type="text" name="runningTime" value="<?php
                                if (isset($_POST) && isset($_POST['runningTime'])) {
                                    echo $_POST['runningTime'];
                                }
                                else echo $screen['runningTime'];
                            ?>" />
                            <span id="runningTimeError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['runningTime'])) {
                                    echo $errorMessage['runningTime'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Age Classification</td>
                        <td>
                            <input type="text" name="ageClassification" value="<?php
                                if (isset($_POST) && isset($_POST['ageClassification'])) {
                                    echo $_POST['ageClassification'];
                                }
                                else echo $movies['ageClassification'];
                            ?>" />
                            <span id="ageClassificationError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['ageClassification'])) {
                                    echo $errorMessage['ageClassification'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Director</td>
                        <td>
                            <input type="text" name="director" value="<?php
                                if (isset($_POST) && isset($_POST['director'])) {
                                    echo $_POST['director'];
                                }
                                else echo $movies['director'];
                            ?>" />
                            <span id="directorError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['director'])) {
                                    echo $errorMessage['director'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                          <td>Screen</td>
                            <td>
                                <select name="screenID">
                                    <option value="-1">No screen</option>
                                    <?php
                                    $id= $screen->fetch(PDO::FETCH_ASSOC);
                                    while ($id) {
                                        $selected = "";
                                    }
                                        if ($id['id'] == $screen['screenID']) {
                                            $selected = "selected";
                                        echo '<option value="' . $id['id'] . '">' . $id['title'] . '</option>';
                                        $id = $screen->fetch(PDO::FETCH_ASSOC);
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Update Movie" name="updateMovie" />
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
