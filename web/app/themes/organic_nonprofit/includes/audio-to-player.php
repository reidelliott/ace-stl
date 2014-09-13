<?php
/**
* Audio Player
*
* Converts audio files to an HTML5 player.
*
* @package  Audio Player
* @author   Matt Varone, Edited by David Morgan
*
*/

if ( ! class_exists( 'MV_Audio_To_Player' ) ) {

	class MV_Audio_To_Player {
	
	private $has_audio = false;
	
	/**
	* Audio Player
	*
	* Construct class. Fires init action.
	*
	* @package Audio Player
	*/
	
	function __construct() {
		add_action( 'init', array( &$this, 'init' ) );
	}
	
	/**
	* Init
	*
	* Loads internationalization and sets the necessary action
	*
	* @return   void
	* @since    1.0
	*/
	
	function init() {
		add_action( 'the_posts', array( &$this, 'have_audio' ), 1, 1 );
	}
	
	/**
	* Have Audio
	*
	* Checks if the content haves audio.
	*
	* @return   array
	* @since    1.0
	*/
	
	function have_audio( $posts ) {
		if ( empty( $posts ) || $this->has_audio )
		return $posts;
		
		foreach ( $posts as $post ) {
			if ( preg_match('/\.(mp3|mp4|m4a)/i', $post->post_content) ) {
				$this->has_audio = true;
				break;
			}
		}
	
		if ( $this->has_audio == true || is_page_template('template-blog.php') )
		add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_assets' ), 10 );
		
		return $posts;

	}

	/**
	* Enqueue Assets
	*
	* Adds JS and CSS assets
	*
	* @return   void
	* @since    1.0
	*/
	
	function enqueue_assets() {
	
		// Style
		$css = 'audio-to-player.css';
		$on_theme = get_template_directory_uri() . '/css/audio-to-player.css';
		$stylesheet = ( file_exists( $on_theme ) ) ? get_stylesheet_directory_uri() . '/' . $css : $on_theme;
		$stylesheet = apply_filters( 'mv_audio_to_player_enqueue_style', $stylesheet );
		if ( $stylesheet ) wp_enqueue_style( 'audio-to-player', $stylesheet , false, 'MV_AUDIO_TO_PLAYER_VERSION', 'all' );
		
		// Script
		wp_register_script( 'jquery-jplayer', get_template_directory_uri() . '/js/jquery.jplayer.min.js' , array( 'jquery' ), '2.1.0' , true );
		wp_enqueue_script( 'audio-to-player', get_template_directory_uri() . '/js/audio.to.player.min.js' , array( 'jquery-jplayer' ), 'MV_AUDIO_TO_PLAYER_VERSION', true );
		$params = array(
			'uri'       => get_template_directory_uri(),
			'in_play'   => '<i class="icon-play"></i>',
			'in_pause'  => '<i class="icon-pause"></i>',
			'in_mute'   => '<i class="icon-microphone-off"></i>',
			'in_unmute' => '<i class="icon-microphone"></i>',
		);
		wp_localize_script( 'audio-to-player', 'mv_audio_to_player_js_params', apply_filters( 'mv_audio_to_player_js_params', $params ) );
	}
}

new MV_Audio_To_Player();
}