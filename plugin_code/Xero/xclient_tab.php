<?php

require_once(dirname(__FILE__) . '/config.inc.php'); 
require_once(dirname(__FILE__) . '/xapp_init.php');

$additional_js = array();

require_once(dirname(__FILE__) . '/views/header.php'); 
var_dump($_REQUEST);
require_once(dirname(__FILE__) . '/views/footer.php'); 

