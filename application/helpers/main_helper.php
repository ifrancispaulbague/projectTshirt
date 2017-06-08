<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *------------+----------------+------------------------------------------
 * Date       | Author         | Revisions
 *------------+----------------+------------------------------------------
 */

function err_log($err)
{
    $fname = $_SERVER["DOCUMENT_ROOT"]."/projectTshirt/syslogs/".date("Ymd")."-ERR.log";
    if(! file_exists($fname)) $file = fopen($fname, 'w');

    $file = fopen($fname,"a") or exit("Unable to open file!");

    fwrite($file, "[ ".date("H:i:s")." ]" . $err);
    fclose($file);
}