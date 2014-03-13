<?php
define('WEBROOT',dirname(__FILE__));
define('ROOT',dirname(WEBROOT));
define('DS',DIRECTORY_SEPARATOR);
define('CORE',ROOT.DS.'core');
define('BASE_URL',dirname(dirname($_SERVER['SCRIPT_NAME'])));


require ROOT.DS.'vendor'.DS.'autoload.php';
require ROOT.DS.'maps'.DS.'GoogleMapAPIv3.class.php';
require ROOT.DS.'model'.DS.'DatabaseHandlers'.DS.'PlaceGateway.php';

require CORE.DS.'includes.php';
new Dispatcher();