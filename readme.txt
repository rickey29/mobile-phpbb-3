Mobile phpBB 3 Readme
################
version: 5.2.0
last update: Mon., Dec. 22, 2014


Description
++++++++++++++++
Mobile phpBB 3 (MphpBB3) is a mobile-friendly phpBB 3 theme.

It only provides essential mobile related functions, it does not support all phpBB 3 features.

Please do NOT use this software when you are driving -- looking at mobile screen while driving is very dangerous.  If you are a webmaster, please forward this caution to your end users.


Highlight
++++++++++++++++
None.


Open Issue
++++++++++++++++
None.


Infrastructure
++++++++++++++++
This version is developed based on phpBB version 3.0.0 to 3.0.12 .


Installation
++++++++++++++++
step 0:
================
Assume your phpBB 3 web site is located in: "http://yoursite.com".

step 1:
================
Please backup your database.  This step is not mandatory for MphpBB3 installation.  However, it provides convenience when you want to restore the system in case of any unhappy.

step 2:
================
Please backup following file(s).  This step is not mandatory for MphpBB3 installation.  However, it provides convenience when you want to restore the system in case of any unhappy.
-- http://yoursite.com/includes/functions.php
-- http://yoursite.com/includes/session.php
-- http://yoursite.com/includes/ucp/ucp_pm_viewfolder.php
-- http://yoursite.com/language/en/common.php
-- http://yoursite.com/viewtopic.php

step 3:
================
Extract MphpBB3 zip package on your PC, you will get a "mphpbb3" directory.

step 4:
================
Upload following directories from the "mphpbb3" directory to your web site:
-- mobile
-- styles/jquery_mobile_smartphone
-- styles/jquery_mobile_tablet
-- styles/jquery_mobile_touch_phone

step 5:
================
OPEN
----------------
includes/functions.php

FIND
----------------
	$template->assign_vars(array(
		$tpl_prefix . 'BASE_URL'		=> $base_url,
		'A_' . $tpl_prefix . 'BASE_URL'	=> addslashes($base_url),
		$tpl_prefix . 'PER_PAGE'		=> $per_page,

		$tpl_prefix . 'PREVIOUS_PAGE'	=> ($on_page == 1) ? '' : $base_url . "{$url_delim}start=" . (($on_page - 2) * $per_page),
		$tpl_prefix . 'NEXT_PAGE'		=> ($on_page == $total_pages) ? '' : $base_url . "{$url_delim}start=" . ($on_page * $per_page),
		$tpl_prefix . 'TOTAL_PAGES'		=> $total_pages,
	));

ADD AFTER
----------------
	if ( defined('MPHPBB3') )
	{
		$template->assign_vars(array(
			$tpl_prefix . 'FIRST_PAGE'	=> ($total_pages <= 3) ? '' : $base_url,
			$tpl_prefix . 'LAST_PAGE'	=> ($total_pages <= 3) ? '' : $base_url . "{$url_delim}start=" . (($total_pages - 1) * $per_page),
		));
	}

FIND
----------------
	$template->assign_vars(array(
		'LOGIN_ERROR'		=> $err,
		'LOGIN_EXPLAIN'		=> $l_explain,

		'U_SEND_PASSWORD' 		=> ($config['email_enable']) ? append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=sendpassword') : '',
		'U_RESEND_ACTIVATION'	=> ($config['require_activation'] == USER_ACTIVATION_SELF && $config['email_enable']) ? append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=resend_act') : '',
		'U_TERMS_USE'			=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=terms'),
		'U_PRIVACY'				=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=privacy'),

		'S_DISPLAY_FULL_LOGIN'	=> ($s_display) ? true : false,
		'S_HIDDEN_FIELDS' 		=> $s_hidden_fields,

		'S_ADMIN_AUTH'			=> $admin,
		'USERNAME'				=> ($admin) ? $user->data['username'] : '',

		'USERNAME_CREDENTIAL'	=> 'username',
		'PASSWORD_CREDENTIAL'	=> ($admin) ? 'password_' . $credential : 'password',
	));

ADD BEFORE
----------------
	if ( defined('MPHPBB3') )
	{
		$err = m_update_err($err);
	}

FIND
----------------
			$template->assign_vars(array(
				'MESSAGE_TITLE'		=> $msg_title,
				'MESSAGE_TEXT'		=> $msg_text,
				'S_USER_WARNING'	=> ($errno == E_USER_WARNING) ? true : false,
				'S_USER_NOTICE'		=> ($errno == E_USER_NOTICE) ? true : false)
			);

ADD BEFORE
----------------
			if ( defined('MPHPBB3') )
			{
				m_update_msg_text($msg_text);
			}

FIND
----------------
	// The following assigns all _common_ variables that may be used at any point in a template.
	$template->assign_vars(array(
		'SITENAME'						=> $config['sitename'],
		'SITE_DESCRIPTION'				=> $config['site_desc'],
		'PAGE_TITLE'					=> $page_title,
		'SCRIPT_NAME'					=> str_replace('.' . $phpEx, '', $user->page['page_name']),
		'LAST_VISIT_DATE'				=> sprintf($user->lang['YOU_LAST_VISIT'], $s_last_visit),
		'LAST_VISIT_YOU'				=> $s_last_visit,
		'CURRENT_TIME'					=> sprintf($user->lang['CURRENT_TIME'], $user->format_date(time(), false, true)),
		'TOTAL_USERS_ONLINE'			=> $l_online_users,
		'LOGGED_IN_USER_LIST'			=> $online_userlist,
		'RECORD_USERS'					=> $l_online_record,
		'PRIVATE_MESSAGE_INFO'			=> $l_privmsgs_text,
		'PRIVATE_MESSAGE_INFO_UNREAD'	=> $l_privmsgs_text_unread,

		'S_USER_NEW_PRIVMSG'			=> $user->data['user_new_privmsg'],
		'S_USER_UNREAD_PRIVMSG'			=> $user->data['user_unread_privmsg'],
		'S_USER_NEW'					=> $user->data['user_new'],

		'SID'				=> $SID,
		'_SID'				=> $_SID,
		'SESSION_ID'		=> $user->session_id,
		'ROOT_PATH'			=> $phpbb_root_path,
		'BOARD_URL'			=> $board_url,

		'L_LOGIN_LOGOUT'	=> $l_login_logout,
		'L_INDEX'			=> $user->lang['FORUM_INDEX'],
		'L_ONLINE_EXPLAIN'	=> $l_online_time,

		'U_PRIVATEMSGS'			=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=pm&amp;folder=inbox'),
		'U_RETURN_INBOX'		=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=pm&amp;folder=inbox'),
		'U_POPUP_PM'			=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=pm&amp;mode=popup'),
		'UA_POPUP_PM'			=> addslashes(append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=pm&amp;mode=popup')),
		'U_MEMBERLIST'			=> append_sid("{$phpbb_root_path}memberlist.$phpEx"),
		'U_VIEWONLINE'			=> ($auth->acl_gets('u_viewprofile', 'a_user', 'a_useradd', 'a_userdel')) ? append_sid("{$phpbb_root_path}viewonline.$phpEx") : '',
		'U_LOGIN_LOGOUT'		=> $u_login_logout,
		'U_INDEX'				=> append_sid("{$phpbb_root_path}index.$phpEx"),
		'U_SEARCH'				=> append_sid("{$phpbb_root_path}search.$phpEx"),
		'U_REGISTER'			=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=register'),
		'U_PROFILE'				=> append_sid("{$phpbb_root_path}ucp.$phpEx"),
		'U_MODCP'				=> append_sid("{$phpbb_root_path}mcp.$phpEx", false, true, $user->session_id),
		'U_FAQ'					=> append_sid("{$phpbb_root_path}faq.$phpEx"),
		'U_SEARCH_SELF'			=> append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=egosearch'),
		'U_SEARCH_NEW'			=> append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=newposts'),
		'U_SEARCH_UNANSWERED'	=> append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=unanswered'),
		'U_SEARCH_UNREAD'		=> append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=unreadposts'),
		'U_SEARCH_ACTIVE_TOPICS'=> append_sid("{$phpbb_root_path}search.$phpEx", 'search_id=active_topics'),
		'U_DELETE_COOKIES'		=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=delete_cookies'),
		'U_TEAM'				=> ($user->data['user_id'] != ANONYMOUS && !$auth->acl_get('u_viewprofile')) ? '' : append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=leaders'),
		'U_TERMS_USE'			=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=terms'),
		'U_PRIVACY'				=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=privacy'),
		'U_RESTORE_PERMISSIONS'	=> ($user->data['user_perm_from'] && $auth->acl_get('a_switchperm')) ? append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=restore_perm') : '',
		'U_FEED'				=> generate_board_url() . "/feed.$phpEx",

		'S_USER_LOGGED_IN'		=> ($user->data['user_id'] != ANONYMOUS) ? true : false,
		'S_AUTOLOGIN_ENABLED'	=> ($config['allow_autologin']) ? true : false,
		'S_BOARD_DISABLED'		=> ($config['board_disable']) ? true : false,
		'S_REGISTERED_USER'		=> (!empty($user->data['is_registered'])) ? true : false,
		'S_IS_BOT'				=> (!empty($user->data['is_bot'])) ? true : false,
		'S_USER_PM_POPUP'		=> $user->optionget('popuppm'),
		'S_USER_LANG'			=> $user_lang,
		'S_USER_BROWSER'		=> (isset($user->data['session_browser'])) ? $user->data['session_browser'] : $user->lang['UNKNOWN_BROWSER'],
		'S_USERNAME'			=> $user->data['username'],
		'S_CONTENT_DIRECTION'	=> $user->lang['DIRECTION'],
		'S_CONTENT_FLOW_BEGIN'	=> ($user->lang['DIRECTION'] == 'ltr') ? 'left' : 'right',
		'S_CONTENT_FLOW_END'	=> ($user->lang['DIRECTION'] == 'ltr') ? 'right' : 'left',
		'S_CONTENT_ENCODING'	=> 'UTF-8',
		'S_TIMEZONE'			=> ($user->data['user_dst'] || ($user->data['user_id'] == ANONYMOUS && $config['board_dst'])) ? sprintf($user->lang['ALL_TIMES'], $user->lang['tz'][$tz], $user->lang['tz']['dst']) : sprintf($user->lang['ALL_TIMES'], $user->lang['tz'][$tz], ''),
		'S_DISPLAY_ONLINE_LIST'	=> ($l_online_time) ? 1 : 0,
		'S_DISPLAY_SEARCH'		=> (!$config['load_search']) ? 0 : (isset($auth) ? ($auth->acl_get('u_search') && $auth->acl_getf_global('f_search')) : 1),
		'S_DISPLAY_PM'			=> ($config['allow_privmsg'] && !empty($user->data['is_registered']) && ($auth->acl_get('u_readpm') || $auth->acl_get('u_sendpm'))) ? true : false,
		'S_DISPLAY_MEMBERLIST'	=> (isset($auth)) ? $auth->acl_get('u_viewprofile') : 0,
		'S_NEW_PM'				=> ($s_privmsg_new) ? 1 : 0,
		'S_REGISTER_ENABLED'	=> ($config['require_activation'] != USER_ACTIVATION_DISABLE) ? true : false,
		'S_FORUM_ID'			=> $forum_id,
		'S_TOPIC_ID'			=> $topic_id,

		'S_LOGIN_ACTION'		=> ((!defined('ADMIN_START')) ? append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=login') : append_sid("index.$phpEx", false, true, $user->session_id)),
		'S_LOGIN_REDIRECT'		=> build_hidden_fields(array('redirect' => build_url())),

		'S_ENABLE_FEEDS'			=> ($config['feed_enable']) ? true : false,
		'S_ENABLE_FEEDS_OVERALL'	=> ($config['feed_overall']) ? true : false,
		'S_ENABLE_FEEDS_FORUMS'		=> ($config['feed_overall_forums']) ? true : false,
		'S_ENABLE_FEEDS_TOPICS'		=> ($config['feed_topics_new']) ? true : false,
		'S_ENABLE_FEEDS_TOPICS_ACTIVE'	=> ($config['feed_topics_active']) ? true : false,
		'S_ENABLE_FEEDS_NEWS'		=> ($s_feed_news) ? true : false,

		'S_LOAD_UNREADS'			=> ($config['load_unreads_search'] && ($config['load_anon_lastread'] || $user->data['is_registered'])) ? true : false,

		'S_SEARCH_HIDDEN_FIELDS'	=> build_hidden_fields($s_search_hidden_fields),

		'T_THEME_PATH'			=> "{$web_path}styles/" . rawurlencode($user->theme['theme_path']) . '/theme',
		'T_TEMPLATE_PATH'		=> "{$web_path}styles/" . rawurlencode($user->theme['template_path']) . '/template',
		'T_SUPER_TEMPLATE_PATH'	=> (isset($user->theme['template_inherit_path']) && $user->theme['template_inherit_path']) ? "{$web_path}styles/" . rawurlencode($user->theme['template_inherit_path']) . '/template' : "{$web_path}styles/" . rawurlencode($user->theme['template_path']) . '/template',
		'T_IMAGESET_PATH'		=> "{$web_path}styles/" . rawurlencode($user->theme['imageset_path']) . '/imageset',
		'T_IMAGESET_LANG_PATH'	=> "{$web_path}styles/" . rawurlencode($user->theme['imageset_path']) . '/imageset/' . $user->lang_name,
		'T_IMAGES_PATH'			=> "{$web_path}images/",
		'T_SMILIES_PATH'		=> "{$web_path}{$config['smilies_path']}/",
		'T_AVATAR_PATH'			=> "{$web_path}{$config['avatar_path']}/",
		'T_AVATAR_GALLERY_PATH'	=> "{$web_path}{$config['avatar_gallery_path']}/",
		'T_ICONS_PATH'			=> "{$web_path}{$config['icons_path']}/",
		'T_RANKS_PATH'			=> "{$web_path}{$config['ranks_path']}/",
		'T_UPLOAD_PATH'			=> "{$web_path}{$config['upload_path']}/",
		'T_STYLESHEET_LINK'		=> (!$user->theme['theme_storedb']) ? "{$web_path}styles/" . rawurlencode($user->theme['theme_path']) . '/theme/stylesheet.css' : append_sid("{$phpbb_root_path}style.$phpEx", 'id=' . $user->theme['style_id'] . '&amp;lang=' . $user->lang_name),
		'T_STYLESHEET_NAME'		=> $user->theme['theme_name'],

		'T_THEME_NAME'			=> rawurlencode($user->theme['theme_path']),
		'T_TEMPLATE_NAME'		=> rawurlencode($user->theme['template_path']),
		'T_SUPER_TEMPLATE_NAME'	=> rawurlencode((isset($user->theme['template_inherit_path']) && $user->theme['template_inherit_path']) ? $user->theme['template_inherit_path'] : $user->theme['template_path']),
		'T_IMAGESET_NAME'		=> rawurlencode($user->theme['imageset_path']),
		'T_IMAGESET_LANG_NAME'	=> $user->data['user_lang'],
		'T_IMAGES'				=> 'images',
		'T_SMILIES'				=> $config['smilies_path'],
		'T_AVATAR'				=> $config['avatar_path'],
		'T_AVATAR_GALLERY'		=> $config['avatar_gallery_path'],
		'T_ICONS'				=> $config['icons_path'],
		'T_RANKS'				=> $config['ranks_path'],
		'T_UPLOAD'				=> $config['upload_path'],

		'SITE_LOGO_IMG'			=> $user->img('site_logo'),

		'A_COOKIE_SETTINGS'		=> addslashes('; path=' . $config['cookie_path'] . ((!$config['cookie_domain'] || $config['cookie_domain'] == 'localhost' || $config['cookie_domain'] == '127.0.0.1') ? '' : '; domain=' . $config['cookie_domain']) . ((!$config['cookie_secure']) ? '' : '; secure')),
	));

ADD AFTER
----------------
	if ( defined('MPHPBB3') )
	{
		$template->assign_vars(array(
			'L_SWITCH_TO_DESKTOP_STYLE'	=> isset($rootref['L_SWITCH_TO_DESKTOP_STYLE']) ? $rootref['L_SWITCH_TO_DESKTOP_STYLE'] : $user->lang['SWITCH_TO_DESKTOP_STYLE'],
			'M_MODE'					=> request_var('m-mode', ''),
			'M_PERSONAL_FOOTER'			=> M_PERSONAL_FOOTER,
			'M_PERSONAL_HEADER'			=> M_PERSONAL_HEADER,
			'U_OPTIONS'					=> append_sid("{$phpbb_root_path}index.$phpEx", 'm-mode=option'),
			'U_SWITCH_TO_DESKTOP_STYLE'	=> append_sid("{$phpbb_root_path}index.$phpEx", 'm-redirection=desktop'),
		));
	}

step 6:
================
OPEN
----------------
includes/session.php

FIND
----------------
			// Set up style
			$style = ($style) ? $style : ((!$config['override_user_style']) ? $this->data['user_style'] : $config['default_style']);

ADD BEFORE
----------------
			include($phpbb_root_path . 'mobile/index.' . $phpEx);

step 7:
================
OPEN
----------------
includes/ucp/ucp_pm_viewfolder.php

FIND
----------------
				// Send vars to template
				$template->assign_block_vars('messagerow', array(
					'PM_CLASS'			=> ($row_indicator) ? 'pm_' . $row_indicator . '_colour' : '',

					'MESSAGE_AUTHOR_FULL'		=> get_username_string('full', $row['author_id'], $row['username'], $row['user_colour'], $row['username']),
					'MESSAGE_AUTHOR_COLOUR'		=> get_username_string('colour', $row['author_id'], $row['username'], $row['user_colour'], $row['username']),
					'MESSAGE_AUTHOR'			=> get_username_string('username', $row['author_id'], $row['username'], $row['user_colour'], $row['username']),
					'U_MESSAGE_AUTHOR'			=> get_username_string('profile', $row['author_id'], $row['username'], $row['user_colour'], $row['username']),

					'FOLDER_ID'			=> $folder_id,
					'MESSAGE_ID'		=> $message_id,
					'SENT_TIME'			=> $user->format_date($row['message_time']),
					'SUBJECT'			=> censor_text($row['message_subject']),
					'FOLDER'			=> (isset($folder[$row['folder_id']])) ? $folder[$row['folder_id']]['folder_name'] : '',
					'U_FOLDER'			=> (isset($folder[$row['folder_id']])) ? append_sid("{$phpbb_root_path}ucp.$phpEx", 'folder=' . $row['folder_id']) : '',
					'PM_ICON_IMG'		=> (!empty($icons[$row['icon_id']])) ? '<img src="' . $config['icons_path'] . '/' . $icons[$row['icon_id']]['img'] . '" width="' . $icons[$row['icon_id']]['width'] . '" height="' . $icons[$row['icon_id']]['height'] . '" alt="" title="" />' : '',
					'PM_ICON_URL'		=> (!empty($icons[$row['icon_id']])) ? $config['icons_path'] . '/' . $icons[$row['icon_id']]['img'] : '',
					'FOLDER_IMG'		=> $user->img($folder_img, $folder_alt),
					'FOLDER_IMG_SRC'	=> $user->img($folder_img, $folder_alt, false, '', 'src'),
					'PM_IMG'			=> ($row_indicator) ? $user->img('pm_' . $row_indicator, '') : '',
					'ATTACH_ICON_IMG'	=> ($auth->acl_get('u_pm_download') && $row['message_attachment'] && $config['allow_pm_attach']) ? $user->img('icon_topic_attach', $user->lang['TOTAL_ATTACHMENTS']) : '',

					'S_PM_UNREAD'		=> ($row['pm_unread']) ? true : false,
					'S_PM_DELETED'		=> ($row['pm_deleted']) ? true : false,
					'S_PM_REPORTED'		=> (isset($row['report_id'])) ? true : false,
					'S_AUTHOR_DELETED'	=> ($row['author_id'] == ANONYMOUS) ? true : false,

					'U_VIEW_PM'			=> ($row['pm_deleted']) ? '' : $view_message_url,
					'U_REMOVE_PM'		=> ($row['pm_deleted']) ? $remove_message_url : '',
					'U_MCP_REPORT'		=> (isset($row['report_id'])) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=pm_reports&amp;mode=pm_report_details&amp;r=' . $row['report_id']) : '',
					'RECIPIENTS'		=> ($folder_id == PRIVMSGS_OUTBOX || $folder_id == PRIVMSGS_SENTBOX) ? implode(', ', $address_list[$message_id]) : '')
				);
			}

ADD BEFORE
----------------
				if ( defined('MPHPBB3') )
				{
					m_update_address_list($address_list[$message_id]);
				}

step 8:
================
OPEN
----------------
language/en/common.php

FIND
----------------
));

?>

ADD BEFORE
----------------
	'COLON'						=> ':',
	'FIRST'						=> 'First',
	'LAST'						=> 'Last',
	'SWITCH_TO_DESKTOP_STYLE'	=> 'Switch to desktop style',

If you use other language(s) than English, please update your language file(s) as I do on "language/en/common.php".

step 9:
================
OPEN
----------------
viewtopic.php

FIND
----------------
	//
	$postrow = array(
		'POST_AUTHOR_FULL'		=> ($poster_id != ANONYMOUS) ? $user_cache[$poster_id]['author_full'] : get_username_string('full', $poster_id, $row['username'], $row['user_colour'], $row['post_username']),
		'POST_AUTHOR_COLOUR'	=> ($poster_id != ANONYMOUS) ? $user_cache[$poster_id]['author_colour'] : get_username_string('colour', $poster_id, $row['username'], $row['user_colour'], $row['post_username']),
		'POST_AUTHOR'			=> ($poster_id != ANONYMOUS) ? $user_cache[$poster_id]['author_username'] : get_username_string('username', $poster_id, $row['username'], $row['user_colour'], $row['post_username']),
		'U_POST_AUTHOR'			=> ($poster_id != ANONYMOUS) ? $user_cache[$poster_id]['author_profile'] : get_username_string('profile', $poster_id, $row['username'], $row['user_colour'], $row['post_username']),

		'RANK_TITLE'		=> $user_cache[$poster_id]['rank_title'],
		'RANK_IMG'			=> $user_cache[$poster_id]['rank_image'],
		'RANK_IMG_SRC'		=> $user_cache[$poster_id]['rank_image_src'],
		'POSTER_JOINED'		=> $user_cache[$poster_id]['joined'],
		'POSTER_POSTS'		=> $user_cache[$poster_id]['posts'],
		'POSTER_FROM'		=> $user_cache[$poster_id]['from'],
		'POSTER_AVATAR'		=> $user_cache[$poster_id]['avatar'],
		'POSTER_WARNINGS'	=> $user_cache[$poster_id]['warnings'],
		'POSTER_AGE'		=> $user_cache[$poster_id]['age'],

		'POST_DATE'			=> $user->format_date($row['post_time'], false, ($view == 'print') ? true : false),
		'POST_SUBJECT'		=> $row['post_subject'],
		'MESSAGE'			=> $message,
		'SIGNATURE'			=> ($row['enable_sig']) ? $user_cache[$poster_id]['sig'] : '',
		'EDITED_MESSAGE'	=> $l_edited_by,
		'EDIT_REASON'		=> $row['post_edit_reason'],
		'BUMPED_MESSAGE'	=> $l_bumped_by,

		'MINI_POST_IMG'			=> ($post_unread) ? $user->img('icon_post_target_unread', 'UNREAD_POST') : $user->img('icon_post_target', 'POST'),
		'POST_ICON_IMG'			=> ($topic_data['enable_icons'] && !empty($row['icon_id'])) ? $icons[$row['icon_id']]['img'] : '',
		'POST_ICON_IMG_WIDTH'	=> ($topic_data['enable_icons'] && !empty($row['icon_id'])) ? $icons[$row['icon_id']]['width'] : '',
		'POST_ICON_IMG_HEIGHT'	=> ($topic_data['enable_icons'] && !empty($row['icon_id'])) ? $icons[$row['icon_id']]['height'] : '',
		'ICQ_STATUS_IMG'		=> $user_cache[$poster_id]['icq_status_img'],
		'ONLINE_IMG'			=> ($poster_id == ANONYMOUS || !$config['load_onlinetrack']) ? '' : (($user_cache[$poster_id]['online']) ? $user->img('icon_user_online', 'ONLINE') : $user->img('icon_user_offline', 'OFFLINE')),
		'S_ONLINE'				=> ($poster_id == ANONYMOUS || !$config['load_onlinetrack']) ? false : (($user_cache[$poster_id]['online']) ? true : false),

		'U_EDIT'			=> ($edit_allowed) ? append_sid("{$phpbb_root_path}posting.$phpEx", "mode=edit&amp;f=$forum_id&amp;p={$row['post_id']}") : '',
		'U_QUOTE'			=> ($auth->acl_get('f_reply', $forum_id)) ? append_sid("{$phpbb_root_path}posting.$phpEx", "mode=quote&amp;f=$forum_id&amp;p={$row['post_id']}") : '',
		'U_INFO'			=> ($auth->acl_get('m_info', $forum_id)) ? append_sid("{$phpbb_root_path}mcp.$phpEx", "i=main&amp;mode=post_details&amp;f=$forum_id&amp;p=" . $row['post_id'], true, $user->session_id) : '',
		'U_DELETE'			=> ($delete_allowed) ? append_sid("{$phpbb_root_path}posting.$phpEx", "mode=delete&amp;f=$forum_id&amp;p={$row['post_id']}") : '',

		'U_PROFILE'		=> $user_cache[$poster_id]['profile'],
		'U_SEARCH'		=> $user_cache[$poster_id]['search'],
		'U_PM'			=> ($poster_id != ANONYMOUS && $config['allow_privmsg'] && $auth->acl_get('u_sendpm') && ($user_cache[$poster_id]['allow_pm'] || $auth->acl_gets('a_', 'm_') || $auth->acl_getf_global('m_'))) ? append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=pm&amp;mode=compose&amp;action=quotepost&amp;p=' . $row['post_id']) : '',
		'U_EMAIL'		=> $user_cache[$poster_id]['email'],
		'U_WWW'			=> $user_cache[$poster_id]['www'],
		'U_ICQ'			=> $user_cache[$poster_id]['icq'],
		'U_AIM'			=> $user_cache[$poster_id]['aim'],
		'U_MSN'			=> $user_cache[$poster_id]['msn'],
		'U_YIM'			=> $user_cache[$poster_id]['yim'],
		'U_JABBER'		=> $user_cache[$poster_id]['jabber'],

		'U_REPORT'			=> ($auth->acl_get('f_report', $forum_id)) ? append_sid("{$phpbb_root_path}report.$phpEx", 'f=' . $forum_id . '&amp;p=' . $row['post_id']) : '',
		'U_MCP_REPORT'		=> ($auth->acl_get('m_report', $forum_id)) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=reports&amp;mode=report_details&amp;f=' . $forum_id . '&amp;p=' . $row['post_id'], true, $user->session_id) : '',
		'U_MCP_APPROVE'		=> ($auth->acl_get('m_approve', $forum_id)) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=queue&amp;mode=approve_details&amp;f=' . $forum_id . '&amp;p=' . $row['post_id'], true, $user->session_id) : '',
		'U_MINI_POST'		=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'p=' . $row['post_id']) . (($topic_data['topic_type'] == POST_GLOBAL) ? '&amp;f=' . $forum_id : '') . '#p' . $row['post_id'],
		'U_NEXT_POST_ID'	=> ($i < $i_total && isset($rowset[$post_list[$i + 1]])) ? $rowset[$post_list[$i + 1]]['post_id'] : '',
		'U_PREV_POST_ID'	=> $prev_post_id,
		'U_NOTES'			=> ($auth->acl_getf_global('m_')) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=notes&amp;mode=user_notes&amp;u=' . $poster_id, true, $user->session_id) : '',
		'U_WARN'			=> ($auth->acl_get('m_warn') && $poster_id != $user->data['user_id'] && $poster_id != ANONYMOUS) ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=warn&amp;mode=warn_post&amp;f=' . $forum_id . '&amp;p=' . $row['post_id'], true, $user->session_id) : '',

		'POST_ID'			=> $row['post_id'],
		'POST_NUMBER'		=> $i + $start + 1,
		'POSTER_ID'			=> $poster_id,

		'S_HAS_ATTACHMENTS'	=> (!empty($attachments[$row['post_id']])) ? true : false,
		'S_POST_UNAPPROVED'	=> ($row['post_approved']) ? false : true,
		'S_POST_REPORTED'	=> ($row['post_reported'] && $auth->acl_get('m_report', $forum_id)) ? true : false,
		'S_DISPLAY_NOTICE'	=> $display_notice && $row['post_attachment'],
		'S_FRIEND'			=> ($row['friend']) ? true : false,
		'S_UNREAD_POST'		=> $post_unread,
		'S_FIRST_UNREAD'	=> $s_first_unread,
		'S_CUSTOM_FIELDS'	=> (isset($cp_row['row']) && sizeof($cp_row['row'])) ? true : false,
		'S_TOPIC_POSTER'	=> ($topic_data['topic_poster'] == $poster_id) ? true : false,

		'S_IGNORE_POST'		=> ($row['hide_post']) ? true : false,
		'L_IGNORE_POST'		=> ($row['hide_post']) ? sprintf($user->lang['POST_BY_FOE'], get_username_string('full', $poster_id, $row['username'], $row['user_colour'], $row['post_username']), '<a href="' . $viewtopic_url . "&amp;p={$row['post_id']}&amp;view=show#p{$row['post_id']}" . '">', '</a>') : '',
	);

ADD AFTER
----------------
	if ( defined('MPHPBB3') )
	{
		m_update_post_row($post_row);
	}

step 10:
================
Go to phpBB 3 "Administration Control Panel", select "Styles", install "jQuery-Mobile smartphone", "jQuery-Mobile tablet" and "jQuery-Mobile touch-phone" styles.

step 11:
================
Set up a sub-domain, such as: "http://m.yoursite.com", which should redirect to "http://yoursite.com/?m-redirection=mobile".

step 12:
================
End users can now get mobile-friendly style of your phpBB 3 from their mobile web browsers through "http://m.yoursite.com".


Configuration
++++++++++++++++
Personalize Page Header and Footer
================
The content of following file(s) will be displayed on the header of each mobile-friendly web page.  You can update these file(s) to show your web site logo and/or advertisement.
-- styles/jquery_mobile_smartphone/template/personal_header.html
-- styles/jquery_mobile_tablet/template/personal_header.html
-- styles/jquery_mobile_touch_phone/template/personal_header.html

The content of following file(s) will be displayed on the footer of mobile-friendly homepage.  You can update these file(s) to show your web site information.
-- styles/jquery_mobile_smartphone/template/personal_footer.html
-- styles/jquery_mobile_tablet/template/personal_footer.html
-- styles/jquery_mobile_touch_phone/template/personal_footer.html

After updating any of above file(s), refresh the related style(s) to make it/them work(s) -- Go to phpBB 3 "Administration Control Panel", select "Styles", then choice "Themes", click "Refresh" of "jQuery-Mobile smartphone", "jQuery-Mobile tablet" and/or "jQuery-Mobile touch-phone" themes.


Frequent Ask Question
++++++++++++++++
Please refer to my web site: "http://flexplat.com/?q=mphpbb3-faq" for detail discussion.

Since my often have to update this section after I release the package, so I provide the questions and answers on my web site instead of here.


History
++++++++++++++++
version 5.2.0 (Mon., Dec. 22, 2014)
-- improvement: rework based on phpBB team's comments

version 5.1.0 (Mon., Nov. 10, 2014)
-- improvement: rework based on phpBB team's comments

version 5.0.0 (Sat., Sep. 20, 2014)
-- retrofit: theme style Mobile phpBB 3

Ducie Release, Load 4.1 (Fri., Jul. 11, 2014)
-- retrofit continue: Mobile phpBB3

Ducie Release, Load 4.0 (Fri., Jun. 27, 2014)
-- retrofit: Mobile phpBB3

Ducie Release, Load 3.3 (Wed., May 28, 2014)
-- improvement: add GPL v2.0 license

Ducie Release, Load 3.2 (Sat., Apr. 05, 2014)
-- improvement: collect end users' Id, IP and UA

Ducie Release, Load 3.1 (Sun., Mar. 23, 2014)
-- bug fix: passing URL string in base64 encoded data

Ducie Release, Load 3.0 (Wed., Mar. 05, 2014)
-- data transmission performance improvement

Ducie Release, Load 2.2 (Sat., Jan. 12, 2014)
-- bug fix: specify mobile library path

Ducie Release, Load 2.1 (Fri., Dec. 20, 2013)
-- theme updating

Ducie Release, Load 2.0 (Sat., Nov. 09, 2013)
-- performance improvement

Ducie Release, Load 1.2 (Fri., Oct. 18, 2013)
-- update form elements

Ducie Release, Load 1.1 (Wed., Sep. 04, 2013)
-- retrofit improvement

Ducie Release, Load 1.0 (Tue., Aug. 20, 2013)
-- retrofit development

Capri Release, Load 2.0 (Sat., Mar. 02, 2013)
-- improvement: theme improvement

Capri Release, Load 1.0 (Mon., Jan. 07, 2013)
-- new feature: tablet theme
-- new feature: smart-phone theme

Bali Release, Load 2.1 (Tue., Nov. 27, 2012)
-- bug fix: disable mobile-friendly theme when Spider/Crawler

Bali Release, Load 2.0 (Sat., Nov. 24, 2012)
-- improvement: update Mobile Detection database

Bali Release, Load 1.0 (Sat., Sep. 15, 2012)
-- Bali release primary development

Aruba Release, Load 8.6 (Sat., Nov. 12, 2011)
-- bug fix: authority checking bug fix

Aruba Release, Load 8.5 (Thur., Nov. 10, 2011)
-- improvement: add board index to options page

Aruba Release, Load 8.4 (Sat., Nov. 05, 2011)
-- improvement: new topic default data improvement

Aruba Release, Load 8.3 (Tue., Nov. 01, 2011)
-- bug fix: work around for undefined variables in old version

Aruba Release, Load 8.2 (Sat., Oct. 29, 2011)
-- bug fix: database operation bug fix
-- bug fix: work around for undefined variables in old version

Aruba Release, Load 8.1 (Fri., Oct. 21, 2011)
-- improvement: touch-screen friendly style

Aruba Release, Load 8.0 (Fri., Sep. 30, 2011)
-- improvement: touch-screen friendly style
-- new feature: view subscription topics
-- new feature: view bookmark topics

Aruba Release, Load 7.2 (Wed., Aug. 24, 2011)
-- improvement: support UTF-8 character encoding

Aruba Release, Load 7.1 (Sat., May 28, 2011)
-- improvement: security improvement

Aruba Release, Load 7.0 (Fri., Apr. 29, 2011)
-- new feature: view your posts
-- new feature: view unanswered posts
-- new feature: view new posts
-- new feature: view active topics
-- new feature: view latest topics

Aruba Release, Load 6.1 (Fri., Mar. 11, 2011)
-- bug fix: "Can see forum"/"Can read forum" permission/authorization issue

Aruba Release, Load 6.0 (Fri., Feb. 11, 2011)
-- new feature: smartphone/touch-screen friendly style

Aruba Release, Load 5.0 (Fri., Oct. 15, 2010)
-- new feature: device detection and redirection

Aruba Release, Load 4.1 (Sat., Aug. 28, 2010)
-- bug fix: Can NOT display post properly when bbcode is inside.

Aruba Release, Load 4.0 (Tue., Aug. 10, 2010)
-- new feature: iPhone/Android friendly style

Aruba Release, Load 3.1 (Mon., Jul. 12, 2010)
-- bug fix: wrong instruction within Readme Installation section

Aruba Release, Load 3.0 (Thur., Jun. 24, 2010)
-- new feature: new topic/post reply

Aruba Release, Load 2.1 (Mon., Jun. 07, 2010)
-- bug fix: Can NOT display &(Ampersand) correctly.

Aruba Release, Load 2.0 (Fri., May 28, 2010)
-- new feature: bbcode
-- new feature: smilies

Aruba Release, Load 1.0 (Wed., May 19, 2010)
-- primary development


To Do List
++++++++++++++++
-- Convert more pages into mobile-friendly ones.


Support
++++++++++++++++
author: Rickey Gu
web: http://flexplat.com
email: rickey29@gmail.com


Copyright and Disclaimer
++++++++++++++++
This application is open-source software released under the GNU General Public License v2: http://opensource.org/licenses/gpl-2.0.php .
