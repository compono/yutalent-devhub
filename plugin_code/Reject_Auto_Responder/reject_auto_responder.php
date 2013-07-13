<link href="https://www.wutalent.co.uk/static/styles/plugin/plugin.css" rel="stylesheet" />
<link href="reject.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://www.wutalent.co.uk/static/scripts/lib/tiny_mce/jquery.tinymce.js"></script>
<script src="jqueryValidate.js" type="text/javascript"></script>
<script src="reject.js" type="text/javascript"></script>
<div id="content">
	<form name="rejectAuotRespond" id="rejectAuotRespond" method="post">
        <span class="red-title">Email send method</span>
        <div class="radioDiv">
            <label><input type="radio" id="ownSmtp" name="useSmtp" value="1" checked="checked"/>Use system to send email</label>
            <label><input type="radio" id="customerSmtp" name="useSmtp" value="0"/>Use my SMTP server to send email</label>
        </div>
        <div class="userSmtpSetting" style="display:none">
            <ul class="outer bronze">
                <li>
                    <ul class="inner">
                        <li>From</li>
                        <li>From Name</li>
                        <li class="last">Host</li>
                    </ul>
                </li>
                <li>
                    <ul class="inner">
                        <li><input type="text" placeholder="From email address..." name="fromEmail" id="fromEmail"/></li>
                        <li><input type="text" placeholder="Name to display..." name="fromName" id="fromName"/></li>
                        <li class="last"><input type="text" placeholder="SMTP server..." name="hostServer" id="hostServer"/></li>
                    </ul>
                </li>
                <li>
                    <ul class="inner">
                        <li>Username</li>
                        <li>Password</li>
                        <li class="last">Port</li>
                    </ul>
                </li>
                <li>
                    <ul class="inner">
                        <li><input type="text" id="userName" name="userName"/></li>
                        <li><input type="password" id="password" name="password"/></li>
                        <li class="last"><input type="text" id="port" name="port"/></li>
                    </ul>
                </li>
            </ul>
            <div class="smtpSecure">
                <div class="goLeft"><a href="" class="standard-blue-link">Click to test connection...</a></div>
                <div class="goRight">
                    <span class="bronze">SMTP secure</span>
                    <span class="">
                        <label><input type="radio" id="smtpNone" name="smtpNumber"/>None</label>
                        <label><input type="radio" id="smtpSSL" name="smtpNumber"/>SSL</label>
                        <label><input type="radio" id="smtpTLS" name="smtpNumber"/>TLS</label>
                    </span>
                </div>
            </div>
            
        </div>
		<div class="edit-yw-box">
            <label class="tiny_mce-label bronze">Full description</label>
            <div class="clear"></div>
            <textarea rows="10" cols="30" id="full-description" name="full-description" class="tinymce bronze"></textarea>
        </div> <!-- edit-yw-box ends here -->
        <div class="">
            <input type="submit" name="submit" id="submit" class="save-auto" value="">
        </div>
	</form>
</div>
