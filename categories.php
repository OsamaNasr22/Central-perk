<?php

ob_start();
session_start();
$pageTitle="Categories";
include './ini.php';
$db=new database();
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
if(isset($_GET['pn'])&&isset($_GET['cid'])){
  $catName= str_replace("-", " ", $_GET['pn']);
$catId= intval($_GET['cid']);
$rows=$db->totalItem("*", "categories", "WHERE id=? AND cat_name=? ", array($catId,$catName));
$totaitem=$db->totalItem("*", "items","WHERE cat_id=?",array($catId));
$lastpage= ceil($totaitem/$numitem);
$items=$db->select("*", "items", "WHERE cat_id=? LIMIT {$startp},{$numitem}", array($catId));
}
if(isset($_GET['search'])){
    $s=$_GET['search'];
    $totaitem=$db->totalItem("*", "items", "WHERE item_name LIKE '%{$s}%'");
     $rows=$db->totalItem("*", "items", "WHERE item_name LIKE '%{$s}%' LIMIT {$startp},{$numitem}");
     if($rows >0){
          $items=$db->select("*", "items", "WHERE item_name LIKE '%{$s}%' LIMIT {$startp},{$numitem}");
    $id=$items[0]['cat_id'];
    $c=$db->select("cat_name", "categories", "WHERE id=?",array($id));
    $catName=$c[0]['cat_name'];
    $lastpage= ceil($totaitem/$numitem);
     } else {
             echo '<script>alert("category not founded");history.back();</script>';
     }
   
    
}







if($rows>0 &&((@$_GET['np']<=$lastpage && @$_GET['np']>=$firtpage)||!isset($_GET['np']))||isset($_GET['search'])){
include $tem.'header.php';
include $tem.'searchnavbar.php';
echo '<div class="content">';
//start Categories
echo '<div class="category-items">';
include $tem.'navbar.php'; 
echo "<div class='category-name'>
                    <p>{$catName}</p>
                </div>";
       //start container
       echo '<div class="container">'; 
       //start row
       echo '<div class="row">';
       foreach ($items as $item){ 
           //`id`, `item_name`, `item_desc`, `price`, `add_date`, `image`, `cat_id`, `url`
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
           
           
           
     <?php  }  
       echo '</div>';
       //end row
       ?>
       <div class="navigation">
                        <ul>
                                   <?php
                                   if(isset($_GET['search'])){
                                       $hrefprev="categories.php?search={$_GET['search']}&np={$prev}";
                                       $hrefnext="categories.php?search={$_GET['search']}&np={$next}";
                                       $loop="categories.php?search={$_GET['search']}";
                                   } else {
                                       $hrefprev="categories.php?pn={$catName}&cid={$catId}&np={$prev}";
                                       $hrefnext="categories.php?pn={$catName}&cid={$catId}&np={$next}";
                                       $loop="categories.php?pn={$catName}&cid={$catId}";
                                   }
                                  
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
                            
<!--                            <a><span>1</span></a>
                            <span>2</span>
                            <span>3</span>
                            <span>4</span>
                            <span>5</span>-->
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
       //end container
echo '</div>';
//end Categories


echo '</div>';
include $tem.'footer.php';    
} else {
    echo '<script>alert("category not founded");history.back();</script>';
}


ob_end_flush();

