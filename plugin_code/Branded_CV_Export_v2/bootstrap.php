<?php

require_once(dirname(__FILE__) . '/config.inc.php'); 
require_once(dirname(__FILE__) . '/libraries/wu-api/wu-api.php'); 
require_once(dirname(__FILE__) . '/libraries/brandedFunctions.php'); 

//ini_set('display_errors', 'On');
//error_reporting(E_ALL);

$WU_API = new WU_API();