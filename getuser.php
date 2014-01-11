<?php
require_once 'inc/init.inc';
header("Content-type: text/xml");
echo chr(60). chr(63).'xml version="1.0" encoding="UTF-8" ' . chr(63) .chr(62);

?>
<list>
    <?php
    session_start();
    $user_name = isset($_GET['user_name']) ? urldecode($_GET['user_name']) : "";
    $user_name = strtolower(mysqli_real_escape_string($db_connect,$user_name));
    $query = "SELECT user_id FROM users WHERE user_name='".$user_name."'";
    $res = mysqli_query($db_connect,$query) or die("MySQLi error: ".mysqli_error($db_connect));
    $user = mysqli_fetch_array($res)[0];
    echo '<result><taken>';
    if(is_null($user) || (isset($_SESSION['autorised']) && (!strcmp($user_name,$_SESSION['user_name'])))) {
        echo 'false';
    }
    else {
        echo 'true';
    }
    echo '</taken></result>';
    ?>
</list>