<?php

require_once(dirname(__FILE__) . '/../bootstrap.php'); 

function search_file($user_id) {
	global $WU_API;

	$result = false;
	$extensions = explode('|', ALLOWED_FILE_EXTENSIONS);

	foreach ($extensions as $extension) {
		if (is_file(TEMPLATES_PATH . $user_id . '.' . $extension) && filesize(TEMPLATES_PATH . $user_id . '.' . $extension)) {
			$orig_file_name = $WU_API->sendMessageToWU('storage/get', array('key' => ORIG_FILE_NAME_KEY));
			
			if ($orig_file_name[0]) {
				$result = array(
					'file' => $user_id . '.' . $extension,
					'path' => TEMPLATES_PATH . $user_id . '.' . $extension,
					'orig_file_name' => $orig_file_name[0]
				);
			}
			break;
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
		$extension = mb_strtolower(end(explode('.', $orig_name)));
		$save_to = TEMPLATES_PATH . $user_id . '.' . $extension;

		if ($error === 0) {
			if ($size > UPLOAD_MAX_FILESIZE) {
				$result = array(
					'success' => false,
					'error' => 'The file is too big, please upload file less then ' . UPLOAD_MAX_FILESIZE / 1024 * 1024 . ' MB'
				);
				return $result;
			} else {
				if (in_array($extension, explode('|', ALLOWED_FILE_EXTENSIONS))) {
					if (move_uploaded_file($tmp_name, $save_to)) {
						$result = array(
							'success' => true,
							'error' => null
						);

						$WU_API->sendMessageToWU('storage/add', array('key' => ORIG_FILE_NAME_KEY, 'value' => $orig_name));
					} else {
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

	$extensions = explode('|', ALLOWED_FILE_EXTENSIONS);

	foreach ($extensions as $extension) {
		if (is_file(TEMPLATES_PATH . $user_id . '.' . $extension)) {
			unlink(TEMPLATES_PATH . $user_id . '.' . $extension);
		}
	}

	$WU_API->sendMessageToWU('storage/add', array('key' => ORIG_FILE_NAME_KEY, 'value' => ''));
}

function download_file($filename, $orig_name) {
	$mime_types = array(
		'pdf' => 'application/pdf',
		'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'doc' => 'application/msword',
		'rtf' => 'application/rtf'
	);

	$extension = mb_strtolower(end(explode('.', $orig_name)));

	header("Content-Type: " . $mime_types[$extension]);
	header("Content-Transfer-Encoding: Binary");
	header('Content-disposition: attachment; filename="' . $orig_name . '"'); 
	echo readfile(TEMPLATES_PATH . $filename);
}

function br2nl($str) {
	$str = preg_replace("/(\r\n|\n|\r)/", "", $str);
	return preg_replace("=<br */?>=i", "\n", $str);
}

function clean_output_LD($str) {
	return strip_tags(str_replace(array('/strong>', '&nbsp;'), array("/strong>\n", ' '), br2nl($str)));
}

function clean_output_OO($str) {
	return $str;
}

function merge_html($filename, $replace) {
	$result = false;

	$file = file_get_contents($filename);
	if ($file) {
		foreach ($replace as $replace_key => $replace_value) {
			$file = str_replace('«' . $replace_key . '»', $replace_value, $file);
		}

		if (file_put_contents($filename, $file) !== false) {
			$result = true;
		}
	}
	return $result;
}

function delete_directory($dir) {
	if (!file_exists($dir)) return true;
	if (!is_dir($dir)) return unlink($dir);
	foreach (scandir($dir) as $item) {
		if ($item == '.' || $item == '..') continue;
		if (!delete_directory($dir.DIRECTORY_SEPARATOR.$item)) return false;
	}
	return rmdir($dir);
}