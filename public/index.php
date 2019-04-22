<?php
session_start();
$g_base = dirname(__DIR__);

require_once $g_base .'/vendor/autoload.php';
require_once $g_base .'/data/totp.php';

$link = substr($_SERVER['REQUEST_URI'], 1); // Clearing first slash
$open = explode('?', $link)[0]; // Clearing GET request
if ( !empty( $open ) ) {
    require_once $open .".php";
    exit();
}

function clearUserInput( $data ) {
    $returnData = [];

    foreach ( $data as $k => $v ) {
        $returnData[$k] = htmlspecialchars( trim($v) );
    }
    return $returnData;
}

require_once $g_base .'/data/serveQR/deliver_data.php'; // Data for home page
require_once 'index.html';