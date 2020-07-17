<?php
/**
 * CROSS Theme Customizer
 *
 * @package CROSS
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cross_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'cross_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'cross_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'cross_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function cross_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function cross_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cross_customize_preview_js() {
	wp_enqueue_script( 'cross-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'cross_customize_preview_js' );


/* Dark mode
---------------------------------------------------------- */
add_action( 'customize_register', 'theme_customize_register' );
function theme_customize_register($wp_customize) {
	
    $wp_customize->add_section( 'theme_option', array(
        'title'          => 'テーマオプション',
        'priority'       => 100,
    ));
    
    $wp_customize->add_setting( 'logo_inline_svg', array(
    	'type' => 'option',
	));
    $wp_customize->add_control( 'logo_inline_svg', array(
		'settings'  => 'logo_inline_svg',
		'label'     => 'ロゴ画像（インラインSVG）',
		'section'   => 'theme_option',
		'type'      => 'text',
	));
	
	$wp_customize->add_setting( 'english_title', array(
    	'type' => 'option',
	));
    $wp_customize->add_control( 'english_title', array(
		'settings'  => 'english_title',
		'label'     => '英語表記',
		'section'   => 'theme_option',
		'type'      => 'text',
	));
}