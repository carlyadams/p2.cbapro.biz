<body bgcolor="#1208FB" text="#08F90D" link="#08F90D" vlink="#08F90D" alink="#08F90D
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3">
            <form method="post" action="<?='/posts/p_add/'.$page_after_add ?>">
                <h2 class="form-signin-heading">Welcome, <?=$user->first_name; ?>.</h2>
                <input type="text" name="content" class="input-block-level" placeholder="What is your GREEN fix for today?"/>
                <button class="btn btn-primary" type="submit">Post</button>
            </form>
        </div>


        <div class="greenmachine span9">
            <h2>Here's what your favorite <em>GREENERS</em> are saying:</h2>
            <a href="/users/follow" class="btn pull-right btn-info">Follow more <em>GREENERS</em></a>
            <?php foreach($posts as $post): ?>
                <div class="media span6">
                    <div class="media">
                        <label class="media-heading">On
                            <time class="post" datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
                                <?=Time::display($post['created'])?>
                            </time>
                            <?php if ($post['user_id'] == $user->user_id): ?>
                                <strong class="author">you</strong>
                            <?php else: ?>
                                <strong class="author"><?=$post['first_name']?> <?=$post['last_name']?></strong>
                            <?php endif; ?>


                            <?php if (!IN_PRODUCTION): ?>
                                (<?=$post['user_id']?>)
                            <?php endif; ?>
                            posted:
                        </label>
                        <?php if ($post['user_id'] == $user->user_id): ?>
                            <a class="btn btn-mini pull-right" href="<?='/posts/p_delete/'.$post['post_id'].'/'.$page_after_delete ?>">Delete Post</a>
                        <?php else: ?>
                            <a class="btn btn-mini btn-inverse pull-right" href="<?='/users/unfollowUser/'.$post['user_id'] ?>">Unfollow</a>
                        <?php endif; ?>
                        <p class="media-body"><em>"</em><?=$post['content']?><em>"</em></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

