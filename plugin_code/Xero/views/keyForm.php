<?php /* Form to get key from user */?>
<div id="content">
    <span class="red-title">Your Xero API keys</span>
    <form action="<?php echo 'http'.($_SERVER['HTTPS'] == 'on'? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>" method="post" id="xero_api_settings">
        <div class="form-element">
            <span class="label-holder">
                <label class="bronze-info goLeft " for="xero_consumer_key">Consumer Key</label>
            </span>
            <span class="margin-right-60">
                <input type="text" name="xero_consumer_key" id="xero_consumer_key" value="<?php echo $_POST['xero_consumer_key']; ?>" class="default-field goLeft "/>
            </span>
        </div>
        <div class="clearfix"></div>
        <div class="form-element">
            <span class="label-holder">
                <label class="bronze-info goLeft " for="xero_consumer_secret">Consumer Secret</label>
            </span>
            <span class="margin-right-60">
                <input type="text" name="xero_consumer_secret" id="xero_consumer_secret" value="<?php echo $_POST['xero_consumer_secret']; ?>" class="default-field goLeft "/>
            </span>
        </div>
        <div class="clearfix"></div>
        <input type="hidden" name="signed_request" id="signed_request" value="<?php echo $_REQUEST['signed_request']; ?>" />     
        <div class="form-element">
            <span class="goLeft">
                <input class="update-btn goLeft" id="submit-api" type="button" value="UPDATE"/>
            </span>
        </div>
        <span class="clearfix"></span>
    </form>
    <?php
        if ($init['success']) {
            echo '<div class="success">Successfully connected to organization "'.$init['organisation_name'].'".</div>';
        } else {
            echo '<div class="error">' . $init['error'] . '</div>';
        }
    ?>
</div>