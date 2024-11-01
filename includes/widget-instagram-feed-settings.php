<?php

// create option menu link

function wif_options_menu_link() {
	add_options_page(
		'Instagram Photo feed options',
		'Instagram Photo feed',
		'manage_options',
		'wif-options',
		'wif_options_content'
	);
}

// create content
function wif_options_content() {

	global $wif_options;

	if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
		$link = "https";
	else
		$link = "http";

	$link .= "://";

	$link .= $_SERVER['HTTP_HOST'];

	$link .= $_SERVER['REQUEST_URI'];

	// echo $link; 

	$redirect_url = $link;

	// 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	var_dump($wif_options);
?>

	<div class="wrap">
		<h2>Instagram Photo Feed Settings</h2>
		<p>Settings for the Instagram Photo feed plugin.</p>
		<form action="options.php" method="post">
			<?php settings_fields('wif_settings_group'); ?>
			<h2>Instagram Authentication</h2>
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="wif_settings[redirect_url]"><?php _e('Redirect URL', 'wif_domain'); ?></label></th>
						<td>
							<p class="description"><strong><?= $redirect_url ?></strong></p>
							<input type="text" name="wif_settings[redirect_url]" id="wif_settings[redirect_url]" value="<?= $redirect_url ?>" class="regular-text">
							<p class="description" id="wif_settings[redirect_url]"><?php _e('Add this URL into your instagram client redirect url field', 'wif_domain') ?></p>
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="wif_settings[client_id]"><?php _e('Client ID', 'wif_domain'); ?></label></th>
						<td>
							<input type="text" name="wif_settings[client_id]" id="wif_settings[client_id]" value="<?= $wif_options['client_id'] ?>" class="regular-text">
							<p class="description" id="wif_settings[client_id]"><?php _e('Get the client ID form Instagram app', 'wif_domain') ?></p>
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="wif_settings[authenticate]"><?php _e('Authenticate', 'wif_domain'); ?></label></th>
						<td>
							<a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo $wif_options['client_id']; ?>&redirect_uri=<?php echo $wif_options['redirect_url']; ?>&response_type=token&scope=public_content" class="button btn">Authenticate</a>
							<p class="description" id="wif_settings[authenticate]"><?php _e('IMPORTANT: Click this after you add the redirect url and the client ID', 'wif_domain') ?></p>
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="wif_settings[access_token]"><?php _e('Access Token', 'wif_domain'); ?></label></th>
						<td>
							<input type="text" name="wif_settings[access_token]" id="wif_settings[access_token]" value="<?= $wif_options['access_token'] ?>" class="regular-text">
							<p class="description" id="wif_settings[access_token]"><?php _e('Get this from the URL after you Authenticate', 'wif_domain') ?></p>
						</td>
					</tr>
				</tbody>
			</table>

			<h2>Widget Settings</h2>
			<p>frontend settings of widget</p>

			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="wif_settings[linked]"><?php _e('Link photo to Instagram', 'wif_domain'); ?></label></th>
						<td>

							<input type="checkbox" name="wif_settings[linked]" value="1" <?php checked('1', !empty($wif_options['linked']) ? 1 : 0); ?> />
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="wif_settings[page_caption]"><?php _e('Widget Title', 'wif_domain'); ?></label></th>
						<td>
							<input type="text" name="wif_settings[page_caption]" id="wif_settings[page_caption]" value="<?= $wif_options['page_caption'] ?>" class="regular-text">
							<p class="description" id="wif_settings[page_caption]"><?php _e('Title for widget', 'wif_domain') ?></p>
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="wif_settings[photoinrow]"><?php _e('Photo in row', 'wif_domain'); ?></label></th>
						<td>
							<?php
							if (empty($wif_options['photoinrow'])) {
								$wif_options['photoinrow'] = '3';
							}
							?>
							<input type="radio" name="wif_settings[photoinrow]" id="style1" value="3" <?php checked('3', $wif_options['photoinrow']); ?>>
							<label for="style1">3</label>

							<input type="radio" name="wif_settings[photoinrow]" id="style2" value="4" <?php checked('4', $wif_options['photoinrow']); ?>>
							<label for="style2">4</label>
						</td>
					</tr>

				</tbody>
			</table>
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button" value="<?php _e('Save Changes', 'wif-domain'); ?>">
			</p>
		</form>
	</div>

	<script type="text/javascript">
		// var accesstoken = document.getElementById("wif_settings[access_token]").value;

		var test = window.location.hash.replace("#", "$");
		// document.cookie = 'tag=' + test;
		var token = '<?php echo $wif_options['access_token']; ?>';
		// alert(token);
		var res = test.split("=");

		if (res[1] === "") {
			// alert('empty');
			var token = "";
			document.getElementById("wif_settings[access_token]").value = token;
		} else {
			// alert('not');
			// document.getElementById("wif_settings[access_token]").value = res[1];
			if (res === undefined || res.length == 0) {
				// alert(1);
				document.getElementById("wif_settings[access_token]").value = token;
			} else {
				// alert(res);
				if (res === undefined || res.length == 0 || res == "") {
					document.getElementById("wif_settings[access_token]").value = token;
				} else {
					document.getElementById("wif_settings[access_token]").value = res[1];

				}


			}
		}
	</script>

<?php
}

add_action('admin_menu', 'wif_options_menu_link');

// register settings 
function wif_register_settings() {
	register_setting('wif_settings_group', 'wif_settings');
}
add_action('admin_init', 'wif_register_settings');
