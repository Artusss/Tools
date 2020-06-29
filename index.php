<meta charset="utf-8"><?php
require_once("vendor/autoload.php");
use Tools\Logor;

echo "Test page<br>";
Logor::setPath("logs");
$rootLogor = Logor::get("test", "root");

$rootLogor->log(array(1, 2, 3, 123, 213, 321));
$rootLogor->log(array(1, 2, 3, 123, 213, 321));
$rootLogor->log(array(1, 2, 3, 123, 213, 321));
$rootLogor->log(array(1, 2, 3, 123, 213, 321));