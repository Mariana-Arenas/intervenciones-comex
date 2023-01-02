<?php
require_once('view/agregar_usuario.php');

$v = new View\agregar_usuario;
$v->nav = $nav;
$v->render();
?>
