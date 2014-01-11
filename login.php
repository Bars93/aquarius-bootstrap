<?php
require_once 'inc/init.inc';
if (@session_start()) {
    if (isset($_POST['loginp'])) {
        $login_name = mysqli_real_escape_string($db_connect, $_POST['loginp']);
        $login_pw = md5(mysqli_real_escape_string($db_connect, $_POST['passinp']) . SALTCONSTANT);
        $query = 'SELECT * FROM ' . USERSTABLE . ' WHERE user_name="' . strtolower($login_name). '" AND password="' . $login_pw . '"';
        $res = mysqli_query($db_connect, $query) or trigger_error('MySQLi error: ' . mysqli_error($db_connect) . '<br> Query: ' . $query);
        if ($data = mysqli_fetch_assoc($res)) {
            $_SESSION['user_id']
                = $data['user_id'];
            $_SESSION['user_name'] = strtolower($data['user_name']);
            $_SESSION['user_full_name'] = $data['user_full_name'];
            $_SESSION['access_ip'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['autorised'] = 1;
            $_SESSION['tasks_count'] = intval($data['rows_per_page']);
            unset($_SESSION['incorrect']);
            echo '<meta http-equiv="refresh" content="0;URL=' . $_SERVER['HTTP_REFERER'] . '">';
            exit;
        } else {
            $_SESSION['incorrect'] = 1;
            echo '<meta http-equiv="refresh" content="0;URL=/logpage.php">';
            exit;
        }
    }
    if (isset($_SESSION['action']) && $_SESSION['action'] == 'logout') {
        session_destroy();
        echo '<meta http-equiv="refresh" content="0;URL=' . $_SERVER['HTTP_REFERER'] . '">';
        exit;
    }

} else {
    echo 'Session error!';
}