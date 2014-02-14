window.wuAfterInit = function(wu) {        
    wu.Messenger.sendMessageToWU('user/profile', {}, function(response){
        alert( response.user );
    });
}