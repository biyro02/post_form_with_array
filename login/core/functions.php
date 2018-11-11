<?php
/**
 * Created by PhpStorm.
 * User: cngsym
 * Date: 4.11.2018
 * Time: 15:02
 */

function doMaskForTelephonNumbers($number)
{
    if(!is_null($number) && is_numeric($number) && strlen($number)==10){
        return "0 (".substr($number,0,3).") ".substr($number,3,3)."-".substr($number,6,2)."-".substr($number,8,2);
    }
    return "Telefon numarası maskelemede bir problem yaşandı.";
}