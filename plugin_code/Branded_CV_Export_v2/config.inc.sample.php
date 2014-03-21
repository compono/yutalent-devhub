<?php
$wuDomain = '';
$domain_parts = explode('.', $_SERVER['HTTP_HOST']);
$domain_parts[0] = 'www';
$wuDomain = implode('.', $domain_parts);
$wuDomain=((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")?'https':'http') . '://' . $wuDomain;

define('WU_DOMAIN', $wuDomain);
define('WU_ID', '');
define('WU_SECRET', '');

//livedocx settings
define('LIVEDOCS_USERNAME', '');
define('LIVEDOCS_PASSWORD', '');

define('TEMPLATES_DIR', dirname(__FILE__) . '/templates/');
define('DEFAULT_CV_TEMPLATE', 'Default_CV_template.docx');