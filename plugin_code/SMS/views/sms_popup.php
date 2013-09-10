<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="https://devhub.wutalent.co.uk/plugin_code/SMS/js/jquery.min.js"></script>
</head>

<!--script for getting mobile no from js API-->
<script type="text/javascript">
window.wuAfterInit = function(wu) {
var cid = wu.Options.getOption('request')['id'];
console.log( cid );
wu.Messenger.sendMessageToWU('contacts/get', {id: wu.Options.getOption('request')['id'] }, function(response){
console.log( response );
/* assigning mobile no to variable from yutalent js API response*/
var mob_no = response.phone.profile.mobile;
$('#cont_no').val(mob_no);



// script for validating mobile number prefix
//var temp_mob_no = mob_no;
var temp_mob_no = mob_no.replace(/[^0-9]/g, '');
$.ajax({
        url: "msg_form_submit.php?mob="+temp_mob_no,
        type: "post",
       	success: function(data)
        {
            //alert(data);
			if(data != '')
			{
				$('#sms_form').replaceWith('<div class="valid_err">'+data+'</div>');
			}else
			{
				$('#sms_form').css('display','block');
			}
        }
    });
	

/*wu.Messenger.sendMessageToWU('credits/getAppCredits',function(cred){
                console.log(cred);
            });*/


var success = $('#char_count').text();
if(success == 'success')
{
var cred_val = $('#cred_count').val();
wu.Messenger.sendMessageToWU('event/decreaseCredits', {amount:cred_val});
wu.Messenger.sendMessageToWU('showGrowl', {
title: 'Message sent', message: 'Your message is sent successfully'}, function(){
wu.Messenger.sendMessageToWU('closePopup');
});
}

});
}

var wuDomain = 'www.wutalent.co.uk';

window.wuAsyncInit = function () {
WU.init({
        domain: wuDomain,
        signed_request: '<?php echo $_REQUEST['signed_request'] ?>',
        height: '100%',
	    'afterInit': function(wu){
        if( typeof window.wuAfterInit == 'function' ) {
        window.wuAfterInit(wu);
          }
         }
      });
};


// Load the SDK's source Asynchronously
(function (d, s, id) {
    var js, wjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//" + wuDomain + "/static/scripts/api/WU.js";
        wjs.parentNode.insertBefore(js, wjs);
		}(document, 'script', 'wutalent-jssdk'));

</script>

<script type="text/javascript" src="../js/SMS_2Way.js"></script>
<link rel="stylesheet" href="../SMS_2Way.css" type="text/css">

<body>
<?php 
// including required files
require_once('../config.inc.php');
require_once('/home/developers_sandbox/SMS_2Way_config.php');
require_once(SITE_URL.DEV.'libraries/textmagicAPI/TextMagicAPI.php');
?>

<!-- text message validation and sending-->
<?php 
$api = new TextMagicAPI(array(
			"username" => U_NAME,
			"password" => U_PASS, 
		));
//echo $results = $api->getBalance();

$feedback = "";
if(isset($_POST['msg_hide']))
{	
	
	// set message
 	$message = trim($_POST['message']);
	
	// set mobile number
	$mob_no = $_POST['contact_no'];
	//echo $mob_no = '919173575883';
	
	
	// check for mobile number format according to text magic API's standard
	$mob_no = preg_replace("/[^0-9]/", "", $mob_no);
	$fchar = trim(substr($mob_no, 0, 1));
		
	// checking for mobile no and message to send message : in failure responce error message.
	if($mob_no == "")
	{
		$feedback = "<p class='err'>No mobile number found!</p>";
	}else if($fchar == '0')
	{
		$feedback = "<p class='err'>Invalid mobile number. There should not be leading zero.</p>";
	}else if($message == "" || $message == "Type your SMS message here..." )
	{	
		$feedback = "<p class='err'>Please type your message!</p>";
	}else
	{
		$api = new TextMagicAPI(array(
			"username" => U_NAME,
			"password" => U_PASS,
		));
		
		$phones = array($mob_no);		
		$is_unicode = true;
		// send message via API		
		
		$results = $api->checkNumber($phones);			
		//print_r($results);
		
		$resp = $api->send($message, $phones, $is_unicode);
		
		//Fetching message id from response
		$key = array_search($mob_no, $resp['messages']);
		echo $key;		
		//checking message delivery status
		$results = $api->messageStatus(array($key));
		//print_r($results);

		$feedback = "<p class='success_msg'>success</p>";
	}
}?>


<!--html for message form start-->
<form method="Post" action="" name="sms_popup" id="sms_form" style="display:none;"/>
	<input type="hidden" name="signed_request" value="<?php print $_REQUEST['signed_request'] ?>"/>
	<input type="hidden" name="contact_no" id="cont_no" value="">
	<input type="hidden" name="credit_count" id="cred_count" value="">
	<input type="hidden" name="msg_hide">

	<textarea id="msg_area" class="textarea-med bronze" name="message" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" rows="6" cols="40" onkeyup="countChar(this)">Type your SMS message here...</textarea>

<!--for displaying credit count and success and failure message-->
<span id="char_count"><?php echo $feedback;?></span>

<input class="msg_submit" type="Submit" value="">
</form>
<!--html for message form end-->


</body>
</html>
