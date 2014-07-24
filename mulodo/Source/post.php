<meta charset="utf-8">
<?php
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use Facebook\FacebookJavaScriptLoginHelper;
use Facebook\FacebookRedirectLoginHelper;


require 'vendor/autoload.php';

define('FB_APP_ID', '695082060564419');
define('FB_APP_SECRET', '093b0b371673a8b831dcc87d62fee7b0');

FacebookSession::setDefaultApplication(FB_APP_ID, FB_APP_SECRET);

session_start();
/*
 * Check login using PHP SDK
 */

$helper = new FacebookRedirectLoginHelper('http://localhost/xampp/facebook/post.php');


/* 
 * Check login by using FacebookJavaScriptLoginHelper() with Javascript SDK
 */
//$helper = new FacebookJavaScriptLoginHelper();


$session = NULL;
$name = '';
try {
    // Check if user has login
    $session = $helper->getSessionFromRedirect(); // use this code for FacebookRedirectLoginHelper
    
    //$session = $helper->getSession(); //use this code for FacebookJavaScriptLoginHelper
    
  
} catch(FacebookRequestException $ex) {
    // When Facebook returns an error
    
} catch(\Exception $ex) {
    // When validation fails or other local issues
    
}

/*
 * Check if user has login to facebook
 */

if ($_SESSION['fb_access_token']) {
    $session = new FacebookSession($_SESSION['fb_access_token']);
}

if ($session) {
    // Logged in
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
} else {
    $login_url = $helper->getLoginUrl();
}
    
include 'layout.php';