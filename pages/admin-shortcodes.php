<div class="wrap t201plugin">
	<h2>
		Generate Shortcodes
		<a href="<?php print admin_url('admin.php?page=ct-all-clients'); ?>" class="add-new-h2">All Clients</a>&nbsp;&nbsp;
	</h2>

	<div id="message" class="updated below-h2 ct-msg ct_success_msg">
		<p>Shortcode has been generated.</p>
	</div>
	<div id="message" class="error below-h2 ct-msg ct_error_msg">
		<p>Issues generating shortcode.</p>
	</div>
	
	<div class="tbox">
		<div class="tbox-heading">
			<h3>Configure and Generate ShortCode</h3>
			<a href="http://labs.think201.com/plugin/clients" target="_blank" class="pull-right">Need help?</a>
		</div>
		<div class="tbox-body">
			<form name="ct-create-shortcode" id="ct-create-shortcode" action="#" method="post">		        
				<input type="hidden" name="action" value="ct_create_shortcode">
				<table class="form-table">

					<tr valign="top">
						<th scope="row">
							<label for="get">Show Clients:</label>
						</td>
						<td>
							<select name="get">
								<option value="all">All</option>
								<option value="featured">Featured</option>
								<option value="randomize">Randomize</option>
							</select>
						</td>
					</tr>

					<tr valign="top">
						<th scope="row">
							<label for="category">Client's Category:</label>
						</td>
						<td>
							<?php ct\getClientCatList(); ?>
						</td>
					</tr>					

					<tr valign="top">
						<th scope="row">
							<label for="style">Select Style</label>
						</td>
						<td>
							<select name="style">
								<option value="grid">Grid View</option>
								<option value="list">List of Clients</option>
								<option value="slider">Slider</option>
							</select>
						</td>
					</tr>

					<tr valign="top">
						<th scope="row">
							<label for="numclients">Number of Clients to show:</label>
						</td>
						<td>
							<input type="text" id="numclients" name="numclients" class="small-text" value="-1">
							<p>Leave default value -1 to show all</p>
						</td>
					</tr>										

					<tr valign="top">
						<th scope="row">
							<label for="numcols">Number of Columns for Grid:</label>
						</td>
						<td>
							<input type="text" id="numcols" name="numcols" class="small-text" value="3">
						</td>
					</tr>
<!-- 					<tr valign="top">
						<th scope="row">
							<label for="items">Details to show?:</label>
						</td>
						<td>
							<p>
								<input type="checkbox" name="showlogo" value="1">Logo of the client<br>
							</p>
							<p>
								<input type="checkbox" name="showname"  value="1">Name of the client<br>
							</p>
						</td>
					</tr> -->
<!-- 					<tr valign="top">
						<th scope="row">
							<label for="items">Link client's logo to URL?:</label>
						</td>
						<td>
							<p>
								<input type="checkbox" name="url[link]" value="1">Give link to client's Website?<br>
							</p>
							<p>
								<input type="checkbox" name="url[open]"  value="1" checked>On clicking Link - Open in New Window<br>
							</p>
						</td>
					</tr> -->
					<tr valign="top">
						<th scope="row">
							<label for="class">CSS Class to be added:</label>
						</td>
						<td>
							<input type="text" id="class" name="class">
						</td>
					</tr>
				</table>
				<div id="shortcode-holder"></div>
				<p class="submit">	    
					<button onClick="CTCreateShortCode.post('#ct-create-shortcode')" class="button button-primary" type="button">Generate Shortcode</button>
				</p>
			</form>

		</div>
		<div class="tbox-footer">
			Configure and generate shortcode to retrieve clients in dashboard
		</div>
	</div>
</div>