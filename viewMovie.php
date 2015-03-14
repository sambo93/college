<?php
require_once 'Connection.php';
require_once 'movieTableGateway.php';
require_once 'ScreenTableGateway.php';
$sessionId = session_id();
if ($sessionId == "") {
    session_start();
}
require 'ensureUserLoggedIn.php';
if (!isset($_GET) || !isset($_GET['id'])) {
    die('Invalid request');
}
$id = $_GET['id'];
$connection = Connection::getInstance();
$movieGateway = new MovieTableGateway($connection);
$screenGateway = new ScreenTableGateway($connection);
$movies = $movieGateway->getMovieById($id);
$screens = $screenGateway->getScreenByMovieId($id);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/movie.js"></script>
        <?php require "styles.php" ?>
        <title></title>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'mainMenu.php' ?>
        <div class="container">
            <h2>View Movie Details</h2>
            <?php
            if (isset($message)) {
                echo '<p>'.$message.'</p>';
            }
            ?>
            <table class="table">
                <tbody>
                    <?php
                    $movie = $movies->fetch(PDO::FETCH_ASSOC);
                    echo '<tr>';
                    echo '<td>title</td>'
                    . '<td>' . $movie['title'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>yearofRelease</td>'
                    . '<td>' . $movie['yearOfRelease'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>ageClassification</td>'
                    . '<td>' . $movie['ageClassification'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>director</td>'
                    . '<td>' . $movie['director'] . '</td>';
                    echo '</tr>';
                    ?>
                </tbody>
            </table>
            <p>
                <a href="editMovieForm.php?id=<?php echo $movie['id']; ?>">
                    Edit Manager</a>
                <a class="deleteManager" href="deleteMovie.php?id=<?php echo $movie['id']; ?>">
                    Delete Manager</a>
            </p>
            <h3>Screens Assigned to <?php echo $movie['title']; ?></h3>
            <?php if ($screens->rowCount() !== 0) { ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Screen Number</th>
                            <th>Fire Exits</th>
                            <th>Seats</th>
                            <th>Projector Type</th>
                            <th>Movie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $row = $screens->fetch(PDO::FETCH_ASSOC);
                        while ($row) {
                            echo '<tr>';
                            echo '<td>' . $row['screenNumber'] . '</td>';
                            echo '<td>' . $row['noOfFireExits'] . '</td>';
                            echo '<td>' . $row['noOfSeats'] . '</td>';
                            echo '<td>' . $row['projectorType'] . '</td>';
                            echo '<td>'
                            . '<a href="viewScreen.php?id='.$row['id'].'">View</a> '
                            . '<a href="editScreenForm.php?id='.$row['id'].'">Edit</a> '
                            . '<a class="deleteScreen" href="deleteScreen.php?id='.$row['id'].'">Delete</a> '
                            . '</td>';
                            echo '</tr>';
                            $row = $screens->fetch(PDO::FETCH_ASSOC);
                        }
                        ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>There are no screens assigned to this movie.</p>
            <?php } ?>
        </div>
        <?php require 'footer.php'; ?>
        <?php require 'scripts.php'; ?>
    </body>
</html>