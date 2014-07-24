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
                    <div class="col-md-12 alert alert-info">
                        <h2 class="">Welcome to my page</h2>
                        <h3>{{"Hope you enjoy this"}}</h3>                                          
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
                    <?php if (isset($login_url)): ?>
                    <a class="btn btn-info btn-md" href="<?php echo $login_url ?>">Login with facebook</a>
                    <?php endif; ?>
                                  
                </div>                            
                <div class="col-md-12">
                
                </div>
            </div>            
        </div>
    </div><!--/.container-->
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.19/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
    <?php include 'ng.php'; ?>
</body>
</html>