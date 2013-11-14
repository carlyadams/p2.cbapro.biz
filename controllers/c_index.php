<?php


class index_controller extends base_controller {
        
        /*-------------------------------------------------------------------------------------------------


        -------------------------------------------------------------------------------------------------*/
        public function __construct() {
                parent::__construct();
        } 
                
        /*-------------------------------------------------------------------------------------------------
        Accessed via http://localhost/index/index/
        -------------------------------------------------------------------------------------------------*/
        public function index($error_code = NULL, $login_email = NULL) {
        if ($this->user) {
            // If the user is logged in redirect to Posts page
            Router::redirect('/posts/');
        }


                # Any method that loads a view will commonly start with this
                # First, set the content of the template with a view file
                $this->template->content = View::instance('v_index_index');
        $this->template->title = "Welcome | ".APP_NAME;


        if ($error_code == ERROR_LOGIN_MANDATORYFIELDS) {
            $this->template->content->login_error = "Please enter your email and password.";
        }
        else if ($error_code == ERROR_INVALIDUSRPWD) {
            $this->template->content->login_error = "Login failed. Please double-check your email and password.";
        }
        else if ($error_code == ERROR_SIGNUP_MANDATORYFIELDS) {
            $this->template->content->signup_error = "All fields are required. Please try again.";
        }
        else if ($error_code == ERROR_ALREADYREGISTERED) {
            $this->template->content->signup_error = "Email ".$login_email." was previously registered. Try logging in instead.";
        }


                # Now set the <title> tag


        
                # CSS/JS includes
                        /*
                        $client_files_head = Array("");
                    $this->template->client_files_head = Utils::load_client_files($client_files);
                    
                    $client_files_body = Array("");
                    $this->template->client_files_body = Utils::load_client_files($client_files_body);   
                    */
                                                                           
                # Render the view
                        echo $this->template;


        } # End of method
        
        
} # End of class

