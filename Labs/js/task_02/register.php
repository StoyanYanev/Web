<?php
$data = file_get_contents('php://input');
$json_array = json_decode($data, true);
var_dump($json_array);
?>