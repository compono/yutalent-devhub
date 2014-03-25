<?php

require_once(dirname(__FILE__) . '/bootstrap.php'); 

$comProfile = $WU_API->sendMessageToWU('user/profile');
$comProfile = json_decode(json_encode($comProfile), true);

if ($document_id = $comProfile['id']) {
	$document = search_file($document_id);

	if ($document) {
		download_file($document['file'], $document['orig_file_name']);
	} else {
		echo '<p>No document found</p>';
	}
} else {
	echo '<p>No document id</p>';
}