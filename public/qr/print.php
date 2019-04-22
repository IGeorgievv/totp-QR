<?php

require_once $g_base ."/data/qr.php";

printQR($_SESSION['label'], encodeSecret(), $_SESSION['username']);