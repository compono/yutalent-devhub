window.wuAfterInit = function(wu) {
	wu.Messenger.sendMessageToWU('event/unlink', {}, function(response){
		wu.Messenger.sendMessageToWU('refresh');
	});
}