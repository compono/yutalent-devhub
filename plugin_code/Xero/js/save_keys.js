window.wuAfterInit = function(wu) {
	var form_keys = ['xero_consumer_key', 'xero_consumer_secret'];

	wu.Messenger.sendMessageToWU('storage/get-multiple', { keys: form_keys }, function(response) {
		console.log('multiple', response);
	});

	$('#submit-api').click(function(){
		wu.Messenger.sendMessageToWU('storage/add-multiple',{
	    append: false,
	    pairs: {
	        xero_consumer_key: $('#xero_consumer_key'),
	        xero_consumer_secret: $('#xero_consumer_secret')
	    }}, function(response) {
	        console.log( response);

	        wu.Messenger.sendMessageToWU('storage/get-multiple',{ keys: form_keys }, function(response) {
	            console.log('multiple', response);
	        });
	    });
	});
}