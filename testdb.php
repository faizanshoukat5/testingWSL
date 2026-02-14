<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'testing_wsl';
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    echo "Connect failed: " . mysqli_connect_error();
    exit(1);
}
echo "Connected to $db OK";
mysqli_close($conn);

?>
