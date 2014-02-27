<div id="content" class="small">
	<form action="<?php echo 'http'.($_SERVER['HTTPS'] == 'on'? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>" method="post">
		<input type="hidden" name="signed_request" value="<?php echo $_REQUEST['signed_request']; ?>" />
			<?php if (count($contacts_select)) : ?>
				<select name="xero_contact_id" id="select_xero_contact_id">
					<?php foreach ($contacts_select as $key => $value) : ?>
						<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php endforeach; ?>
				</select>
				<input type="button" id="save_xero_connection" value="Save" />
			<?php else : ?>
				<p>No contacts yet in your Xero organization</p>
			<?php endif; ?>
	</form>
</div>