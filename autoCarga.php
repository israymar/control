<?php
date_default_timezone_set("America/Lima");
function __autoload($className)
{
	require("clases/$className.php");
}
require("libs/FirePHPCore/FirePHP.class.php");
?>