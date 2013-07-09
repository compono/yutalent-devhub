var categories = '';
window.wuAfterInit = function(wu)
{ 
	var keyArray = new Array();
	// get candidate contact record type.
	wu.Messenger.sendMessageToWU('candidates/categories', {}, function(response)
	{
		$('#mapContentRecords').empty();
		// process each category and preapre the html and add mailchimp list in select box
		$(response).each(function()
		{
			$(this).each(function()
			{
				if(this.visible)
				{
					$('#mapContentRecords').append('<p id="categories_'+this.id+'">'+
						'<span class="goLeft main">'+
							'<span class="black-title-large goLeft">'+this.name+'</span>'+
							'<span class="goLeft right">'+
								'<span class="bronze-info">updates:</span>'+
								'<select id="select'+this.id+'" name="select'+this.id+'" class="default-field bronze-info">'+mailChimpList+'</select>'+
							'</span>'+
						'</span>'+
						'<span class="clearfix"></span>'+
					'</p>');
				}
			});
		});
		//Add save button
		$('#mapContentRecords').append('<p>'+
			'<span class="goLeft main">'+
				'<span class="black-title-large goLeft"></span>'+
				'<span class="goLeft right input">'+
					'<input id="saveMailChimp" class="save-btn goLeft " type="button" value="SAVE"/>'+
				'</span>'+
			'</span>'+
			'<span class="clearfix"></span>'+
		'</p>');
		//add bronze-info class if user does not select any text otherwise remove the class
		$('select').change(function()
		{
			var selectText = $(this).siblings('button').find('span');
			if(!$(this).val())
				selectText.addClass('value');
			else
				selectText.removeClass('value');
		});		
		
		// save certain contact record type for mailchimp list
		$('#saveMailChimp').click(function()
		{
			//create array object to store data
			var arr = {};
			$('#mapContentRecords p[id]').each(function()
			{
				arr[$(this).attr('id')] = $(this).find('select option:selected').attr('webid');
			});
			//store all the categories record
			wu.Messenger.sendMessageToWU('storage/add-multiple',{append: false, pairs: arr});
		});
		
		/*get all the stored data when user has saved previously*/
		$('#mapContentRecords p[id]').each(function()
		{
			keyArray[keyArray.length] = $(this).attr('id');
		});
		// send the request to get all the stored previous data
		wu.Messenger.sendMessageToWU('storage/get-multiple',{ keys: keyArray }, function(response)
		{
			$('p#'+this.key).find('select option').removeAttr('selected');
			$(response).each(function(k,v)
			{
				var dropDown = $('p#'+this.key).find('select');
				dropDown.find('option').filter('[webid="'+this.value[0]+'"]').attr('selected','selected');
				dropDown.multiselect({ header:false,multiple: false,selectedList: 1});
				if(!dropDown.val())	dropDown.siblings('button').find('span').addClass('value');
			});
		});
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
	js.src = "//" + wuDomain + "/static/scripts/api/WU.js";
	wjs.parentNode.insertBefore(js, wjs);
}(document, 'script', 'wutalent-jssdk'));
