window.wuAfterInit = function(wu) {
	var key = 'yucontact_' + $('#xero_consumer_key').val() + '_' + $('#yu_contact_id').val();
	var value = $('#xero_contact_id').val();
	
	wu.Messenger.sendMessageToWU('storage/add', {key: key, value: value}, function(response){
        $('#content').html('<p>Contact successfully saved.</p>');
        window.setTimeout(function(){
        	wu.Messenger.sendMessageToWU('refresh');
        }, 1000);
    });
}