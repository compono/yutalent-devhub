<?php require_once('config.inc.php');
?><script>var wuDomain = '<?php echo WU_DOMAIN; ?>';
var DEFAULT_MAIL_CONTENT = '<?php echo DEFAULT_MAIL_CONTENT; ?>';
var DEFAULT_SUBJECT = '<?php echo DEFAULT_SUBJECT; ?>';
</script>
<?php require_once('views/smtpSettingForm.php');