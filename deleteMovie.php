<?php
//require_once 'Screen.php';
require_once 'Connection.php';
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

$gateway->deleteScreen($id);

header("Location: viewMovies.php");
?>
