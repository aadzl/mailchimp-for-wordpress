<?php

defined( 'ABSPATH' ) or exit;

/**
 * Adds MC4WP_Widget widget.
 */
class MC4WP_Form_Widget extends WP_Widget {

	/**
	 * @var array
	 */
	private $default_instance_settings = array(
		'title' => '',
		'form_id' => ''
	);

	/**
	 * Register widget with WordPress.
	 *
	 * @todo write upgrade routine for Base ID change
	 */
	function __construct() {

		// translate default widget title
		$this->default_instance_settings['title'] = __( 'Newsletter', 'mailchimp-for-wp' );

		parent::__construct(
			'mc4wp_form_widget', // Base ID
			__( 'MailChimp Sign-Up Form', 'mailchimp-for-wp' ), // Name
			array(
				'description' => __( 'Displays your MailChimp for WordPress sign-up form', 'mailchimp-for-wp' ),
			)
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array   $args     Widget arguments.
	 * @param array   $instance_settings Saved values from database.
	 */
	public function widget( $args, $instance_settings ) {

		$instance_settings = array_merge( $this->default_instance_settings, $instance_settings );
		$title = apply_filters( 'widget_title', $instance_settings['title'] );

		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		echo mc4wp_get_form( $instance_settings['form_id'] );

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $settings Previously saved values from database.
	 *
	 * @return string|void
	 */
	public function form( $settings ) {
		$settings = array_merge( $this->default_instance_settings, $settings );
		?>
        <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'mailchimp-for-wp' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $settings['title'] ); ?>" />
        </p>

		<?php do_action( 'mc4wp_form_widget_form', $settings, $this ); ?>

        <p class="help">
			<?php printf( __( 'You can edit your sign-up form in the <a href="%s">MailChimp for WordPress form settings</a>.', 'mailchimp-for-wp' ), admin_url( 'admin.php?page=mailchimp-for-wp-form-settings' ) ); ?>
        </p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array   $new_instance_settings Values just sent to be saved.
	 * @param array   $old_instance_settings Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance_settings, $old_instance_settings ) {

		if( ! empty( $new_instance_settings['title'] ) ) {
			$new_instance_settings['title'] = sanitize_text_field( $new_instance_settings['title'] );
		}

		$new_instance_settings = apply_filters( 'mc4wp_form_widget_sanitize_settings', $new_instance_settings, $old_instance_settings, $this );

		return $new_instance_settings;
	}

} // class MC4WP_Widget
