<?php 

require_once(dirname(__FILE__) . '/bootstrap.php'); 

require_once(dirname(__FILE__) . '/views/header.php'); 

$comProfile = $WU_API->sendMessageToWU('user/profile');
$comProfile = json_decode(json_encode($comProfile), true);

if ($document_id = $comProfile['id']) {

	$message = array('error' => '', 'success' => '');

	if ($_FILES) {
		$save =  save_file($document_id);
		if ($save['success']) {
			$message['success'] = 'File uploaded successfully';
		} else {
			$message['error'] = $save['error'];
		}
	}

	$current_file['link'] = TEMPLATES_DIR . '/' . DEFAULT_CV_TEMPLATE;
	$current_file['title'] = DEFAULT_CV_TEMPLATE;

	$document = search_file($document_id);

	if ($document) {
		$current_file['link'] = 'downloadDoc.php';
		$current_file['title'] = $document['orig_file_name'];
	}

	require_once(dirname(__FILE__) . '/views/upload-template.php'); 
} else {
	require_once(dirname(__FILE__) . '/views/error.php'); 
}

require_once(dirname(__FILE__) . '/views/footer.php'); 
