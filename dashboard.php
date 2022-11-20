<!DOCTYPE html>
<html>
<?php include 'templates/head.php';?>
<body>

<?php
include 'templates/sidenav.php';
include 'templates/nav.php';
session_start();

// define variables and set to empty values
$userErr = $passErr = "";
$username = $password = "";
$errCount = 0;

if (isset($_SESSION['uname'])) 
{

    echo "<h1> Welcome ".$_SESSION['uname']."</h1>";

    include 'templates/nav2.php';
} 
else
{
    header('Location: Login.php');
}

?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><hr>
</body>
<?php include 'templates/footer.php';?>
</html>