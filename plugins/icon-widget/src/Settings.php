<?php

namespace SeoThemes\IconWidget;

/**
 * Class Settings
 *
 * @package SeoThemes\IconWidget
 */
class Settings extends Service {

	/**
	 * Runs class hooks.
	 *
	 * @since 1.2.0
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
		add_action( 'admin_init', [ $this, 'settings_init' ] );

		$plugin_file = $this->plugin->handle . DIRECTORY_SEPARATOR . basename( $this->plugin->file );
		add_filter( 'plugin_action_links_' . $plugin_file, [ $this, 'action_links' ] );
	}

	/**
	 * Add settings menu item.
	 *
	 * @since 1.2.0
	 *
	 * @return void
	 */
	public function add_admin_menu() {
		add_options_page(
			$this->plugin->name,
			$this->plugin->name,
			'manage_options',
			'icon_widget',
			[ $this, 'options_page' ]
		);
	}

	/**
	 * Initialize settings.
	 *
	 * @since 1.2.0
	 *
	 * @return void
	 */
	public function settings_init() {
		register_setting( 'icon_widget_setting', 'icon_widget_settings' );

		add_settings_section(
			'icon_widget_section',
			'',
			'',
			'icon_widget_setting'
		);

		add_settings_field(
			'icon_widget_font',
			__( 'Icon font', 'icon-widget' ),
			[ $this, 'render_fonts' ],
			'icon_widget_setting',
			'icon_widget_section'
		);
	}

	/**
	 * Render select dropdown.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function render_fonts() {
		$options  = get_option( 'icon_widget_settings' );
		$selected = $options['font'] ? $options['font'] : 'font-awesome-5';
		$fonts    = Utils::get_fonts();

		echo '<select name="icon_widget_settings[font]">';

		foreach ( $fonts as $option ) {
			echo '<option value="' . $option . '" ' . selected( $selected, $option ) . '>' . ucwords( str_replace( '-', ' ', $option ) ) . '</option>';
		}

		echo '</select>';
	}

	/**
	 * Display options page.
	 *
	 * @since 1.2.0
	 *
	 * @return void
	 */
	public function options_page() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( $this->plugin->name ); ?></h1>
			<form action='options.php' method='post'>
				<?php
				settings_fields( 'icon_widget_setting' );
				do_settings_sections( 'icon_widget_setting' );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Adds plugin settings link.
	 *
	 * @since 1.2.0
	 *
	 * @param  array $links Plugin links.
	 *
	 * @return array
	 */
	public function action_links( $links ) {
		$settings[] = sprintf(
			'<a href="%s">%s</a>',
			admin_url( 'options-general.php?page=icon_widget' ),
			__( 'Settings', 'icon-widget' )
		);

		return array_merge( $links, $settings );
	}
}
