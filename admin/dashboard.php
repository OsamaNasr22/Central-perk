<?php
ob_start();
session_start();
$pageTitle="dashboard";
if(isset($_SESSION["admin"])){
include_once  './ini.php'; 
    $db=new database();
    $totalmem=$db->totalItem("id", "users","WHERE GroupId=?",array(0));
    $totalcom=$db->totalItem("id", "comments");

    $penmem=$db->totalItem("id", "users","WHERE regStatus=? And GroupId!=?",array(0,1));
    $totalitem=$db->totalItem("id", "items");
    $lastitems=$db->latestItems("*", "items", "id","",5);
     $query="INNER JOIN items ON comments.item_id=items.id INNER JOIN users ON comments.user_id=users.id";
    $latescomment=$db->latestItems("comments.*,items.item_name,users.username", "comments", "id", $query,10);
  ?>
    <div class="container ">
        <h1 class=" shadowhead text-center">Dashboard</h1>
        <div class=" homestat text-center">
            <div class="container">
                
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="stat stat1 ">
                        <div class="icon-info ">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="info ">
                            <p>Total Members</p>
                        <a href="Members.php"><span><?php echo $totalmem;?></span></a>
                        </div>
                        
                    </div>
                </div>
                 <div class="col-lg-3">
                    <div class="stat stat2">
                        <div class="icon-info">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <div class="info">
                            <p>Pending Members</p>
                        <a href="Members.php?page=Pending"><span> <?php echo $penmem;?></span></a>
                            
                        </div>
                        
                    </div>
                </div>
                 <div class="col-lg-3">
                    <div class="stat stat3">
                        <div class="icon-info">
                        <i class="fa fa-tags"></i>

                        </div>
                        <div class="info">
                            <p>Total Items</p>
                            <a href="items.php"> <span> <?php echo $totalitem;?></span></a>
                        </div>
                        
                    </div>
                </div>
                 <div class="col-lg-3">
                    <div class="stat stat4">
                        <div class="icon-info">
                  <i class="fa fa-comments"></i>

                        </div>
                        <div class="info">
                            <p>Comments</p>
                            <a href="comments.php"><span><?php echo $totalcom;?></span></a>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
        <div class="lastest">
            <div class="row">
                
                
                
                 
                <div class="col-lg-6">
                   <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users"></i>Latest Register Users
                            <div class="toggle-latest pull-right">
                                <i class="fa fa-minus"></i>
                            </div>
                        </div>
                        <?php
                          $db=new database();
                        $luser= $db->latestItems("*", "users", "id","WHERE GroupId!=1", 5);
                        ?>
                        <div class="panel-body">
                            <ul class="list-unstyled list-group">
                                <?php
                                    foreach ($luser as $user){
                                     echo"<li class=\"list-group-item \"> <span>{$user['username']}</span>
                                <a href=\"Members.php?do=Edit&id={$user['id']}\" class=\"edit pull-right \"><i class=\"fa fa-edit \"></i></a>
                                <a href=\"Members.php?do=Delete&id={$user['id']}\" class=\"delete pull-right confirm\"><i class=\"fa fa-remove\"></i></a>"

                                ;
                                if($user["regStatus"]==0&&$user["GroupId"]!=1){
                                    echo "<a href=\"Members.php?do=Activate&id={$user['id']}\" class=\"activate pull-right \"><i class=\"fa fa-check-circle \"></i></a>
";
                                }
                                echo "</li>";
                                    }
                                ?>                            
                            </ul>
                        </div>
                    </div>
                </div>
                    
                    <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-comments"></i>Latest Comments
                        <div class="toggle-latest pull-right">
                                <i class="fa fa-minus"></i>
                            </div>
                        </div>
                        <div class="panel-body">
                            
                            <?php
                            if(!empty($latescomment)){
                            foreach ($latescomment as $com){ ?>
                                <div class="comment-div">
                                    <div class="com-user"><?php echo $com['username'];?></div>
                                <div class="com-text">
                                    <p><?php echo $com['comment'];?></p>
                                    <a href="comments.php?do=Edit&id=<?php echo $com['id'];?>"><span>edit</span></a>
                                    <a href="comments.php?do=Delete&id=<?php echo $com['id'];?>" class="confirm"><span>| delete</span></a>
                                    <?php echo ($com['status']==0)?"<a href=\"comments.php?do=Activate&id={$com['id']}\"><span>| accept</span></a> ":"";?>
                                    <span class="com-date pull-right"><?php echo $com['comment_date'];?></span>
                                </div>
                            </div>
                            <hr>
                            <?php } } else {
                                            echo 'Empty';
                                            }
                            ?>
                            

                        </div>
                    </div>
                </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-tags"></i>Latest Items
                        <div class="toggle-latest pull-right">
                                <i class="fa fa-minus"></i>
                            </div>
                        </div>
                        <div class="panel-body">
                            <ul class="list-unstyled list-group">
                                <?php
                                    foreach ($lastitems as $item){
                                     echo"<li class=\"list-group-item \"> <span>{$item['item_name']}</span>
                                <a href=\"items.php?do=edit&id={$item['id']}\" class=\"edit pull-right \"><i class=\"fa fa-edit \"></i></a>
                                <a href=\"items.php?do=delete&id={$item['id']}\" class=\"delete pull-right confirm\"><i class=\"fa fa-remove\"></i></a>"

                                ;
                               
                                echo "</li>";
                                    }
                                ?>                            
                            </ul>

                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div> 
        <?php
     include_once $tem.'footer.php';
} else {
    header("Location: index.php");
exit();    
}
ob_end_flush();
?>