<?php
$host='localhost'; // имя хоста (уточняется у провайдера)
$database='helicopter'; // имя базы данных, которую вы должны создать
$user='root'; // заданное вами имя пользователя, либо определенное провайдером
$pswd='root'; // заданный вами пароль
 
$dbh = mysqli_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
mysqli_select_db($dbh, $database) or die("Не могу подключиться к базе.");


?>