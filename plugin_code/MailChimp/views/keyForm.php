<?php /* Form to get key from user */?>

<span class="red-title">Your Mailchip API key</span>
<form action="<?php echo 'http'.($_SERVER['HTTPS'] == 'on'? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>" method="post" >
    <span class="margin-right-70">
        <label class="bronze-info goLeft " for="apikey">Api Key</label>
    </span>
    <span class="margin-right-60">
        <input type="text" name="apikey" id="apikey" value="<?php echo $_POST['apikey']; ?>" class="default-field goLeft "/>
    </span>
    <input type="hidden" name="signed_request" id="signed_request" value="<?php echo $_REQUEST['signed_request']; ?>" />     
    <span class="goLeft">
        <input class="update-btn goLeft " type="submit" value="UPDATE"/>
    </span>
    <span class="clearfix"></span>
</form>