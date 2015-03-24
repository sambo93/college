<?php
require_once 'Connection.php';
require_once 'movieTableGateway.php';
require 'ensureUserLoggedIn.php';
$connection = Connection::getInstance();
$movieGateway = new MovieTableGateway($connection);
$movies = $movieGateway->getMovies();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/screen.js"></script>
        //<?php require "styles.php" ?>
        <title></title>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'mainMenu.php' ?>
        <div class="container">
            <h2>View Movies</h2>
            <?php
            if (isset($message)) {
                echo '<p>'.$message.'</p>';
            }
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Year Of Release</th>
                        <th>Age Classification</th>
                        <th>Director</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row = $movies->fetch(PDO::FETCH_ASSOC);
                    while ($row) {
                        echo '<td>' . $row['title'] . '</td>';
                        echo '<td>' . $row['yearOfRelease'] . '</td>';
                        echo '<td>' . $row['ageClassification'] . '</td>';
                        echo '<td>' . $row['director'] . '</td>';
                        echo '<td>'
                        . '<a href="viewMovie.php?id='.$row['id'].'">View</a> '
                        . '<a href="editMovieForm.php?id='.$row['id'].'">Edit</a> '
                        . '<a class="deleteMovie" href="deleteMovie.php?id='.$row['id'].'">Delete</a> '
                        . '</td>';
                        echo '</tr>';
                        $row = $movies->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                </tbody>
            </table>
            <p><a href="createMovieForm.php">Create Movie</a></p>
        </div>
        <?php require 'footer.php'; ?>
        <?php require 'scripts.php'; ?>
    </body>
</html>