<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *------------+----------------+------------------------------------------
 * Date       | Author         | Revisions
 *------------+----------------+------------------------------------------
 */

function syslogs($log, $type="")
{
    $fname = $_SERVER['DOCUMENT_ROOT']."/projectTshirt/syslogs/".date("Ymd")."-".$type.".log";
    if(! file_exists($fname))
    {
        $file = fopen($fname, 'w');
    }
    $file = fopen($fname,"a") or exit("Unable to open file!");
    fwrite($file, $log);
    fclose($file);
}