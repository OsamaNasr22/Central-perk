     <div class="navbar">
                <div class="brand">
                <h1>Centeral Perk</h1>
                <img src="<?php echo $img;?>logo.png">
                </div>
                <div class="container-fluid">
                    <div class="row">
                         <div class="left col-xs-3">
                <ul>
                    <li <?php echo ((isset($pageTitle)&&$pageTitle=="Home"))?'class="active"':""; ?>><a href="index.php">Home</a></li>
                <li <?php echo ((isset($pageTitle)&&$pageTitle=="Categories"))?'class="active"':""; ?>>
                    <div class="dropdown" <?php echo ((isset($pageTitle)&&$pageTitle=="Categories"))?'class="active"':""; ?>>
                        <?php
                        $db=new database();
                        $arrcat=$db->select("*", "categories","WHERE visability=?", array(0));
                        
                        ?>
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Categories
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <?php
                                           foreach ($arrcat as $cat){
                                               $pn= str_replace(" ", "-", $cat['cat_name']);
                                               echo "<li><a href='Categories.php?pn={$pn}&cid={$cat['id']}'>{$cat['cat_name']}</a></li>";
                                           }
                                        ?>
<!--                                      <li><a href="#">Meat</a></li>
                                      <li><a href="#">Pizza</a></li>
                                     
                                      <li><a href="logout.php">drink</a></li>-->
                                    </ul>
                                    </div>
                    
                </li>
                </ul>
                         </div>
                        <div class="right col-xs-3 pull-right">
            <ul>
                <li>Gallary</li>
                <li <?php echo ((isset($pageTitle)&&$pageTitle=="Online Reservation"))?'class="active"':""; ?>><a href="online.php">Reservation</a></li>
                </ul>
                    </div>
                    </div>
                </div>
                
            </div>