<?php
$config = parse_ini_file('config.ini'); 
$link = mysqli_connect($config['servername'],$config['username'],$config['password'],$config['dbname']);
?>

