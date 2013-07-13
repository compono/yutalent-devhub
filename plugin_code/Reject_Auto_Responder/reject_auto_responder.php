<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="https://www.wutalent.co.uk/static/styles/plugin/plugin.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="jqueryValidate.js" type="text/javascript"></script>
<script type="text/javascript" src="https://www.wutalent.co.uk/static/scripts/lib/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
$(window).load(function()
{
	$('textarea.tinymce').tinymce({setup:function(ed){ed.onInit.add(function(ed,evt){tinyMCE.dom.Event.add(ed.getDoc(),'blur',function(e){$('#full-description').blur();});});},script_url:'https://www.wutalent.co.uk//static/scripts/lib/tiny_mce/tiny_mce.js',forced_root_block:'',force_br_newlines:true,force_p_newlines:false,paste_auto_cleanup_on_paste:true,paste_remove_styles:true,paste_remove_styles_if_webkit:true,paste_strip_class_attributes:"all",paste_use_dialog:false,paste_remove_spans:true,paste_remove_styles:true,paste_retain_style_properties:'',paste_text_linebreaktype:'br',convert_newlines_to_brs:true,element_format:"xhtml",fix_list_elements:true,valid_elements:"br,em/i,strong/b,ul,ol,li",paste_preprocess:function(pl,o){o.content=o.content.replace(/<(p|div)\s?[^>]*?>\s*<br\s?\/?>\s*<\/(p|div)>/gi,'<br/>');o.content=o.content.replace(/<(p|div)\s?[^>]*?>/gi,'').replace(/<\/(p|div)>/gi,'<br/>');},theme:"advanced",plugins:"autoresize,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",theme_advanced_buttons1:"bold,italic,bullist,numlist",theme_advanced_toolbar_location:"top",theme_advanced_toolbar_align:"right",theme_advanced_statusbar_location:"bottom",theme_advanced_resizing:false});
});
$(document).ready(function()
{
	
	$("#rejectAuotRespond").validate(
	{
		rules:{full_description:{required:true}},
		messages:{full_description:{required:'Please eneter mail content'}}	
	});
	$('#ownSmtp').click(function()
	{
		$('.userSmtpSetting').slideUp();
		$('#fromEmail,#fromName,#hostServer,#userName,#password').rules('remove');  
	});
	$('#customerSmtp').click(function()
	{
		$('.userSmtpSetting').slideDown();
		$("#fromEmail").rules("add", {required: true,email:true,messages: {required: "Please enter sending email",email:'Please enter valid email'}});
		$("#fromName").rules("add", {required: true,messages: {required: "Please enter name"}});
		$("#hostServer").rules("add", {required: true,messages: {required: "Please enter host name"}});
		$("#userName").rules("add", {required: true,messages: {required: "Please enter user name"}});
		$("#password").rules("add", {required: true,messages: {required: "Please enter password"}});
		//$("#port").rules("add", {required: true,messages: {required: "Please enter port"}});										
	});
	
	$('#port').keyup(function()
	{
		var value = $(this).val();
		if(parseInt(value) == 485)		$('#smtpSSL').trigger('click');
		else if(parseInt(value) == 587)	$('#smtpTLS').trigger('click');
		else							$('#smtpNone').trigger('click');
	});

	$('#smtpSSL,#smtpTLS,#smtpNone').click(function()
	{
		var smtpId = $(this).attr('id');
		if(smtpId == 'smtpSSL')			$('#port').val(485);
		else if(smtpId == 'smtpTLS')	$('#port').val(587);
		else 							$('#port').val('');
	});
});

</script>
<style>
#content{padding: 0 25px 25px; width: 95%;}
.red-title{float: left;padding-bottom: 50px;width: 100%;}
.radioDiv{text-align:center}
.userSmtpSetting{padding-top:30px;}
ul,li{list-style:none}
.inner {font-size: 18px;padding-bottom: 8px;}
.inner li{display:inline-block;width:32%;margin-right:1%}
.inner li.last{margin-right:0}
.inner li input[type="text"],.inner li input[type="password"]{  font-size: 18px;padding: 6px;width: 100%;}
::-webkit-input-placeholder { color:#AA9984 !important; }
::-moz-placeholder { color:#AA9984 !important; } /* firefox 19+ */
:-ms-input-placeholder { color:#AA9984 !important; } /* ie */
input:-moz-placeholder { color:#AA9984 !important; }
.save-auto{background: url("images/saveAutoResponder.png") no-repeat scroll -1px 0 transparent;display: block;height: 43px;margin-top: 14px;text-decoration: none;width: 367px;float:right}
.save-auto:hover{background: url("images/saveAutoResponder.png") no-repeat scroll -1px -43px transparent;}
.smtpSecure {padding-bottom: 30px;padding-top: 20px;}
.smtpSecure .standard-blue-link{font-size:18px;}
.edit-yw-box{margin-top:20px}
.error{color:red;font-size:13px}
</style>
</head>
<body>
<div id="content">
	<form name="rejectAuotRespond" id="rejectAuotRespond" method="post">
        <span class="red-title">Email send method</span>
        <div class="radioDiv">
            <label><input type="radio" id="ownSmtp" name="useSmtp" value="1" checked="checked"/>Use system to send email</label>
            <label><input type="radio" id="customerSmtp" name="useSmtp" value="0"/>Use my SMTP server to send email</label>
        </div>
        <div class="userSmtpSetting" style="display:none">
            <ul class="outer bronze">
                <li>
                    <ul class="inner">
                        <li>From</li>
                        <li>From Name</li>
                        <li class="last">Host</li>
                    </ul>
                </li>
                <li>
                    <ul class="inner">
                        <li><input type="text" placeholder="From email address..." name="fromEmail" id="fromEmail"/></li>
                        <li><input type="text" placeholder="Name to display..." name="fromName" id="fromName"/></li>
                        <li class="last"><input type="text" placeholder="SMTP server..." name="hostServer" id="hostServer"/></li>
                    </ul>
                </li>
                <li>
                    <ul class="inner">
                        <li>Username</li>
                        <li>Password</li>
                        <li class="last">Port</li>
                    </ul>
                </li>
                <li>
                    <ul class="inner">
                        <li><input type="text" id="userName" name="userName"/></li>
                        <li><input type="password" id="password" name="password"/></li>
                        <li class="last"><input type="text" id="port" name="port"/></li>
                    </ul>
                </li>
            </ul>
            <div class="smtpSecure">
                <div class="goLeft"><a href="" class="standard-blue-link">Click to test connection...</a></div>
                <div class="goRight">
                    <span class="bronze">SMTP secure</span>
                    <span class="">
                        <label><input type="radio" id="smtpNone" name="smtpNumber"/>None</label>
                        <label><input type="radio" id="smtpSSL" name="smtpNumber"/>SSL</label>
                        <label><input type="radio" id="smtpTLS" name="smtpNumber"/>TLS</label>
                    </span>
                </div>
            </div>
        </div>
         <div class="edit-yw-box">
            <label class="tiny_mce-label bronze">Full description</label>
            <div class="clear"></div>
            <textarea rows="10" cols="28" id="full_description" name="full_description" class="tinymce bronze"></textarea>
        </div> <!-- edit-yw-box ends here -->
        <div class="">
            <input type="submit" name="submit" id="submit" class="save-auto" value="">
        </div>
	</form>
</div>
</body>
</html>