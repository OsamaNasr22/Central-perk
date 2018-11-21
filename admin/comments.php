<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ob_start();
session_start();
$pageTitle="Comments";

if(isset($_SESSION['admin'])){
    include './ini.php';
    echo '<div class="container mem">';
    $do=(isset($_GET["do"]))?$_GET["do"]:"manage";
    $comid=(isset($_GET["id"]) && is_numeric($_GET["id"]))?intval($_GET["id"]):0;
    if($do=="manage"){
        $query="INNER JOIN items ON comments.item_id=items.id INNER JOIN users ON comments.user_id=users.id";
        $d1=new database();
        $comments=$d1->select("comments.*,items.item_name,users.username", "comments", $query);
      if(!empty($comments)){
          
      
        ?>

<div class="maintable">
    <h1 class="text-center shadowhead">Manage Comments</h1>
    <table class="table table-bordered table-responsive table-hover">
        <!--`id`, `username`, `password`, `Email`, `Fullname`, `GroupId`, `trustStatus`, `regStatus-->

        <tr>
            <th>#ID</th>
            <th>Comment</th>
            <th>User</th>
            <th>Item</th>
            <th>Date</th>
            <th>Manage</th>
        </tr>
        <?php 
                foreach($comments as $com ){
                    if($com['status']==0){
                        $activate="<a href=\"comments.php?do=Activate&id={$com['id']}\" class=\"activate\"><i class=\"fa fa-check-circle\"></i></a>";

                    } else {
                    $activate="";    
                    }
             $users= <<<MEMBERS
        <tr>
             <td>{$com['id']}</td>
             <td><span class="tab-wide">{$com['comment']}</span></td>
             <td>{$com['username']}</td>
             <td>{$com['item_name']}</td>
             <td>{$com['comment_date']}</td>
             <td>
                 <a href="comments.php?do=Edit&id={$com['id']}" class="edit"><i class="fa fa-edit"></i></a>
                 <a href="comments.php?do=Delete&id={$com['id']}" class="delete confirm"><i class="fa fa-remove"></i></a>
                 {$activate}
             </td>
        </tr>
MEMBERS;
                 echo $users;
        }
        
       
        ?>
         
    </table>
</div>
    <?php 
    } else {
        echo '<div class="empty-rec">This Page is not have any record</div>';
      }
                 }
 elseif($do=="Edit") {
         $comid=(isset($_GET["id"]) && is_numeric($_GET["id"]))?intval($_GET["id"]):0;
         $db= new database();
         $data=array($comid);
         $arr=$db->select("*", "comments","WHERE id=?",$data);
         $row=$db->totalItem("*", "comments","WHERE id=?",$data);
        if($row>0){?>

<h1 class="text-center shadowhead" >Edit Comment</h1>
    <div class="container">
        <form class="form-horizontal" action="comments.php?do=Update" method="POST">
            <input class="form-control" type="hidden" name="comid" value="<?php echo $comid;?>">
            <div class="form-group ">
                <label class="col-lg-2 control-label">Comment</label>
                <div class="col-lg-10">
                    <textarea class="form-control" name="comment"><?php echo $arr[0]['comment'];?></textarea>
                </div>
            </div>
            <div class="form-group ">
                <div class="col-lg-offset-2 col-lg-10">
                    <input class="btn btn-primary" type="submit" value="Edit">
                </div>
            </div>
        </form>
</div>
        <?php } 
        
        else {
     redirect("<div class='alert alert-danger'>This Comment is not found</div>","back",4);
        }   
    }
    elseif($do=="Update"){
     if($_SERVER["REQUEST_METHOD"]=="POST"){
           $id=$_POST['comid'];
         $data["comment"]=$_POST["comment"];

         $db=new database();
         $row=$db->Update("comments", $data, $id);
         redirect("<div class='alert alert-success'>{$row} Record Updated</div>","back",4);      
       
     } else {
         redirect("<div class='alert alert-danger'>don't access this page dirctly</div>","back",2);    
     }
        }
elseif($do=="Delete"){
    echo '<h1 class="text-center shadowhead">Remove Comment</h1>';
    $db=new database();
    $row=$db->totalItem("*", "comments","WHERE id=?",array($comid));

    if($row >0){

        $row=$db->Delete("comments", $comid);
         redirect("<div class='alert alert-danger'>{$row} Record Removed</div>","back",2);
        
    }else{
        redirect("Redirect back","back",2);
    }
}
elseif ($do=="Activate") {
    $db=new database();
    $check=$db->totalItem("id", "comments", "WHERE id=?",array($comid));
    if($check>0){
      $row=$db->activateMembers("comments", $comid,"status=1");
         redirect("<div class='alert alert-success'>{$row} Record Activated</div>","back",3);
    } else {
        redirect("Redirect back","back",0);
    }
}
    
    else {
       redirect("Redirect back","back",0);   
    }
    echo '</div>';
    include $tem."footer.php";
} else {
    header("Location:index.php");
exit();    
}
ob_end_flush();
?>