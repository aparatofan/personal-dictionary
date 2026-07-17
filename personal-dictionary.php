<?php
ob_start();
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://ays-pro.com
 * @since             1.0.0
 * @package           Personal_Dictionary
 *
 * @wordpress-plugin
 * Plugin Name:       Personal Dictionary
 * Plugin URI:        https://ays-pro.com/wordpress/personal-dictionary
 * Description:       Personal Dictionary is a handy plugin that lets you create and manage your own list of words and definitions. It's perfect for learning new words or keeping track of important terms.
 * Version:           2.7.4
 * Author:            Personal Dictionary Team
 * Author URI:        https://ays-pro.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       personal-dictionary
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PERSONAL_DICTIONARY_VERSION', '2.7.4' );
define( 'PERSONAL_DICTIONARY_NAME_VERSION', '1.0.0' );
define( 'PERSONAL_DICTIONARY_NAME', 'personal-dictionary' );
define( 'PERSONAL_DICTIONARY_DB_PREFIX', 'ayspd_' );

if( ! defined( 'PERSONAL_DICTIONARY_BASENAME' ) )
    define( 'PERSONAL_DICTIONARY_BASENAME', plugin_basename( __FILE__ ) );

if( ! defined( 'PERSONAL_DICTIONARY_DIR' ) )
    define( 'PERSONAL_DICTIONARY_DIR', plugin_dir_path( __FILE__ ) );

if( ! defined( 'PERSONAL_DICTIONARY_BASE_URL' ) )
    define( 'PERSONAL_DICTIONARY_BASE_URL', plugin_dir_url(__FILE__ ) );

if( ! defined( 'PERSONAL_DICTIONARY_ADMIN_PATH' ) )
    define( 'PERSONAL_DICTIONARY_ADMIN_PATH', plugin_dir_path( __FILE__ ) . 'admin' );

if( ! defined( 'PERSONAL_DICTIONARY_ADMIN_URL' ) )
    define( 'PERSONAL_DICTIONARY_ADMIN_URL', plugin_dir_url( __FILE__ ) . 'admin' );

if( ! defined( 'PERSONAL_DICTIONARY_PUBLIC_PATH' ) )
    define( 'PERSONAL_DICTIONARY_PUBLIC_PATH', plugin_dir_path( __FILE__ ) . 'public' );

if( ! defined( 'PERSONAL_DICTIONARY_PUBLIC_URL' ) )
    define( 'PERSONAL_DICTIONARY_PUBLIC_URL', plugin_dir_url( __FILE__ ) . 'public' );
    

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-personal-dictionary-activator.php
 */
function activate_personal_dictionary() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-personal-dictionary-activator.php';
	Personal_Dictionary_Activator::ays_pd_update_db_check();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-personal-dictionary-deactivator.php
 */
function deactivate_personal_dictionary() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-personal-dictionary-deactivator.php';
	Personal_Dictionary_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_personal_dictionary' );
register_deactivation_hook( __FILE__, 'deactivate_personal_dictionary' );

add_action( 'plugins_loaded', 'activate_personal_dictionary' );
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-personal-dictionary.php';
require plugin_dir_path( __FILE__ ) . 'personal-dictionary/personal-dictionary-block.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_personal_dictionary() {
    add_action( 'admin_notices', 'personal_dictionary_general_admin_notice' );
	$plugin = new Personal_Dictionary();
	$plugin->run();

}

function personal_dictionary_general_admin_notice(){
    global $wpdb;
    if ( isset($_GET['page']) && strpos( sanitize_text_field( $_GET['page'] ), PERSONAL_DICTIONARY_NAME) !== false ) {
        ?>
        <div class="ays-notice-banner">
            <div class="navigation-bar">
                <div id="navigation-container">                    
                    <div class="ays-pd-logo-container-upgrade">
                        <div class="logo-container">
                            <a href="https://ays-pro.com/wordpress/personal-dictionary?utm_source=dashboard&utm_medium=pd-free&utm_campaign=pd-top-banner-logo-link-<?php echo esc_attr( PERSONAL_DICTIONARY_VERSION ); ?>" target="_blank" style="box-shadow: none;">
                                <img  class="pd-logo" src="<?php echo esc_attr( PERSONAL_DICTIONARY_ADMIN_URL ) . '/images/icons/pd-logo-128x128.png'; ?>" alt="<?php echo __( "Personal Dictionary", 'personal-dictionary' ); ?>" title="<?php echo __( "Personal Dictionary", 'personal-dictionary' ); ?>"/>
                            </a>
                        </div>
                        <div class="ays-pd-upgrade-container">
                            <a href="https://ays-pro.com/wordpress/personal-dictionary?utm_source=dashboard-pd&utm_medium=free-pd&utm_campaign=top-menu-pd-<?php echo esc_attr( PERSONAL_DICTIONARY_VERSION ); ?>" target="_blank">
                                <img src="<?php echo esc_attr( PERSONAL_DICTIONARY_ADMIN_URL ) . '/images/icons/lightning-hover.svg'; ?>">
                                <span><?php echo __( "Upgrade", 'personal-dictionary' ); ?></span>
                            </a>
                            <span class="ays-pd-logo-container-one-time-text"><?php echo __( "One-time payment", 'personal-dictionary' ); ?></span>
                        </div>                        
                    </div>
                    <ul id="menu">
                            <li class="modile-ddmenu-lg"><a class="ays-btn" href="https://ays-pro.com/wordpress/personal-dictionary/?utm_source=dashboard&utm_medium=pd-free&utm_campaign=pd-top-banner-pricing-link-<?php echo esc_attr( PERSONAL_DICTIONARY_VERSION ); ?>" target="_blank"><?php echo esc_html__( "Pricing", 'personal-dictionary' ); ?></a></li>
                            <li class="modile-ddmenu-lg"><a class="ays-btn" href="https://ays-demo.com/wordpress-personal-dictionary-plugin-demo/" target="_blank"><?php echo esc_html__( "Demo", 'personal-dictionary' ); ?></a></li>
                            <li class="modile-ddmenu-lg"><a class="ays-btn" href="https://wordpress.org/support/plugin/personal-dictionary/" target="_blank"><?php echo esc_html__( "Free Support", 'personal-dictionary' ); ?></a></li>
                            <li class="modile-ddmenu-xs make_a_suggestion"><a class="ays-btn" href="https://ays-demo.com/personal-dictionary-plugin-survey/" target="_blank"><?php echo esc_html__( "Make a Suggestion", 'personal-dictionary' ); ?></a></li>
                            <li class="modile-ddmenu-lg"><a class="ays-btn" href="https://wordpress.org/support/plugin/personal-dictionary/" target="_blank"><?php echo esc_html__( "Contact us", 'personal-dictionary' ); ?></a></li>
                            <li class="modile-ddmenu-md">
                                <a class="toggle_ddmenu" href="javascript:void(0);"><i class="ays_fa_pd ays_fa_ellipsis_h"></i></a>
                                <ul class="ddmenu" data-expanded="false">
                                    <li><a class="ays-btn" href="https://ays-pro.com/wordpress/personal-dictionary/?utm_source=dashboard&utm_medium=pd-free&utm_campaign=pd-top-banner-pricing-link-<?php echo esc_attr( PERSONAL_DICTIONARY_VERSION ); ?>" target="_blank"><?php echo esc_html__( "Pricing", 'personal-dictionary' ); ?></a></li>
                                    <li><a class="ays-btn" href="https://ays-pro.com/wordpress-personal-dictionary-user-manual" target="_blank"><?php echo esc_html__( "Documentation", 'personal-dictionary' ); ?></a></li>
                                    <li><a class="ays-btn" href="https://ays-demo.com/wordpress-personal-dictionary-plugin-demo/" target="_blank"><?php echo esc_html__( "Demo", 'personal-dictionary' ); ?></a></li>
                                   <li><a class="ays-btn" href="https://wordpress.org/support/plugin/personal-dictionary/" target="_blank"><?php echo esc_html__( "Free Support", 'personal-dictionary' ); ?></a></li>
                                    <li><a class="ays-btn" href="https://wordpress.org/support/plugin/personal-dictionary/" target="_blank"><?php echo esc_html__( "Contact us", 'personal-dictionary' ); ?></a></li>
                                </ul>
                            </li>
                            <li class="modile-ddmenu-sm">
                            <a class="toggle_ddmenu" href="javascript:void(0);"><i class="ays_fa_pd ays_fa_ellipsis_h"></i></a>
                            <ul class="ddmenu" data-expanded="false">
                                <li><a class="ays-btn" href="https://ays-pro.com/wordpress/personal-dictionary/?utm_source=dashboard&utm_medium=pd-free&utm_campaign=pd-top-banner-pricing-link-<?php echo esc_attr( PERSONAL_DICTIONARY_VERSION ); ?>" target="_blank"><?php echo esc_html__( "Pricing", 'personal-dictionary' ); ?></a></li>
                                <li><a class="ays-btn" href="https://ays-pro.com/wordpress-personal-dictionary-user-manual" target="_blank"><?php echo esc_html__( "Documentation", 'personal-dictionary' ); ?></a></li>
                                <li><a class="ays-btn" href="https://wordpress.org/support/plugin/personal-dictionary/reviews/" target="_blank"><?php echo esc_html__( "Rate us", 'personal-dictionary' ); ?></a></li>
                                <li><a class="ays-btn" href="https://ays-demo.com/wordpress-personal-dictionary-plugin-demo/" target="_blank"><?php echo esc_html__( "Demo", 'personal-dictionary' ); ?></a></li>
                                <li><a class="ays-btn" href="https://wordpress.org/support/plugin/personal-dictionary/" target="_blank"><?php echo esc_html__( "Free Support", 'personal-dictionary' ); ?></a></li>
                                <li class="make_a_suggestion"><a class="ays-btn" href="https://ays-demo.com/personal-dictionary-plugin-survey/" target="_blank"><?php echo esc_html__( "Make a Suggestion", 'personal-dictionary' ); ?></a></li>
                                <li><a class="ays-btn" href="https://wordpress.org/support/plugin/personal-dictionary/" target="_blank"><?php echo esc_html__( "Contact us", 'personal-dictionary' ); ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="ays_ask_question_content">
			<div class="ays_ask_question_content_inner">				
                <a href="https://wordpress.org/support/plugin/personal-dictionary/" class="ays_pd_question_link" target="_blank">
                    <span class="ays-pd-ask-question-mark-text">?</span>
                    <span class="ays-pd-ask-question-hidden-text"><?php echo esc_html__( "Ask a question", 'personal-dictionary' ); ?></span>
                </a>
			</div>
		</div>

     <?php
      
    }
}
run_personal_dictionary();
