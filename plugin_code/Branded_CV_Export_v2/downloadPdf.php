<?php

//$scriptUrl = ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")?'https':'http') . '://' . $_SERVER['HTTP_HOST'].'/'.$_SERVER['PHP_SELF'].'&id='.$_REQUEST['id'];
extract($_REQUEST);
require_once(dirname(__FILE__) . '/bootstrap.php'); 

// this is optional, but if you use query parameters in your script,
// then better to set it right, as oauth server will return additional parameters into script
// and then redirect uri will differ from the url which requested access token
//$WU_API->setRedirectUri($scriptUrl);

$comProfile = $WU_API->sendMessageToWU('user/profile');
$comProfile = json_decode(json_encode($comProfile), true);
$imagePath = $comProfile['profile']['company-logo']['medium'];
$currentUserProfile = $WU_API->sendMessageToWU('contacts/get', array('id' => $id));
$currentUserProfile = json_decode(json_encode($currentUserProfile), true);
$candidateName = $currentUserProfile['name'];
$userCVDetail = $WU_API->sendMessageToWU('contacts/get-parsed-cv', array('id' => $id));
$userCVDetail = json_decode(json_encode($userCVDetail), true);
$summary = str_replace('/strong>', "/strong><br/>", $userCVDetail['html']['summary']);
$summary = str_replace('Summary:', "", $userCVDetail['html']['summary']);
//$privateInfo		= str_replace('/strong>',"/strong><br/>",$currentUserProfile['cv']['html']['private-info']);
$keySkills = str_replace('/strong>', "/strong><br/>", $userCVDetail['html']['key-skills']);
$history = str_replace('/strong>', "/strong><br/>", $userCVDetail['html']['history']);
$education = str_replace('/strong>', "/strong><br/>", $userCVDetail['html']['education']);
$cvHTML = '<style>
h2{color:#788184;font-size:0.65em;font-weight:normal;}
span{color:#47616c;font-size:0.65em;font-weight:normal;}
strong{font-weight: 400;}
</style>';
$filenameFromUrl = parse_url($imagePath);
$ext = pathinfo($filenameFromUrl['path'], PATHINFO_EXTENSION);
$uploadImgPath = 'upload_image/';
$file = tempnam($uploadImgPath, 'tcpdf') . '.' . $ext;
if (is_dir($uploadImgPath)) {
    chmod($uploadImgPath, 0755);
} else {
    mkdir($uploadImgPath, 0755);
    chmod($uploadImgPath, 0755);
}
file_put_contents($file, file_get_contents($imagePath));
$imagePath = $file;
if (!(@getimagesize($imagePath)))
    $imagePath = 'images/wu-logo.png'; // if image does not exist then provide default image
list($imageWidth, $imageHeight) = @getimagesize($imagePath);
$brandedFunctions = new BrandedFunctions;
$imageSize = $brandedFunctions->getAspectRatio($imageHeight, $imageWidth, 43, 132);
if (/* !is_null($privateInfo) || */!is_null($summary) && !empty($summary)) {
    $cvHTML.='<table border="0">
        <tr>
        <th width="15%" align="right"><h2>SUMMARY</h2></th>
        <th width="7%" align="right"></th>
        <th width="68%" align="left"><span>' . $summary .
            //(!is_null($privateInfo) ? $privateInfo : '').
            //(!is_null($summary) ? .$summary : '').
            '</span></th>
          <th width="10%" align="right"></th>
    </tr>
    </table>';
}
if (!is_null($keySkills) && !empty($keySkills))
    $cvHTML.='<table border="0">
        <tr>
            <th width="15%" align="right"><h2>KEY SKILLS</h2></th>
            <th width="7%" align="right"></th>
            <th width="68%" align="left"><span>' . $keySkills .
                '</span></th>
            <th width="10%" align="right"></th>
        </tr>
        </table>';
if (!is_null($history) && !empty($history))
    $cvHTML.='<table border="0">
        <tr>
            <th width="15%" align="right"><h2>WORK HISTORY</h2></th>
            <th width="7%" align="right"></th>
            <th width="68%" align="left"><span>' . $history .
                '</span></th>
           <th width="10%" align="right"></th>
        </tr>
        </table>';
if (!is_null($education) && !empty($education))
    $cvHTML.='<table border="0">
        <tr>
            <th width="15%" align="right"><h2>EDUCATION</h2></th>
            <th width="7%" align="right"></th>
            <th width="68%" align="left"><span>' . $education .
                '</span></th>
            <th width="10%" align="right"></th>
        </tr>
        </table>';

?>
