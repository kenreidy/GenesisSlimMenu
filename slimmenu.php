<?php
// Start copy from line below
// and put it to your Child Theme functions.php



/* Based on original genesis_do_nav() function */
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_after_header', 'wpkits_do_nav' );
function wpkits_do_nav() {

	//* Do nothing if menu not supported
	if ( ! genesis_nav_menu_supported( 'primary' ) )
		return;

	//* If menu is assigned to theme location, output
	if ( has_nav_menu( 'primary' ) ) {

		$class = 'menu genesis-nav-menu slimmenu menu-primary';

		$args = array(
			'theme_location' => 'primary',
			'container'      => '',
			'menu_class'     => $class,
			'echo'           => 0,
		);

		$nav = wp_nav_menu( $args );

		//* Do nothing if there is nothing to show
		if ( ! $nav )
			return;

		$nav_markup_open = genesis_markup( array(
			'html5'   => '<nav %s>',
			'xhtml'   => '<div id="nav">',
			'context' => 'nav-primary',
			'echo'    => false,
		) );
		$nav_markup_open .= genesis_structural_wrap( 'menu-primary', 'open', 0 );

		$nav_markup_close  = genesis_structural_wrap( 'menu-primary', 'close', 0 );
		$nav_markup_close .= genesis_html5() ? '</nav>' : '</div>';

		$nav_output = $nav_markup_open . $nav . $nav_markup_close;

		echo apply_filters( 'genesis_do_nav', $nav_output, $nav, $args );

	}

}
