<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('home', 'DefaultController');
Routing::get('licytacje', 'DefaultController');
Routing::get('licytacje_archiwalne', 'DefaultController');
Routing::get('moje_licytacje', 'DefaultController');
Routing::get('licytacja', 'DefaultController');


Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('getSavedAuctions', 'IDController');
Routing::post('updateAuction', 'AuctionUpdater');
Routing::post('saveAuction', 'SaveAuctionController');

Routing::run($path);