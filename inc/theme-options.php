<?php
/**
 * Setup the "Theme settings" page.
 * adapted from http://themeshaper.com/2010/06/03/sample-theme-options/
 * which was adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/
 *
 * @package Peanut Butter 2015
 */


add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'pb2015_options', 'pb2015_theme_options', 'theme_options_validate' );

	// Add options (possibly with defaults) if they haven't been created yet.
	$default_options = array(
		'dpl_version' => DPL_VERSION_DEFAULT,
		'hide_site_title' => null,
		'footer_type' => 'large', // see $pb2015_footer_types below
		'logo_link' => 'http://www.st-andrews.ac.uk/', // see $pb2015_footer_types below

		'unit_name' => 'University of St Andrews',
		'street_address' => 'College Gate
St Andrews
KY16 9AJ
Fife, Scotland, UK',
		'phone_number' => '+44 (0)1334 47 6161',
		'email' => '',
	);
	add_option('pb2015_theme_options', $default_options);
	
	// Ensure that each item in the defaults is set in the current options
	$current_options = get_option('pb2015_theme_options');
	$updated = false;
	foreach($default_options as $key => $val) {
		if (!array_key_exists($key,$current_options)) {
			$current_options[$key] = $val;
			$updated = true;
		}
	}
	if ($updated) {
		update_option('pb2015_theme_options',$current_options);
	}

}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'pb2015' ), __( 'Theme Options', 'pb2015' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create arrays for our select and radio options
 */
$pb2015_select_options = array(
	'0' => array(
		'value' =>	'0',
		'label' => __( 'Zero', 'pb2015' )
	),
	'1' => array(
		'value' =>	'1',
		'label' => __( 'One', 'pb2015' )
	),
	'2' => array(
		'value' => '2',
		'label' => __( 'Two', 'pb2015' )
	),
	'3' => array(
		'value' => '3',
		'label' => __( 'Three', 'pb2015' )
	),
	'4' => array(
		'value' => '4',
		'label' => __( 'Four', 'pb2015' )
	),
	'5' => array(
		'value' => '3',
		'label' => __( 'Five', 'pb2015' )
	)
);

$pb2015_footer_types = array(
	'large' => array(
		'value' => 'large',
		'label' => __( 'Large footer &mdash; show the footer widget areas and contact information ', 'pb2015' )
	),
	'small' => array(
		'value' => 'small',
		'label' => __( 'Small footer &mdash; show a slimmed down header', 'pb2015' )
	)
);

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $pb2015_select_options, $pb2015_footer_types;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . wp_get_theme() . __( ' Theme Options', 'pb2015' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'pb2015' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'pb2015_options' ); ?>
			<?php $options = get_option( 'pb2015_theme_options' ); ?>

			<table class="form-table">

				<?php
				/**
				 * DPL version number; 
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Pattern library version', 'pb2015' ); ?></th>
					<td>
						<input id="pb2015_theme_options[dpl_version]" class="regular-text" type="text" name="pb2015_theme_options[dpl_version]" value="<?php esc_attr_e( $options['dpl_version'] ); ?>" />
						<label class="description" for="pb2015_theme_options[dpl_version]"><?php _e( 'Enter a version number (e.g. "0.2.0") or branch name.', 'pb2015' ); ?></label>
					</td>
				</tr>


				<?php
				/**
				 * Hide site title
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Hide site title', 'sampletheme' ); ?></th>
					<td>
						<input id="pb2015_theme_options[hide_site_title]" name="pb2015_theme_options[hide_site_title]" type="checkbox" value="1" <?php array_key_exists('hide_site_title',$options) ? checked( '1', $options['hide_site_title'] ) : null ?> />
						<label class="description" for="pb2015_theme_options[hide_site_title]"><?php _e( 'Optionally hides the site title on all pages.', 'pb2015' ); ?></label>
					</td>
				</tr>


				<?php
				/**
				 * Toggle footer type
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Footer type', 'pb2015' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Radio buttons', 'pb2015' ); ?></span></legend>
						<?php

							$radio_setting = $options['footer_type'];
							foreach ( $pb2015_footer_types as $option ) {
								$checked = '';
								if ( $options['footer_type'] == $option['value'] ) {
									$checked = "checked=\"checked\"";
								}
								?>
								<label class="description"><input type="radio" name="pb2015_theme_options[footer_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?></label><br />
								<?php
							}
						?>
						</fieldset>
					</td>
				</tr>

				<?php
				/**
				 * Overide logo link URL
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Pattern library version', 'pb2015' ); ?></th>
					<td>
						<input id="pb2015_theme_options[logo_link]" class="regular-text" type="text" name="pb2015_theme_options[logo_link]" value="<?php esc_attr_e( $options['logo_link'] ); ?>" />
						<label class="description" for="pb2015_theme_options[logo_link]"><?php _e( 'Enter where you want the logo to link to; default is "http://www.st-andrews.ac.uk/"', 'pb2015' ); ?></label>
					</td>
				</tr>


			</table>


			<h3>Contact information</h3>

			<p>Values here show up in the footer, if large footer is chosen.</p>

			<table class="form-table">
				<?php
				/**
				 * Unit name 
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Unit name', 'pb2015' ); ?></th>
					<td>
						<input id="pb2015_theme_options[unit_name]" class="regular-text" type="text" name="pb2015_theme_options[unit_name]" value="<?php esc_attr_e( $options['unit_name'] ); ?>" />
						<label class="description" for="pb2015_theme_options[unit_name]"><?php _e( 'Enter the unit name', 'pb2015' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Street address
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Street address', 'pb2015' ); ?></th>
					<td>
						<textarea id="pb2015_theme_options[street_address]" class="large-text" cols="50" rows="10" name="pb2015_theme_options[street_address]"><?php echo esc_textarea( $options['street_address'] ); ?></textarea>
						<label class="description" for="pb2015_theme_options[street_address]"><?php _e( 'Enter the street address, separate with line breaks.', 'pb2015' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Phone number
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Phone number', 'pb2015' ); ?></th>
					<td>
						<input id="pb2015_theme_options[phone_number]" class="regular-text" type="text" name="pb2015_theme_options[phone_number]" value="<?php esc_attr_e( $options['phone_number'] ); ?>" />
						<label class="description" for="pb2015_theme_options[phone_number]"><?php _e( 'Enter the phone number', 'pb2015' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Email
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Email', 'pb2015' ); ?></th>
					<td>
						<input id="pb2015_theme_options[email]" class="regular-text" type="text" name="pb2015_theme_options[email]" value="<?php esc_attr_e( $options['email'] ); ?>" />
						<label class="description" for="pb2015_theme_options[email]"><?php _e( 'Enter the email address', 'pb2015' ); ?></label>
					</td>
				</tr>

			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'pb2015' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $pb2015_select_options, $pb2015_footer_types;

	// Say our text option must be safe text with no HTML tags
	$input['dpl_version'] = wp_filter_nohtml_kses( $input['dpl_version'] );
	$input['logo_link'] = wp_filter_nohtml_kses( $input['logo_link'] );
	$input['unit_name'] = wp_filter_nohtml_kses( $input['unit_name'] );
	$input['street_address'] = wp_filter_nohtml_kses( $input['street_address'] );
	$input['phone_number'] = wp_filter_nohtml_kses( $input['phone_number'] );
	$input['email'] = wp_filter_nohtml_kses( $input['email'] );

	return $input;
}

