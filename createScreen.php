<?php
require_once 'Screen.php';
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
$screenNumber = $_POST['screenNumber'];
$noOfFireExits = $_POST['noOfFireExits'];
$noOfSeats= $_POST['noOfSeats'];
$projectorType = $_POST['projectorType'];

$id = $gateway->insertScreen($screenNumber, $noOfFireExits, $noOfSeats, $projectorType);

header('Location: viewScreens.php');