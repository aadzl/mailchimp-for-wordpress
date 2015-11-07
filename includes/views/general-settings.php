<?php
defined( 'ABSPATH' ) or exit;
?>
<div id="mc4wp-admin" class="wrap mc4wp-settings">

	<h1 class="page-title">
		<?php _e( 'MailChimp for WordPress', 'mailchimp-for-wp' ); ?>: <?php _e( 'MailChimp Settings', 'mailchimp-for-wp' ); ?>
	</h1>

	<div class="row">

		<!-- Main Content -->
		<div class="main-content col col-4">

			<?php settings_errors(); ?>

			<form action="<?php echo admin_url( 'options.php' ); ?>" method="post">
				<?php settings_fields( 'mc4wp_settings' ); ?>

				<h3>
					MailChimp <?php _e( 'API Settings', 'mailchimp-for-wp' ); ?>
				</h3>

				<table class="form-table">

					<tr valign="top">
						<th scope="row">
							<?php _e( 'Status', 'mailchimp-for-wp' ); ?>
						</th>
						<td>
							<?php if($connected) { ?>
								<span class="status positive"><?php _e( 'CONNECTED' ,'mailchimp-for-wp' ); ?></span>
							<?php } else { ?>
								<span class="status neutral"><?php _e( 'NOT CONNECTED', 'mailchimp-for-wp' ); ?></span>
							<?php } ?>
						</td>
					</tr>


					<tr valign="top">
						<th scope="row"><label for="mailchimp_api_key"><?php _e( 'API Key', 'mailchimp-for-wp' ); ?></label></th>
						<td>
							<input type="text" class="widefat" placeholder="<?php _e( 'Your MailChimp API key', 'mailchimp-for-wp' ); ?>" id="mailchimp_api_key" name="mc4wp[api_key]" value="<?php echo esc_attr( $opts['api_key'] ); ?>" />
							<p class="help">
								<?php _e( 'The API key for connecting with your MailChimp account.', 'mailchimp-for-wp' ); ?>
								<a target="_blank" href="https://admin.mailchimp.com/account/api"><?php _e( 'Get your API key here.', 'mailchimp-for-wp' ); ?></a>
							</p>
						</td>

					</tr>

				</table>

				<?php submit_button(); ?>

				<hr />

				<h3><?php _e( 'Usage Tracking', 'mailchimp-for-wp' ); ?></h3>
				<p>
					<label>
						<?php /* hidden input field to send `0` when checkbox is not checked */ ?>
						<input type="hidden" name="mc4wp[allow_usage_tracking]" value="0" />
						<input type="checkbox" name="mc4wp[allow_usage_tracking]" value="1" <?php checked( $opts['allow_usage_tracking'], 1 ); ?>>
						<?php echo sprintf( __( 'Allow us to anonymously track how this plugin is used to help us make it better fit your needs. <a href="%s">This is what we track</a>.', 'mailchimp-for-wp' ), 'https://mc4wp.com/kb/what-is-usage-tracking/#utm_source=wp-plugin&utm_medium=mailchimp-for-wp&utm_campaign=settings-page' ); ?>
					</label>
				</p>

				<?php submit_button(); ?>
			</form>

			<?php

			do_action( 'mc4wp_admin_after_general_settings' );

			if( $connected ) {
				echo '<hr />';
				include dirname( __FILE__ ) . '/parts/lists-overview.php';
			}

			include dirname( __FILE__ ) . '/parts/admin-footer.php';

			?>
		</div>

		<!-- Sidebar -->
		<div class="sidebar col col-2">
			<?php include dirname( __FILE__ ) . '/parts/admin-sidebar.php'; ?>
		</div>


	</div>

</div>

