<?php
$MySession_id = session_id();
if ($MySession_id == "") {
    session_start();
}

if (isset($_SESSION['username'])) {
    echo '<br><p class="toolbar"><a href="home.php">Home</a></p>';
    echo '<p class="toolbar"><a href="logout.php">Logout</a></p><br>';
}
else {
     echo '<br><p class="toolbar"<a href="index.php">Home</a></p>';
     echo '<p class="toolbar"><a href="login.php">Login</a></p><br>';
}
?>