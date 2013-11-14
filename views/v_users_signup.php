<body bgcolor="#0D0BFD" text="#30F708" link="#30F708" vlink="#30F708" alink="#30F708">
<form class="form-signin" method="post" action="/users/p_signup">
    <?php if(isset($error)): ?>
        <div class='error'>
            <?= $error ?>
            <?php if(isset($loginOption)): ?>
                Click <a class="login" href="/users/login">here</a> to login.
            <?php endif; ?>
        </div>
        <br>
    <?php endif; ?>
    <h2 class="form-signin-heading">Sign Up</h2>
    <input type="text" class="input-block-level" placeholder="First Name" name="first_name"/>
    <input type="text" class="input-block-level" placeholder="Last Name" name="last_name"/>
    <input type="text" class="input-block-level" placeholder="Email address" name="email"/>
    <input type="password" class="input-block-level" placeholder="Password" name="password"/>
    <button class="btn btn-large btn-primary" type="submit">Sign up to be a GURU</button>
    <!--
    or <a class="login" href="/users/login">Log in</a> -->
</form>


