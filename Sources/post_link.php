<?php
session_start();

use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;

require_once 'vendor/autoload.php';

define('FB_APP_ID', '695082060564419');
define('FB_APP_SECRET', '093b0b371673a8b831dcc87d62fee7b0');

FacebookSession::setDefaultApplication(FB_APP_ID, FB_APP_SECRET);

//Create a login helper
$url_redirect = 'http://localhost/facebook/test.php'; //url to redirect when log in
$helper = new FacebookRedirectLoginHelper($url_redirect);

try {
    $session = $helper->getSessionFromRedirect();
} catch(FacebookRequestException $ex) {
    // When Facebook returns an error
} catch(\Exception $ex) {
    // When validation fails or other local issues
}

if (isset($session)) { // Login successful
    //*** Exchange for long-lived token
    $facebook = new FacebookSession($session->getAccessToken());
    $long_lived_token = $facebook->getLongLivedSession();

    //*** Make an api call
    try {
        $response = ( new FacebookRequest( $session, 'POST', '/me/feed', array(
				'link'      => 'http://geekboy.in/hanh-trang-cho-developer-2014/',
				'message'   => 'Hello, EchPay! Đây là bài viết mình post tự động bằng cách sử dụng api của Facebook',
            )
        ))->execute()->getGraphObject() ;  
        
        echo "Posted with id: ". $response->getProperty('id');


	} catch(FacebookRequestException $e) {

		echo "Exception occured, code: " . $e->getCode();
		echo " with message: " . $e->getMessage();

	} catch (Exception $ex) {
		echo $ex->getMessage();
	}    

    print_r($session);

} else { // Not logged
    echo 'Not logged <br/>';
    $login_url = $helper->getLoginUrl();
    echo "<a href='". $login_url. "'>Login with facebook</a>";
}