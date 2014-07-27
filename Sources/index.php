<?php
/*
 * Tutorial for Login facebook using PHP SDK with Javascript SDK
 * Versions: 1.0
 * @Author: EchPay - Nguyen Huu Phuoc
 
 * * Packages using: 
 * - PHP SDK
 * - Composer
 * 
 */
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

    //Create a login helper
    $helper = new FacebookJavaScriptLoginHelper();
    
    try {
        $session = $helper->getSession();
    } catch(FacebookRequestException $ex) {
        // When Facebook returns an error
        $errors =  'Error: ' . $ex->getMessage();
    } catch(\Exception $ex) {
        // When validation fails or other local issues
    }
    
    if(isset($session)) {
        $message = 'Welcome to Tìm Chòi ';
        
        //Do stuff
        $response = ( new FacebookRequest($session,'GET','/me'))
                    ->execute()
                    ->getGraphObject(GraphUser::className());
        $name = $response->getName();
        $birthday = $response->getBirthday();
    } else {
        $message = 'Please login with facebook';
        $name = 'guys!';
    }
    
    include 'layout.php';



