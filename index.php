<?php
// v1.1

error_reporting(0);
mkdir("plugins/config");
$update = json_decode(file_get_contents('php://input'), true);

require 'config.php';
require 'functions.php';
sec_test($config['key'], $_GET['key']);


require 'database.php';
foreach ($config['plugins'] as $plugin => $active) {
  if ($active) {
    mkdir("plugins/config/$plugin");
    include "plugins/$plugin.php";
  }
}
require 'commands.php';