<?php

use Endroid\QrCode\QrCode;

function printQR(string $label, string $secret, string $issuer = "") : void {
    
    $qrCode = new QrCode('otpauth://totp/'. $label .'?secret='. $secret .'&issuer='. $issuer);
    
    // header('Content-Type: '.$qrCode->getContentType());
    header('Content-Type: image/png');
    echo $qrCode->writeString();

    return;
}