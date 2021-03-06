<?php

header('Content-Type: application/json');
$ini = parse_ini_file("dbconfig.ini");
$username = $ini['username'];
$password = $ini['password'];
$database = $ini['database'];
$host = $ini['host'];
$db = new mysqli($host, $username, $password, $database);
//mysql_connect($host, $username, $password);
//@mysql_select_db($database) or die("Unable to select database");
if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
} else {
    $sql = "SELECT * FROM MOOCEDC.tweets limit 3;";
    if (!$result = $db->query($sql)) {
        die('There was an error running the query [' . $db->error . ']');
    }
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
}
?>