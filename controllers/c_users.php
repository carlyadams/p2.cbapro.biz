<?php
class users_controller extends base_controller {


    public function __construct() {
        parent::__construct();
        //echo "users_controller construct called<br><br>";
    }


    public function index() {
        $this->follow();
    }


    public function signup($error_code = NULL, $email = NULL) {
        $this->template->content = View::instance('v_users_signup');
        $this->template->title = "Sign Up | ".APP_NAME;


        if ($error_code == ERROR_ALREADYREGISTERED) {
            $this->template->content->error = "Email ".$email." already registered.";
            $this->template->content->loginOption = true;
        }
        elseif ($error_code == ERROR_SIGNUP_MANDATORYFIELDS) {
            $this->template->content->error = "All fields are required. Please try again.";
        }


        echo $this->template;
    }


    public function p_signup() {
        // Make sure all fields are field out
        $_POST['first_name'] = trim($_POST['first_name']);
        $_POST['last_name'] = trim($_POST['last_name']);
        $_POST['email'] = trim($_POST['email']);
        if (!$_POST['first_name'] or !$_POST['last_name'] or !$_POST['email'] or !$_POST['password']) {
            Router::redirect('/users/signup/'.ERROR_SIGNUP_MANDATORYFIELDS);
        }


        // Check if user exist
        $q = 'SELECT * FROM users WHERE email="'.$_POST['email'].'"';
        $user = DB::instance(DB_NAME)->select_row($q);


        if (isset($user)) {
            ///// Existing user ////


            Router::redirect('/users/signup/'.ERROR_ALREADYREGISTERED.'/'.$_POST['email']);
        }
        else {
            ///// new user


            // Encrypt password
            $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
            // Generate token
            $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());


            // Add timestamps
            $_POST['created'] = Time::now();
            $_POST['modified'] = Time::now();
            $_POST['timezone'] = TIMEZONE;


            // Insert new user data to DB
            DB::instance(DB_NAME)->insert_row('users', $_POST);


            // send email confirmation
            $this->email_signup_confimation($_POST);


            Router::redirect('/users/login/noerror/'.INFO_SIGNUP_SUCCESS);
        }
    }


    private function email_signup_confimation($user_info) {
        if ($user_info) {
            $to[] = Array(
                "name" => $user_info['first_name']." ".$user_info['last_name'],
                "email" => $user_info['email']
            );
            $from = Array("name" => APP_NAME, "email" => APP_EMAIL);
            $subject = "Welcome to ".APP_NAME."!";
            $body = "Hi ".$user_info['first_name'].", this is a message to confirm your registration at ".APP_NAME.
                ". Visit http://p2.cbapro.biz to login.";
            $cc  = APP_EMAIL;
            $bcc = "";
            $email = Email::send($to, $from, $subject, $body, true, $cc, $bcc);
        }
    }


    public function login($error_code = NULL, $info_code = NULL) {
        // Set up View
        $this->template->content = View::instance('v_users_login');
        $this->template->title = "Login | ".APP_NAME;


        if ($info_code == INFO_SIGNUP_SUCCESS) {
            $this->template->content->info = "Sign up successful! Please log in.";
        }


        if ($error_code == ERROR_INVALIDUSRPWD) {
            $this->template->content->error = "Login failed. Please double-check your email and password.";
        }


        // Render template
        echo $this->template;
    }


    public function p_login() {
        // Sanitize data entered by user
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);


        // Hash user-submitted password
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);


        // Check is email/password combination is correct.
        $q = "SELECT token FROM users WHERE email='".$_POST['email']."' AND password='".$_POST['password']."'";
        $token = DB::instance(DB_NAME)->select_field($q);


        // Check if the user token exists
        if ($token) {
            // Login success
            setcookie('token', $token, strtotime('+1 week'), '/');


            Router::redirect('/posts/index');
        }
        else {
            // Login failure
            Router::redirect('/users/login/'.ERROR_INVALIDUSRPWD);
        }
    }


    public function logout() {
        if ($this->user) {
            $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
            $data = Array('token' => $new_token);


            DB::instance(DB_NAME)->update('users', $data, 'WHERE user_id='.$this->user->user_id);
        }


        setcookie('token', '', strtotime('-1 year'), '/');
        Router::redirect('/');
    }


    public function profile($user_name = NULL) {
        if (!$this->user) {
            die("Members only. <a href='/users/login'>Login</a>");
        }


        # set up the view
        $view = View::instance('v_users_profile');
        $view->user_name = $user_name;


        $this->template->content = $view;
        $this->template->title = 'User Profile | '.$user_name;


        #display the view
        echo $this->template;
    }


    public function follow() {
        $this->template->content = View::instance('v_users_follow');
        $this->template->title = "GREENERS | ".APP_NAME;


        // Load all other users
        $q = "SELECT * FROM users WHERE user_id != ".$this->user->user_id;
        $users = DB::instance(DB_NAME)->select_rows($q);


        // Load the user IDs of users the logged in user is following
        $q = "SELECT * FROM users_followers WHERE follower_user_id =".$this->user->user_id;
        $following = DB::instance(DB_NAME)->select_array($q, 'user_id');


        // Pass data to the View
        $this->template->content->users = $users;
        $this->template->content->following = $following;


        echo $this->template;
    }


    public function followUser($follow_user_id) {
        $data = Array(
            'user_id' => $follow_user_id,
            'follower_user_id' => $this->user->user_id,
            'created' => Time::now()
        );


        DB::instance(DB_NAME)->insert('users_followers', $data);


        Router::redirect('/users/follow');
    }


    public function unfollowUser($unfollow_user_id) {
        // Remove "following" relationship from DB
        $where_condition = "WHERE user_id = ".$unfollow_user_id." AND follower_user_id = ".$this->user->user_id;
        DB::instance(DB_NAME)->delete('users_followers', $where_condition);


        Router::redirect('/users/follow');
    }


} # end of the class users_controller
?>