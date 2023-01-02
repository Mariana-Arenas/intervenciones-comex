<?php
require_once('view/dashboard.php');

$v = new View\dashboard;

$v->nav = $nav;
$v->render();
?>
