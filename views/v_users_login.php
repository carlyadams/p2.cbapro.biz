<form class="form-signin" method="post" action="/users/p_login">
    <?php if(isset($info)): ?>
        <label>
            <?= $info ?>
        </label>
    <?php endif; ?>


    <?php if(isset($error)): ?>
        <label>
            <?= $error ?>
        </label>
        <br>
    <?php endif; ?>


    <h2 class="form-signin-heading">Please log in</h2>
    <input type="text" class="input-block-level" placeholder="Email address" name="email"/>
    <input type="password" class="input-block-level" placeholder="Password" name="password"/>
    <button class="btn btn-large btn-primary" type="submit">Log in</button>
    <!--        or <a class="signup" href="/users/signup">Sign up</a> -->
</form>

