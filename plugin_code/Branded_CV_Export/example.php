<?php

require_once 'libraries/tcpdf/core/tcpdf_include.php';
$imagepath = $_REQUEST['img'];
$filename_from_url = parse_url($_REQUEST['img']);
$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
$uploadImgPath = __DIR__ . '/upload_image/';
$file = tempnam( $uploadImgPath, 'tcpdf').'.'.$ext;
if(is_dir($uploadImgPath)){
	chmod($uploadImgPath,0777);
} else{
	mkdir($uploadImgPath,0777) ;
	chmod($uploadImgPath,0777);
}
file_put_contents($file,file_get_contents($imagepath));




$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('WuTalent');
$pdf->SetTitle('CV-'.$candidateName);
$pdf->SetSubject('CV-'.$candidateName);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->AddPage();

$pdf->Image($file, 0, 0, 20, 20, '', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
@unlink($file);
$pdf->Output('doc.pdf', 'I');

 exit;