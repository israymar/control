<?php
require("../recursos/jsmin-1.1.1.php");

echo JSMIN::minify(file_get_contents('funcionesJS.js'))

?>
