<?php
/**
 * CROSS functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CROSS
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.2.0' );
}

if ( ! function_exists( 'cross_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function cross_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on CROSS, use a find and replace
		 * to change 'cross' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'cross', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'cross' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'cross_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'cross_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cross_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'cross_content_width', 640 );
}
add_action( 'after_setup_theme', 'cross_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cross_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'cross' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'cross' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'cross_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cross_scripts() {
		
	// Google Fonts
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&family=Orbitron&display=swap', array(), _S_VERSION );
	
	// Font Awesome 5
	//wp_enqueue_style( 'font-awesome-5', 'https://use.fontawesome.com/releases/v5.13.0/css/all.css', array(), "5.13.0" );
	
	wp_enqueue_style( 'cross-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'cross-style', 'rtl', 'replace' );


	// WordPress提供のjquery.jsを読み込まない
	wp_deregister_script('jquery');
	// jQuery.js
	wp_enqueue_script( 'cross-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', array(), "2.2.4", true );
	
	wp_enqueue_script( 'cross-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'cross-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), _S_VERSION, true );
	
	wp_enqueue_script( 'cross-cookie', 'https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js', array(), "3.0.0", true );
	
	wp_enqueue_script( 'cross-plugin', get_template_directory_uri() . '/js/plugin.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cross_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/*-----------------------------------------------------------------------------------*/
/* Remove Tag
/*-----------------------------------------------------------------------------------*/
// WordPressバージョン情報の削除
remove_action('wp_head', 'wp_generator');
// ショートリンクURLの削除
remove_action('wp_head', 'wp_shortlink_wp_head');
// wlwmanifestの削除
remove_action('wp_head', 'wlwmanifest_link');
// application/rsd+xmlの削除
remove_action('wp_head', 'rsd_link');
// RSSフィードのURLの削除
remove_action('wp_head', 'feed_links_extra', 3);
// oEmbed関連のタグを削除
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
// emoji関連のタグを削除
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// メニューのクラスを削除する
add_filter( 'nav_menu_css_class', 'my_custom_nav', 10, 2 );
function my_custom_nav( $classes, $item ) {
 
    if( !empty( $classes[0] ) ){
        $custom_class = esc_attr( $classes[0] );
    }
     
    $classes = array();
    if( $item -> current == true ) {
        $classes[] = 'current';
    }
    if( !empty( $custom_class ) ){
        $classes[] = $custom_class;
    }
    return $classes;
}
// メニューのIDを削除
add_filter('nav_menu_item_id', 'removeId', 10);
function removeId( $id ){ 
    return $id = array(); 
}
// the_archive_title 余計な文字を削除
add_filter( 'get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('',false);
    } elseif (is_tag()) {
        $title = single_tag_title('#',false);
	} elseif (is_tax()) {
	    $title = single_term_title('',false);
	} elseif (is_post_type_archive() ){
		$title = post_type_archive_title('',false);
	} elseif (is_date()) {
	    $title = get_the_time('Y年n月');
	} elseif (is_search()) {
	    $title = '検索結果：'.esc_html( get_search_query(false) );
	} elseif (is_404()) {
	    $title = '「404」ページが見つかりません';
	} else {

	}
    return $title;
});
//ウィジェットのタイトルを「!」で非表示
add_filter( 'widget_title', 'remove_widget_title' );
function remove_widget_title( $widget_title ) {
  if ( substr ( $widget_title, 0, 1 ) == '!' )
    return;
  else 
    return ( $widget_title );
}

/*-----------------------------------------------------------------------------------*/
/* Breadcrumb
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'custom_breadcrumb' ) ) {
    function custom_breadcrumb( $wp_obj = null ) {

        // トップページでは何も出力しない
        if ( is_home() || is_front_page() ) return false;

        //そのページのWPオブジェクトを取得
        $wp_obj = $wp_obj ?: get_queried_object();

        echo '<nav id="breadcrumb">'.  //id名などは任意で
                '<ul class="breadcrumb">'.
                    '<li>'.
                        '<a href="'. home_url() .'"><span>Home</span></a>'.
                    '</li>';

        if ( is_attachment() ) {

            /**
             * 添付ファイルページ ( $wp_obj : WP_Post )
             * ※ 添付ファイルページでは is_single() も true になるので先に分岐
             */
            echo '<li><span>'. $wp_obj->post_title .'</span></li>';

        } elseif ( is_single() ) {

            /**
             * 投稿ページ ( $wp_obj : WP_Post )
             */
            $post_id    = $wp_obj->ID;
            $post_type  = $wp_obj->post_type;
            $post_title = $wp_obj->post_title;

            // カスタム投稿タイプかどうか
            if ( $post_type !== 'post' ) {

                $the_tax = "";  //そのサイトに合わせ、投稿タイプごとに分岐させて明示的に指定してもよい

                // 投稿タイプに紐づいたタクソノミーを取得 (投稿フォーマットは除く)
                $tax_array = get_object_taxonomies( $post_type, 'names');
                foreach ($tax_array as $tax_name) {
                    if ( $tax_name !== 'post_format' ) {
                        $the_tax = $tax_name;
                        break;
                    }
                }

                //カスタム投稿タイプ名の表示
                echo '<li>'.
                        '<a href="'. get_post_type_archive_link( $post_type ) .'">'.
                            '<span>'. get_post_type_object( $post_type )->label .'</span>'.
                        '</a>'.
                     '</li>';

            } else {
                $the_tax = 'category';  //通常の投稿の場合、カテゴリーを表示
            }

            // タクソノミーが紐づいていれば表示
            if ( $the_tax !== "" ) {

                $child_terms = array();   // 子を持たないタームだけを集める配列
                $parents_list = array();  // 子を持つタームだけを集める配列

                // 投稿に紐づくタームを全て取得
                $terms = get_the_terms( $post_id, $the_tax );

                if ( !empty( $terms ) ) {

                    //全タームの親IDを取得
                    foreach ( $terms as $term ) {
                        if ( $term->parent !== 0 ) $parents_list[] = $term->parent;
                    }

                    //親リストに含まれないタームのみ取得
                    foreach ( $terms as $term ) {
                        if ( ! in_array( $term->term_id, $parents_list ) ) $child_terms[] = $term;
                    }

                    // 最下層のターム配列から一つだけ取得
                    $term = $child_terms[0];

                    if ( $term->parent !== 0 ) {

                        // 親タームのIDリストを取得
                        $parent_array = array_reverse( get_ancestors( $term->term_id, $the_tax ) );

                        foreach ( $parent_array as $parent_id ) {
                            $parent_term = get_term( $parent_id, $the_tax );
                            echo '<li>'.
                                    '<a href="'. get_term_link( $parent_id, $the_tax ) .'">'.
                                      '<span>'. $parent_term->name .'</span>'.
                                    '</a>'.
                                 '</li>';
                        }
                    }

                    // 最下層のタームを表示
                    echo '<li>'.
                            '<a href="'. get_term_link( $term->term_id, $the_tax ). '">'.
                              '<span>'. $term->name .'</span>'.
                            '</a>'.
                         '</li>';
                }
            }

            // 投稿自身の表示
            echo '<li><span>'. $post_title .'</span></li>';

        } elseif ( is_page() ) {

            /**
             * 固定ページ ( $wp_obj : WP_Post )
             */
            $page_id    = $wp_obj->ID;
            $page_title = $wp_obj->post_title;

            // 親ページがあれば順番に表示
            if ( $wp_obj->post_parent !== 0 ) {
                $parent_array = array_reverse( get_post_ancestors( $page_id ) );
                foreach( $parent_array as $parent_id ) {
                    echo '<li>'.
                            '<a href="'. get_permalink( $parent_id ).'">'.
                                '<span>'.get_the_title( $parent_id ).'</span>'.
                            '</a>'.
                         '</li>';
                }
            }
            // 投稿自身の表示
            echo '<li><span>'. $page_title .'</span></li>';

        } elseif ( is_post_type_archive() ) {

            /**
             * 投稿タイプアーカイブページ ( $wp_obj : WP_Post_Type )
             */
            echo '<li><span>Design Archives</span></li>';

        } elseif ( is_date() ) {

            /**
             * 日付アーカイブ ( $wp_obj : null )
             */
            $year  = get_query_var('year');
            $month = get_query_var('monthnum');
            $day   = get_query_var('day');

            if ( $day !== 0 ) {
                //日別アーカイブ
                echo '<li><a href="'. get_year_link( $year ).'"><span>'. $year .'年</span></a></li>'.
                     '<li><a href="'. get_month_link( $year, $month ). '"><span>'. $month .'月</span></a></li>'.
                     '<li><span>'. $day .'日</span></li>';

            } elseif ( $month !== 0 ) {
                //月別アーカイブ
                echo '<li><a href="'. get_year_link( $year ).'"><span>'.$year.'年</span></a></li>'.
                     '<li><span>'.$month . '月</span></li>';

            } else {
                //年別アーカイブ
                echo '<li><span>'.$year.'年</span></li>';

            }

        } elseif ( is_author() ) {

            /**
             * 投稿者アーカイブ ( $wp_obj : WP_User )
             */
            echo '<li><span>'. $wp_obj->display_name .' の執筆記事</span></li>';

        } elseif ( is_archive() ) {

            /**
             * タームアーカイブ ( $wp_obj : WP_Term )
             */
            $term_id   = $wp_obj->term_id;
            $term_name = $wp_obj->name;
            $tax_name  = $wp_obj->taxonomy;

            /* ここでタクソノミーに紐づくカスタム投稿タイプを出力しても良いでしょう。 */

            // 親ページがあれば順番に表示
            if ( $wp_obj->parent !== 0 ) {

                $parent_array = array_reverse( get_ancestors( $term_id, $tax_name ) );
                foreach( $parent_array as $parent_id ) {
                    $parent_term = get_term( $parent_id, $tax_name );
                    echo '<li>'.
                            '<a href="'. get_term_link( $parent_id, $tax_name ) .'">'.
                                '<span>'. $parent_term->name .'</span>'.
                            '</a>'.
                         '</li>';
                }
            }

            // ターム自身の表示
            echo '<li>'.
                    '<span>'. $term_name .'</span>'.
                '</li>';


        } elseif ( is_search() ) {

            /**
             * 検索結果ページ
             */
            echo '<li><span>「'. get_search_query() .'」で検索した結果</span></li>';

        
        } elseif ( is_404() ) {

            /**
             * 404ページ
             */
            echo '<li><span>お探しの記事は見つかりませんでした。</span></li>';

        } else {

            /**
             * その他のページ（無いと思うが一応）
             */
            echo '<li><span>'. get_the_title() .'</span></li>';
        }

        echo '</ul></nav>';  // 冒頭に合わせて閉じタグ

    }
}

/*-----------------------------------------------------------------------------------*/
/* Pagination
/*-----------------------------------------------------------------------------------*/
function pagination($pages = '') {

	global $paged;
	if(empty($paged)) $paged = 1;

	if($pages == '')  {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages) {
			$pages = 1;
		}
	}

	if(1 != $pages) {
		echo '<nav class="pagenation">';
		echo '<ul class="pager">';
		echo '<li class="page-number">' .$paged.' / '.$pages. '</li>';
		//Prev：現在のページ値が１より大きい場合は表示
		if($paged > 1) echo '<li class="prev"><a href="'.get_pagenum_link($paged - 1).'"></a></li>';

		for ($i=1; $i <= $pages; $i++) {
			//三項演算子での条件分岐
			echo ($paged == $i)? '<li class="current">'.$i.'</li>':'<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
		//Next：総ページ数より現在のページ値が小さい場合は表示
		if ($paged < $pages) echo '<li class="next"><a href="'.get_pagenum_link($paged + 1).'"></a></li>';
		echo '</ul>';
		echo '</nav>';
	}
}

/*-----------------------------------------------------------------------------------*/
/* OGPタグの出力
/*-----------------------------------------------------------------------------------*/
function my_meta_ogp() {
  if( is_front_page() || is_home() || is_singular() || is_archive() ){
    global $post;
    $ogp_title = '';
    $ogp_descr = '';
    $ogp_url = '';
    $ogp_img = '';
    $insert = '';

    if( is_singular() ) {
       setup_postdata($post);
       $ogp_title = $post->post_title;
       $ogp_descr = mb_substr(get_the_excerpt(), 0, 100);
       $ogp_url = get_permalink();
       wp_reset_postdata();
    } elseif ( is_front_page() || is_home() || is_archive() ) {
       $ogp_title = get_bloginfo('name');
       $ogp_descr = get_bloginfo('description');
       $ogp_url = home_url();
    }

    //og:type
    $ogp_type = ( is_front_page() || is_home() || is_archive() ) ? 'website' : 'article';

    //og:image
    if ( is_singular() && has_post_thumbnail() ) {
		$ps_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-list-slider');
		$ogp_img = $ps_thumb[0];
    } else {
		$ogp_img = esc_url($ogp_url).'/wp-content/themes/cross/img/ogp.png';
	}

    //出力するOGPタグをまとめる
    $insert .= '<meta property="og:title" content="'.esc_attr($ogp_title).'">' . "\n";
    $insert .= '<meta property="og:description" content="'.esc_attr($ogp_descr).'">' . "\n";
    $insert .= '<meta property="og:type" content="'.$ogp_type.'">' . "\n";
    $insert .= '<meta property="og:url" content="'.esc_url($ogp_url).'">' . "\n";
    $insert .= '<meta property="og:image" content="'.esc_url($ogp_img).'">' . "\n";
    $insert .= '<meta property="og:site_name" content="'.esc_attr(get_bloginfo('name')).'">' . "\n";
    $insert .= '<meta property="og:locale" content="ja_JP">' . "\n";
    $insert .= '<meta property="fb:app_id" content="597235134471842">' . "\n";

    echo $insert;
  }
} //END my_meta_ogp

add_action('wp_head','my_meta_ogp');//headにOGPを出力

/**
 * Meta Descriptionの出力
 */
function get_description() {
  if(is_single()) {

    $description = get_the_excerpt();
  }

  if(empty($description)) {
    $description = bloginfo('description');
  }

  return $description;
}


/*-----------------------------------------------------------------------------------*/
/* Widget Customize
/*-----------------------------------------------------------------------------------*/
/* Tag Cloud Widget */
function theme_wp_tag_cloud($output, $param){
	$output = preg_replace('/style=".+?"/', '', $output);
	return $output;
}
add_filter('wp_tag_cloud', 'theme_wp_tag_cloud', 10, 2);

/* Category Widget */
//カテゴリ・アーカイブウィジェットの投稿数のカッコを取り除く
function remove_post_count_parentheses( $output ) {
	$output = preg_replace('/<\/a>.*\((\d+)\)/','</a> <span class="count">$1</span>',$output);
	return $output;
}
add_filter( 'wp_list_categories', 'remove_post_count_parentheses' );
add_filter( 'get_archives_link',  'remove_post_count_parentheses' );

/*-----------------------------------------------------------------------------------*/
/* reCAPTCHA
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_enqueue_scripts', function() {
	if(is_page('contact')) return;
    wp_deregister_script( 'google-recaptcha' );
});

/*-----------------------------------------------------------------------------------*/
/* テーマのアップデートチェッカー
/*-----------------------------------------------------------------------------------*/
require 'plugin-update-checker-4.9/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://raw.githubusercontent.com/mrtc-jp/cross/master/theme.json?token=APXEEMFJ3EVCF3ZG7YG3DQ263HYBQ',
    __FILE__,
    'cross'
);
