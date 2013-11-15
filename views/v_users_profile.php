<body bgcolor="#0C11F5" text="#24F80C" link="#24F80C" vlink="#24F80C" alink="#24F80C">

<h1>Profile info for <?=$user->first_name ?> </h1>
<ul>
        <li>First Name: <?=$user->first_name?></li>
        <li>Last Name: <?=$user->last_name?></li>
        <li>Email: <?=$user->email?></li>
        <li>Greener Member since: <?=Time::display($user->created)?></li>
        <br>


<a href='/users/change_password/'>Change Password</a>
