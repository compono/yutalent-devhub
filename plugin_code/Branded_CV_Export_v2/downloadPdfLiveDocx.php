<?php

require_once(dirname(__FILE__) . '/bootstrap.php'); 
require_once 'Zend/Service/LiveDocx/Exception.php';
require_once 'Zend/Service/LiveDocx/MailMerge.php';

$id = intval($_GET['id']);

$comProfile = $WU_API->sendMessageToWU('user/profile');
$comProfile = json_decode(json_encode($comProfile), true);

if ($document_id = $comProfile['id']) {
	$currentUserProfile = $WU_API->sendMessageToWU('contacts/get', array('id' => $id));
	$currentUserProfile = json_decode(json_encode($currentUserProfile), true);

	$candidateName = $currentUserProfile['name'];
	$userCVDetail = $WU_API->sendMessageToWU('contacts/get-parsed-cv', array('id' => $id));
	$userCVDetail = json_decode(json_encode($userCVDetail), true);
	$summary = clean_output_LD($userCVDetail['html']['summary']);
	$keySkills =clean_output_LD($userCVDetail['html']['key-skills']);
	$history = clean_output_LD($userCVDetail['html']['history']);
	$education = clean_output_LD($userCVDetail['html']['education']);

	$mailMerge = new Zend_Service_LiveDocx_MailMerge();

	$mailMerge->setUsername(LIVEDOCS_USERNAME)
			  ->setPassword(LIVEDOCS_PASSWORD);

	$template = TEMPLATES_PATH . DEFAULT_CV_TEMPLATE;

	$document = search_file($document_id);

	if ($document) {
		$template = $document['path'];
	}

	try {
		$mailMerge->setLocalTemplate($template);
	} catch (Exception $e) {
		echo "<p>Looks like your template file is not compatible with our system. Please use Microsoft Word to create templates</p>";
		echo $e->getMessage();
	}

	$mailMerge->assign('summary', $summary)
			->assign('key-skills', $keySkills)
			->assign('work-history', $history)
			->assign('education', $education);

	$mailMerge->createDocument();
	$document = $mailMerge->retrieveDocument('pdf');
	header("Content-Type: application/pdf");
	header("Content-Transfer-Encoding: Binary");
	header('Content-disposition: attachment; filename="CV-' . $candidateName . '.pdf"'); 
	echo $document;
} else {
	require_once(dirname(__FILE__) . '/views/error.php'); 
}



