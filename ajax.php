<?php
include 'Product.php';
include 'ProductManager.php';
$product_manager = new ProductManager();

if(isset($_GET) && isset($_GET['pk'])) {
    $product = $product_manager->fetch($_GET['pk']);
    $display = 'one';
}

?>
<h2><?= $product->__get('name'); ?></h2>