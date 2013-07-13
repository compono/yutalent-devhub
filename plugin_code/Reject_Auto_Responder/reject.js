$(window).load(function()
{
	$('textarea.tinymce').tinymce({setup:function(ed){ed.onInit.add(function(ed,evt){tinyMCE.dom.Event.add(ed.getDoc(),'blur',function(e){$('#full-description').blur();});});},script_url:'https://www.wutalent.co.uk//static/scripts/lib/tiny_mce/tiny_mce.js',forced_root_block:'',force_br_newlines:true,force_p_newlines:false,paste_auto_cleanup_on_paste:true,paste_remove_styles:true,paste_remove_styles_if_webkit:true,paste_strip_class_attributes:"all",paste_use_dialog:false,paste_remove_spans:true,paste_remove_styles:true,paste_retain_style_properties:'',paste_text_linebreaktype:'br',convert_newlines_to_brs:true,element_format:"xhtml",fix_list_elements:true,valid_elements:"br,em/i,strong/b,ul,ol,li",paste_preprocess:function(pl,o){o.content=o.content.replace(/<(p|div)\s?[^>]*?>\s*<br\s?\/?>\s*<\/(p|div)>/gi,'<br/>');o.content=o.content.replace(/<(p|div)\s?[^>]*?>/gi,'').replace(/<\/(p|div)>/gi,'<br/>');},theme:"advanced",plugins:"autoresize,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",theme_advanced_buttons1:"bold,italic,bullist,numlist",theme_advanced_toolbar_location:"top",theme_advanced_toolbar_align:"right",theme_advanced_statusbar_location:"bottom",theme_advanced_resizing:false});
});
$(document).ready(function()
{
	
	$("#rejectAuotRespond").validate(
	{
		//rules:{full_description:{required:true}},
		//messages:{full_description:{required:'Please eneter mail content'}}	
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
