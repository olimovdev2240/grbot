<?php

ob_start();
session_start();

defined("DB_NAME") ? null : define("DB_NAME", "xshop");
defined("DB_HOST") ? null : define("DB_HOST", "localhost");
defined("DB_USER") ? null : define("DB_USER", "root");
defined("DB_PASS") ? null : define("DB_PASS", "");


$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("xatolik");

require_once "function.php";
?>