<?php

header('Content-Type: application/json');
$ini = parse_ini_file("dbconfig.ini");
$username = $ini['username'];
$password = $ini['password'];
$database = $ini['database'];
$host = $ini['host'];
$db = new mysqli($host, $username, $password, $database);
if (isset($_POST['ruleId'])) {
    $_POST = array_map("strip_tags", $_POST);
    $_POST = array_map("trim", $_POST);

    if ($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    } else {

        $sth = $db->prepare("DELETE FROM `tweetRules` where `id`= ? " );
        $sth->bind_param('i', ($_POST['ruleId']));
        echo "about to run!";
        /*
         * TODO:
         * add better error handling.
         */
        $OK = $sth->execute();
        // return if successful or display error
        if ($OK) {
            $response = "Success";
        } else {
            $response = "Something went wrong.";
        }
        echo $response;
        $sth->close();
    }
}
?>