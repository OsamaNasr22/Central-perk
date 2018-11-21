<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ob_start();
session_start();
$pageTitle="Items";
if(isset($_SESSION["admin"])){
    $do=(isset($_GET["do"]))?$_GET['do']:"manage";
    include './ini.php';
    echo '<div class="container mem">';
        if($do=="manage"){
              $d1=new database();
              $query="INNER JOIN categories ON categories.id=items.cat_id";
        $members=$d1->select("items.*,categories.cat_name", "items", $query);
       if(!empty($members)){
           
      
        ?>
<div class="maintable">
    <h1 class="text-center shadowhead">Manage Items</h1>
    <table class="table table-bordered table-responsive table-hover">
        <!--`id`, `username`, `password`, `Email`, `Fullname`, `GroupId`, `trustStatus`, `regStatus-->

        <tr>
            <th>#ID</th>
            <th>Item Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th>Add Date</th>
            <th>Manage</th>
        </tr>
        <?php 
                foreach($members as $mem ){
//                    if($mem['regStatus']==0){
//                        $activate="<a href=\"Members.php?do=Activate&id={$mem['id']}\" class=\"btn btn-primary\"><i class=\"fa fa-check-circle\"></i>Accept</a>";
//
//                    } else {
//                    $activate="";    
//                    }
             $users= <<<MEMBERS
        <tr>
             <td>{$mem['id']}</td>
             <td>{$mem['item_name']}</td>
             <td><span class="tab-wide">{$mem['item_desc']}</span></td>
             <td>{$mem['price']}</td>
             <td>{$mem['cat_name']}</td>
             <td>{$mem['add_date']}</td>
             <td>
                 <a href="items.php?do=edit&id={$mem['id']}" ><i class="fa fa-edit edit"></i></a>
                 <a href="items.php?do=delete&id={$mem['id']}" class="confirm delete"><i class="fa fa-remove"></i></a>
                 
             </td>
        </tr>
MEMBERS;
                 echo $users;
        }
        
       
        ?>
         
    </table>
    <a href="items.php?do=add" class="btn btn-primary"><i class="fa fa-plus"></i>Add New Item</a>
</div>
<?php
 } else {
             echo '<div class="empty-rec">This Page is not have any record</div>';
        }
        }elseif ($do=="add") { 
            $db=new database();
            $cat=$db->select("*", "categories");
            ?>
      <h1 class="text-center shadowhead">Add Item</h1>
    <div class="container">
        <form class="form-horizontal" action="?do=insert" method="post" enctype="multipart/form-data">
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Name</label>
                <div class="col-lg-10">
                    <input class="form-control" type="text" name="name"  placeholder="Enter Item Name" autocomplete="off">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Description</label>
                <div class="col-lg-10">
                    <input class="form-control"  type="text"  name="desc" placeholder="Enter Item Description" autocomplete="off">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Price</label>
                <div class="col-lg-10">
                    <input class="form-control" type="text" name="price"  placeholder="Enter Item Price" autocomplete="off">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Upload Image</label>
                <div class="col-lg-2">
                    <input class="form-control"  type="file" name="upload">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Category</label>
                <div class="col-lg-2">
                    <select class="form-control" name="cat">
                        <option value="0"></option>
                        <?php
                         foreach ($cat as $val){
                             echo "<option value='{$val['id']}'>{$val['cat_name']}</option>";
                         }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group ">
                
                
                <div class="col-lg-offset-2 col-lg-10">
                    <input class="btn btn-primary" type="submit" value="Add Item">
                </div>
            </div>
        </form>
</div>  
 <?php
    }elseif ($do=="insert") {
        
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            echo '<h1 class="text-center shadowhead">Add Categories</h1>';
            //`cat_id``id`, `item_name`, `item_desc`, `price`, `add_date`, `image`, `cat_id`SELECT * FROM `items` WHERE 1
            $db=new database();
            $data["item_name"]=$_POST["name"];
            $data["item_desc"]=$_POST["desc"];
            $data["price"]=$_POST["price"];
            $data["cat_id"]=$_POST["cat"];
            
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
            }
            $errors=array();
         if(empty($data['item_name'])){
             $errors[]="field name must be filled";
         }
         if(empty($data['item_desc'])){
             $errors[]="field desciription must be filled";
         }
         if(empty($data['price'])){
             $errors[]="field price must be filled";
         }
         if($data['cat_id']==0){
             $errors[]="you must choose category";
         }
         
         if(empty($errors)){
         $db=new database();
         $row=$db->Add("items", $data);
         redirect("<div class='alert alert-success'>{$row} item added</div>","back",4);      
         } else {
            foreach ($errors as $e){
                 echo "<div class='alert alert-danger'>{$e}</div>";
             }
           redirect("","back",4);
         }
            
            
        } else {
            redirect("","back",0);
        }
        
    }elseif ($do=="edit") {
        $id=(isset($_GET['id'])&& is_numeric($_GET['id']))?intval($_GET['id']):0;
    
        $db= new database();
        $arr=$db->select("*", "items","WHERE id=?",array($id));
      $cat=$db->select("*", "categories");
     

        ?>
        <h1 class="text-center shadowhead">Edit Item</h1>
    <div class="container">
        <form class="form-horizontal" action="?do=update" method="post" enctype="multipart/form-data">
            
            <div class="form-group ">
                <label class="col-lg-2 control-label">Name</label>
                <div class="col-lg-10">
                 <input class="form-control" type="hidden" value="<?php echo $arr[0]['id'] ;?>" name="id"  >

                    <input class="form-control" type="text" value="<?php echo $arr[0]['item_name'];?>" name="name"  placeholder="Enter Item Name" autocomplete="off">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Description</label>
                <div class="col-lg-10">
                    <input class="form-control"  type="text" value="<?php echo $arr[0]['item_desc'];?>"  name="desc" placeholder="Enter Item Description" autocomplete="off">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Price</label>
                <div class="col-lg-10">
                    <input class="form-control" type="text"value="<?php echo $arr[0]['price'];?>" name="price"  placeholder="Enter Item Price" autocomplete="off">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Upload Image</label>
                <div class="col-lg-2">
                    <input class="form-control"  type="file" name="upload">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-lg-2 control-label">Category</label>
                <div class="col-lg-2">
                    <select class="form-control" name="cat">
                       
                        <?php
                         foreach ($cat as $val){
                             echo "<option value='{$val['id']}' ";            
                             if($arr[0]['cat_id']==$val['id']){
                                 echo 'selected';
                             }
                             echo ">{$val['cat_name']}</option>";
                         }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group ">
                
                
                <div class="col-lg-offset-2 col-lg-10">
                    <input class="btn btn-primary" type="submit" value="Edit Item">
                </div>
            </div>
        </form>
</div>
 <?php       
    }elseif ($do=="update") {
        
        if($_SERVER["REQUEST_METHOD"]=="POST"){
             echo '<h1 class="text-center shadowhead">Edit item</h1>';
            //`id`, `cat_name`, `cat_desc`, `ordering`, `visability`, `allow_comment`, `allow_ads`, `image`, `cat_date`, `createdBy`
            $db=new database();
           
            
             $id=$_POST['id'];
             $arr=$db->select("image", "items","WHERE id=?",array($id));
     
            $data["item_name"]=$_POST["name"];
            $data["item_desc"]=$_POST["desc"];
            $data["price"]=$_POST["price"];
            $data["cat_id"]=$_POST["cat"];
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
                      $errors=array();
         if(empty($data['item_name'])){
             $errors[]="field name must be filled";
         }
         if(empty($data['item_desc'])){
             $errors[]="field desciription must be filled";
         }
         if(empty($data['price'])){
             $errors[]="field price must be filled";
         }
         if($data['cat_id']==0){
             $errors[]="you must choose category";
         }
         
         if(empty($errors)){
         $db=new database();
         $row=$db->Update("items", $data,$id);
         redirect("<div class='alert alert-success'>{$row} item Updated</div>","back",4);      
         } else {
            foreach ($errors as $e){
                 echo "<div class='alert alert-danger'>{$e}</div>";
             }
           redirect("","back",4);
         }            
        } else {
            redirect("","back",0);    
        }
   
    }elseif ($do=="delete") {
        
           echo '<h1 class="text-center shadowhead">Delete Categories</h1>';
        $id=(isset($_GET['id'])&& is_numeric($_GET['id']))?intval($_GET['id']):0;
        $db=new database();
        $unl=new fileDeleted();
        $check=$db->totalItem("id", "items", "WHERE id=?", array($id));
        $file=$db->select("url", "items", "WHERE id=?", array($id));
        if($_SERVER['REQUEST_METHOD']=="GET"){
             if($check!=0){
         $row=$db->Delete("items", $id);
         try {
              $unl->delete($file[0]['url']);   
         } catch (Exception $ex) {
             echo $ex->getMessage();
         }
            
         redirect("<div class='alert alert-danger'>$row item deleted </div>","back",3);
         
                 
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
