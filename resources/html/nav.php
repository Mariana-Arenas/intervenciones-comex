<div id="wrapper" class="toggled">
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">

  <div class="sidebar-brand-icon">
 <img src="/images/logo.jpg" style="max-width:32%">
  </div>  
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">
<!-- MENU  ADMINISTRADOR-->
<?php
if ($_SESSION['comex']['usuario']['perfilID']==1 )
{
?>
  <li class="nav-item ">
  <a class="nav-link" href="maestro">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Archivos Maestros</span></a>
</li>

<div class="sidebar-heading"></div>
<li class="nav-item ">
  <a class="nav-link" href="usuario">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Usuarios</span></a>
</li>
<div class="sidebar-heading"></div>
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsuarios" aria-expanded="true" aria-controls="collapseEspecialistaReserva">
    <i class="fas fa-city fa-wrench"></i>
    <span>Parametros</span>
  </a>
<div id="collapseUsuarios" class="collapse" aria-labelledby="headingEspecialistaReserva" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header"></h6>
      <a class="collapse-item" href="ncm">NCM</a>
      <a class="collapse-item" href="ncm_faltantes">NCM Faltantes</a>
      <a class="collapse-item" href="cotizacion">Cotizaciones</a> 
      <!-- <a class="collapse-item" href="grupopais">Grupo Pais</a>
      <a class="collapse-item" href="paise">Paises</a>  
       -->
    </div>
  </div>
  </li>
<div class="sidebar-heading"></div>
<?php
 }
?>


<!--MENU Usuario -->
<?php
if ($_SESSION['comex']['usuario']['perfilID']==2 )
{
?>
  <li class="nav-item ">
  <a class="nav-link" href="archivo">
    <i class="fas fa-file-excel"></i>
    <span>Archivos</span></a>
</li>
<div class="sidebar-heading"></div>


<?php
 }
?>



<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>

</div>