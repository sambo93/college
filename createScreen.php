<?php
//require_once 'Screen.php';
require_once 'Connection.php';
require_once 'ScreenTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new ScreenTableGateway($connection);

//$name = $_POST['screenID'];

//$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
//$emailValid = filter_var($email, FILTER_VALIDATE_EMAIL);

//$email = $_POST['email'];
$screenNumber  = filter_input(INPUT_POST, 'screenNumber',      FILTER_SANITIZE_NUMBER_INT);
$noOfFireExits = filter_input(INPUT_POST, 'noOfFireExits',      FILTER_SANITIZE_NUMBER_INT);
$noOfSeats = filter_input(INPUT_POST, 'noOfSeats',      FILTER_SANITIZE_NUMBER_INT);
$projectorType = filter_input(INPUT_POST, 'projectorType',      FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$movieID = filter_input(INPUT_POST, 'movieID',      FILTER_SANITIZE_NUMBER_INT);
if ($movieID == -1) {
    $movieID = NULL;
}

$id = $gateway->insertScreen($screenNumber, $noOfFireExits, $noOfSeats, $projectorType);

header('Location: viewScreens.php');