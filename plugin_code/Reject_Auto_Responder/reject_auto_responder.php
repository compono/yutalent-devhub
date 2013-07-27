<?php require_once('config.inc.php');
?><script>var wuDomain = '<?php echo wuDomain; ?>';
var HTTP_SSL = '<?php echo HTTP_SSL; ?>';
var DEFAULT_MAIL_CONTENT = '<?php echo DEFAULT_MAIL_CONTENT; ?>';</script>
<?php require_once('views/smtpSettingForm.php');