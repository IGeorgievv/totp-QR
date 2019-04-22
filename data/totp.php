<?php
/*
 * Create Secret and TOTP.
 *
 * If no secret is provided as an arg, the script will create it.
 *
 */

use lfkeitel\phptotp\Totp;
use lfkeitel\phptotp\Base32;

function generateTotp( string $secret ) : string {

    $totp = "";
    
    $key = decodeSecret($secret);
    
    $totp = (new Totp())->GenerateToken($key);

    return $totp;
}

function encodeSecret( string $secret = "foundation3649(" ) : string {

    return Base32::encode($secret);
}

function decodeSecret( string $secret ) : string {

    return Base32::decode($secret);
}
