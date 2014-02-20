window.wuAfterInit = function(wu) {
	$('#connect_to_xero').click(function(){
		wu.Messenger.sendMessageToWU('event/popup', {popup : 'create'});
	});

	$('#add_new_xero').click(function(){
		wu.Messenger.sendMessageToWU('event/popup', {popup : 'add'});
	});
}

