<?php
/*
Plugin Name: Video chat roulette
Plugin URI: https://chatroulette.online-webcam.net/
Description: With chat roulette you can let visitors of your website to stay more. Chat roulette is based on Flash and would work in any desktop browser supporting Flash Player.
Version: 1.0
Author: SoftService
Author URI: http://softservice.org
*/

// this is the function that outputs the background as a style tag in the <head> 
if ( ! defined( 'WP_CONTENT_URL' ) )
      define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
      define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
      define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
      define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
      
      
class VideoChatRoulettePlugin {

  static public $basename;

  static public function control_config_page() 
  {
    if ( function_exists('add_submenu_page') ) {
      add_submenu_page('options-general.php', __('Video chat roulette'), __('Video chat roulette'), 'manage_options', 'video-chatroulette', array('VideoChatRoulettePlugin', 'control_conf'));
    }
  }
  
  /**
  * This is the function that outputs our configuration page
  */
  static public function control_conf() {
        
    $chat_code = <<<HTML
<iframe src="https://chatroulette.online-webcam.net/facebook/?width=807&height=500" width="807" height="500" scrolling="no" style="border:0 none; overflow:hidden; background:transparent;"></iframe>
HTML;
    $chat_code = htmlentities($chat_code);
      
    echo <<<HTML
    <div class="wrap">
      <h2>Video chat roulette</h2>
      <p style="font-size:large;">
      You can place following HTML code into any Page of Wordpress.
      </p>
      <textarea rows="4" cols="80" onclick="this.select();">{$chat_code}</textarea>
    </div>
HTML;

  }
  
  /**
  * This is the function that adds a configuration page to settings menu group
  */
  static public function control_init() 
  {
    VideoChatRoulettePlugin::$basename = plugin_basename(__FILE__);
    add_action('admin_menu', array('VideoChatRoulettePlugin', 'control_config_page'));
    add_filter('plugin_action_links', array('VideoChatRoulettePlugin', 'manage_link'), 10, 2);
  }
  
  /**
  * Adds the manage link in the plugins list
  */
  static public function manage_link($links, $file)
  {
    if ($file == VideoChatRoulettePlugin::$basename) {
      $settings_link = '<a href="options-general.php?page=video-chatroulette">' . __('Settings') . '</a>';
      array_unshift($links, $settings_link);
    }
    return $links;
  }

}

add_action('init',    array('VideoChatRoulettePlugin', 'control_init'));

?>