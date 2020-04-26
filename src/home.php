<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: login.php');
}
?>
<h1>Member area</h1>

<p>Hello <? echo $_SESSION['username']; ?>!</p>
<p><a href="logout.php">Logout</a></p>