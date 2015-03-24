<?php
//require_once 'Screen.php';
require_once 'Connection.php';
require_once 'MovieTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new MovieTableGateway($connection);

//$name = $_POST['screenID'];

//$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
//$emailValid = filter_var($email, FILTER_VALIDATE_EMAIL);

//$email = $_POST['email'];
$title  = filter_input(INPUT_POST, 'title',      FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$yearOfRelease = filter_input(INPUT_POST, 'yearOfRelease',      FILTER_SANITIZE_NUMBER_INT);
$runningTime = filter_input(INPUT_POST, 'runningTime',      FILTER_SANITIZE_NUMBER_INT);
$ageClassification = filter_input(INPUT_POST, 'ageClassification',      FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$director = filter_input(INPUT_POST, 'director',      FILTER_SANITIZE_FULL_SPECIAL_CHARS);


$mId = $gateway->insertMovie($title, $yearOfRelease, $runningTime, $ageClassification, $director);

header('Location: viewMovies.php');