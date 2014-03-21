<?php

require_once(dirname(__FILE__) . '/../bootstrap.php'); 

function search_file($user_id) {
	global $WU_API;

	$result = false;

	if (is_file(TEMPLATES_DIR . $user_id) || filesize(TEMPLATES_DIR . $user_id)) {
		$orig_file_name = $WU_API->sendMessageToWU('storage/get', array('key' => ORIG_FILE_NAME_KEY));
		
		if ($orig_file_name[0]) {
			$result = array(
				'path' => TEMPLATES_DIR . $user_id,
				'orig_file_name' => $orig_file_name[0]
			);
		}
	}

	return $result;
}

function save_file($user_id) {
	global $WU_API;

	$result = array(
		'success' => false,
		'error' => 'Error uploading file'
	);

	if ($_FILES['cv_template']) {
		$orig_name = $_FILES['cv_template']['name'];
		$size = $_FILES['cv_template']['size'];
		$error = $_FILES['cv_template']['error'];
		$tmp_name = $_FILES['cv_template']['tmp_name'];
		$save_to = TEMPLATES_DIR . $user_id;

		if ($error === 0) {
			if ($size > UPLOAD_MAX_FILESIZE) {
				$result = array(
					'success' => false,
					'error' => 'The file is too big, please upload file less then ' . UPLOAD_MAX_FILESIZE / 1024 * 1024 . ' MB'
				);
				return $result;
			} else {
				$extension = end(explode('.', $orig_name));
				if (in_array($extension, explode('|', ALLOWED_FILE_EXTENSIONS))) {
					if (move_uploaded_file($tmp_name, $save_to)) {
						$result = array(
							'success' => true,
							'error' => null
						);

						$WU_API->sendMessageToWU('storage/add', array('key' => ORIG_FILE_NAME_KEY, 'value' => $orig_name));
					} else {

						var_dump($tmp_name);
						var_dump($save_to);
						$result = array(
							'success' => false,
							'error' => 'Error moving file'
						);
						return $result;
					}
				} else {
					$result = array(
						'success' => false,
						'error' => 'Invalid extension of the file, please use one of these: ' . implode(', ', explode('|', ALLOWED_FILE_EXTENSIONS))
					);
					return $result;
				}
			}
		} else {
			$result = array(
				'success' => false,
				'error' => 'Error uploading file'
			);
		}
	}

	return $result;
}

function delete_file($user_id) {
	global $WU_API;

	if (is_file(TEMPLATES_DIR . $user_id)) {
		unlink(is_file(TEMPLATES_DIR . $user_id));
	}

	$WU_API->sendMessageToWU('storage/add', array('key' => ORIG_FILE_NAME_KEY, 'value' => ''));
}