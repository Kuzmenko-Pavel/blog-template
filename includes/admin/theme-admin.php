<?php

add_action( 'admin_menu', 'theme_admin_add_page' );
function theme_admin_add_page() {
	add_theme_page( THEME_NAME . ' ' . __( 'Options' ), THEME_NAME . ' ' . __( 'Options' ), 'edit_theme_options', 'theme', 'theme_options_page' );
}

// Display admin options page
function theme_options_page() {
	$options = get_option( 'theme_options' );
	?>
    <div class="wrap zee_admin_wrap">

        <div class="icon32" id="icon-themes"></div>
        <h2><?php echo THEME_NAME; ?><?php _e( 'Options' ); ?></h2>

		<?php if ( isset( $_GET['settings-updated'] ) ) : ?>
            <div class='updated'><p><?php _e( 'Theme settings updated successfully.' ); ?></p></div>
		<?php endif; ?>

        <form class="zee_form" action="options.php" method="post">
            <p><input name="Submit" class="button-primary" type="submit"
                      value="<?php esc_attr_e( 'Save Changes' ); ?>"/>
            </p>

            <div class="zee_settings">
				<?php settings_fields( 'theme_options' ); ?>
				<?php do_settings_sections( 'theme' ); ?>
            </div>

            <p><input name="Submit" class="button-primary" type="submit"
                      value="<?php esc_attr_e( 'Save Changes' ); ?>"/>
            </p>
        </form>

    </div>

	<?php
}

// Display Setting Fields
function theme_display_setting( $setting = array() ) {
	$options = get_option( 'theme_options' );

	if ( ! isset( $options[ $setting['id'] ] ) ) {
		$options[ $setting['id'] ] = $setting['std'];
	}

	switch ( $setting['type'] ) {

		case 'text':
			echo "<input id='" . $setting['id'] . "' name='theme_options[" . $setting['id'] . "]' type='text' value='" . esc_attr( $options[ $setting['id'] ] ) . "' />";
			echo '<br/><label>' . $setting['desc'] . '</label>';
			break;

		case 'textarea':
			echo "<textarea id='" . $setting['id'] . "' name='theme_options[" . $setting['id'] . "]' rows='5'>" . esc_attr( $options[ $setting['id'] ] ) . "</textarea>";
			echo '<br/><label>' . $setting['desc'] . '</label>';
			break;

		case 'checkbox':
			echo "<input id='" . $setting['id'] . "' name='theme_options[" . $setting['id'] . "]' type='checkbox' value='true'";
			checked( $options[ $setting['id'] ], 'true' );
			echo ' /><label> ' . $setting['desc'] . '</label>';
			break;

		case 'select':
			echo "<select id='" . $setting['id'] . "' name='theme_options[" . $setting['id'] . "]'>";

			foreach ( $setting['choices'] as $value => $label ) {
				echo "<option " . selected( $options[ $setting['id'] ], $value ) . " value='" . $value . "' >" . $label . "</option>";
			}

			echo "</select>";
			echo '<br/><label>' . $setting['desc'] . '</label>';
			break;

		case 'radio':
			foreach ( $setting['choices'] as $value => $label ) {
				echo "<input id='" . $setting['id'] . "'";
				checked( $options[ $setting['id'] ], $value );
				echo " type='radio' name='theme_options[" . $setting['id'] . "]' value='" . $value . "'/> " . $label . "<br/>";
			}
			break;

		case 'logo':
			echo "<p id='zee-logo-bg'><img id='zee-logo-img' src='" . esc_attr( $options[ $setting['id'] ] ) . "' /></p>";
			echo "<input id='" . $setting['id'] . "' name='theme_options[" . $setting['id'] . "]' type='text' value='" . esc_attr( $options[ $setting['id'] ] ) . "' />";
			echo '<br/><label>' . $setting['desc'] . '</label>';
			break;

		case 'colorpicker':
			echo "#<input id='" . $setting['id'] . "' name='theme_options[" . $setting['id'] . "]' class='colorpickerfield' type='text' maxlength='6' value='" . esc_attr( $options[ $setting['id'] ] ) . "' />";
			echo '<br/><label>' . $setting['desc'] . '</label>';
			break;

		default:
			echo "<input id='" . $setting['id'] . "' name='theme_options[" . $setting['id'] . "]' size='40' type='text' value='" . esc_attr( $options[ $setting['id'] ] ) . "' />";
			echo '<br/><label>' . $setting['desc'] . '</label>';
			break;
	}
}

// Register Settings
add_action( 'admin_init', 'theme_register_settings' );
function theme_register_settings() {
	$theme_settings = theme_get_settings();
	$theme_sections = theme_get_sections();

	register_setting( 'theme_options', 'theme_options', 'theme_options_validate' );

	// Create Setting Sections
	foreach ( $theme_sections as $section ) {
		add_settings_section( $section['id'], $section['name'], 'theme_section_text', 'theme' );
	}

	// Create Setting Fields
	foreach ( $theme_settings as $setting ) {
		add_settings_field( $setting['id'], $setting['name'], 'theme_display_setting', 'theme', $setting['section'], $setting );
	}
}

// Validate Settings
function theme_options_validate( $input ) {
	$theme_settings = theme_get_settings();

	foreach ( $theme_settings as $setting ) {

		if ( $setting['type'] == 'checkbox' and ! isset( $input[ $setting['id'] ] ) ) {
			$options[ $setting['id'] ] = 'false';
		} elseif ( $setting['type'] == 'radio' and ! isset( $input[ $setting['id'] ] ) ) {
			$options[ $setting['id'] ] = 1;
		} else {
			$options[ $setting['id'] ] = esc_attr( trim( $input[ $setting['id'] ] ) );
		}
	}

	return $options;
}

function theme_section_text() {
}

?>