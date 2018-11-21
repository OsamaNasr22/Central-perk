<?php
ob_start();
session_start();
$pageTitle="Home";
include './ini.php';
$db=new database();
$cats=$db->select("*", "categories", "WHERE visability=? LIMIT 3", array(0));
include $tem.'header.php';
include $tem.'searchnavbar.php';
echo '<div class="content">';
include $tem.'slider.php';
//start categories
echo ' <div class="Categories">';
echo "<img class='prev' src='{$img}p.png'>";
echo "<img class='next' src='{$img}n.png'>";
echo '<div class="heading"><h3>Categories</h3><p>Order Now</p></div>';
echo '<div class="container">';
echo '<div class="row">';
foreach ($cats as $cat){
    $catname=$cat['cat_name'];
    $catId=$cat['id'];
    $rand= rand(0,2);
    $items=$db->select("*", "items", "WHERE cat_id=? LIMIT $rand,3", array($catId));
    echo '<div class="col-lg-4">';
    echo ' <div class="item"> ';
    echo "<div class='image text-center'><img class='img-responsive img-thumbnail img-circle' src='{$img}{$cat['image']}'></div>";
    echo "<h3 class='  text-center heading-item'>{$cat['cat_name']}</h3>";
    foreach ($items as $item){
        $itemdesc= substr($item['item_desc'], 0,50);
          echo " 
                                <div class='media'>
                <div class='media-left media-middle'>
                  <a href='order.php?do=order&id={$item['id']}'>
                      <img class='media-object' src='{$img}{$item['image']}' alt='...' width='64' height='64'>
                  </a>
                </div>
                <div class='media-body'>
                  <h4 class='media-heading'>{$item['item_name']}</h4>
                  <p>{$itemdesc}</p>
                  <span>M</span><span>S</span><span>L</span>
                </div>
                                     </div>";
        
    }
    echo " 
         <a href='categories.php?pn={$catname}&cid={$catId}' class='seemore'>See More</a>
         <div class='clear'></div>";
    echo '</div>';
    echo '</div>';
}
echo '</div>';
echo '</div>';
echo '</div>';
//end categories
?>
            <div class="location">
                <div class="text">
                    <h3>Location</h3>
                    <p>Visit Now</p>
                </div>
                <img src="<?php echo $img;?>us-appletv-4-locate-with-google-maps.png">
            </div>
            <div class="branches">
                 <div class="text">
                    <h3>Branches</h3>
                    <p>Visit Now</p>
                </div>
                
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="branch">
                                <img class="img-responsive img-thumbnail img-rounded" src="<?php echo $img;?>lucca-restaurant.jpg">
                                <p>Cairo</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="branch">
                                <img class="img-responsive img-thumbnail img-rounded" src="<?php echo $img;?>DSC_0405.jpg">
                                <p>Mansoura</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="branch">
                                <img class="img-responsive img-thumbnail img-rounded" src="<?php echo $img;?>DSC_0163.jpg">
                                <p>Alexandria</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
echo '</div>';
include $tem.'footer.php';
ob_end_flush();
/*
<div class="col-lg-4">
                              
                                 <div class="item"> 
                                     <div class="image text-center">
                                         <img class="img-responsive img-thumbnail img-circle" src="../images/pizza.jpg" >
                                </div>
                                     
                                          <h3 class="  text-center heading-item">Pizza</h3>
                                     
                                    
                                    <div class="media">
                                    <div class="media-left media-middle">
                                      <a href="#">
                                          <img class="media-object" src="../images/FAJITA.png" alt="..." width="64" height="64">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading">checken pata</h4>
                                      <p>lorem textlorem textlorem textlorem textlorem textlorem text</p>
                                      <span>M</span><span>S</span><span>L</span>
                                    </div>
                                     </div>
                                     <div class="media">
                                    <div class="media-left media-middle">
                                      <a href="#">
                                          <img class="media-object" src="../images/FAJITA.png" alt="..." width="64" height="64">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading">checken pata</h4>
                                      <p>lorem textlorem textlorem textlorem textlorem textlorem text</p>
                                       <span>M</span><span>S</span><span>L</span>
                                    </div>
                                     </div>
                                     <div class="media">
                                    <div class="media-left media-middle">
                                      <a href="#">
                                          <img class="media-object" src="../images/FAJITA.png" alt="..." width="64" height="64">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading">checken pata</h4>
                                      <p>lorem textlorem textlorem textlorem textlorem textlorem text</p>
                                       <span>M</span><span>S</span><span>L</span>
                                    </div>
                                     </div>
                                     <a class="seemore">See More</a>
                                     <div class="clear"></div>
                                 </div>
                 
                            </div>*/