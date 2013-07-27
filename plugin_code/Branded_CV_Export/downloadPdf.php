<?php
$scriptUrl = ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")?'https':'http') . '://' . $_SERVER['HTTP_HOST'].'/'.$_SERVER['PHP_SELF'];
extract($_REQUEST);
require_once 'config.inc.php';
require_once 'libraries/wu-api/wu-api.php';
require_once 'libraries/brandedFunctions.php';
require_once 'libraries/tcpdf/core/tcpdf_include.php';
$WU_API = new WU_API();
// this is optional, but if you use query parameters in your script,
// then better to set it right, as oauth server will return additional parameters into script
// and then redirect uri will differ from the url which requested access token
$WU_API->setRedirectUri($scriptUrl);	
$currentUserProfile 	= $WU_API->sendMessageToWU('contacts/get',array('id'=>4255));
$currentUserProfile	= json_decode(json_encode($currentUserProfile),true);
$candidateName 		= $currentUserProfile['name'];
$summary 		= str_replace('/strong>',"/strong><br/>",$currentUserProfile['cv']['html']['summary']);
//$privateInfo		= str_replace('/strong>',"/strong><br/>",$currentUserProfile['cv']['html']['private-info']);
$keySkills 		= str_replace('/strong>',"/strong><br/>",$currentUserProfile['cv']['html']['key-skills']);
$history 		= str_replace('/strong>',"/strong><br/>",$currentUserProfile['cv']['html']['history']);
$education 		= str_replace('/strong>',"/strong><br/>",$currentUserProfile['cv']['html']['education']);
//list($imageWidth,$imageHeight) = @getimagesize($image);
//$brandedFunctions	= new BrandedFunctions;
//$imageSize 		= $brandedFunctions->getAspectRatio($imageHeight,$imageWidth,43,135);
$cvHTML = '<style>
.profile-info-box {display: block;font-family: \'ProximaNovaRegular\';font-size: 14px;margin-bottom: 33px;}	
.profile-info-box h2 {color: #CB2027;font-family: \'ProximaNovaRegular\';font-size: 17px;font-weight: normal;margin-bottom: 17px;}
.profile-info-box strong,.profile-info-box h5 {display: block;padding: 5px 0 0;width:600px;}
</style>';

if(/*!is_null($privateInfo) || */!is_null($summary) && !empty($summary))
{
	$cvHTML.= '<div class="profile-info-box">
		<h2>Summary</h2>'.$summary.
		//(!is_null($privateInfo) ? $privateInfo : '').
		//(!is_null($summary) ? '</div><div class="profile-info-box" style="margin-bootm:0 !important">'.$summary : '').
	'</div>';
}
if(!is_null($keySkills)  && !empty($keySkills))
	$cvHTML.= '<div class="profile-info-box"><h2>Key skills</h2>'.$keySkills.'</div>';
if(!is_null($history)  && !empty($history))
	$cvHTML.= '<div class="profile-info-box"><h2>Work history</h2>'.$history.'</div>';
if(!is_null($education)  && !empty($education))
	$cvHTML.= '<div class="profile-info-box"><h2>Education</h2>'.$education.'</div>';

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('WuTalent');
$pdf->SetTitle('CV-'.$candidateName);
$pdf->SetSubject('CV-'.$candidateName);

// set default header data
$pdf->SetHeaderData('', '', '', '');
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to0
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// Set some content to print
// Print text using writeHTMLCell()
//$pdf->writeHTMLCell(0, 0, 10, 10, '<img height="'.$imageSize['h'].'px" width="'.$imageSize['w'].'px" src="'.$image.'" alt="test alt attribute" border="0" />', 0, 0, false, true, '',true);
$pdf->writeHTMLCell(0, 0, 48, 10, $companyName, 0, 0, false, true, '',true);
$pdf->writeHTMLCell(0, 0, 48, 18, 'CV: '.$candidateName, 0, 0, false, true, '',true);
$style = array('width' => 0.5, 'phase' => 10, 'color' => array(0, 0, 0));
$pdf->Line(10, 30, 200, 30, $style);
$pdf->writeHTMLCell(0, 0, 10, 30, $cvHTML, 0, 1, 0, true, '', true);

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('CV-'.$candidateName.'.pdf', 'I');