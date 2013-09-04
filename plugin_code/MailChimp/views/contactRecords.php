<div class="wuplugin-title"></div>
<span class="red-title">Map contact records</span>
<div class="bronze-info">Map the contact record types to the mailing lists you have inside your MailChimp account. New contacts with emails will be automatically added to the mailing list.</div>
<div id="mapContentRecords"></div>
<?php /* Css and JS files require for select box and send the request to get and add teh data*/ ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="jquery.multiselect.js"></script>
<script type="text/javascript" src="mailchimp.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_SSL.'://'.wuDomain.'/static/styles/jquery-ui/jquery-ui.css'?>" />
<link href="<?php echo HTTP_SSL.'://'.wuDomain.'/static/styles/jquery-ui/jquery.multiselect.css';?>" rel="stylesheet" />