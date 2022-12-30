<?php
/**
 * Plugin Name:       Portfolio
 * Description:       WP Online Support, portfolio plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            S P Pramodh
 * License:           GPL v2 or later
 * Text Domain:       portfolio
 * Domain Path:       /languages
 */

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once plugin_dir_path(__FILE__) . 'shortcode.php';

/**
* Load ACF custom fields.
*/
add_filter('acf/settings/load_json', 'wpos_acf_json_load_point');

function wpos_acf_json_load_point( $paths ) {
    // append path
    $paths[] = plugin_dir_path(__FILE__) . '/acf-json';
    return $paths;        
}

function acf_inactive_notice() {
    ?>
    <div id="message" class="error">
    <p><?php printf( __( '%sAdvanced custom fileds plugin is inactive.%s The plugin%s must be active for this plugin to work. Please %sinstall & activate ACF%s', 'portfolio' ), '<strong>', '</strong>', '<a target="_blank" href="https://wordpress.org/plugins/advanced-custom-fields/">', '</a>', '<a href="' . admin_url( 'plugin-install.php?tab=search&s=advanced-custom-fields' ) . '">', '&nbsp;&raquo;</a>' ); ?></p>
    </div>
    <?php
}

if(!file_exists(WP_PLUGIN_DIR.'/advanced-custom-fields/acf.php')) {
	add_action( 'admin_notices', 'acf_inactive_notice' );
    exit;
} else {
class Portfolio {
    function __construct() { 
        add_action('init', [$this, 'wpos_setup_post_type'] );
        add_action('init', [$this, 'wpos_setup_custom_portfolio_taxonomy']);
        add_action('init', [$this, 'wpos_shortcode_init'] );
        if(!is_admin()){
            wp_register_style('bootstrap-css', '//cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css');
            wp_enqueue_style('bootstrap-css');

            wp_register_script('bootstrap-js', '//cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.2.3', true);
            wp_enqueue_script('bootstrap-js');
        }
   
    }

    /**
     * Register the portfolio custom post type
     */
    function wpos_setup_post_type() {
        register_post_type( 'portfolio', array(
            'labels' => array(
                'name' => __( 'Portfolios' ),
                'singular_name' => __('Portfolio'),
                'all_items' => __('All Portfolios'),
                'view_item' => __('View Portfolio'), 
                'add_new_item' => __('Add Portfolio'),
                'add_new' => __('Add Portfolio'),
                'edit_item' => __('Edit Portfolio'),
                'update_item' => __('Update Portfolio'),   
            ), 
            'show_in_rest' => true,
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields'),
            'rewrite' => array('slug' => 'portfolios'),
            'has_archive' => true,
            'public' => true,
            'publicly_queryable'  => true,
            'menu_icon' => 'dashicons-businesswoman'
            )
        ); 
    } 
    
    /**
     * Register custom taxonomy "portfolio cat" for custom post type
     */
    function wpos_setup_custom_portfolio_taxonomy() {
        $labels = array(
            'name'              => __('Portfolio Categories'),
            'singular_name'     => __('Portfolio Category'),
            'search_items'      => __('Search Portfolio Categories'),
            'all_items'         => __('All Portfolio Categories'),
            'parent_item'       => __('Parent Portfolio Category'),
            'parent_item_colon' => __('Parent Portfolio Category'),
            'edit_item'         => __('Edit Portfolio Category'),
            'update_item'       => __('Update Portfolio Category'),
            'add_new_item'      => __('Add New Portfolio Category'),
            'new_item_name'     => __('New Portfolio Category Name'),
            'menu_name'         => __('Portfolio Categories')
        );
        
        $args = array(
            'labels'            => $labels,
            'public'            => true,
            'rewrite'           => true,
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_in_rest'      => true,
            'show_admin_column' => true,
            'query_var'         => true,
        );
        register_taxonomy( 'portfolio-cat', 'portfolio', $args );
    }

    /**
     * Central location to create all shortcodes.
     */
    function wpos_shortcode_init() {
        add_shortcode( 'wpos-show-portfolio', 'wpos_custom_shortcode' );
    }

}

$portfolio = new Portfolio();
}


