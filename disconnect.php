<?php

session_start();
session_destroy();
header('/index.php');
header('Location: index.php');

?>