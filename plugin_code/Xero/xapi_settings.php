<?php 
	require_once(dirname(__FILE__) . '/config.inc.php'); 
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="<?php echo HTTP_SSL.'://'.wuDomain.'/static/styles/plugin/plugin.css';?>" rel="stylesheet" />
	<link href="css/xero.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script>var wuDomain ='<?php echo wuDomain; ?>';</script>
	<script type="text/javascript" src="js/xero.js"></script>
	<script type="text/javascript" src="js/xapi_settings.js"></script>
</head>
<body>
	<div id="content">
	  <?php /* Form for get xero key from user*/
		require_once(dirname(__FILE__) . '/views/keyForm.php');
		if(isset($_POST['xero_consumer_key']) or isset($_POST['xero_consumer_secret']))	// if user has posted submit the form
		{
			
		} ?>
	</div>
</body>
</html>
