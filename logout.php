<?php
require_once './autoload.php';
require_once './includes/security.php';

session_destroy();

header('location: login.php');