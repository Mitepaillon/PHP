<?php 
include 'Product.php';
include 'ProductManager.php';
$product_manager = new ProductManager();
$display = 'list';

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'create') {
    $product = $product_manager->save($_POST);
}

if (isset($_POST) && isset($_POST['del']) && $_POST['del'] == 'supprimer'){
	$product = $product_manager->supprimer($_POST);
}

/*if (isset($_POST) && isset($_POST['edit']) && $_POST['edit'] == 'modifier'){
	$product = $product_manager->modifier($_POST);
}*/

if(isset($_GET) && isset($_GET['pk'])) {
    $product = $product_manager->fetch($_GET['pk']);
    $display = 'one';
} else {
    $product_list = $product_manager->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    
    <script src="script.js"></script>
</head>
<body>
    <button type="button" id="btn">CLICK ME</button>
    
       <form action="index.php" method="get" id="search-form">
        <label for="pk-search">Rechercher</label>
        <input type="number" name="pk" id="pk-search">
        <input type="submit" value="Rechercher">
    </form>
    
    <form action="index.php" method="post">
        <input type="hidden" name="type" value="create">
        <input type="text" name="name">
        <input type="number" name="price" step="0.01">
        <input type="number" name="quantity" min="0">
        <input type="submit">
    </form>
    
    <form action="index.php" method="post">
        
    </form>
    <section id="ajax-rsp">
        
    </section>
	
	<table id="product-list">
    <tr>
        <th>Nom</th>
        <th>Prix</th>
        <th>Quantité</th>
    </tr>
    <?php foreach($product_list as $product): ?>
        <tr>
			<td><?= $product->__get('pk'); ?></td>
            <td><?= $product->__get('name'); ?></td>
            <td><?= $product->__get('price'); ?></td>
            <td><?= $product->__get('quantity'); ?></td>
			<form action='index.php' method='post' >
			<input type="hidden" name="del" value="supprimer">
            <td><input type="submit" value="Supprimer"></td>
			</form>
			<td><button type="button" name="edit" class="update-btn">UPDATE</button></td>
        </tr>
    <?php endforeach; ?>
</table>
    
    <?php if($display == 'one') include 'unique_view.php'; ?>
</body>
</html>

