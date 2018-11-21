<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ob_start();
session_start();
$pageTitle="Banners";

if(isset($_SESSION['admin'])){
    include './ini.php';
    echo '<div class="container  mem">';
    $do=(isset($_GET["do"]))?$_GET["do"]:"manage";
    $banid=(isset($_GET["id"]) && is_numeric($_GET["id"]))?intval($_GET["id"]):0;
    if($do=="manage"){
        $d1=new database();
        $banners=$d1->select("*", "banners");
       if(!empty($banners)){
           
       
        ?>
<div class="maintable">
    <h1 class="text-center shadowhead">Manage banners</h1>
    <table class="table table-bordered table-responsive table-hover">
        <!--`id`, `username`, `password`, `Email`, `Fullname`, `GroupId`, `trustStatus`, `regStatus-->

        <tr>
            <th>#ID</th>
            <th>Banner Url</th>
            <th>Type</th>
            <th>Date</th>
            <th>Manage</th>
        </tr>
        <?php 
                foreach($banners as $ban ){
                    if($ban['status']==0){
                        $activate="<a href=\"banners.php?do=Activate&id={$ban['id']}\" class=\"activate\"><i class=\"fa fa-check-circle\"></i></a>";

                    } else {
                    $activate="";    
                    }
             $users= <<<MEMBERS
        <tr>
             <td>{$ban['id']}</td>
             <td><span class="tab-wide">{$ban['banner_url']}</span></td>
             <td>{$ban['type']}</td>
             <td>{$ban['banner_date']}</td>
             <td>
                 <a href="banners.php?do=Edit&id={$ban['id']}" class="edit"><i class="fa fa-edit"></i></a>
                 <a href="banners.php?do=Delete&id={$ban['id']}" class="delete confirm"><i class="fa fa-remove"></i></a>
                 {$activate}
             </td>
        </tr>
MEMBERS;
                 echo $users;
        }
        
       
        ?>
         
    </table>
    <a href="banners.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i>Add New Banner</a>
</div>
    <?php 
     } else {
             echo '<div class="empty-rec">This Page is not have any record</div>';
        }
    
                 }
 elseif($do=="Edit") {
         $banid=(isset($_GET["id"]) && is_numeric($_GET["id"]))?intval($_GET["id"]):0;
         $db= new database();
         $data=array($banid);
         $arr=$db->select("*", "banners","WHERE id=?",$data);
         $row=$db->totalItem("*", "banners","WHERE id=?",$data);
        if($row>0){?>

 <h1 class="text-center shadowhead">Edit Banner</h1>
    <div class="container">
        <form class="form-horizontal" action="?do=Update" method="post" enctype="multipart/form-data">
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Upload</label>
                <div class="col-lg-3">
                    <input type="hidden" name="banid" value="<?php echo $banid; ?>">
                    <input class="form-control "  type="file" name="upload">
                </div>
                <div class="col-lg-3">
                    <input class="form-control" type="text" name="type"  placeholder="Type" autocomplete="off" value="<?php echo $arr[0]["type"]; ?>">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Description</label>
                <div class="col-lg-6">
                    <textarea class="form-control" name="desc" placeholder="Enter Description"><?php echo $arr[0]["banner_desc"]; ?></textarea>
                </div>
            </div>
            
             <div class="form-group ">
                <label class="col-lg-2 control-label">Status</label>
                <div class="col-lg-1">
                    <input class="form-control"   type="number"  name="status" min="0" max="1" value="<?php echo $arr[0]["status"]; ?>">
                </div>
            </div>
            
            <div class="form-group ">
                
                
                <div class="col-lg-offset-2 col-lg-10">
                    <input class="btn btn-primary" type="submit" value="Add">
                </div>
            </div>
        </form>
</div>        <?php } 
        
        else {
     redirect("<div class='alert alert-danger'>This User is not found</div>","back",4);
        }   
    }
    elseif($do=="Update"){
    if($_SERVER["REQUEST_METHOD"]=="POST"){
     echo '<h1 class="text-center shadowhead">Edit Banner</h1>';
     $errors=array();
      $banid=$_POST['banid'];
     $db=new database();
              $arr=$db->select("*", "banners","WHERE id=?",array($banid));

     //`id`, `username`, `password`, `Email`, `Fullname`, `GroupId`, `trustStatus`, `regStatus`, `date`
    
     $data["type"]=$_POST['type'];
     $data["banner_desc"]=$_POST['desc'];
     $data["creatBy"]= $_SESSION['admin'];
     $data["status"]=$_POST['status'];
       if(isset($_FILES)){
            if(!empty($_FILES['upload']['name'])){
            try {
                //include 'models/Upload.php';
                $file=$_FILES['upload'];
                $extentionallowed=array('jpg','png','gif','jpeg');
                $maxSize=2048000;
                $directory='../layout/images/';
                $upload=new Upload($file, $extentionallowed, $maxSize, $directory);
                $upload->upload();
                $url=$upload->geturl();
                $data['banner_url']=$directory.$url;
                $data['bannerName']=$url;
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
            } else {
            $data['banner_url']= "http://placehold.it/100x100";   
            }
            }else {
            $data['banner_url']= $arr[0]["banner_url"];   
            }
      
         if(empty($data['type'])){
             $errors[]="field type must be filled";
         }
         if(empty($data["banner_desc"])){
             $errors[]="field desciription must be filled";
            
     }
         
         if(!empty($errors)){
             foreach ($errors as $e){
                 echo "<div class='alert alert-danger'>{$e}</div>";
                 
             }
         redirect("",4);
         } else {
                 $row=$db->Update("banners", $data,$banid);
         $ms= "<div class='alert alert-success'>{$row} Record Updated</div>";
          redirect($ms,2);
            
              
         }
 } else {
     redirect("Redirect back","back",2);
     exit();
 }
        }
    
    elseif ($do=="Add") { 
       
        ?>
      <h1 class="text-center shadowhead">Add Banner</h1>
    <div class="container">
        <form class="form-horizontal" action="?do=Insert" method="post" enctype="multipart/form-data">
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Upload</label>
                <div class="col-lg-3">
                    <input class="form-control "  type="file" name="upload">
                </div>
                <div class="col-lg-3">
                    <input class="form-control" type="text" name="type"  placeholder="Type" autocomplete="off">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Description</label>
                <div class="col-lg-6">
                    <textarea class="form-control" name="desc" placeholder="Enter Description"></textarea>
                </div>
            </div>
            
             <div class="form-group ">
                <label class="col-lg-2 control-label">Status</label>
                <div class="col-lg-1">
                    <input class="form-control"   type="number"  name="status" min="0" max="1" value="1">
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
     echo '<h1 class="text-center shadowhead">Add Banner</h1>';
     $errors=array();
     $db=new database();
     //`id`, `username`, `password`, `Email`, `Fullname`, `GroupId`, `trustStatus`, `regStatus`, `date`
     $data["type"]=$_POST['type'];
     $data["banner_desc"]=$_POST['desc'];
     $data["creatBy"]= $_SESSION['admin'];
     $data["status"]=$_POST['status'];
       if(isset($_FILES)){
            if(!empty($_FILES['upload']['name'])){
            try {
                //include 'models/Upload.php';
                $file=$_FILES['upload'];
                $extentionallowed=array('jpg','png','gif','jpeg');
                $maxSize=2048000;
                $directory='../layout/images/';
                $upload=new Upload($file, $extentionallowed, $maxSize, $directory);
                $upload->upload();
                $url=$upload->geturl();
                $data['banner_url']=$directory.$url;
                $data['bannerName']=$url;
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
            } else {
            $data['banner_url']= "http://placehold.it/100x100";   
            }
            }else {
            $data['banner_url']= "http://placehold.it/100x100";   
            }
      
         if(empty($data['type'])){
             $errors[]="field type must be filled";
         }
         if(empty($data["banner_desc"])){
             $errors[]="field desciription must be filled";
            
     }
         
         if(!empty($errors)){
             foreach ($errors as $e){
                 echo "<div class='alert alert-danger'>{$e}</div>";
                 
             }
         redirect("",4);
         } else {
                 $row=$db->Add("banners", $data);
         $ms= "<div class='alert alert-success'>{$row} Record Added</div>";
          redirect($ms,2);
            
              
         }
 } else {
     redirect("Redirect back","back",2);
     exit();
 }
}
elseif($do=="Delete"){
    echo '<h1 class="text-center shadowhead">Remove Banner</h1>';
    $db=new database();
    $row=$db->totalItem("*", "banners","WHERE id=?",array($banid));
    $banners=$db->select("*", "banners", "WHERE id=?", array($banid));
    $unl= new fileDeleted();
    if($row >0){

        $row=$db->Delete("banners", $banid);
         try {
              $unl->delete($banners[0]['banner_url']);   
         } catch (Exception $ex) {
             echo $ex->getMessage();
         }
         redirect("<div class='alert alert-danger'>{$row} Record Removed</div>","back",2);
        
    }else{
        redirect("Redirect back","back",2);
    }
}
elseif ($do=="Activate") {
    echo '<h1 class="text-center shadowhead">Activate Banner</h1>';
    $db=new database();
    $check=$db->totalItem("id", "banners", "WHERE id=?",array($banid));
    if($check>0){
      $row=$db->activateMembers("banners", $banid,"status=1");
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