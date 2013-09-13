<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
        <script src="https://devhub.wutalent.co.uk/plugin_code/SMS/js/jquery.min.js"></script>
        <script type="text/javascript">
            window.wuAfterInit = function(wu){};
            var wuDomain = Options.getOption('domain');
            console.log(wuDomain);
            window.wuAsyncInit = function(){
                WU.init({
                    domain: wuDomain,
                    signed_request: '<?php echo $_REQUEST['signed_request'] ?>',
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
    </head>
    <body>
        <div>
            <p class="valid_err">You dont have any SMS credit</p>
        </div>
    </body>
</html>