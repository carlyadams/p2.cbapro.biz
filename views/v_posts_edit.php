<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<style type="text/css">
body,td,th {
	color: rgba(7,243,12,1);
}
body {
	background-color: rgba(17,43,248,1);
	font-size: 24px;
}
</style>
<body bgcolor="#0916F7" text="#0CF835" link="#0CF835" vlink="#0CF835" alink="#0CF835"><div class="6">


<script type="text/javascript">
    $(function () {
        $('textarea.limited').maxlength({
            'feedback' : '.charsLeft' // note: looks within the current form
        });
        
        $('input.limited').maxlength({
            'feedback' : '.charsLeftInput' // note: looks within the current form
        });
     
    });
    
</script>








<form method='POST' action='/posts/p_edit/<?php echo $post['id']; ?>              
    <p>
  <label><small>GREENER Title</small></label>
  <input type="text" name="title" maxlength="100" value="<?php echo $post['title']; ?>" placeholder="Your GREENER Title" autofocus>
  </p>
    <p><strong>Characters left:</strong> <span>10</span></small>
    <p>
      <textarea class="form-control limited" maxlength="250" rows="4" cols="50" name="content"><?php echo $post['content']; ?></textarea>
    </p>

      
      
      
      <label><small>Your GREENER</small><span style="color: rgba(16,20,248,1)"></span></label>

                    <p class="char-count"><strong>Characters left:</strong> <span class="charsLeft">10</span></small></p>


                    <br />
                
<input name="GREENER" type="button" id="GREENER" title="Greener Editor" value="Edit Greener">
</form>
    


 