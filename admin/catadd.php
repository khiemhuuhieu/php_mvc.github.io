﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
include '../classes/category.php';
?>
<?php

$cat= new category();
    if($_SERVER['REQUEST_METHOD'] === 'POST')
      {
         
       $catName=$_POST['catName'];

       $insertCat = $cat->insert_category($catName);

      }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm danh mục</h2>
               <div class="block copyblock">
                <span>
                <?php
                if(isset($insertCat))
                {
                  echo $insertCat;
                }
                ?>
                    
                </span> 
                 <form action="catadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="Thêm danh mục sản phẩm..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>