<!DOCTYPE html>
<html>
<head>
        <title><?php if(isset($title)) echo $title; ?></title>


        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        
                                        
        <!-- Controller Specific JS/CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet"/>
    <link href="/css/profile.css" rel="stylesheet"/>


        <?php if(isset($client_files_head)) echo $client_files_head; ?>
        
</head>


<body bgcolor="#0D1AFB" text="#0BFB08" link="#0BFB08" vlink="#0BFB08" alink="#0BFB08">        
    <div class="navbar navbar-fixed-top navbar-inverse">
        <div class="navbar-inner">
            <div class="container">
                <a href="/" class="brand" style="font-size: 36px">CBA eBlog</a>
                <div class="nav-collapse collapse">
                    <?php if($user): ?>
                        <ul class="nav">
                            <!-- menu for logged in users -->
                            <li><a href="/posts/following">GURUS You FOLLOW</a></li>
                            <li><a href="/users/follow">FOLLOW more GURUS</a></li>


                            <?php if (!IN_PRODUCTION): ?>
                                <li><a href="/posts/all">All GREENERS</a></li>
                            <?php endif; ?>
                  </ul>
                        <ul class="nav pull-right">
                            <!-- <a href="/users/profile">Profile</a> -->
                            <li><a href="/posts/mine"><?=$user->first_name ?></a></li>
                          <li><a href="/users/logout">Logout</a></li>
                            <?php if (!IN_PRODUCTION): ?>
                                <li><a href="/posts/mine">User ID: <?=$user->user_id ?></a></li>
                            <?php endif; ?>
                        </ul>
                    <?php else: ?>
                        <ul class="nav pull-right">
                            <!-- menu for users that are not logged in -->
                            <li><a href="/users/login">Login</a></li>
                            <li><a href="/users/signup">Sign up</a></li>
                        </ul>
                    <?php endif; ?>
              </div>
          </div>
        </div>
</div>


        <?php if(isset($content)) echo $content; ?>


        <?php if(isset($client_files_body)) echo $client_files_body; ?>


    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap-min.js"></script>
</body>
</html>
