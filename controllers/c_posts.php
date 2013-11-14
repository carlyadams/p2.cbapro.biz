<?php


class posts_controller extends base_controller {


    public function __construct() {
        parent::__construct();


        // Make sure the user is logged in. If not link to the login page.
        if(!$this->user) {
            die("Members only. Please <a href='/users/login'>login</a>.");
        }
    }


    public function index() {
        $this->following();
    }


    public function add() {
        $this->template->content = View:: instance('v_posts_add');
        $this->template->title = "New Post";


        echo $this->template;
    }


    public function p_add($next_page = NULL) {
        // todo Create a better "Add Post" page


        // Set user ID
        $_POST['user_id'] = $this->user->user_id;


        // Set timestamps
        $_POST['created'] = Time::now();
        $_POST['modified'] = Time::now();


        // Save post to DB
        DB::instance(DB_NAME)->insert('posts', $_POST);


        Router::redirect('/posts/'.$next_page);
    }


    public function p_delete($post_id, $next_page = NULL)
    {
        if ($post_id) {
            // Delete the post if it belongs to the user
            $where = "WHERE post_id = ".$post_id." AND user_id = ".$this->user->user_id;


            DB::instance(DB_NAME)->delete('posts',$where);
        }


        Router::redirect('/posts/'.$next_page);
    }


    public function following() {
        $this->template->content = View::instance('v_posts_index');
        $this->template->title = "GREENERS | ".APP_NAME;
        $this->template->content->page_after_delete = 'following';
        $this->template->content->page_after_add = 'following';


        // Retrieve posts from followed users and the users own posts
        $q = "(SELECT posts.post_id AS post_id, posts.content AS content, posts.created AS created, posts.user_id AS user_id, users.first_name AS first_name,
                users.last_name AS last_name FROM posts
                INNER JOIN users_followers ON users_followers.user_id=posts.user_id
                INNER JOIN users ON posts.user_id = users.user_id
                WHERE follower_user_id=".$this->user->user_id.
            ") UNION (".
                "SELECT post_id, content, created, user_id, '".$this->user->first_name."' AS first_name, '".
                    $this->user->last_name."' AS last_name
                    FROM posts WHERE user_id = ".$this->user->user_id.
            ") ORDER BY created DESC";


        $posts = DB::instance(DB_NAME)->select_rows($q);


        // Display posts
        $this->template->content->posts = $posts;
        echo $this->template;
    }


    public function all() {
        $this->template->content = View::instance('v_posts_index');
        $this->template->content->page_after_delete = 'all';
        $this->template->content->page_after_add = 'all';


        // Retrieve posts from DB
        $q = "SELECT posts.content, posts.post_id, posts.created, posts.user_id, users.first_name, users.last_name FROM posts
                INNER JOIN users ON posts.user_id = users.user_id
                ORDER BY posts.created DESC";
        $posts = DB::instance(DB_NAME)->select_rows($q);


        // Display posts
        $this->template->content->posts = $posts;
        echo $this->template;
    }


    public function mine() {
        $this->template->content = View::instance('v_posts_index');
        $this->template->title = "My GREENERS | ".APP_NAME;


        $this->template->content->page_after_add = 'mine';
        $this->template->content->page_after_delete = 'mine';


        // Retrieve posts from DB
        $q = "SELECT posts.content, posts.post_id, posts.created, posts.user_id, posts.user_id, '".
            $this->user->first_name."' AS first_name, '".
            $this->user->last_name."' AS last_name FROM posts
                WHERE user_id=".$this->user->user_id.
                " ORDER BY posts.created DESC";
        $posts = DB::instance(DB_NAME)->select_rows($q);


        // Display posts
        $this->template->content->posts = $posts;
        echo $this->template;
    }
}


?>