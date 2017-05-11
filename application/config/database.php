<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Revisions
 *------------------------------------------------------------------
 * Date       | Author                 | Revisions
 *------------------------------------------------------------------
 * 2017-03-30 | Analyn R. Sosa         | Initial Draft
 *------------------------------------------------------------------
 *
 */

$active_group = 'raffle';
$active_record = TRUE;

$db['raffle']['hostname'] = 'raffle_host_db';
$db['raffle']['username'] = 'ucs_user';
$db['raffle']['password'] = 'pass123';
$db['raffle']['database'] = 'ussc_raffle';
$db['raffle']['dbdriver'] = 'mysql';
$db['raffle']['dbprefix'] = '';
$db['raffle']['pconnect'] = TRUE;
$db['raffle']['db_debug'] = FALSE;
$db['raffle']['cache_on'] = FALSE;
$db['raffle']['cachedir'] = '';
$db['raffle']['char_set'] = 'utf8';
$db['raffle']['dbcollat'] = 'utf8_general_ci';
$db['raffle']['swap_pre'] = '';
$db['raffle']['autoinit'] = TRUE;
$db['raffle']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */