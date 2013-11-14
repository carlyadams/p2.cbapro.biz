<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>
	<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
	<?php
	# Setup view
    $this->template->content = View::instance('v_posts_index');
  $(document).ready(function () {
        var tz = jstz.determine();
        var timezone = jstz.determine();
		timezone.name(); 
		"America/New_York"
        response_text = 'No timezone found';
        
        if (typeof (tz) === 'undefined') {
            response_text = 'No timezone found';
        }
        else {
            response_text = tz.name(); 
        }
        
        $('#tz_info').html(response_text);
        
        $('#code-example').html("> var timezone = jstz.determine();\n" +
        "> timezone.name(); \n" + 
        "\"" + tz.name() + "\"\n\n");
        $('#tz_info').show();
        prettyPrint();
    });

	# View within a view        
    $this->template->content->signup = View::instance('v_signup');

	# Render template
    echo $this->template;?>
	
	<script>
    $('input[name=timezone]').val(jstz.determine().name());
	</script>


		
	<input type='hidden' name='timezone'>

	

	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- Common CSS/JSS -->
	 <link rel="stylesheet" href="/css/app.css" type="text/css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	
	
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	

	<?php if(isset($content)) echo $content; ?>



</body>
</html>