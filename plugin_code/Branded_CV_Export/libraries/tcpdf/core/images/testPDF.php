<?php
$scriptUrl = ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")?'https':'http') . '://' . $_SERVER['HTTP_HOST'].'/'.$_SERVER['PHP_SELF'];
require 'wu-api/wu-api.php';

define('WU_DOMAIN', 'https://www.yutalent.co.uk');

define('WU_ID', '4ce2-ee6463a16-50426db0c-be81040be-ad322');
define('WU_SECRET', 'xmW5SW84sPLQmP4vsNG9ZDCyHN5tOV1B9N6Rn6NU');

$WU_API = new WU_API();

// this is optional, but if you use query parameters in your script,
// then better to set it right, as oauth server will return additional parameters into script
// and then redirect uri will differ from the url which requested access token
$WU_API->setRedirectUri($scriptUrl);
//$response = $WU_API->sendMessageToWU( 'user/profile', array() /* no params */ );
$error = $WU_API->getParam('error');
$style = 'style="color:#CB2027;font-family:\'ProximaNovaRegular\';font-size: 17px;font-weight: normal;margin-bottom: 17px;"';
if(!is_null($error))
{
	$error == 0 ? 'Ask your account owner to complete the company profile' : 'Please <a href="'.WU_DOMAIN.'/c/accounts/profile">click here</a> to complete the company profile';
	echo '<div '.$style.'>'.$error.'</div>';
}
else
{
	$currentUserProfile = $WU_API->sendMessageToWU( 'contacts/get',array('id'=>$WU_API->getParam('contact_id')));
	$currentUserProfile	= json_decode(json_encode($currentUserProfile),true);
	$candidateName 	= $currentUserProfile['name'];
	$summary 		= $currentUserProfile['cv']['html']['summary'];
	$privateInfo	= $currentUserProfile['cv']['html']['private-info'];
	$keySkills 		= $currentUserProfile['cv']['html']['key-skills'];
	$history 		= $currentUserProfile['cv']['html']['history'];
	$education 		= $currentUserProfile['cv']['html']['education'];
	$companyName 	= $WU_API->getParam('companyName');
	$image 			= $WU_API->getParam('image');
	//$divStyle = 'style="display: block;font-family: \'ProximaNovaRegular\';font-size: 14px;line-height: 21px;margin-bottom: 33px;"';
	$cvHTML = '<style>
	.profile-info-box {display: block;font-family: \'ProximaNovaRegular\';font-size: 14px;margin-bottom: 33px;}	
	.profile-info-box h2 {color: #CB2027;font-family: \'ProximaNovaRegular\';font-size: 17px;font-weight: normal;margin-bottom: 17px;}
	.profile-info-box strong {display: block;padding: 5px 0 0;width:400px;}
	</style>';
	$cvHTML = '<img src="http://www.anylinuxwork.com/images/anylinuxwork-logo.jpg" alt="test alt attribute" border="0" />';
	if(!is_null($privateInfo) || !is_null($summary))
	{
		$cvHTML.= '<div class="profile-info-box">
			<h2 '.$style.'>Summary</h2>'.
			(!is_null($privateInfo) ? $privateInfo : '').
			(!is_null($summary) ? '</div><div class="profile-info-box" style="margin-bootm:0 !important">'.$summary : '').
		'</div>';
	}
	if(!is_null($keySkills))
		$cvHTML.= '<div class="profile-info-box"><h2 '.$style.'>Key skills</h2>'.$keySkills.'</div>';
	if(!is_null($history))
		$cvHTML.= '<div class="profile-info-box"><h2 '.$style.'>Work history</h2>'.$history.'</div>';
	if(!is_null($education))
		$cvHTML.= '<div class="profile-info-box"><h2 '.$style.'>Education</h2>'.$education.'</div>';
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');



// set default header data
$pdf->SetHeaderData('logo_example.png', PDF_HEADER_LOGO_WIDTH, $companyName, 'CV: '.$candidateName, array(0,0,0), array(0,0,0));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
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

// ---------------------------------------------------------

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

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $cvHTML, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
/*echo '<script>document.getElementByClass("ui-button").click();</script>';*/
$pdf->Output('test'.time().'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
}