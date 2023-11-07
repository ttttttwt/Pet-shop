<?php

include_once('../backend/Category.php');

$category = new Category();
$category->deleteCategory($_GET['id']);
