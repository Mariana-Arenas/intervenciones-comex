<?php
require_once('view/ver_ncm.php');
require_once('model/ncm.php');
require_once('model/unidadmedida.php');
require_once('model/grupopais.php');

$v = new View\ver_ncm;

 $unidadmedida_model = new Model\unidadmedida;
 $grupopais_model = new Model\grupopais;
 $ncm_model = new Model\ncm;

 $v->unidad_medida= $unidadmedida_model->Gets();
 $v->grupo_pais= $grupopais_model->GetsGruposDistintos();

 $v->ncm  = $ncm_model->getById($ID);

 $v->nav = $nav;
$v->render();


?>




