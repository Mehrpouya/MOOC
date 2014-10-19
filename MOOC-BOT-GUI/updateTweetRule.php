<?php

header('Content-Type: application/json');
if (isset($_POST['who'], $_POST['containsThis'], $_POST['containsThat'], $_POST['thenTweet'])) {
    $ini = parse_ini_file("dbconfig.ini");
    $username = $ini['username'];
    $password = $ini['password'];
    $database = $ini['database'];
    $host = $ini['host'];
    $db = new mysqli($host, $username, $password, $database);
    if ($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    } else {
        // remove tags and whitespace from the beginning and end of form data
        $_POST = array_map("strip_tags", $_POST);
        $_POST = array_map("trim", $_POST);
        $sth = $db->prepare("UPDATE `tweetRules` SET `who`= ? , `ruleName` = ? , `containsThis` = ? , `containsThat` = ? , `notThis` = ? , `thenTweet` = ? , `catName` = ?  where `id`= ? ");
        $sth->bind_param('sssssssi'
                , ($_POST['who'])
                , ($_POST['ruleName'])
                , ($_POST['containsThis'])
                , ($_POST['containsThat'])
                , ($_POST['notThis'])
                , ($_POST['thenTweet'])
                , ($_POST['catName'])
                , ($_POST['ruleId']));
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