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

    $helper = new FacebookJavaScriptLoginHelper();
    $session = NULL;
    
    try 
    {
        // Get session of facebook login
        $session = $helper->getSession();
    } catch (Exception $ex) {

    } catch (FacebookRequestException $ex) {
        // When Facebook returns an error
        $errors =  'Error: ' . $ex->getMessage();    
    }
    
    if (isset($session)) {
        // User is logged into facebook and app
        //Call API get User information
        $response = (new FacebookRequest($session, 'GET', '/me'))
                    ->execute()
                    ->getGraphObject(Facebook\GraphUser::className());
        
        $data['name'] = $response->getName();
        $data['birthday'] = $response->getBirthday()->format('d-m-Y');
        $data['link'] = $response->getLink();
        $data['location'] = $response->getLocation();
        
        $data = json_encode($data);
        
    } else {
        // Not Logged
        $errors =  "Not logged";
    }


    include_once 'index.php';