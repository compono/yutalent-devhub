<?php

define('HTTP_SSL','https');
define("WU_DOMAIN","www.yutalent.co.uk");
define('WU_ID', '');
define('WU_SECRET', '');

//livedocx settings
define('LIVEDOCS_USERNAME', '');
define('LIVEDOCS_PASSWORD', '');

define('TEMPLATES_DIR', 'templates');
define('TEMPLATES_PATH', dirname(__FILE__) . '/' . TEMPLATES_DIR . '/');
define('DEFAULT_CV_TEMPLATE', 'Default_CV_template.docx');

define('UPLOAD_MAX_FILESIZE', 2 * 1024 * 1024); //2MB
define('ALLOWED_FILE_EXTENSIONS', 'docx|doc|pdf|rtf');

define('ORIG_FILE_NAME_KEY', 'cv_export_template_original_file_name');

define('OO_CONVERT_COMMAND', 'python DocumentConverter.py');