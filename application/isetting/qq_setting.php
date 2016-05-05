<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @qq互联配置信息
 * 默认开启get_user_info模块
 * **/

$config['inc_info'] = array(
	array (
		'appid' => '101286207',
		'appkey' => 'b5d446e4d44b9fc4dc6f8624a6c42bc1',
		'callback' => 'http://fwww.bl.com'
	),
	array (
		'get_user_info' => '1',
		'add_topic' => '0',
		'add_one_blog' => '0',
		'add_album' => '0',
		'upload_pic' => '0',
		'list_album' => '0',
		'add_share' => '0',
		'check_page_fans' => '0',
		'add_t' => '0',
		'add_pic_t' => '0',
		'del_t' => '0',
		'get_repost_list' => '0',
		'get_info' => '0',
		'get_other_info' => '0',
		'get_fanslist' => '0',
		'get_idollist' => '0',
		'add_idol' => '0',
		'del_idol' => '0',
		'get_tenpay_addr' => '0',
	)
);