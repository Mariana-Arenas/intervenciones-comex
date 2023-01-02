<?php
require_once('view/agregar_ncm.php');
require_once('model/unidadmedida.php');
require_once('model/grupopais.php');
$v = new View\agregar_ncm;

$unidadmedida_model = new Model\unidadmedida;
$grupopais_model = new Model\grupopais;

$v->unidad_medida= $unidadmedida_model->Gets();
$v->grupo_pais= $grupopais_model->GetsPaisesDistintos();
$v->nav = $nav;
$v->render();
?>
