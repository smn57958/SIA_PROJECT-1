<?php
$cookie_username_value = ($_GET['username']);
$cookie_password_value = ($_GET['password']);
$cookie_db_name_value = ($_GET['dbname']);
setcookie("username", $cookie_username_value, time() + (86400), "/"); // 86400 = 1 day
setcookie("password", $cookie_password_value, time() + (86400), "/"); // 86400 = 1 day
setcookie("dbname", $cookie_db_name_value, time() + (86400), "/"); // 86400 = 1 day

?>