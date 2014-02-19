<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="<?php echo HTTP_SSL.'://'.wuDomain.'/static/styles/plugin/plugin.css';?>" rel="stylesheet" />
	<link href="css/xero.css" rel="stylesheet" />
	<?php 
	if (isset($additional_css) and is_array($additional_css) and $additional_css) {
		foreach ($additional_css as $css) {
			echo '<link href="' . $css . '" rel="stylesheet" />';
		}
	}
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script>var wuDomain ='<?php echo wuDomain; ?>';</script>
	<script type="text/javascript" src="js/xero.js"></script>
	<?php 
	if (isset($additional_js) and is_array($additional_js) and $additional_js) {
		foreach ($additional_js as $js) {
			echo '<script type="text/javascript" src="'.$js.'"></script>';
		}
	}
	?>
</head>
<body>