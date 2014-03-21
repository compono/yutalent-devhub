<?php 

require_once(dirname(__FILE__) . '/bootstrap.php'); 

require_once(dirname(__FILE__) . '/views/header.php'); 

$comProfile = $WU_API->sendMessageToWU('user/profile');
$comProfile = json_decode(json_encode($comProfile), true);

if ($document_id = $comProfile['id']) {

	if ($_FILES) {
		
	}

	require_once(dirname(__FILE__) . '/views/upload-template.php'); 
} else {
	require_once(dirname(__FILE__) . '/views/error.php'); 
}

require_once(dirname(__FILE__) . '/views/footer.php'); 
