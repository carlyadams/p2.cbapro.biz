<!-- Start Error/Success Messages -->
<?php if(isset($_GET['no-permission'])): ?>
<div>

<strong> No permissions</strong></div>

<?php endif; ?>
<!-- End Error/Success Messages -->
<h1>Posts</h1>
<?php if($user): ?>
<a href="/posts/add/">New Posts</a><br>
<?php endif; ?> 

<?php foreach ($view_posts as $post): ?>

<!-- Start Post -->
<div> 
<!-- Process the Posts array -->
<h3><a href="/posts/view/post/<?php echo $post['id']; ?><?php echo $post['title']; ?>
</a></h3></div> 
<div> 
<?php echo $post['content']; ?>
</div>

<div>
<strong><small>Posted added by:</strong> 
<a href="/posts/user/<?php echo $post['created_by']; ?>
        <?php echo $post['first_name']; ?> 
        <?php echo $post['last_name'];?></a></small>
</div>
                <!-- End Post -->
<?php endforeach; ?>

