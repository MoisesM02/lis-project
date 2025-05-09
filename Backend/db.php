<?php
$host = 'db';
$user = 'moisesm';
$password = 'Mdvlinux23';
$database = 'test';

// Optional: retry loop
$retries = 5;
while ($retries > 0) {
    $connection = @mysqli_connect($host, $user, $password, $database);
    if ($connection) {
        break;
    }
    echo "Waiting for MySQL to be ready...\n";
    sleep(3);
    $retries--;
}

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
