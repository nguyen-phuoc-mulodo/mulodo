<?php
    require '../vendor/autoload.php';
    session_start();
    
    use Facebook\FacebookSession;
    use Facebook\FacebookJavaScriptLoginHelper;
    use Facebook\FacebookRequestException;
    use Facebook\FacebookRequest;
    use Facebook\GraphUser;
    

    //Set up application
    $appId = '695082060564419';
    $appSecret ='093b0b371673a8b831dcc87d62fee7b0';
    FacebookSession::setDefaultApplication($appId, $appSecret);
    
    $url = 'http://localhost/xampp/facebook/phpsdk';
    
    $helper = new Facebook\FacebookRedirectLoginHelper($url);
    
    try 
    {
        // Get session of facebook login
        $session = $helper->getSessionFromRedirect();
    } catch (Exception $ex) {

    } catch (FacebookRequestException $ex) {
        // When Facebook returns an error
        $errors =  'Error: ' . $ex->getMessage();    
    }
    if (isset($session)) {
        //Call API get User information
        $response = (new FacebookRequest($session, 'GET', '/me'))
                    ->execute()
                    ->getGraphObject(Facebook\GraphUser::className());
        
        $data['name'] = $response->getName();
        $data['birthday'] = $response->getBirthday();
        $data['link'] = $response->getLink();
        $data['location'] = $response->getLocation();
        $data = json_encode($data);
        
    } else {
        // Not Logged
        $login_url = $helper->getLoginUrl();
    }


    include_once 'layout.php';