<?php
require_once("layout/header.php");

if(isset($_GET['idProduct']) && isset($_GET['quantity'])){
    $cart->addProductToCart($_GET['idProduct'], $_GET['quantity'], $_SESSION['user_id']);
}
?>
<div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php 
        if(!empty($_GET['category']) && $_GET['category'] > 0){
            $rowArr = $productObj->getSpecificProductCategory($_GET['category']);
            if(!is_null($rowArr)){
                foreach($rowArr as $row){
                    if((int)$row['ProductStock'] > 0){
                        echo'<div class="col my-5">';
                        echo '<div class="card h-100">';
                        echo "<img class='card-img-top' src='dashboard/images/Product/".$row['CategoryName']."/".$row['ProductImage']."' alt='Card image cap'>";
                        echo '<div class="card-body">';
                        echo "<a href='product-detail.php?category=".$row['CategoryID']."&productid=".$row['ProductID']."'><h5 class='card-title'>".$row['ProductName']."</h5></a>";
                        echo '<p class="card-text">'. $row['ProductDescription']. '</p>';
                        echo '</div>';
                        echo '<div class="card-footer">';
                        echo '<small class="text-muted">₱'. $row['ProductPrice'] .' Stock: '. $row['ProductStock']. '</small>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            }
        }
        else if(isset($_POST["submit"])){
            $productObj->searchByNameProduct($searchProduct);
        }
        else{
            $rowArr = $productObj->GetAllProductFullData();
            if(!is_null($rowArr)){
                foreach($rowArr as $row){
                    if((int)$row['ProductStock'] > 0){
                        echo'<div class="col my-5">';
                        echo '<div class="card h-100">';
                        echo "<img class='card-img-top' src='dashboard/images/Product/".$row['CategoryName']."/".$row['ProductImage']."' alt='Card image cap'>";
                        echo '<div class="card-body">';
                        echo "<a href='product-detail.php?category=".$row['CategoryID']."&productid=".$row['ProductID']."'><h5 class='card-title'>".$row['ProductName']."</h5></a>";
                        echo '<p class="card-text">'. $row['ProductDescription']. '</p>';
                        echo '</div>';
                        echo '<div class="card-footer">';
                        echo '<small class="text-muted">₱'. $row['ProductPrice'] .' Stock: '. $row['ProductStock']. '</small>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            }
        }
        ?>
    </div>
</div>
<?php
require_once("layout/footer.php");
?>