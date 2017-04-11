<?php
/**
 * Educare functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Educare
 */

if ( ! function_exists( 'muslimguide_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function muslimguide_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Educare, use a find and replace
	 * to change 'educare-champtheme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mslm-guide-special', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'mslm-guide-special' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'muslimguide_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'muslimguide_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function muslimguide_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'muslimguide_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'muslimguide_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function muslimguide_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mslm-guide-special' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mslm-guide-special' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer widgets', 'mslm-guide-special' ),
		'id'            => 'footer-widgets',
		'description'   => esc_html__( 'Add footer widgets here.', 'mslm-guide-special' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="footer-widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'muslimguide_theme_widgets_init' );

function muslimguide_theme_sidebar1_params($params) {

$sidebar_id = $params[0]['id'];

if ( $sidebar_id == 'footer-widgets' ) {

    $total_widgets = wp_get_sidebars_widgets();
    $sidebar_widgets = count($total_widgets[$sidebar_id]);
    
    if($sidebar_widgets == 2) {
        $footer_wid_width_markup = 'col-xs-12 col-sm-6';
    } elseif($sidebar_widgets == 3) {
        $footer_wid_width_markup = 'col-md-4 col-xs-12 col-sm-6';
    }  elseif($sidebar_widgets == 4) {
        $footer_wid_width_markup = 'col-md-3 col-xs-12 col-sm-6';
    }  elseif($sidebar_widgets == 5) {
        $footer_wid_width_markup = 'col-md-3 col-xs-12 col-sm-6';
    }  elseif($sidebar_widgets == 6) {
        $footer_wid_width_markup = 'col-md-2 col-xs-12 col-sm-6';
    } else {
        $footer_wid_width_markup = 'col-md-12';
    }

    $params[0]['before_widget'] = str_replace('class="', 'class="'.$footer_wid_width_markup.' ', $params[0]['before_widget']);
}

return $params;
}
add_filter('dynamic_sidebar_params','muslimguide_theme_sidebar1_params');


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/libs/cs-framework/cs-framework.php';
require get_template_directory() . '/libs/cs-framework-overwrites.php';
require get_template_directory() . '/libs/custom-breadcrumbs/custom-breadcrumbs.php';



/**
 * Enqueue scripts and styles.
 */

function muslimguide_theme_google_fonts_url() {
    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'mslm-guide-special' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Roboto:300,300i,400,400i,700,700i,900,900i&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}

function muslimguide_theme_scripts() {
    
    
    wp_enqueue_style( 'mslm-guide-special-google-fonts', muslimguide_theme_google_fonts_url(), array(), '1.0.0' );
    
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '3.3.7' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.7' );
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '3.5.1' );
    wp_enqueue_style( 'jquery-slicknav', get_template_directory_uri() . '/assets/css/slicknav.min.css', array(), '1.0.10' );
	wp_enqueue_style( 'mslm-guide-special-style', get_stylesheet_uri() );

    
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'jquery-slicknav', get_template_directory_uri() . '/assets/js/jquery.slicknav.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'jquery-waypoint', get_template_directory_uri() . '/assets/js/waypoint.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'jquery-counter', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array('jquery'), '20151215', true );
    
	wp_enqueue_script( 'mslm-guide-special-active', get_template_directory_uri() . '/assets/js/active.js', array('jquery'), '20151215', true );
    
    
    global $post_type;
    $gmap_api_key = cs_get_option('gmap_api_key');
    if($post_type == 'event' && !empty($gmap_api_key)) {
        wp_enqueue_script( 'gmap-api-key', '//maps.googleapis.com/maps/api/js?key='.cs_get_option('gmap_api_key').'', array(), '20151215', false );
    }

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'muslimguide_theme_scripts' );


require get_template_directory() . '/inc/theme-style.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';




/**
 * Favicon.
 */


if(function_exists('wp_site_icon') && has_site_icon()) { } else {
    $educare_favicon = cs_get_option('educare_favicon');
    if ( ! function_exists( 'muslimguide_theme_favicon' ) && !empty($educare_favicon) ) {
        function muslimguide_theme_favicon() {
            $educare_favicon_id = cs_get_option('educare_favicon');
            $educare_favicon_url = wp_get_attachment_image_src($educare_favicon_id, 'thumbnail');
            ?>
            <link rel="shortcut icon" type="image/png" href="<?php echo esc_url($educare_favicon_url[0]); ?>"/>
            <?php
        }
        add_action('wp_head', 'muslimguide_theme_favicon');
    }   
}





/**
 * Required plugin install notice.
 */
require get_template_directory() . '/inc/required-plugins.php';

/**
 * Import demo data.
 */

function muslimguide_theme_import_files() {
return array(
		array(
			'import_file_name'             => esc_html__('Demo Import 1', 'mslm-guide-special'),
			'local_import_file'            => trailingslashit( get_template_directory() ) . '/inc/demo-contents/educare-demo-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . '/inc/demo-contents/educare-demo-widgets.wie',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . '/inc/demo-contents/educare-demo-customizer.dat',
//			'import_preview_image_url'     => get_template_directory_uri().'/inc/demo-contents/educare-demo-preview.jpg',
			'import_notice'                => esc_html__( 'After import demo, just set static homepage from settings > reading, check widgets & menus. You will be done! :-)', 'mslm-guide-special' ),
		)
	);
} //industry_import_files
add_filter( 'pt-ocdi/import_files', 'muslimguide_theme_import_files' );


// Removing unnecessary scripts
remove_action ('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');


////POC creation plugin cours - TEST

/*
* Fonction de création du post personnalisé cours
*/
/*function cours_post_type() {
// On définit les labels pour le post personnalisé
$labels = array(
'name' => __( 'cours', 'Post Type General
Name', 'mslm-guide-special' ),
'singular_name' => __( 'Cours', 'Post Type Singular
Name', 'mslm-guide-special' ),
'menu_name' => __( 'cours', 'mslm-guide-special' ),
'parent_item_colon' => __( 'Parent Cours', 'mslm-guide-special'
),
'all_items' => __( 'Tous les cours',
'mslm-guide-special' ),
'view_item' => __( 'Voir un cours', 'mslm-guide-special'
),
'add_new_item' => __( 'Ajouter un nouveau Cours',
'mslm-guide-special' ),
'add_new' => __( 'Ajouter nouveau',
'mslm-guide-special' ),
'edit_item' => __( 'Editer Cours', 'mslm-guide-special'
),
'update_item' => __( 'Mettre à jour Cours',
'mslm-guide-special' ),
'search_items' => __( 'Rechercher Cours',
'mslm-guide-special' ),
'not_found' => __( 'Non trouvé', 'mslm-guide-special' ),
'not_found_in_trash' => __( 'Non trouvé dans la corbeille',
'mslm-guide-special' ),
);
// On définit les autres options pour le post personnalisé
$args = array(
'label' => __( 'cours', 'mslm-guide-special' ),
'description' => __( 'Nouveautés et critiques sur les
cours', 'mslm-guide-special' ),
'labels' => $labels,
// On peut l'éditer dans l'éditeur de posts
'supports' => array( 'title', 'editor', 'excerpt',
'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
// On l'associe avec une taxonomie (ici genres).
'taxonomies' => array( 'categorie' ),
/* Un post personnalisé hiérarchique est comme une Page et
peut avoir un
* Parent et des enfants. Un PP non-hiérarchique est comme un
article.
*/
/*'hierarchical' => false,
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'show_in_nav_menus' => true,
'show_in_admin_bar' => true,
'menu_position' => 5,
'can_export' => true,
'has_archive' => true,
'exclude_from_search' => false,
'publicly_queryable' => true,
'capability_type' => 'page',
);
// Enregistrer le Type de Post personnalisé
register_post_type( 'cours', $args );
}
/* Utiliser le hook 'init' pour exécuter l’action d’enregistrement du
* Type personnalisé.
*/
//add_action( 'init', 'cours_post_type', 0 );

function films_post_type() {
// On définit les labels pour le post personnalisé
$labels = array(
'name' => _x( 'Films', 'Post Type General
Name', 'twentysixteen' ),
'singular_name' => _x( 'Film', 'Post Type Singular
Name', 'twentysixteen' ),
'menu_name' => __( 'Films', 'twentysixteen' ),
'parent_item_colon' => __( 'Parent Film', 'twentysixteen'
),
'all_items' => __( 'Tous les Films',
'twentysixteen' ),
'view_item' => __( 'Voir un Film', 'twentysixteen'
),
'add_new_item' => __( 'Ajouter un nouveau Film',
'twentysixteen' ),
'add_new' => __( 'Ajouter nouveau',
'twentysixteen' ),
'edit_item' => __( 'Editer Film', 'twentysixteen'
),
'update_item' => __( 'Mettre à jour Film',
'twentysixteen' ),
'search_items' => __( 'Rechercher Film',
'twentysixteen' ),
'not_found' => __( 'Non trouvé', 'twentysixteen' ),
'not_found_in_trash' => __( 'Non trouvé dans la corbeille',
'twentysixteen' ),
);
// On définit les autres options pour le post personnalisé
$args = array(
'label' => __( 'Films', 'twentysixteen' ),
'description' => __( 'Nouveautés et critiques sur les
films', 'twentysixteen' ),
'labels' => $labels,
// On peut l'éditer dans l'éditeur de posts
'supports' => array( 'title', 'editor', 'excerpt',
'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
// On l'associe avec une taxonomie (ici genres).
'taxonomies' => array( 'genres' ),
/* Un post personnalisé hiérarchique est comme une Page et
peut avoir un
* Parent et des enfants. Un PP non-hiérarchique est comme un
article.
*/
'hierarchical' => false,
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'show_in_nav_menus' => true,
'show_in_admin_bar' => true,
'menu_position' => 5,
'can_export' => true,
'has_archive' => true,
'exclude_from_search' => false,
'publicly_queryable' => true,
'capability_type' => 'page',
);
// Enregistrer le Type de Post personnalisé
register_post_type( 'Films', $args );
}
/* Utiliser le hook 'init' pour exécuter l’action d’enregistrement du
* Type personnalisé.
*/
add_action( 'init', 'films_post_type', 0 );





















function register_cours_post_type() {

	/**
	 * Post Type: Cours.
	 */

	$labels = array(
		"name" => __( 'Cours', 'mslm-guide-special' ),
		"singular_name" => __( 'Cours', 'mslm-guide-special' ),
		"menu_name" => __( 'Cours', 'mslm-guide-special' ),
		"all_items" => __( 'Tous les cours', 'mslm-guide-special' ),
		"add_new" => __( 'Ajouter nouveau', 'mslm-guide-special' ),
		"add_new_item" => __( 'Ajouter nouveau Cours', 'mslm-guide-special' ),
		"edit_item" => __( 'Éditer Cours', 'mslm-guide-special' ),
		"new_item" => __( 'Nouveau cours', 'mslm-guide-special' ),
		"view_item" => __( 'Afficher cours', 'mslm-guide-special' ),
		"view_items" => __( 'Afficher les cours', 'mslm-guide-special' ),
		"search_items" => __( 'Chercher cours', 'mslm-guide-special' ),
		"not_found" => __( 'Cours pas trouvé', 'mslm-guide-special' ),
		"not_found_in_trash" => __( 'Cours pas trouvé dans la poubelle', 'mslm-guide-special' ),
		"parent_item_colon" => __( 'Cours parent', 'mslm-guide-special' ),
		"featured_image" => __( 'Image de promotion', 'mslm-guide-special' ),
		"set_featured_image" => __( 'Mettre à jour image de promotion', 'mslm-guide-special' ),
		"remove_featured_image" => __( 'Supprimer image de promotion', 'mslm-guide-special' ),
		"use_featured_image" => __( 'Utiliser comme image de promotion', 'mslm-guide-special' ),
		"archives" => __( 'Archive des cours', 'mslm-guide-special' ),
		"insert_into_item" => __( 'Insérer dans cours', 'mslm-guide-special' ),
		"uploaded_to_this_item" => __( 'chargé dans le cours', 'mslm-guide-special' ),
		"filter_items_list" => __( 'Filtrer liste cours', 'mslm-guide-special' ),
		"items_list_navigation" => __( 'Liste navigation cours', 'mslm-guide-special' ),
		"items_list" => __( 'Liste cours', 'mslm-guide-special' ),
		"attributes" => __( 'Attributs cours', 'mslm-guide-special' ),
		"parent_item_colon" => __( 'Cours parent', 'mslm-guide-special' ),
	);

	$args = array(
		"label" => __( 'Cours', 'mslm-guide-special' ),
		"labels" => $labels,
		"description" => "Cours pour les musulmans",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "cours", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-book-alt",
		"supports" => array( "title", "editor", 'excerpt', 'author', "thumbnail", "custom-fields",'page-attributes'),
	);

	register_post_type( "cours", $args );
	
	//CAtégorie cours personnalisé
	register_taxonomy(
        'cours_cat',  
        'cours',                  
        array(
            'hierarchical'          => true,
            'label'                 => esc_html__('Catégorie cours', 'educare-toolkit'),  
            'query_var'             => true,
            'show_admin_column'     => true,
            'rewrite'               => array(
                'slug'              => 'categorie-cours', 
                'with_front'    => true 
            )
        )
    );
}

add_action( 'init', 'register_cours_post_type' );
