<?php
/*
	project: Mobile phpBB 3 (MphpBB3)
	file:    $phpbb_root_path/mobile/lib/lib.php
	version: 5.5.0
	author:  Rickey Gu
	web:     http://flexplat.com
	email:   rickey29@gmail.com
*/

if ( !defined('IN_PHPBB') )
{
	exit;
}


function m_update_address_list(&$address_list)
{
	if ( empty($address_list) || !is_array($address_list) )
	{
		return;
	}

	$pattern = '#^\s*<a[^>]*>\s*(.*)\s*</a>\s*$#isU';
	foreach ( $address_list as $key => $value )
	{
		if ( preg_match($pattern, $value, $matches) )
		{
			$address_list[$key] = $matches[1];
		}
	}
}

function m_update_err($err)
{
	$pattern = '#<a[^>]*>\s*(.*)\s*</a>#isU';
	$err = preg_replace($pattern, '$1', $err);

	return $err;
}

function m_update_msg_text($msg_text)
{
	global $template;

	$pattern = '#<br\s*/>\s*<br\s*/>#isU';
	$pattern2 = '#^(.*)<a.*\s+href\s*=\s*("|\')([^\\2]*)\\2.*>\s*(.*)\s*</a>(.*)$#isU';
	foreach ( preg_split($pattern, $msg_text) as $key => $value )
	{
		$value = trim($value);

		if ( $key == 0 )
		{
			$template->assign_vars(array(
				'TEXT_HEADING' => $value
			));

			continue;
		}

		if ( preg_match($pattern2, $value, $matches) )
		{
			$template->assign_block_vars('msg_text_row', array(
				'TEXT' => $matches[1] . $matches[4] . $matches[5],
				'U_TEXT' => $matches[3]
			));
		}
		else
		{
			$template->assign_block_vars('msg_text_row', array(
				'TEXT' => $value
			));
		}
	}
}

function m_update_post_row(&$post_row)
{
	$pattern = '#<a[^>]*>\s*(.*)\s*</a>#isU';

	$post_row['L_IGNORE_POST'] = preg_replace($pattern, '$1', $post_row['L_IGNORE_POST']);
}
?>
