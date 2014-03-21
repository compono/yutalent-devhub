window.wuAfterInit = function(wu)
{
        $('a').click(function(){
                wu.Messenger.sendMessageToWU('openUrl', {link: wuDomain+'/c/accounts/profile'} );
        });
}

window.wuAsyncInit = function ()
{
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
        js.src = wuDomain+'/static/scripts/api/WU.js';
        wjs.parentNode.insertBefore(js, wjs);
}(document, 'script', 'wutalent-jssdk'));