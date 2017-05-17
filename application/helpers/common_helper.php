<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *------------+----------------+------------------------------------------
 * Date       | Author         | Revisions
 *------------+----------------+------------------------------------------
 * 2017-05-17 | Analyn R. Sosa | Initial Draft
 *------------+----------------+------------------------------------------
 */

function syslogs($log, $type="")
{
    $fname = $_SERVER['DOCUMENT_ROOT']."raffle/syslogs/".date("Ymd")."-".$type.".log";
    if(! file_exists($fname))
    {
        $file = fopen($fname, 'w');
    }
    $file = fopen($fname,"a") or exit("Unable to open file!");
    fwrite($file, $log);
    fclose($file);
}