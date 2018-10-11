<?php
if (isset($_GET['page']) && isset($_GET['clientid'])) {
	if ($_GET['page'] === 'ct-edit-client') {
		$update_id = $_GET['clientid'];
		$Client = ct\CTData::getClientInfo($update_id);
	} else {
		ct\ctRedirectTo('admin.php?page=ct-all-clients');
	}
} else {
	if (function_exists('ctRedirectTo')) {
		ct\ctRedirectTo('admin.php?page=ct-all-clients');
	} else {
		die('Do not have sufficient permission to access page.');
	}
}

?>

<div class="wrap t201plugin">
 	<h2>
 		Update
 		<a href="<?php print admin_url('admin.php?page=ct-all-clients');?>" class="add-new-h2">Back</a>
 	</h2>

	<div id="message" class="updated below-h2 ct-msg ct_success_msg">
		<p>Client has been added</p>
	</div>
	<div id="message" class="error below-h2 ct-msg ct_error_msg">
		<p>Client has been not added</p>
	</div>
 	<div class="tbox">
		<div class="tbox-heading">
			<h3><?php print $Client->name?></h3>
		  	<a href="https://github.com/Think201/wordpress-plugin-clients" target="_blank" class="pull-right">Need help?</a>
		</div>
		<div class="tbox-body">
			<form name="ct_add_form" id="ct_add_form" action="#" method="post">
	            <input type="hidden" name="action" value="page_add_new">
	            <input type="hidden" name="update" value="update">
	            <input type="hidden" name="update_id" value="<?php print $Client->id?>">
				<table class="form-table">
					<tr valign="top">
						<th scope="row">
		                    <label for="name">Name:</label>
						</td>
						<td>
							<input type="text" id="name" name="name" placeholder="Client Name" class="regular-text" data-validations="required" value="<?php print $Client->name?>">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
		                        <label for="url">URL:</label>
						</td>
						<td>
							<input type="text" id="url" name="url" placeholder="URL of Client's website" class="regular-text" value="<?php print $Client->url?>">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
		                        <label for="logo">Logo:</label>
						</td>
						<td>
							<img src="<?php print $Client->logo?>"><br>
							<input type="text" id="logo" name="logo" placeholder="Client Logo" class="regular-text" value="<?php print $Client->logo?>">
		                    <input id="upload_logo" class="button" type="button" value="Upload Logo" />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="name">List Order</label>
						</td>
						<td>
							<input type="text" id="listorder" name="listorder" placeholder="List Order 1-100" class="regular-text" value="<?php print $Client->listorder?>">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
		                    <label for="description">Description:</label>
						</td>
						<td>
		                    <textarea rows="4" cols="50" id="description" name="description" placeholder="Client Description"><?php print $Client->description?></textarea>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
		                        <label for="category">Category:</label>
						</td>
						<td>
							<?php ct\getClientCatList($Client->category);?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
		                        <label for="url">Featured:</label>
						</td>
						<td>
		                     	<input type="checkbox" name="isfeatured" id="isfeatured" value="1" <?php checked($Client->isfeatured, true, true);?>>Is Featured?<br>
						</td>
					</tr>
				</table>
				<p class="submit">
		        <button onClick="CTForm.post('#ct_add_form', true)" class="button button-primary" type="button">Update Client</button>
				</p>
		    </form>
		</div>

		<div class="tbox-footer">
		  Add client details. Make sure your cross check the details provided.
		</div>
	</div>
</div>
