<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$config['redis_host'] = '192.168.205.196';
$config['redis_port'] = '6379';
$config['base_url']	= '';
$config['index_page'] = 'index.php';
$config['uri_protocol']	= 'AUTO';
$config['url_suffix'] = '';
$config['language']	= 'english';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = FALSE;
$config['subclass_prefix'] = 'MY_';
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['allow_get_array']		= TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']	= 'c';
$config['function_trigger']		= 'm';
$config['directory_trigger']	= 'd'; // experimental not currently in use
$config['log_threshold'] = 2;
$config['log_path'] = '';
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['cache_path'] = '';
$config['encryption_key'] = 'UCS0b0019092cc3776e2fcefd56c9159c2f7f8552ad9a4fbc9d75d82e1b3de62b2b7c6fcbc3da9f5a59abcd7657f9c5a4779cf188ae7953c8794cd0cc7195c5f0772014';
$config['sess_cookie_name']  = 'ci_session';
$config['sess_expiration']  = 7200;
$config['sess_expire_on_close'] = FALSE;
if (gethostname() == 'ucs-web-01') 
	$config['sess_encrypt_cookie'] = FALSE;
else
	$config['sess_encrypt_cookie'] = TRUE;
$config['sess_use_database'] = FALSE;
$config['sess_table_name']  = 'ci_sessions';
$config['sess_match_ip']  = FALSE;
$config['sess_match_useragent'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['cookie_prefix']	= "";
$config['cookie_domain']	= "";
$config['cookie_path']		= "/";
$config['cookie_secure']	= FALSE;
$config['global_xss_filtering'] = FALSE;
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['compress_output'] = FALSE;
$config['time_reference'] = 'local';
$config['rewrite_short_tags'] = FALSE;
$config['proxy_ips'] = '';

/* End of file config.php */
/* Location: ./application/config/config.php */
