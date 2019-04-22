<?php

$data = loadPage();

require_once 'page.html';

function loadPage() {

    $data                  = [];
    $data['totp']          = "";
    $data['qrCode']        = "";
    $data['msgs']['error'] = "";
    if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
        $_GET = clearUserInput( $_GET );
        
        if ( empty($_GET['code'])) {
            $data['msgs']['error'] .= '<p class="desc error">The Code is required field!</p>';
        }
        if ( empty($_GET['user'])) {
            $data['msgs']['error'] .= '<p class="desc error">The User is required field!</p>';
        }

        if ( empty( $data['msgs']['error'] ) ) {

            $_SESSION['code'] = str_replace(' ', '', $_GET['code']);
            $_SESSION['user'] = trim($_GET['user']);

            $totp = generateTotp( encodeSecret() );

            if ( $_SESSION['code'] == $totp && $_SESSION['user'] == $_SESSION['username'] ) {
                $data['qr']['status']   = "<p class=\"msg warning\">200</p>";
                $data['qr']['response'] = "<p class=\"msg info\">Good to go.</p>";
            }
            else {
                $data['qr']['status']   = "<p class=\"msg warning\">201</p>";
                $data['qr']['response'] = "<p class=\"msg info\">Wrong TOTP code or User!</p>";
            }
        }
        else {
            $_SESSION['code']    = "";
            $_SESSION['username'] = "";
        }
    }

    $data['form']['check']['code'] = empty($_SESSION['code']) ?
                                                "Code..." : $_SESSION['code'];
    $data['form']['check']['user'] = empty($_SESSION['user']) ?
                                            "User..." : $_SESSION['user'];

    return $data;
}