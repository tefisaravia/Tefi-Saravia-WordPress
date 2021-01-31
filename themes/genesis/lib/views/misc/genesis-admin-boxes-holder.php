<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package StudioPress\Genesis
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

global $wp_meta_boxes;
?>
<div class="metabox-holder">
	<div class="postbox-container">
		<?php
		/**
		 * Fires inside meta box holder view, before the meta boxes.
		 *
		 * @since 1.8.0
		 *
		 * @param string $page_hook Page hook.
		 */
		do_action( 'genesis_admin_before_metaboxes', $this->pagehook );
		do_meta_boxes( $this->pagehook, 'main', null );
		if ( isset( $wp_meta_boxes[ $this->pagehook ]['column2'] ) ) {
			do_meta_boxes( $this->pagehook, 'column2', null );
		}

		/**
		 * Fires inside meta box holder view, after the meta boxes.
		 *
		 * @since 1.8.0
		 *
		 * @param string $page_hook Page hook.
		 */
		do_action( 'genesis_admin_after_metaboxes', $this->pagehook );
		?>
	</div>
</div>