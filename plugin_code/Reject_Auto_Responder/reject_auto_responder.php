<link href="https://www.wutalent.co.uk/static/styles/plugin/plugin.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script><script type="text/javascript" src="https://www.wutalent.co.uk/static/scripts/lib/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">$(document).load(function(){$('textarea.tinymce').tinymce({setup:function(ed){ed.onInit.add(function(ed,evt){tinyMCE.dom.Event.add(ed.getDoc(),'blur',function(e){$('#full-description').blur();});});},script_url:'https://www.wutalent.co.uk//static/scripts/lib/tiny_mce/tiny_mce.js',forced_root_block:'',force_br_newlines:true,force_p_newlines:false,paste_auto_cleanup_on_paste:true,paste_remove_styles:true,paste_remove_styles_if_webkit:true,paste_strip_class_attributes:"all",paste_use_dialog:false,paste_remove_spans:true,paste_remove_styles:true,paste_retain_style_properties:'',paste_text_linebreaktype:'br',convert_newlines_to_brs:true,element_format:"xhtml",fix_list_elements:true,valid_elements:"br,em/i,strong/b,ul,ol,li",paste_preprocess:function(pl,o){o.content=o.content.replace(/<(p|div)\s?[^>]*?>\s*<br\s?\/?>\s*<\/(p|div)>/gi,'<br/>');o.content=o.content.replace(/<(p|div)\s?[^>]*?>/gi,'').replace(/<\/(p|div)>/gi,'<br/>');},theme:"advanced",plugins:"autoresize,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",theme_advanced_buttons1:"bold,italic,bullist,numlist",theme_advanced_toolbar_location:"top",theme_advanced_toolbar_align:"right",theme_advanced_statusbar_location:"bottom",theme_advanced_resizing:false});});</script>
<!-- /TinyMCE -->
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
        <div class="edit-yw-box">
			<label class="tiny_mce-label bronze">Full description</label>
            <div class="clear"></div>
               <textarea rows="10" cols="20" id="full-description" name="description" class="tinymce bronze"></textarea>
            
            
        </div> <!-- edit-yw-box ends here -->

        <div class="">
        	<a href="" class="save-auto"></a>
        </div>
    </div>
</div>