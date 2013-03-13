<?php 
if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('APP_DIR')) {
	define('APP_DIR', basename(dirname(dirname(__FILE__))));
}

if(!defined('ROOT'))
{
	define('ROOT', dirname(__FILE__));

}
if(!defined('CLASS_DIR'))
{
	define('CLASS_DIR', 'Lib'.DS.'Core');

}


require(ROOT.DS .APP_DIR.DS .CLASS_DIR.DS."Autoloader.php") ;

 

