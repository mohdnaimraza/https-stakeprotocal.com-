<?php 
$servername = "localhost";
$dbname = 'dex';
$username = 'stakeprotocal';
$password = 'Admin.w/v.21@';
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

/************************************************************************/
/****************** default functions for utility ***********************/
/************************************************************************/

//function to check all the user inputs to prevent SQL injection
function secureInput($string) {
    $string = trim($string);
    $string = stripcslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}
?>