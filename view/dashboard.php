<?php
	namespace View;
	require_once('view.php');
	class dashboard extends view{
		function __construct(){
			$this->html = "dashboard";
			$this->page = "dashboard";
		}
	}
?>