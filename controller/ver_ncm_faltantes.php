<?php
require_once('view/ver_ncm_faltantes.php');
require_once('model/ncm.php');
require_once('model/unidadmedida.php');
require_once('model/grupopais.php');

$v = new View\ver_ncm_faltantes;

 $unidadmedida_model = new Model\unidadmedida;
 $grupopais_model = new Model\grupopais;
 $ncm_model = new Model\ncm;

 $v->unidad_medida= $unidadmedida_model->Gets();
 $v->ncm  = $ncm_model->getFaltanteById($ID);
 $v->grupo_pais= $grupopais_model->GetsGruposDistintosNcmPaisFaltante($ID);



 $v->nav = $nav;
$v->render();


?>




