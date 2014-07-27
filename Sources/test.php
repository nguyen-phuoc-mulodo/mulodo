<?php
session_start();

use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
require_once 'vendor/autoload.php';

define('FB_APP_ID', '695082060564419');
define('FB_APP_SECRET', '093b0b371673a8b831dcc87d62fee7b0');

FacebookSession::setDefaultApplication(FB_APP_ID, FB_APP_SECRET);

//Create a login helper
$url_redirect = 'http://localhost/xampp/facebook/test.php'; //url to redirect when log in
$helper = new FacebookRedirectLoginHelper($url_redirect);

$session = new FacebookSession('890446910969119');

echo "<pre>";
var_dump($session);
