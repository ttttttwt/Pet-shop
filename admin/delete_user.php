<?php

include_once('../backend/User.php');

$user = new User();
$user->deleteUser($_GET['id']);
