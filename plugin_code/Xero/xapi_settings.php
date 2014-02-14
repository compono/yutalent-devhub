<?php 
	require_once(dirname(__FILE__) . '/config.inc.php'); 
?>
<link href="<?php echo HTTP_SSL.'://'.wuDomain.'/static/styles/plugin/plugin.css';?>" rel="stylesheet" />
<link href="css/xero.css" rel="stylesheet" />
<script>var wuDomain ='<?php echo wuDomain; ?>';</script>
<div id="content">
  <?php /* Form for get xero key from user*/
	if($_REQUEST['xero_consumer_key'] != '')	$_POST['xero_consumer_key'] = $_REQUEST['xero_consumer_key'];
	if($_REQUEST['xero_consumer_secret'] != '')	$_POST['xero_consumer_secret'] = $_REQUEST['xero_consumer_secret'];

	require_once(dirname(__FILE__) . '/views/keyForm.php');
	if(isset($_POST['consumer_key']) or isset($_POST['consumer_secret']))	// if user has posted submit the form
	{
		\WU_API::apiCall('storage/add', array('key' => 'xero_consumer_key', 'value' => $_POST['xero_consumer_key']));
		\WU_API::apiCall('storage/add', array('key' => 'xero_consumer_secret', 'value' => $_POST['xero_consumer_secret']));
	} ?>
</div>