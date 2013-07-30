<?php

require_once('../tcpdf.php');
$imagepath = $_REQUEST['img'];
$filename_from_url = parse_url($_REQUEST['img']);
$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
$uploadImgPath = __DIR__ . '/upload_image/';
echo $file = tempnam( $uploadImgPath, 'tcpdf').'.'.$ext;die;
file_put_contents($file,file_get_contents($imagepath));

//$image = '/home/vitaly/user_icon.png';

$pdf = new TCPDF();

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->AddPage();

$pdf->Image($file, 0, 0, 20, 20, '', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);

$pdf->Output('doc.pdf', 'I');

 exit;