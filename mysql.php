<?php
$mysqli = new mysqli('db', 'root', 'pass', 'mysql');
var_dump($mysqli);
if($mysqli->connect_error) {
    echo '接続失敗'.PHP_EOL;
    exit();
} else {
    echo '接続成功'.PHP_EOL;
}
?>