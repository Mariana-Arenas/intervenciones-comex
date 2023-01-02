<?php 

	require_once('view/main.php');
	require_once('model/home.php');
	$v = new View\main;
	$objhome = new Model\home;
	$v->home  = $objhome->gethome();
	$v->nav = $nav;
	$v->render();


?>