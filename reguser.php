<?php
require_once 'inc/init.inc';
define('DEFAVATAR', 'img/default.png');
$user_nick = strtolower(mysqli_real_escape_string($db_connect,$_POST['login_name']));
$user_pw = mysqli_real_escape_string($db_connect,$_POST['login_pw']);
$user_cpw = mysqli_real_escape_string($db_connect,$_POST['login_cpw']);
$user_email = mysqli_real_escape_string($db_connect,$_POST['login_email']);

if (session_start()) {
    if (strlen($user_nick) <= 25) {
        if (preg_match('.@.', $user_email)) {
            if (preg_match('/(?!^[0-9]*$)(?!^[a-zA-Z!@#$%^&*()_+=<>?]*$)^([a-zA-Z!@#$%^&*()_+=<>?0-9]{6,})$/', $user_pw)) {
                if (!strcmp($user_pw, $user_cpw)) {
                    $query = 'SELECT * FROM ' . USERSTABLE . ' WHERE user_name="' . $user_nick . '"';
                    $usrs = mysqli_query($db_connect, $query) or die('MySQLi error: ' . mysqli_error($db_connect));
                    $uarr = mysqli_fetch_array($usrs)['user_name'];
                    if (!isset($uarr)) {
                        $pass = md5($user_pw . SALTCONSTANT);
                        $query = 'SELECT COUNT(1) FROM ' . USERSTABLE;
                        $res = mysqli_query($db_connect, $query) or die('MySQLi error: ' . mysqli_error($db_connect));
                        $user_count = mysqli_fetch_array($res)[0];
                        echo 'Total count of users: ' . $user_count++ . '<br>';
                        $query = "INSERT INTO " . USERSTABLE . " VALUES(NULL,'$user_nick',NULL,'$pass','$user_email',NOW(),'" . DEFAVATAR . "',5)";

                        $res = mysqli_query($db_connect, $query) or die('MySQLi error: ' . mysqli_error($db_connect));
                        $ok = true;
                        $_SESSION['user_id'] = $user_count;
                        $_SESSION['user_name'] = $user_nick;
                        $_SESSION['access_ip'] = $_SERVER['REMOTE_ADDR'];
                        $_SESSION['user_full_name'] = '';
                        $_SESSION['autorised'] = 1;
                        $_SESSION['taskscount'] = 5;
                        unset($_SESSION['incorrect']);
                        echo 'New user is registered successfully. Autorefresh return you to tasks page or click <a href="/tasks.php">here</a> if autorefresh turned off<br>';
                        echo '<meta http-equiv="refresh" content="3;URL=/tasks.php">';
                    } else {
                        echo 'User with nick ' . $user_nick . ' has already exist <br>';
                    }

                } else {
                    echo 'Password and it\'s confirm are not equal<br>';
                }
            } else {
                echo "Password requires length 6 symbols or more with using latin character and numbers<br>";
            }
        } else {
            echo 'E-mail must contains \'@\' character<br>';
        }
    } else {
        echo 'User nick is too length (' . strlen($user_nick) . ' of 25 (max))';
    }
} else {
    echo 'Session error';
}
if (!isset($ok)) {
    echo 'You have submitted incorrect data<br>';
    echo "Press <a href='" . $_SERVER['HTTP_REFERER'] . "'>here</a> to return";
}
mysqli_close($db_connect);