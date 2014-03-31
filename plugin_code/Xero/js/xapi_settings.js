window.wuAfterInit = function(wu) {
	var form_keys = ['xero_consumer_key', 'xero_consumer_secret'];

	//saving the keys to the storage
	$('#submit-api').click(function(){
		wu.Messenger.sendMessageToWU('storage/add-multiple',{
			append: false,
			pairs: {
				xero_consumer_key: $('#xero_consumer_key_input').val(),
				xero_consumer_secret: $('#xero_consumer_secret_input').val()
			}
		}, 
		function(response) {
			$('#xero_api_settings').submit();
		});
	});
}