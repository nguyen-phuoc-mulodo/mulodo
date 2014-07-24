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
$url_redirect = ''; //url to redirect when log in
$helper = new FacebookRedirectLoginHelper($url_redirect);

// Check if user has login

$session = null;
if (isset($_SESSION) && isset($_SESSION['fb_token'])) {
    // Create a new session from a saved access token
    $session = new FacebookSession($_SESSION['fb_token']);
    
    // Validate access token to make sure it's still valid
    try {
        if (!$session->validate() ) {
            $session = null;
        }
    } catch (Exception $ex) {
        //Catch any exception
        $session = null;
    }
} else {
    try {
        $session = $helper->getSessionFromRedirect();
    } catch (Facebook\FacebookRequestException $ex) {
        // When Facebook return an error
    } catch (Exception $ex) {
        // when validate fails or other local issues
        echo $ex->message;
    }
}

// Check if a session exits
if ( isset($session)) {
    // Save a session
    $_SESSION['fb-token'] = $session->getToken();
    
    // Create session using saved  token or the new one we generated at login
    $session = new FacebookSession($session->getToken());
    
    // Create a logout url
    $url_redirect = 'http://yourdomain.com/logout';
    $logoutUrl = $helper->getLogoutUrl($session, $url_redirect);
} else {
    // No Session
    // Requeste permission - optional
    $permissions = array(
        'email', 'user_location', 'user_birthday'
    );
    
    // Get login URL
    $loginUrl = $helper->getLoginUrl($permissions);
    
}


