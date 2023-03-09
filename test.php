<?php
include "api-connect.php";

$API = new cater_api('connect');
$parse = $API->parse();

var_dump($parse);