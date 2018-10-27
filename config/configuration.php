<?php
/**
 * Created by PhpStorm.
 * User: vektorel
 * Date: 27.10.2018
 * Time: 14:11
 */

if(!defined('env') || env=='local'){
    if(!defined('HOST')) define('HOST','127.0.0.1');
    if(!defined('PORT')) define('PORT','3307');
    if(!defined('DB_VEKTOREL')) define('DB_VEKTOREL','vektorel');
    if(!defined('USR_VEKTOREL')) define('USR_VEKTOREL','usr_vektorel');
    if(!defined('PSW_USR_VEKT')) define('PSW_USR_VEKT','123456');
} elseif(defined('env') && env=='prod'){
    if(!defined('HOST')) define('HOST','127.0.0.1');
    if(!defined('PORT')) define('PORT','3307');
    if(!defined('DB_VEKTOREL')) define('DB_VEKTOREL','vektorel');
    if(!defined('USR_VEKTOREL')) define('USR_VEKTOREL','usr_vektorel');
    if(!defined('PSW_USR_VEKT')) define('PSW_USR_VEKT','123456');
}
