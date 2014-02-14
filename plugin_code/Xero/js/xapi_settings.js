window.wuAfterInit = function(wu) {
	var form_keys = ['xero_consumer_key', 'xero_consumer_secret'];

	wu.Messenger.sendMessageToWU('storage/get-multiple', { keys: form_keys }, function(response) {
		console.log('get', response);
	});

	$('#submit-api').click(function(){
		wu.Messenger.sendMessageToWU('storage/add-multiple',{
	    append: false,
	    pairs: {
	        xero_consumer_key: $('#xero_consumer_key').val(),
	        xero_consumer_secret: $('#xero_consumer_secret').val()
	    }}, function(response) {
	        console.log( response);

	        wu.Messenger.sendMessageToWU('storage/get-multiple',{ keys: form_keys }, function(response) {
	            console.log('get after save', response);
	            $('#xero_api_settings').submit();
	        });
	    });
	});
}