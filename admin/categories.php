<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ob_start();
session_start();
$pageTitle="Categories";
if(isset($_SESSION['admin'])){
    include './ini.php';
       echo '<div class="container mem">';
    $do=(isset($_GET['do']))?$_GET['do']:"manage";
    if($do=="manage"){
        $db= new database();
        $cat=$db->select("*", "categories","ORDER BY ordering DESC"); 
        if(!empty($cat)){
            
        
        ?>
       <div class="maintable">
    <h1 class="text-center shadowhead">Manage Categories</h1>
    <table class="table table-bordered table-responsive table-hover">
     <!--`id`, `cat_name`, `cat_desc`, `ordering`, `visability`, `allow_comment`, `allow_ads`, `image`, `cat_date`, `createdBy`, `url`-->

        <tr>
            <th>#ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Comment</th>
            <th>Ads</th>
            <th>Visibility</th>
            <th>Date</th>
            <th>Created By</th>
            <th>Manage</th>
        </tr>
        <?php 
                foreach($cat as $c ){
                   $comment=($c['allow_comment']==1)?'yes':'no';
                   $ads=($c['allow_ads']==1)?'yes':'no';
                   $visability=($c['visability']==0)?'yes':'no';
             $users= <<<MEMBERS
        <tr>
             <td>{$c['id']}</td>
             <td>{$c['cat_name']}</td>
             <td><span class='tab-wide'>{$c['cat_desc']}</span></td>
             <td><span class='tab-wide'>{$c['image']}</span></td>
             <td>{$comment}</td>
             <td>{$ads}</td>
             <td>{$visability}</td>
             <td>{$c['cat_date']}</td>
             <td>{$c['createdBy']}</td>
            
             <td>
                 <a href="categories.php?do=edit&id={$c['id']}" class="edit"><i class="fa fa-edit"></i></a>
                 <a href="categories.php?do=delete&id={$c['id']}" class="delete confirm"><i class="fa fa-remove"></i></a>
             
             </td>
        </tr>
MEMBERS;
                 echo $users;
        }
        
       
        ?>
         
    </table>

<a href="categories.php?do=add" class="btn btn-primary "><i class="fa fa-plus"></i>Add New Categories</a>
       </div>
        <?php
        } else {
             echo '<div class="empty-rec">This Page is not have any record</div>';
        }
    }elseif ($do=="add") {
        ?>
        <h1 class="text-center shadowhead">Add Categories</h1>
    <div class="container">
        <form class="form-horizontal" action="?do=insert" method="post" enctype="multipart/form-data">
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Name</label>
                <div class="col-lg-10">
                    <input class="form-control" type="text" name="name"  placeholder="Enter Category Name" autocomplete="off">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Description</label>
                <div class="col-lg-10">
                    <input class="form-control"  type="text"  name="desc" placeholder="Enter Categories Description" autocomplete="off">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Ordering</label>
                <div class="col-lg-10">
                    <input class="form-control" value="" type="text" name="ordering" placeholder="Enter Your Password" autocomplete="off">
                </div>
            </div>
            
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Upload Image</label>
                <div class="col-lg-2">
                    <input class="form-control"  type="file" name="upload">
                </div>
            </div>
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Visibale</label>
                <div class="col-lg-10">
                    <div>
                        <input id="vis_yes" class="radio-inline"   type="radio"  name="visibale" value="0" checked="">
                        <label for="vis_yes">yes</label>
                    </div>
                    <div>
                        <input id="vi_no"class="radio-inline"   type="radio"  name="visibale" value="1" >
                        <label for="vi_no">No</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Comment</label>
                <div class="col-lg-10">
                    <div>
                        <input id="com_yes" class="radio-inline"   type="radio"  name="comment" value="0" checked="">
                        <label for="com_yes">yes</label>
                    </div>
                    <div>
                        <input id="com_no"class="radio-inline"   type="radio"  name="comment" value="1" >
                        <label for="com_no">No</label>
                    </div>
                </div>
            </div>
            
            
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Ads</label>
                <div class="col-lg-10">
                    <div>
                        <input id="ads_yes" class="radio-inline"   type="radio"  name="ads" value="0" checked="">
                        <label for="ads_yes">yes</label>
                    </div>
                    <div>
                        <input id="ads_no"class="radio-inline"   type="radio"  name="ads" value="1" >
                        <label for="ads_no">No</label>
                    </div>
                </div>
            </div>
            
             
            
            <div class="form-group ">
                
                
                <div class="col-lg-offset-2 col-lg-10">
                    <input class="btn btn-primary" type="submit" value="Add Categories">
                </div>
            </div>
        </form>
</div>
    <?php }
    elseif ($do=="insert") {
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            echo '<h1 class="text-center shadowhead">Add Categories</h1>';
            //`id`, `cat_name`, `cat_desc`, `ordering`, `visability`, `allow_comment`, `allow_ads`, `image`, `cat_date`, `createdBy`
            $db=new database();
            $data["cat_name"]=$_POST["name"];
            $data["cat_desc"]=$_POST["desc"];
            $data["ordering"]=$_POST["ordering"];
            $data["visability"]=$_POST["visibale"];
            $data["allow_comment"]=$_POST["comment"];
            $data["allow_ads"]=$_POST["ads"];
            $data["createdBy"]=$_SESSION['admin'];
            
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
                $data['image']=$url;
                $data['url']=$directory.$url;
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
            } else {
            $data['image']= "http://placehold.it/100x100";   
            }
            }else {
            $data['image']= "http://placehold.it/100x100";   
            }
            $row=$db->totalItem("cat_name", "categories","WHERE cat_name=?",array( $data["cat_name"]));
            if($row==0){
                $row=$db->Add("categories", $data);
                redirect("<div class='alert alert-success'>$row category add</div>","back","2");
            } else {
                echo '<script>alert("category is exist");history.back()</script>';    
            }
            
            
        } else {
            redirect("","back",0);
        }
    
    }elseif ($do=="edit") {

        $id=(isset($_GET['id'])&& is_numeric($_GET['id']))?intval($_GET['id']):0;

        $db= new database();
        $arr=$db->select("*", "categories","WHERE id=?",array($id)); 
                    //`id`, `cat_name`, `cat_desc`, `ordering`, `visability`, `allow_comment`, `allow_ads`, `image`, `cat_date`, `createdBy`

        ?>
        
        <h1 class="text-center shadowhead">Edit Categories</h1>
    <div class="container">
        <form class="form-horizontal" action="?do=update" method="post" enctype="multipart/form-data">
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Name</label>
                <div class="col-lg-10">
                    <input class="form-control" type="hidden" value="<?php echo $id ;?>" name="id"  >

                    <input class="form-control" type="text" value="<?php echo $arr[0]["cat_name"] ;?>" name="name"  placeholder="Enter Category Name" autocomplete="off">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Description</label>
                <div class="col-lg-10">
                    <input class="form-control"  type="text" value="<?php echo  $arr[0]["cat_desc"]?>"  name="desc" placeholder="Enter Categories Description" autocomplete="off">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Ordering</label>
                <div class="col-lg-10">
                    <input class="form-control"  value="<?php echo  $arr[0]["ordering"]?>" type="text" name="ordering" placeholder="Enter Your Password" autocomplete="off">
                </div>
            </div>
            
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Upload Image</label>
                <div class="col-lg-2">
                    <input class="form-control"  type="file" name="upload">
                </div>
            </div>
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Visibale</label>
                <div class="col-lg-10">
                    <div>
                        <input id="vis_yes" class="radio-inline"   type="radio"  name="visibale" value="0" <?php echo ($arr[0]['visability']==0)?'checked=""':'' ; ?> >
                        <label for="vis_yes">yes</label>
                    </div>
                    <div>
                        <input id="vi_no"class="radio-inline"   type="radio"  name="visibale" value="1" <?php echo ($arr[0]['visability']==1)?'checked=""':'' ; ?> >
                        <label for="vi_no">No</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Comment</label>
                <div class="col-lg-10">
                    <div>
                        <input id="com_yes" class="radio-inline"   type="radio"  name="comment" value="0" <?php echo ($arr[0]['allow_comment']==0)?'checked=""':'' ; ?>>
                        <label for="com_yes">yes</label>
                    </div>
                    <div>
                        <input id="com_no"class="radio-inline"   type="radio"  name="comment" value="1" <?php echo ($arr[0]['allow_comment']==1)?'checked=""':'' ; ?>>
                        <label for="com_no">No</label>
                    </div>
                </div>
            </div>
            
            
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Ads</label>
                <div class="col-lg-10">
                    <div>
                        <input id="ads_yes" class="radio-inline"   type="radio"  name="ads" value="0" <?php echo ($arr[0]['allow_ads']==0)?'checked=""':'' ; ?>>
                        <label for="ads_yes">yes</label>
                    </div>
                    <div>
                        <input id="ads_no"class="radio-inline"   type="radio"  name="ads" value="1" <?php echo ($arr[0]['allow_ads']==1)?'checked=""':'' ; ?>>
                        <label for="ads_no">No</label>
                    </div>
                </div>
            </div>
            
             
            
            <div class="form-group ">
                
                
                <div class="col-lg-offset-2 col-lg-10">
                    <input class="btn btn-primary" type="submit" value="Edit Categories">
                </div>
            </div>
        </form>
</div>
 <?php
    }
    elseif ($do=="update") {
        if($_SERVER["REQUEST_METHOD"]=="POST"){
             echo '<h1 class="text-center shadowhead">Edit Categories</h1>';
            //`id`, `cat_name`, `cat_desc`, `ordering`, `visability`, `allow_comment`, `allow_ads`, `image`, `cat_date`, `createdBy`
            $db=new database();
           
            
             $id=$_POST['id'];
             $arr=$db->select("image", "categories","WHERE id=?",array($id));
     

            $data["cat_name"]=$_POST["name"];
            $data["cat_desc"]=$_POST["desc"];
            $data["ordering"]=$_POST["ordering"];
            $data["visability"]=$_POST["visibale"];
            $data["allow_comment"]=$_POST["comment"];
            $data["allow_ads"]=$_POST["ads"];
            $data["createdBy"]=$_SESSION['admin'];
            
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
                $data['image']=$url;
                $data['url']=$directory.$url;
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
            } else {
            $data['image']= $arr[0]['image'];   
            }
            }         
                    $row=$db->Update("categories", $data,$id);
                    redirect("<div class='alert alert-success'>$row category Updated</div>","back","2");            
        } else {
            redirect("","back",0);    
        }
        
        
        
        
    }
     elseif ($do=="delete") {
          echo '<h1 class="text-center shadowhead">Delete Categories</h1>';
        $id=(isset($_GET['id'])&& is_numeric($_GET['id']))?intval($_GET['id']):0;
        $db=new database();
        $unl=new fileDeleted();
        $check=$db->totalItem("id", "categories", "WHERE id=?", array($id));
        $file=$db->select("url", "categories", "WHERE id=?", array($id));
        if($_SERVER['REQUEST_METHOD']=="GET"){
             if($check!=0){
         $row=$db->Delete("categories", $id);
         try {
              $unl->delete($file[0]['url']);   
         } catch (Exception $ex) {
             echo $ex->getMessage();
         }
            
         redirect("<div class='alert alert-danger'>$row category deleted </div>","back",3);
         
                 
        } else {
            redirect("","back",0);  
        }
        } else {
            redirect("","back",0);    
        }
       

    } else {
        redirect("","back",0);    
    }
    echo '</div>';
    include $tem."footer.php";
} else {
    header("Location:index.php");
exit();    
}
ob_end_flush();

