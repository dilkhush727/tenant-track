<?php
require 'vendor/autoload.php';
$app = require 'app/Config/Paths.php';
$bootstrap = require 'app/Config/Boot/development.php';
$db = \Config\Database::connect();
var_dump($db->getConnectHostname(), $db->getInitialConnection()->getAttribute(PDO::ATTR_CONNECTION_STATUS));
