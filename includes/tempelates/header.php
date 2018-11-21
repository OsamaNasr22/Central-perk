
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo getTitle();?></title>
        <link rel="stylesheet" href="<?php echo $css;?>bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo $css;?>font-awesome.min.css"/>
        <link rel="stylesheet" href="<?php echo $css;?>frontend.css"/>
    </head>
    <body>
        <div id="pop_background"></div>
	<div id="pop_box">
		  <span id="close"> &times;</span>
                  <form method="post" class="form-horizontal" action="?do=feed">
                      <h3 class="text-center">Write Your Feedback</h3>
                      <textarea name="feed" placeholder="Enter Your Feedback" required></textarea>
                      <input class="form-control btn btn-primary" type="submit" value="send">
                  </form>
	</div>
        <?php
        @$do=$_GET['do'];
        if($do=='feed'){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $db=new database();
                //`user_id``id`, `feedback`, `username`, `user_id`, `date_feed`
                $data['user_id']=$_SESSION['userid'];
                $data['username']=$_SESSION['user'];
                $data['feedback']=$_POST['feed'];
                $fed=$db->Add('feedback', $data);
                if($fed){
                    echo '<script>alert("Thanks");history.back();</script>';
                }
            } else {
                redirect("","back",0);    
            }
        }
        ?>