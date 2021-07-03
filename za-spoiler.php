<?php
/*
Plugin Name: zaerl Spoiler
Plugin URI: http://www.zaerl.com
Description: Add the Spoiler tag
Author: zaerl
Author URI: http://www.zaerl.com
Version: 0.1
*/
	
define('ZA_SP_VERSION', '0.1');
define('ZA_SP_ID', 'za-spoiler');
define('ZA_SP_NAME', 'zaerl Spoiler');

/*function za_ap_spoiler($atts, $content='')
{
	// <input type=\"submit\" value=\"Spoiler\" />
	return "<div style=\"display:none;\" id=\"za_ap_hidden_div\">-- $content</div>";
}*/

function za_sp_filter($text)
{// echo "(($text))"; // (.+)<\/spoiler>
	return preg_replace_callback('/<spoiler>(.+?)<\/spoiler>/im', 'za_sp_filter_callback', $text);
}

function za_sp_filter_callback($matches)
{
	return "<button class=\"za_ap_spoiler\">Spoiler</button>
<script type=\"text/javascript\">jQuery('.za_ap_spoiler').click(function() {
jQuery(this).replaceWith('" . esc_js($matches[1]) . "');
})</script>";
}

function za_sp_allow_tag($tags)
{
	$tags['spoiler'] = array();

	return $tags;
}

function za_ap_initialize()
{
	add_filter('bb_allowed_tags', 'za_sp_allow_tag');
	add_filter('post_text', 'za_sp_filter');
}

add_action('bb_init', 'za_ap_initialize');

?>