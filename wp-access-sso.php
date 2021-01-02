<?php
/**
 * @link              https://403page.com
 * @since             0.1.0
 * @package           Wp_Access_Sso
 *
 * @wordpress-plugin
 * Plugin Name:       Cloudflare Access SSO
 * Plugin URI:        https://403page.com
 * Description:       Allow a single sign on to Wordpress when using Cloudflare Access.
 * Version:           0.1.0
 * Author:            403Page Labs
 * Author URI:        https://403page.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-access-sso
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
 if ( ! defined( 'WPINC' ) ) {
    die; }

/**
 * Current plugin version.
 */
define( 'WP_ACCESS_SSO_VERSION', '0.1.0' );

// Go!
add_action( 'after_setup_theme', 'new_login' );

function new_login() {

    $emailauth = $_SERVER["HTTP_CF_ACCESS_AUTHENTICATED_USER_EMAIL"];
    $user = get_user_by( 'email', $emailauth );
    $user_id = $user->id;

    if ( $user_id > 0 && ! is_user_logged_in() ) {
        $user = get_user_by( 'id', $user_id );
        wp_set_current_user( $user->ID, $user->user_login );

        if ( is_user_logged_in() ) {
            return true;
        }

	} elseif ( $user_id == 0 && is_user_logged_in() ) {
        wp_logout();
        wp_set_current_user( 0 );
	} if ( $user_id == 0 ) {

        $nousermessage = 'User not found in site database. Please contact your site administrator for access.';

        echo '<html><body><center>';
        echo '<h1>Cloudflare Access mismatch:</h1>';
        echo $nousermessage;
        echo "<br /><a href='/cdn-cgi/access/logout'>Logout and try again...</a>";
        echo '</center></body></html>';
        die;
	}
}

add_action('wp_logout','redirect_to_cf_access_logout');
function redirect_to_cf_access_logout(){
        wp_safe_redirect( '/cdn-cgi/access/logout' );
	exit();
}
