<?php
$start_time = microtime();
$time_array = explode(" ",$start_time);
$start_time = $time_array[1] + $time_array[0];
require_once 'auth.inc';
$db_connect = mysqli_connect(DB_HOST,DB_UNAME,DB_PASSW,DEF_DB) or die('MySQL connection error!
 Please, check settings or contact yout admin! Error: ').mysqli_error($db_connect);
if(!$db_connect) {
    echo "Ошибка при подключении MySQL. Возможно база данных aquarius не создана или повреждена.";
}
/*if($res = mysqli_query($db_connect,"SELECT * from `users`")) {
    mysqli_free_result($res);
}
else {
    $res = mysqli_query($db_connect,"CREATE TABLE `users` (`user_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `user_name` CHAR(50) NOT NULL, `password` TEXT(255) NOT NULL,`email` TEXT NOT NULL, `regdate` DATETIME NOT NULL, `img_path` TEXT)");
    if(!$res) {
            echo "Error with connecting DB";
        }
    else {
        @mysqli_free_result($res);
    }
}
if($res = mysqli_query($db_connect,"SELECT * from `tasks`")) {
    mysqli_free_result($res);
}
else {
    $res = mysqli_query($db_connect,"CREATE TABLE `tasks` (`task_id` INT NOT NULL AUTO_INCREMENT, `author_id` INT NOT NULL, `user_id` INT NOT NULL, `create_time` DATETIME NOT NULL, `start_time` DATETIME NOT NULL,`end_time` DATETIME NOT NULL, PRIMARY KEY (`task_id`))");
    if(!$res) {
        echo "Error with connecting DB";
    }
    else {
        @mysqli_free_result($res);
}
}
if($res = mysqli_query($db_connect,"SELECT * FROM `visit`")) {
    mysqli_free_result($res);
}
else {
    $res = mysqli_query($db_connect,"CREATE TABLE `visit` (`page_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,`page_file` TEXT(255) NOT NULL,`last_visit` DATETIME NOT NULL, `v_count` INT NOT NULL)");
    if(!$res) {
        echo "Error with connecting DB. Error: ".mysqli_error($db_connect);
    }
    else {
        @mysqli_free_result($res);
    }
}*/