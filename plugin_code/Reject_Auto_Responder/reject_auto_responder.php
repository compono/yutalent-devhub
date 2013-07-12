<link href="https://www.wutalent.co.uk/static/styles/plugin/plugin.css" rel="stylesheet" />
<style>

#content{padding: 0 25px 25px; width: 95%;}
.red-title{float: left;padding-bottom: 50px;width: 100%;}
.radioDiv{text-align:center}
.text{padding-top:30px;}
ul,li{list-style:none}
.inner {font-size: 18px;padding-bottom: 8px;}
.inner li{display:inline-block;width:32%;margin-right:1%}
.inner li.last{margin-right:0}
.inner li input[type="text"]{  font-size: 18px;padding: 6px;width: 100%;}
/*::-webkit-input-placeholder { color:#AA9984 !important; }
::-moz-placeholder { color:#AA9984 !important; } /* firefox 19+ */
/*:-ms-input-placeholder { color:#AA9984 !important; } /* ie */
input:-moz-placeholder { color:#AA9984 !important; }
.save-auto{background: url("images/saveAutoResponder.png") no-repeat scroll -1px 0 transparent;display: block;height: 43px;margin-top: 14px;text-decoration: none;width: 367px;float:right}
.save-auto:hover{background: url("images/saveAutoResponder.png") no-repeat scroll -1px -43px transparent;}
.smtpSecure {padding-bottom: 30px;padding-top: 20px;}
.smtpSecure .standard-blue-link{font-size:18px;}
</style>
<div id="content">
	<span class="red-title">Email send method</span>
    <div class="radioDiv">
    	<label><input type="radio"/>Use system to send email</label>
        <label><input type="radio"/>Use my SMTP server to send email</label>
    </div>
    <div class="text">
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
                	<li><input type="text" placeholder="From email address..."/></li>
                    <li><input type="text" placeholder="Name to display..."/></li>
					<li class="last"><input type="text" placeholder="SMTP server..."/></li>
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
					<li><input type="text"/></li>
                    <li><input type="text"/></li>
					<li class="last"><input type="text"/></li>
                </ul>
            </li>
        </ul>
        <div class="smtpSecure">
        	<div class="goLeft"><a href="" class="standard-blue-link">Click to test connection...</a></div>
			<div class="goRight">
            	<span class="bronze">SMTP secure</span>
                <span class="">
                	<label><input type="radio"/>None</label>
                    <label><input type="radio"/>SSL</label>
                    <label><input type="radio"/>TLS</label>    
                </span>
			</div>
        </div>
        <div class="">
        	<a href="" class="save-auto"></a>
        </div>
    </div>
</div>