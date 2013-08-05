<link href="<?php echo HTTP_SSL.'://'.wuDomain.'/static/styles/plugin/plugin.css'?>" rel="stylesheet" />
<link href="reject.css" rel="stylesheet" />
<link rel="stylesheet" href="https://www.wutalent.co.uk/static/styles/base.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo HTTP_SSL.'://'.wuDomain.'/static/scripts/lib/tiny_mce/jquery.tinymce.js'?>"></script>
<script src="jqueryValidate.js" type="text/javascript"></script>
<script src="reject.js" type="text/javascript"></script>
<div id="content">
<form name="rejectAuotRespond" id="rejectAuotRespond" method="post" style="display:none">
     <input type="hidden" id="signed_request" name="signed_request" value="<?php echo $_POST['signed_request'] ?>" />
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
                        <li>From name</li>
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
                <div class="goLeft">
                 <a href="javascript:void(0)" id="testSmtpConnection" class="standard-blue-link">Click to test connection...
                    </a>
                    <img class="loadingImage" src="images/loading.gif"/ >
</div>
                <div class="goRight">
                    <span class="bronze">SMTP secure</span>
                    <span class="">
                        <label><input type="radio" id="smtpNone" name="smtpNumber" value=""/>None</label>
                        <label><input type="radio" id="smtpSSL" name="smtpNumber" value="ssl"/>SSL</label>
                        <label><input type="radio" id="smtpTLS" name="smtpNumber" value="tls"/>TLS</label>
                    </span>
                </div>
            </div>
            
        </div>
	<div class="edit-yw-box">
		<label class="bronze" for="subject">Email subject</label>
		<input type="text" name="subject" id="subject"/>
	</div>
	<div class="edit-yw-box">
	<div class="goLeft">
		    <label class="tiny_mce-label bronze">Rejected candidate email template</label>
	</div>
<div class="goRight">
<a id="enable-disable-editor" href="javascript:void(0)" class="standard-blue-link">disbale editor</a></div>
            <div class="clear"></div>
            <textarea rows="10" cols="100" id="full-description" name="full-description" class="tinymce"></textarea>
        </div> <!-- edit-yw-box ends here -->
        <div class="">
            <input type="submit" name="submit" id="submit" class="save-auto" value="">
        </div>
</form>
</div>