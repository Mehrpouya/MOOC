<?php

header('Content-Type: application/json');
$ini = parse_ini_file("dbconfig.ini");
$username = $ini['username'];
$password = $ini['password'];
$database = $ini['database'];
$host = $ini['host'];
$db = new mysqli($host, $username, $password, $database);
if (isset($_POST['who']) && isset($_POST['containsThis']) && isset($_POST['containsThat']) && isset($_POST['thenTweet'])) {
    $_POST = array_map("strip_tags", $_POST);
    $_POST = array_map("trim", $_POST);

    if ($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    } else {

        $sth = $db->prepare("INSERT INTO `tweetRules` (`who`,`ruleName`, `containsThis`, `containsThat`,`notThis`, `thenTweet`,`catName`) VALUES (?,?,?,?,?,?,?) ");
        $sth->bind_param('sssssss'
                , ($_POST['who'])
                , ($_POST['ruleName'])
                , ($_POST['containsThis'])
                , ($_POST['containsThat'])
                , ($_POST['notThis'])
                , ($_POST['thenTweet'])
                , ($_POST['catName']));
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

//$sql = "INSERT INTO `tweetRules` (`who`,`ruleName`, `containsThis`, `containsThat`,`notThis`, `thenTweet`,`catName`) VALUES ('" .
//        mysql_real_escape_string($_POST['who']) . "', '" .
//        mysql_real_escape_string($_POST['ruleName']) . "', '" .
//        mysql_real_escape_string($_POST['containsThis']) . "', '" .
//        mysql_real_escape_string($_POST['containsThat']) . "', '" .
//        mysql_real_escape_string($_POST['notThis']) . "', '" .
//        mysql_real_escape_string($_POST['thenTweet']) . "', '" .
//        mysql_real_escape_string($_POST['catName']) . "')";
//// Performs the $sql query on the server to insert the values
//if (mysql_query($sql) === TRUE) {
//    echo'users entry saved successfully';
//} else {
//    echo'Error: ' . mysql_error();
//}
//mysql_free_result($result);
//mysql_close();
//}
?>