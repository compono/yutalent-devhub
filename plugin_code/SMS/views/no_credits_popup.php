<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
        <link rel="stylesheet" href="../SMS_2Way.css" type="text/css">
        <script src="../js/jquery.min.js"></script>
    </head>
    <script type="text/javascript">
        var wuDomain = 'www.yutalent.com';
        window.wuAfterInit = function(wu){
            var wuDomain = wu.Options.getOption('domain');
            console.log('wuDomain' + wuDomain);
            wu.sendMessageToWU('credits/getProductID', {}, function(response){
                console.log(response);
                console.log(document.getElementById('credit-link').href);
                document.getElementById('credit-link').href = '//' + wuDomain + '/a/cart/index/index/type/';
            });
        };
        window.wuAsyncInit = function(){
            WU.init({
                domain: wuDomain,
                signed_request: '<?php echo $_REQUEST['signed_request'];?>',
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
    </script>
    <body>
        <div>
            <p class="error-message">You dont have any SMS credit</p>
            <a href="#" class="update-btn" id="credit-link"><span>Buy Credit</span></a>
        </div>
    </body>
</html>