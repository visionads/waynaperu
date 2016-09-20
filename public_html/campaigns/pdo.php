<?php

define('HOST', 'localhost');
define('DATABASE', 'waynacom_app');
define('USERNAME', 'waynacom_app');
define('PASSWORD', 'JuP!dA7*XyOU');

$pdo = new PDO('mysql:host='. HOST .';dbname=' . DATABASE, USERNAME, PASSWORD);
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
