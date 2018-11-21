<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ob_start();
session_start();
$pageTitle="Members";

if(isset($_SESSION['admin'])){
    include './ini.php';
    echo '<div class="container mem">';
    $do=(isset($_GET["do"]))?$_GET["do"]:"manage";
    $userid=(isset($_GET["id"]) && is_numeric($_GET["id"]))?intval($_GET["id"]):0;
    if($do=="manage"){
        $query=(isset($_GET["page"])&& $_GET['page']=="Pending")?"WHERE GroupId != 1 AND regStatus=0":"WHERE GroupId != 1";

        $d1=new database();
        $members=$d1->select("*", "users", $query);

       if(!empty($members)){
           
       
        ?>
<div class="maintable">
    <h1 class="text-center shadowhead">Manage Members</h1>
    <table class="table table-bordered table-responsive table-hover">
        <!--`id`, `username`, `password`, `Email`, `Fullname`, `GroupId`, `trustStatus`, `regStatus-->

        <tr>
            <th>#ID</th>
            <th>Username</th>
            <th>Fullname</th>
            <th>E-mail</th>
            <th>Register Date</th>
            <th>Manage</th>
        </tr>
        <?php 
                foreach($members as $mem ){
                    if($mem['regStatus']==0){
                        $activate="<a href=\"Members.php?do=Activate&id={$mem['id']}\" class=\"activate\"><i class=\"fa fa-check-circle\"></i></a>";

                    } else {
                    $activate="";    
                    }
             $users= <<<MEMBERS
        <tr>
             <td>{$mem['id']}</td>
             <td>{$mem['username']}</td>
             <td>{$mem['Fullname']}</td>
             <td>{$mem['Email']}</td>
             <td>{$mem['date']}</td>
             <td>
                 <a href="Members.php?do=Edit&id={$mem['id']}" class="edit"><i class="fa fa-edit"></i></a>
                 <a href="Members.php?do=Delete&id={$mem['id']}" class="delete confirm"><i class="fa fa-remove"></i></a>
                 {$activate}
             </td>
        </tr>
MEMBERS;
                 echo $users;
        }
        
       
        ?>
         
    </table>
    <a href="Members.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i>Add New Member</a>
</div>

    <?php 
     } else {
             echo '<div class="empty-rec">This Page is not have any record</div>';
        }
                 }
 elseif($do=="Edit") {
         $userid=(isset($_GET["id"]) && is_numeric($_GET["id"]))?intval($_GET["id"]):0;
         $db= new database();
         $data=array($userid);
         $arr=$db->select("*", "users","WHERE id=?",$data);
         $row=$db->totalItem("*", "users","WHERE id=?",$data);
        if($row>0){?>

<h1 class="text-center shadowhead" >Edit Member</h1>
    <div class="container">
        <form class="form-horizontal" action="Members.php?do=Update" method="POST">
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Username</label>
                <div class="col-lg-10">
                    <input class="form-control" type="text" name="name" value="<?php echo $arr[0]['username'];?>" placeholder="Enter Your Name" autocomplete="off">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Fullname</label>
                <div class="col-lg-10">
                    <input class="form-control" type="hidden" name="userid" value="<?php echo $userid;?>">
                    <input class="form-control"   type="text" value="<?php echo $arr[0]['Fullname'];?>" name="fname" placeholder="Enter Your Fullname" autocomplete="off">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Password</label>
                <div class="col-lg-10">
                    <input class="form-control" value="" type="password" name="pass" placeholder="Enter Your Password" autocomplete="off">
                    <input class="form-control" type="hidden" name="oldpass" value="<?php echo $arr[0]['password'];?>">

                </div>
            </div>
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Email</label>
                <div class="col-lg-10">
                    <input class="form-control"   type="email" value="<?php echo $arr[0]['Email'];?>" name="email" placeholder="Enter Your Email" autocomplete="off">
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
     redirect("<div class='alert alert-danger'>This User is not found</div>","back",4);
        }   
    }
    elseif($do=="Update"){
     if($_SERVER["REQUEST_METHOD"]=="POST"){
           $id=$_POST['userid'];
         $data["username"]=$_POST["name"];
         $data["Fullname"]=$_POST["fname"];
        $data["password"]=(empty($_POST["pass"]))? $_POST["oldpass"] :sha1($_POST["pass"]);
         $data["Email"]=$_POST["email"];
         $errors=array();
         if(empty($data['username'])){
             $errors[]="field name must be filled";
         }
         if(empty($data['password'])){
             $errors[]="field password must be filled";
         }
         if(empty($data['Email'])){
             $errors[]="field Email must be filled";
         }
         if(empty($data['Fullname'])){
             $errors[]="field Fullname must be filled";
         }
         
         if(empty($errors)){
         $db=new database();
         $row=$db->Update("users", $data, $id);
         redirect("<div class='alert alert-success'>{$row} Record Updated</div>","back",4);      
         } else {
            foreach ($errors as $e){
                 echo "<div class='alert alert-danger'>{$e}</div>";
             }
           redirect("","back",4);
         }    
     } else {
         redirect("<div class='alert alert-danger'>don't access this page dirctly</div>","back",2);    
     }
        }
    
    elseif ($do=="Add") { 
       
        ?>
      <h1 class="text-center shadowhead">Add Member</h1>
    <div class="container">
        <form class="form-horizontal" action="?do=Insert" method="post">
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Username</label>
                <div class="col-lg-10">
                    <input class="form-control" type="text" name="name"  placeholder="Enter Your Name" autocomplete="off">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Fullname</label>
                <div class="col-lg-10">
                    <input class="form-control"  type="text"  name="fname" placeholder="Enter Your Fullname" autocomplete="off">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Password</label>
                <div class="col-lg-10">
                    <input class="form-control" value="" type="password" name="pass" placeholder="Enter Your Password" autocomplete="off">
                    <i class="fa fa-eye fa-2x password"></i>

                </div>
            </div>
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Email</label>
                <div class="col-lg-10">
                    <input class="form-control"   type="email"  name="email" placeholder="Enter Your Email" autocomplete="off">
                </div>
            </div>
             <div class="form-group ">
                <label class="col-lg-2 control-label">Permission</label>
                <div class="col-lg-1">
                    <input class="form-control"   type="number"  name="perm" min="0" max="1" value="0" autocomplete="off">
                </div>
            </div>
            
            <div class="form-group ">
                
                
                <div class="col-lg-offset-2 col-lg-10">
                    <input class="btn btn-primary" type="submit" value="Add">
                </div>
            </div>
        </form>
</div>  
      <!--`id`, `username`, `password`, `Email`, `Fullname`, `GroupId`, `trustStatus`, `regStatus-->
<?php }
 elseif ($do=="Insert") {
 if($_SERVER["REQUEST_METHOD"]=="POST"){
     echo '<h1 class="text-center shadowhead">Add Member</h1>';
     $errors=array();
     $db=new database();
     //`id`, `username`, `password`, `Email`, `Fullname`, `GroupId`, `trustStatus`, `regStatus`, `date`
     $data["username"]=$_POST['name'];
     $data["Fullname"]=$_POST['fname'];
     $pass=$_POST['pass'];
     $data["password"]= sha1($pass);
     $data["Email"]=$_POST['email'];
     $data["GroupId"]=$_POST['perm'];
     $data["regStatus"]=1;
      if(empty($data["username"])){
             $errors[]="field name must be filled";
         }
         if(empty($data['password'])){
             $errors[]="field password must be filled";
         }
         if(empty($data["Email"])){
             $errors[]="field Email must be filled";
            
     }
         if(empty($data["Fullname"])){
             $errors[]="field Fullname must be filled";
         }
         if(empty($data["GroupId"])){
             $permission=0;
         }
         
         if(!empty($errors)){
             foreach ($errors as $e){
                 echo "<div class='alert alert-danger'>{$e}</div>";
                 
             }
         redirect("",4);
         } else {
            
             if($db->totalItem("username", "users","WHERE username=?",array($data["username"]))!=0){
                 echo '<script>alert("the user is exist");history.back();</script>';
             } else {
                 $row=$db->Add("users", $data);
         $ms= "<div class='alert alert-success'>{$row} Record Added</div>";
          redirect($ms,2);
             }
              
         }
 } else {
     redirect("Redirect back","back",2);
     exit();
 }
}
elseif($do=="Delete"){
    echo '<h1 class="text-center shadowhead">Remove Member</h1>';
    $db=new database();
    $row=$db->totalItem("*", "users","WHERE id=? AND GroupId!=1",array($userid));

    if($row >0){

        $row=$db->Delete("users", $userid);
         redirect("<div class='alert alert-danger'>{$row} Record Removed</div>","back",2);
        
    }else{
        redirect("Redirect back","back",2);
    }
}
elseif ($do=="Activate") {
     echo '<h1 class="text-center shadowhead">Activate Member</h1>';
    $db=new database();
    $check=$db->totalItem("id", "users", "WHERE id=?",array($userid));
    if($check>0){
      $row=$db->activateMembers("users", $userid);
         redirect("<div class='alert alert-success'>{$row} Record Activated</div>","back",3);
    } else {
        redirect("Redirect back","back",2);
    }
}
    
    else {
       redirect("Redirect back","back",2);   
    }
    echo '</div>';
    include $tem."footer.php";
} else {
    header("Location:index.php");
exit();    
}
ob_end_flush();
?>