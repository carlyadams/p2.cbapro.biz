<body bgcolor="#0814F5" text="#08F824" link="#08F824" vlink="#08F824" alink="#08F824">
<div class="container greenmachine">
    <h2>Learn more green by following more <em>GURUS</em>, GREENERS.</h2>
    <div class="offset1">
        <?php foreach($users as $user): ?>
            <div class="row">
                <div class="span1">
                    <!-- If there exists a connection with this user, show a unfollow link -->
                    <?php if(isset($following[$user['user_id']])): ?>
                        <a class="btn btn-mini pull-right" href='/users/unfollowUser/<?=$user['user_id']?>'>Unfollow</a>
                    <?php else: ?>
                        <!-- Otherwise, show the follow link -->
                        <a class="btn btn-mini btn-success pull-right" href='/users/followUser/<?=$user['user_id']?>'>Follow</a>
                    <?php endif; ?>
                </div>
                <div class="span6">
                    <!-- Print this user's name -->
                    <label><?=$user['first_name']?> <?=$user['last_name']?></label>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


    <a class="btn btn-primary pull-right" href="/">Done</a>
</div>
