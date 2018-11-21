<div class="slider">
       
               <?php
               include $tem.'navbar.php';
               $db=new database();
               $banners=$db->select("bannerName", "banners", " WHERE type=? AND status=?",array("slider",1));
               $arr=array();
               foreach ($banners as $ban){
                   $arr[]=$ban['bannerName'];
               }
               $first=$arr[0];
               ?>
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <?php
    for($i=1;$i<count($arr);$i++){
        echo "<li data-target='#carousel-example-generic' data-slide-to='{$i}'></li>";
    }
    ?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="<?php echo $img . $first;?>" alt="...">
      <div class="carousel-caption">
       
      </div>
    </div>
      
      <?php 
      for($i=1;$i<count($arr);$i++){
          echo " <div class='item'>
        <img src='{$img}{$arr[$i]}' alt='...'>
      <div class='carousel-caption'>
       
      </div>
    </div>";
      }
      ?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
      <img class="prev-img" src="<?php echo $img;?>prev.png">
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
      <img class="next-img" src="<?php echo $img;?>bitmap.png">
      <span class="sr-only">Next</span>
    
  </a>
</div>
            </div>