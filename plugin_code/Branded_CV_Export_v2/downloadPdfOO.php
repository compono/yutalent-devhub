<?php

require_once(dirname(__FILE__) . '/bootstrap.php'); 

$id = intval($_GET['id']);

$comProfile = $WU_API->sendMessageToWU('user/profile');
$comProfile = json_decode(json_encode($comProfile), true);

if ($document_id = $comProfile['id']) {
	//creating temp folder for our document
	$tmp_dir = dirname(__FILE__) . '/tmp/' . $document_id . '_' . $id . '/';
	$tmp_file = $tmp_dir . 'tmp.html';
	$pdf_file = $tmp_dir . 'cv.pdf';
	if (is_dir($tmp_dir) || mkdir($tmp_dir)) {
		//converting our document to html file
		$template = TEMPLATES_PATH . DEFAULT_CV_TEMPLATE;

		$document = search_file($document_id);

		if ($document) {
			$template = $document['path'];
		}

		$convert_to_html = shell_exec(OO_CONVERT_COMMAND . ' ' . $template . ' ' . $tmp_file);
		if (is_file($tmp_file) && filesize($tmp_file)) {
			$currentUserProfile = $WU_API->sendMessageToWU('contacts/get', array('id' => $id));
			$currentUserProfile = json_decode(json_encode($currentUserProfile), true);

			$candidateName = $currentUserProfile['name'];
			$userCVDetail = $WU_API->sendMessageToWU('contacts/get-parsed-cv', array('id' => $id));
			$userCVDetail = json_decode(json_encode($userCVDetail), true);
			$summary = clean_output_OO($userCVDetail['html']['summary']);
			$keySkills =clean_output_OO($userCVDetail['html']['key-skills']);
			$history = clean_output_OO($userCVDetail['html']['history']);
			$education = clean_output_OO($userCVDetail['html']['education']);

			$replace = array(
				'summary' => $summary,
				'key-skills' => $keySkills,
				'work-history' => $history,
				'education' => $education
			);

			//merging html file with the data
			if (merge_html($tmp_file, $replace)) {
				//converting html file to pdf
				$convert_to_pdf = shell_exec(OO_CONVERT_COMMAND . ' ' . $tmp_file . ' ' . $pdf_file);
				if (is_file($pdf_file) && filesize($pdf_file)) {
					header("Content-Type: application/pdf");
					header("Content-Transfer-Encoding: Binary");
					header('Content-disposition: attachment; filename="CV-' . $candidateName . '.pdf"'); 
					echo readfile($pdf_file);

					delete_directory($tmp_dir);
				} else {
					die('Error converting to pdf');
				}
			} else {
				die('Error while merging file');
			}
		} else {
			die('Error while converting to tmp file');
		}
	} else {
		die('Unable to create temp dir');
	}
} else {
	require_once(dirname(__FILE__) . '/views/error.php'); 
}