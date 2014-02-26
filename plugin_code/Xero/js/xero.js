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

function setCookie(cname,cvalue,exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires=" + d.toGMTString();
	document.cookie = cname + "=" + cvalue + "; " + expires;
}