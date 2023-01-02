<?php
require_once('view/ver_usuario.php');
require_once('model/usuario.php');
$v = new View\ver_usuario;

$objusuario = new Model\usuario;

$v->usuario  = $objusuario->getById($ID);
$v->nav = $nav;
$v->render();
?>




