window.wuAfterInit = function(wu) {
	$('#connect_to_xero').click(function(){
		wu.Messenger.sendMessageToWU('event/popup', {popup : 'create'});
	});

	$('#add_new_xero').click(function(){
		wu.Messenger.sendMessageToWU('event/popup', {popup : 'add'});
	});

	$('#unlink_contact').click(function(){
		wu.Messenger.sendMessageToWU('event/unlink', {}, function(response){
			wu.Messenger.sendMessageToWU('refresh');
		});
	});
}

