var wuObject;
var tinyMCE = null;
// add custome validator for tinyMce
jQuery.validator.addMethod("tinyMCEvalidator", function(value, element)
{
	if (tinyMCE.getInstanceById('full-description'))	// fi tiny mce editor is enable
		$('#full-description').val(tinyMCE.get('full-description').getContent());
	value = $('#full-description').val();
	if(value.length)	return true;
	else			return false;
}, "Please eneter mail content");
$(document).ready(function()
{
	$('a#enable-disable-editor').click(function()
	{
		if(tinyMCE)
		{
			if (tinyMCE.getInstanceById('full-description'))
			{
				tinyMCE.execCommand('mceFocus', false, 'full-description');          
				tinyMCE.execCommand('mceRemoveControl', false, 'full-description');
				$('#full-description').val($('#full-description').val().replace(/\<br\s*\/\>/g,"\n"));
				$(this).html('enable editor');
			}
			else
			{
				$('#full-description').val($('#full-description').val().replace(/\n/g,"<br />"));
				initTinyMceEditor();
				$(this).html('disable editor');
			}
			
		}
		else
		{
			$('#full-description').val($('#full-description').val().replace(/\n/g,"<br />"));
			initTinyMceEditor();
			$(this).html('disable editor');
		}
	});
	$("#rejectAuotRespond").validate({});								// add form validation initilize
	$('#full-description').rules("add", {tinyMCEvalidator: true});				// add validation for tiny mce editor
	$('#subject').rules("add", {required: true,messages:{required: "Please enter subject"}});				// add validation for subject
	$('#ownSmtp').click(function()										// remove validations from user's smtp setting
	{
		$('.userSmtpSetting').slideUp();
		$('#fromEmail').rules('remove');  
		$('#fromName').rules('remove');
		$('#hostServer').rules('remove'); 
		$('#userName').rules('remove'); 
		$('#password').rules('remove'); 
	});
	$('#customerSmtp').click(function()									// add validations from user's smtp setting
	{
		$('.userSmtpSetting').slideDown();
		$("#fromEmail").rules("add", {required: true,email:true,messages: {required: "Please enter sending email",email:'Please enter valid email'}});
		$("#fromName").rules("add", {required: true,messages: {required: "Please enter name"}});
		$("#hostServer").rules("add", {required: true,messages: {required: "Please enter host name"}});
		$("#userName").rules("add", {required: true,messages: {required: "Please enter user name"}});
		$("#password").rules("add", {required: true,messages: {required: "Please enter password"}});
		//$("#port").rules("add", {required: true,messages: {required: "Please enter port"}});										
	});
	
	$('#port').keyup(function()											// change smtp secure when user add value in port
	{
		var value = $(this).val();
		if(parseInt(value) == 465)		$('#smtpSSL').trigger('click');
		else if(parseInt(value) == 587)		$('#smtpTLS').trigger('click');
		else					$('#smtpNone').trigger('click');
	});

	$('#smtpSSL,#smtpTLS,#smtpNone').click(function()					// change port value when user choose smtp secure 
	{
		var smtpId = $(this).attr('id');
		if(smtpId == 'smtpSSL')			$('#port').val(465);
		else if(smtpId == 'smtpTLS')		$('#port').val(587);		
	});
});

window.wuAfterInit = function(wu)
{
	wuObject = wu;
	wu.Messenger.sendMessageToWU('storage/get-multiple',{ keys: ['useSmtp','fromEmail','fromName','hostServer','userName','password','port','mailContent','mailSubject','disableTinyMCE'] },function(response)		// get added information
	{
		console.log(response);
		var formData = new Array();
		$(response).each(function()
		{
			formData[this.key] = this.value[0];			
		});
		
		if(Object.keys(formData).length)
		{	// add added information in form
			(parseInt(formData['useSmtp'])) ? $('#ownSmtp').trigger('click') : $('#customerSmtp').trigger('click');
			$('#fromEmail').val(formData['fromEmail']);
			$('#fromName').val(formData['fromName']);
			$('#hostServer').val(formData['hostServer']);
			$('#userName').val(formData['userName']);
			$('#password').val(formData['password']);
			$('#subject').val((formData['mailSubject']).length ? formData['mailSubject'] : DEFAULT_SUBJECT);
			$('#port').val(formData['port']);
			$('#rejectAuotRespond').show();
			if(parseInt(formData['port']) == 465)		$('#smtpSSL').trigger('click');
			else if(parseInt(formData['port']) == 587)	$('#smtpTLS').trigger('click');
			else						$('#smtpNone').trigger('click');
			if(!(parseInt(formData['disableTinyMCE'])))
			{
				initTinyMceEditor();
				$('#full-description').val((formData['mailContent']));
				$('a#enable-disable-editor').html('disable editor');
			}
			else
			{
				$('#full-description').val(formData['mailContent'].replace(/\<br\s*\/\>/g,"\n"));
				$('a#enable-disable-editor').html('enable editor');
			}
		}
		if ($('#full-description').val().length == 0)	$('#full-description').val(DEFAULT_MAIL_CONTENT);
		$('#rejectAuotRespond').show();
		$('a#testSmtpConnection').click(function()		// test connection to check smtp setting
		{
			var self = $(this);
			$('#full-description').rules("remove");
			if(!self.hasClass('dull') && $('#rejectAuotRespond').valid())
			{
				wu.Messenger.sendMessageToWU('user/profile',{},
					function(userProfile)
					{
						var formData = new Array();
						formData['fromEmail'] 	= 	$('#fromEmail').val();
						formData['fromName'] 	= 	$('#fromName').val();
						formData['hostServer'] 	= 	$('#hostServer').val();
						formData['userName'] 	= 	$('#userName').val();
						formData['password'] 	= 	$('#password').val();
						formData['smtpNumber'] 	= 	$('#port').val();
						formData['mailContent'] = 	($('#full-description').val());
						formData['port']  	= 	$('[name="smtpNumber"]:checked').val();
						formData['name']  	= 	userProfile['first-name']+' '+userProfile['last-name'];
						
						var dataString = Object.keys(formData).map(function(x){return x+'='+formData[x];}).join('&');
						$.ajax(
						{
							type:'post',
							url:'sendEmail.php',
							data:dataString+'&testConnection=1',
							beforeSend:function()
							{self.addClass('dull');self.siblings('img').show();},
							complete:function()
							{self.removeClass('dull');self.siblings('img').hide();},
							success:function(response)
							{
								if(response == '1')
									statusMessage('Test connection succeed',false);
								else
									statusMessage(response,true);
							}
						});						
					}
				);
				$('#full-description').rules("add", {tinyMCEvalidator: true});	
				
			}
		});
	});
	$('#rejectAuotRespond').submit(function()		// submit the form
	{
		$('#full-description').rules("add", {tinyMCEvalidator: true});		
		if($(this).valid())
		{
			var formData = {};
			formData['useSmtp'] 	= 	$('input[name="useSmtp"]:checked').val();
			formData['fromEmail'] 	= 	$('#fromEmail').val();
			formData['fromName'] 	= 	$('#fromName').val();
			formData['hostServer'] 	= 	$('#hostServer').val();
			formData['userName'] 	= 	$('#userName').val();
			formData['password'] 	= 	$('#password').val();
			formData['port'] 	= 	$('#port').val();
			formData['mailContent'] = 	$('#full-description').val();
			formData['mailSubject']	= 	$('#subject').val();
			formData['mailContent']	= 	formData['mailContent'].replace(/\n/g,"<br />");
			formData['disableTinyMCE']= 	tinyMCE.getInstanceById('full-description') ? 0 : 1;
			var firstLine = formData['mailContent'].split(/<br\s*\//)[0];
			var firstWord = firstLine.split(' ')[0];
			if(firstLine.indexOf('Candidate') == -1 && firstLine.indexOf('candidate') == -1 && firstLine.indexOf('{name}') == -1)
				formData['mailContent'] = formData['mailContent'].replace(firstLine, $.trim(firstWord)+' Candidate');
			wu.Messenger.sendMessageToWU('storage/add-multiple',{append: false, pairs: formData},function(response)
			{
				statusMessage('Auto-reject settings have been saved',false);
			});
			if (!(tinyMCE.getInstanceById('full-description')))
				$('#full-description').val(formData['mailContent'].replace(/\<br\s*\/\>/g,"\n"));
			else
				$('#full-description').val(formData['mailContent']);
		}		
		return false;
	});
}

window.wuAsyncInit = function () {
	WU.init({
		domain: wuDomain,
		signed_request: $('#signed_request').val(),
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
	js.src = HTTP_SSL+'://'+wuDomain+'/static/scripts/api/WU.js';
	wjs.parentNode.insertBefore(js, wjs);
}(document, 'script', 'wutalent-jssdk'));

function statusMessage(msg,error)
{
	var message = {};
	message['title'] 	= error ? 'Error' : 'Success';
	message['message'] 	= msg;
	wuObject.Messenger.sendMessageToWU('showGrowl',message);
}

function initTinyMceEditor()
{
	$('textarea.tinymce').tinymce({setup:function(ed){ed.onInit.add(function(ed,evt){tinyMCE.dom.Event.add(ed.getDoc(),'blur',function(e){$('#full-description').blur();});});},script_url:HTTP_SSL+'://'+wuDomain+'/static/scripts/lib/tiny_mce/tiny_mce.js',forced_root_block:'',force_br_newlines:true,force_p_newlines:false,paste_auto_cleanup_on_paste:true,paste_remove_styles:true,paste_remove_styles_if_webkit:true,paste_strip_class_attributes:"all",paste_use_dialog:false,paste_remove_spans:true,paste_remove_styles:true,paste_retain_style_properties:'',paste_text_linebreaktype:'br',convert_newlines_to_brs:true,element_format:"xhtml",fix_list_elements:true,valid_elements:"br,em/i,strong/b,ul,ol,li",paste_preprocess:function(pl,o){o.content=o.content.replace(/<(p|div)\s?[^>]*?>\s*<br\s?\/?>\s*<\/(p|div)>/gi,'<br/>');o.content=o.content.replace(/<(p|div)\s?[^>]*?>/gi,'').replace(/<\/(p|div)>/gi,'<br/>');},theme:"advanced",plugins:"autoresize,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",theme_advanced_buttons1:"bold,italic,bullist,numlist",theme_advanced_toolbar_location:"top",theme_advanced_toolbar_align:"right",theme_advanced_statusbar_location:"bottom",theme_advanced_resizing:false,height:'200px'});
}