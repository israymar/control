<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pruebas de FirePhp</title>
</head>

<body>
<?php
require("libs/FirePHPCore/FirePHP.class.php");

//ob_start();

$firephp = FirePHP::getInstance(true);

$var = array('i'=>20, 'j'=>30);

$firephp->log($var, 'Iterators');

?>
</body>
</html>
