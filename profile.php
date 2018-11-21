<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

ob_start();
session_start();
include './ini.php';
$pageTitle="Profile";
if(isset($_SESSION['user'])){
    include $tem."headerpro.php";
echo '<div class="header">';
include $tem."searchnavbar.php";
include $tem.'navbar.php';
$db=new database();
  $id=$_SESSION['userid'];
$ima=$db->select("image,cover", "users","WHERE id=?",array($id));
?>

             <div class="cover">
                 <img class="img-responsive" src="<?php echo $img.$ima[0]['cover'];?>" 
                      height="140">   
            </div>
              <div class="profilepic">
                  <img class="img-responsive img-circle" id="pic" 
                         src="<?php echo $img.$ima[0]['image'];?>">


                   
                    <a href="#">
                       <img id="edit"  src="<?php echo $img;?>\edit.png">  
                    </a>   
                      <div id="pop_background"></div>
                            <div id="pop_box">
                                  <span id="close"> &times;</span>
                                  <form action="?do=upload" method="post" enctype="multipart/form-data" class="form-horizontal">
                                       <label id="profpic">Profile</label> :
                                       <input  class="form-control" type="file" id="profpic" name="profile">
                                       <label  id="cov">Cover</label> :
                                       <input class="form-control" type="file" id="cov" name="cover">
                                       <input class="form-control btn btn-success" type="submit" value="upload">
                                  </form>
                            </div>
                     </div>
<?php
echo '</div>';
?>
<ul id="navigation">
                <li class="home"><a href="profile.php?do=info">informtion <img src="<?php echo $img;?>infologo.png"></a></li>
                <li class="about"><a href="profile.php?do=fav">Favourite <img src="<?php echo $img;?>favlogo.png"></a></li>
                <li class="search"><a href="profile.php?do=wl">Watchlist <img src="<?php echo $img;?>watchlistlogo.png"></a></li>
                <li class="photos"><a href="profile.php?do=ord">Ordered <img src="<?php echo $img;?>orderlogo.png"></a></li>
            </ul>
<div class="category-items">
<?php
$do=(isset($_GET['do']))?$_GET['do']:'info';

if($do=='info'){
    $id=$_SESSION['userid'];
    $userdata=$db->select("*", "users","WHERE id=?",array($id));
    ?>
    <div class="container">
    <div class="row">
        <div class="col-lg-5 col-lg-offset-3">
            <div class="row">
                <div class="text-info col-lg-12">
                    <div class="row">
                        <label class="col-lg-4">Username:</label> <p class="col-lg-8"><?php echo $userdata[0]['username'];?></p>
                    </div>
                
                </div>
                <div class="text-info col-lg-12">
                     <div class="row">
                        <label class="col-lg-4 ">Fullname:</label> <p class="col-lg-8"><?php echo $userdata[0]['Fullname'];?></p>
                    </div>
                 
                </div>
                <div class="text-info col-lg-12">
                    <div class="row">
                        <label class="col-lg-4">Email:</label> <p class="col-lg-8"><?php echo $userdata[0]['Email'];?></p>
                    </div>
                 
                </div>
                <div class="text-info col-lg-12">
                    <div class="row">
                        <label class="col-lg-4">Telephone:</label> <p class="col-lg-8"><?php echo $userdata[0]['telephone'];?></p>
                    </div>
                </div>
                <div class="text-info col-lg-12">
                    <div class="row">
                        <label class="col-lg-4">Address:</label> <p class="col-lg-8"><?php echo $userdata[0]['address'];?> </p>
                    </div>
                  
                </div>
                <a href="profile.php?do=edit" class="btn btn-success pull-right">Edit</a> 
            </div>
            




   
        </div>
    </div>

</div>


<?php
}elseif ($do=='ord'||isset ($_GET['np'])||$do=='wl'||$do=='fav') {
    if(isset($_GET['np'])){
    if($_GET['np']<1){
        $cuurentpage=1;
    } else {
         $cuurentpage=$_GET['np'];
    }
   
} else {
$cuurentpage=1;    
}
$next=$cuurentpage+1;
$prev=$cuurentpage-1;
$firtpage=1;
$numitem=3;
$startp=($cuurentpage - 1)*$numitem;
$rows=$db->totalItem("item_id", "orders", "WHERE orderedBy=?", array($_SESSION['user']));

$lastpage= ceil($rows/$numitem);
$items=$db->select("item_id", "orders", "WHERE orderedBy=? LIMIT {$startp},{$numitem}", array($_SESSION['user']));
echo '<div class="container">'; 
echo '<div class="row">'; 
foreach ($items as $item){
    $i=$db->select('*', 'items','WHERE id=?',array($item['item_id']));
    foreach ($i as $item){
    ?>
      <div class="col-xs-2 col-lg-4 col-md-4">
                            <div class="item text-center">
                                <div class="item-image">
                                    <img class="img-rounded img-responsive " src="<?php echo $img.$item['image'];?>">
                                    <p><?php echo $item['price'];?><span>$</span></p>
                                </div>
                                
                                <ul class="item-head">
                                    <li><img class="img-responsive" src="<?php echo $img;?>plus.png"></li>
                                    <li><?php echo $item['item_name'];?></li>
                                    <li><img class="img-responsive" src="<?php echo $img;?>heart.png"</li>
                                </ul>
                                <ul class="item-size text-center">
                                    <li>s</li>
                                    <li>m</li>
                                    <li>l</li>
                                </ul>
                                <p><?php echo $item['item_desc'];?></p>
                                <a href="order.php?do=order&id=<?php echo $item['id'];?>">Order Now</a>
                            </div>
                        </div>  
    <?php
}
} ?>
<div class="navigation col-lg-12">
                        <ul>
                                   <?php
                                   
                                       $hrefprev="profile.php?do=ord&np={$prev}";
                                       $hrefnext="profile.php?do=ord&np={$next}";
                                       $loop="profile.php?do=ord";
                                   
                                  
                                   ?>
                            <?php
                            if($cuurentpage==$firtpage){ ?>
                            <li><i class="fa fa-caret-left"></i>prev</li>
                           <?php } else { ?>
                            <li><a href="<?php echo $hrefprev;?>"><i class="fa fa-caret-left"></i>prev</a></li>
                                  <?php }
                                  
                                  
                                  for($i=$cuurentpage-2;$i<=$cuurentpage+2;$i++){
                                      if($i>0 && $i<$lastpage){
                                          if($cuurentpage !=$i ){
                                          echo "<a href='{$loop}&np={$i}'><span>{$i}</span></a>"; 
                                      } else {
                                          echo "<span class='activelink'>{$i}</span>";
                                      }
                                      }
                                      
                                     
                                  }
                            ?>
                            
                            <?php
                            if($cuurentpage==$lastpage){ ?>
                                <li>next<i class="fa fa-caret-right"></i></li>
                           <?php } else { ?>
                                       <li><a href="<?php echo $hrefnext;?>">next<i class="fa fa-caret-right"></i></a></li>
                                  <?php }
                            ?>
                                
                        </ul>
                    </div>
<?php
echo '</div>'; 
echo '</div>'; 

    
}elseif ($do=='upload') {
    
     if(isset($_FILES)){
            if(!empty($_FILES['profile']['name'])){
            try {
                //include 'models/Upload.php';
                $file=$_FILES['profile'];
                $extentionallowed=array('jpg','png','gif','jpeg');
                $maxSize=2048000;
                $directory='layout/images/';
                $upload=new Upload($file, $extentionallowed, $maxSize, $directory);
                $upload->upload();
                $url=$upload->geturl();
               
                $data['image']=$url;
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
            } else {
            $data['image']=$ima[0]['image'];   
            }
            
               if(!empty($_FILES['cover']['name'])){
            try {
                //include 'models/Upload.php';
                $file=$_FILES['cover'];
                $extentionallowed=array('jpg','png','gif','jpeg');
                $maxSize=2048000;
                $directory='layout/images/';
                $upload=new Upload($file, $extentionallowed, $maxSize, $directory);
                $upload->upload();
                $url=$upload->geturl();
               
                $data['cover']=$url;
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
            } else {
            $data['cover']= $ima[0]['cover'];   
            }
            }else {
           $data['cover']= "http://placehold.it/1200x300";    
            $data['image']= "http://placehold.it/100x100"; 
            }
            $ad=$db->Update('users', $data, $_SESSION['userid']);
            if($ad){
                echo '<script>alert("profile Updated");history.back();</script>';
            }
}elseif ($do=='edit') { 
    $id=$_SESSION['userid'];
    $userdata=$db->select("*", "users","WHERE id=?",array($id));
    ?>
    <div class="container">
    <div class="row">
        <div class="form-info col-lg-8 col-lg-offset-2">
            <form class="form-horizontal" action="?do=upd" method="post">
                <input class="form-control" type="text" name="Username" placeholder="Username" value="<?php echo $userdata[0]['username'];?>">
                <input class="form-control" type="text" name="Fullname" placeholder="Fullname" value="<?php echo $userdata[0]['Fullname'];?>">
                <input class="form-control" type="text" name="Email" placeholder="Email" value="<?php echo $userdata[0]['Email'];?>">
                <input class="form-control" type="text" name="Telephone" placeholder="Telephone" value="<?php echo $userdata[0]['telephone'];?>">
                <input class="form-control" type="text" name="Address" placeholder="Address" value="<?php echo $userdata[0]['address'];?>">
                <input class="form-control" type="text" name="Password" placeholder="Password" >
                <input type="submit" class="btn btn-success" value="Save">
            </form>
    
    </div>
    </div>
    
</div>
    <?php
}elseif ($do=='upd') {
    $userdata=$db->select("*", "users","WHERE id=?",array($id));
    $data['username']=$_POST['Username'];
    $data['Fullname']=$_POST['Fullname'];
    $data['Email']=$_POST['Email'];
    $data['telephone']=$_POST['Telephone'];
    $data['address']=$_POST['Address'];
    if(empty($_POST['Password'])){
        $data['password']=$userdata[0]['password'];
    } else {
    $data['password']= sha1($_POST['Password']);    
    }
    
    $up=$db->Update('users', $data, $_SESSION['userid']);
    if($up){
        echo '<script>alert("information updated");history.back();</script>';
    }
} else {
    redirect("","back",0);    
}
echo '</div>';
include  $tem.'footer.php';
} else {
    redirect("",'back',0); 
}

ob_end_flush();