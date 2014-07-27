<html>
<head>
    <title>Facebook Login</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
    <style>
        .container {
            margin-top: 40px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <?php if (isset($errors)): ?>
        <div class="col-md-12 alert alert-danger">
            <?php  echo $errors; ?>
        </div>
        <?php endif; ?>
    
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <?php if (isset($name)): ?>
                    <h2>Hello, <?php echo $name; ?></h2>
                    <?php endif; ?>
                    <h3 class="alert alert-danget"><?php if (isset($message)) echo $message; ?></h3>                            
                </div>
                <div class="col-md-12">
                    <form action="index.php">
                        <input type="submit" value="Check session" class="btn btn-info" />
                    </form>                                    
                </div>

                <div class="col-md-12"></div>
            </div><!--./row-->
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12"><fb:login-button show-faces="true" perms="email" /></div>
                <div class="col-md-12">
                    <?php if (isset($login_url)): ?>
                    <a href="<?php echo $login_url; ?>" class="btn btn-success">Login using facebook</a>
                    <?php endif; ?>
                </div>
                
                <div class="col-md-12">
                    <h2>Your information</h2>
                    <p>FirstName: <?php if (isset($response)) echo $response->getFirstName(); ?></p>
                    <p>LastName: <?php if (isset($response)) echo $response->getLastName(); ?></p>
                    <p>Birthday: <?php if (isset($response)) echo $birthday->format('d-m-Y'); ?></p>
                </div>                
            </div>
            
            
        </div>    
    </div> <!--/.row-->
</div>



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
   window.fbAsyncit = function() {}
 */
  window.fbAsyncInit = function() {
    
    FB.init({
      appId      : '695082060564419',
      xfbml      : true, // parse social plugins on this page
      cookie     : true,
      version    : 'v2.0' // use version 2.0
    });

    /* Check if user has logged. The param response can be: connected | unknown | not_authorized
        FB.getLoginStatus(function(response) {

        });

      This code below is the function to get login form by facebook.
      - The simple login: 
        FB.login();
      - The advanced login:
        FB.login(function() {}, { scope: 'publish_actions'});        
    */
    FB.getLoginStatus(function(response) {

      console.log(response);
      
      if ( response.status === 'connected' ) {
        
            //Get information of a user
            FB.api('/'+ uid, 'get', function(res) {
            
            //do stuff with the response
            console.log(res);

        });

      } else if (response.status === 'not_authorized') {
          // Do stuff here

      } else {
        
//        FB.login( function() {
//          //Handle the response
//          // Systax: FB.api( path, method, param, callback );
//
//          //FB.api('/me/feed', 'get', {message: 'Hello, world!'} );
//
//        }, {
//            scope: 'publish_actions, email, user_likes',
//            return_scopes: true
//        } );

      }
    }, true );

  };



</script>
</body>
</html>