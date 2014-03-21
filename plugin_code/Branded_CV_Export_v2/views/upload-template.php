<div id="content">
	<h2 class="red mb-25">Your Word Doc template file</h2>
	<p class="bronze mb-50">Download the word doc file and make your own updates to create your own branded version</p>
	<div class="upload-form ml-130">
		<div class="mb-15"><b>Current file:</b> <a href="#">default-template.docx</a></div>
		<form enctype="multipart/form-data" method="post" id="file-upload-form">
			<div class="file_upload_outter">
				<input type="file" name="cv_template" id="cv_template" />
				<input type="hidden" name="signed_request" value="<?php echo $_REQUEST['signed_request']; ?>" />
			</div>
		</form>
	</div>
</div>