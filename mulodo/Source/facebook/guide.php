<?php
// Using Composer
require_once 'vendor/autoload.php';
// Call namespace
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;

//Set up application
$appId = '';
$appSecret ='';

FacebookSession::setDefaultApplication($appId, $appSecret);

//Create a login helper
$url_redirect = 'http://localhost/xampp/facebook/phpsdk/'; //url to redirect when log in
$helper = new FacebookRedirectLoginHelper($url_redirect);

$session = $helper->getSessionFromRedirect();
var_dump($session);
// Check if a session exits
if ( isset($session)) {
    // Save a session
    //$_SESSION['fb-token'] = $session->getToken();
    $_SESSION['fb-token'] = NULL;
    
    // Create session using saved  token or the new one we generated at login
    $session = new FacebookSession($session->getToken());
    
    // Create a logout url
    $url_redirect = 'http://yourdomain.com/logout';

} else {
    // No Session
    // Requeste permission - optional
    $permissions = array(
        'email', 'user_location', 'user_birthday'
    );
    
    // Get login URL
    $loginUrl = $helper->getLoginUrl($permissions);
    
}


