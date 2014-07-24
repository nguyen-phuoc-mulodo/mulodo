<html>
<head>
    <title>Facebook Login</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <style>
        .container {
            margin-top: 40px;
        }
    </style>
    
</head>
<body ng-app="myModule">
    <div class="container">
        <div class="row">
            <?php if (isset($errors)): ?>
            <div class="col-md-12 alert alert-danger">
                <?php  echo $errors; ?>
            </div>
            <?php endif; ?>
            
            <div class="col-md-8" ng-controller="getUserProfile as userinfo">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="alert alert-info">Welcome to my page</h2>
                        <h3>{{"Hope you enjoy this"}}</h3>
                        <form action="server.php" method="POST">
                            <input type="submit" value="Get User info" class="btn btn-md btn-info" />
                        </form>                                                
                    </div>
                    <div class="col-md-12">
                        <p>User: {{userinfo.user.name}}</p>
                        <p>Facebook: <a target="_blank" ng-href="{{userinfo.user.link}}">Click here</a></p>
                        <p>Birthday: {{userinfo.user.birthday}}</p>
                        <p>location: {{userinfo.user.location}}</p>
                    </div>

                </div>
                
            </div>
            <div class="col-md-4">
                <div id="facebook" class="col-md-12">
                    <div class="fb-login-button" data-scope="public_profile, user_friends, user_birthday, user_location" data-max-rows="4" data-size="xlarge" data-show-faces="true" data-auto-logout-link="true"></div>                    
                </div>                            
                <div class="col-md-12">
                
                </div>
            </div>            
        </div>
    </div><!--/.container-->
    <script>

    /*
    * Before using facebok Javascript SDK. You muse load SDK for javascript.
    * Use this code below.
    */
      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));

    /*
     * Wrap your inside below: 
       window.fbAsyncit = function() {
        // your code's here
       }
     */
        window.fbAsyncInit = function() {

            FB.init({
              appId      : '695082060564419',
              xfbml      : true, // parse social plugins on this page
              version    : 'v2.0', // use version 2.0
              cookie     : true, // must be enable to use FacebookJavascriptLoginHelper
            });

            /* Check if user has logged.
                FB.getLoginStatus(function(response) {

                });

              This code below is the function to get login form by facebook.
              - The simple login: 
                FB.login();
              - The advanced login with grant permissions:
                FB.login(function() {}, { scope: 'publish_actions'});        
            */

            /*
             * FB.getLoginStatus(callback, bool)
             * the second parameter set to true to force a roundtrip to Facebook 
             * - effectively refreshing the cache of the response object.
             */
            FB.getLoginStatus(function(response) {
                /*
                 * Response Object: 
                 * - status (string): connected | unknown | not_authorized
                 * - authResponse (Object): 
                 * {
                        status: 'connected',
                        authResponse: {
                            accessToken: '...',
                            expiresIn:'...',
                            signedRequest:'...',
                            userID:'...'
                        }
                    }
                 */
                console.log(response);

                if ( response.status === 'connected' ) { // Logged into your app and Facebook.
                    console.log('Logged');
                    var uid = response.authResponse.userID;
                    // Call api. Get information of a user
                    FB.api('/'+ uid, 'get', function(res) {

                      //do stuff with the response
                      console.log(res);

                    });

                } else if (response.status === 'not_authorized') { // The person is logged into Facebook, but not your app.


                } else {

                    // The person is not logged into Facebook, so we're not sure if
                    // they are logged into this app or not.                

                    //Get facebook login
//                    FB.login( function() {
//                      //Handle the response
//                      // Systax: FB.api( path, method, param, callback );
//
//                      FB.api('/me/feed', 'get', {message: 'Hello, world!'} );
//
//                    }, {
//                        scope: 'publish_actions, email, user_likes',
//                        return_scopes: true // ???
//                    } );

                }
            }, true );

        };
    </script>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=695082060564419&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.19/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
    <?php include 'ng.php'; ?>
</body>
</html>