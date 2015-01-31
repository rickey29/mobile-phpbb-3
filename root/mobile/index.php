<?php
/*
	project: Mobile phpBB 3 (MphpBB3)
	file:    $phpbb_root_path/mobile/index.php
	version: 5.3.0
	author:  Rickey Gu
	web:     http://flexplat.com
	email:   rickey29@gmail.com
*/

if ( !defined('IN_PHPBB') )
{
	exit;
}


if ( $this->data['is_bot'] || defined('ADMIN_START') || defined('IN_ADMIN') )
{
	return;
}

if ( $style )
{
	return;
}


define('IN_MPHPBB3', true);

// detection library
require($phpbb_root_path . 'mobile/lib/detection.' . $phpEx);


global $user;


$m_data = array();
$m_data['user_agent'] = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
$m_data['accept'] = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : '';
$m_data['profile'] = isset($_SERVER['HTTP_PROFILE']) ? $_SERVER['HTTP_PROFILE'] : '';
$m_data['redirection'] = request_var('m-redirection', '');
$m_data['cookie'] = request_var($config['cookie_name'] . '_m-redirection', '', false, true);

$m_value = m_get_redirection($m_data);

$m_response = array();
$m_response['device_platform'] = $m_value[0];
$m_response['device_grade'] = $m_value[1];
$m_response['device_system'] = $m_value[2];
$m_response['echo_page'] = $m_value[3];
$m_response['set_cookie'] = $m_value[4];


if ( !empty($m_response['set_cookie']) )
{
	if ( $m_response['set_cookie'] == 'mobile' )
	{
		// the cookie expires one year later: 60 * 60 * 24 * 365 = 31,536,000
		$user->set_cookie('m-redirection', 'mobile', time() + 31536000);
	}
	else if ( $m_response['set_cookie'] == 'desktop' )
	{
		// the cookie expires one year later: 60 * 60 * 24 * 365 = 31,536,000
		$user->set_cookie('m-redirection', 'desktop', time() + 31536000);
	}
}

if ( !empty($m_response['echo_page']) && $m_response['echo_page'] == 'mobile' )
{
	if ( $m_response['device_system'] == 'smartphone' )
	{
		define('MPHPBB3', 'jQuery-Mobile Smartphone');
	}
	else if ( $m_response['device_system'] == 'tablet' )
	{
		define('MPHPBB3', 'jQuery-Mobile Tablet');
	}
	else
	{
		define('MPHPBB3', 'Feature Phone');
	}


	$sql = 'SELECT style_id
		FROM ' . STYLES_TABLE . "
		WHERE style_name = '" . $db->sql_escape(MPHPBB3) . "'";
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	$style = $row['style_id'];


	// library
	include($phpbb_root_path . 'mobile/lib/lib.' . $phpEx);
}
?>
