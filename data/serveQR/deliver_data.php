<?php

$data                  = [];
$data['totp']          = "";
$data['qrCode']        = "";
$data['msgs']['error'] = "";
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $_POST = clearUserInput( $_POST );
    if ( empty($_POST['label'])) {
        $data['msgs']['error'] .= '<p class="desc error">The Label is required field!</p>';
    }
    if ( empty($_POST['username'])) {
        $data['msgs']['error'] .= '<p class="desc error">The Username is required field!</p>';
    }

    if ( empty( $data['msgs']['error'] ) ) {
        $_SESSION['label']    = $_POST['label'];
        $_SESSION['username'] = $_POST['username'];
        $data['qrCode'] = '<img src="/qr/print" alt=" " />';
        $data['totp']   = '<h2 class="title">'. generateTotp( encodeSecret() ) .'</h2>';
    }
    else {
        $_SESSION['label']    = "";
        $_SESSION['username'] = "";
    }
}

$data['form']['create']['label']    = empty($_SESSION['label']) ?
                                            "Label..." : $_SESSION['label'];
$data['form']['create']['username'] = empty($_SESSION['username']) ?
                                            "Username..." : $_SESSION['username'];