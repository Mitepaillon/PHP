<?php 
include 'Product.php';
include 'ProductManager.php';
include 'User.php';
include 'UserManager.php';
include 'DAO.php';
$user_manager = new UserManager();
$product_manager = new ProductManager();
$display = 'list';

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'create'  && ($_POST['price']>=0)) {
	// Test : s'il y a une PK détectée (en hidden) c'est d'office un produit déjà existant = fonction "modifier" enclenchée
	if(isset($_POST['pk']) && !empty($_POST['pk'])){
    $product = $product_manager->update($_POST['name'],$_POST['price'],$_POST['quantity'],$_POST['pk']);
} else {
	// S'il n'y a pas de PK détectée c'est d'office un nouvel objet = fonction "create" enclenchée
    $product = $product_manager->save($_POST);
}
}

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'create_util') {
	// Test : s'il y a une PK détectée (en hidden) c'est d'office un utilisateur déjà existant = fonction "modifier" enclenchée
	if(isset($_POST['pk']) && !empty($_POST['pk'])){
    $user = $user_manager->update($_POST['username'],$_POST['password'],$_POST['pk']);
} else {
	// S'il n'y a pas de PK détectée c'est d'office un nouvel objet = fonction "create" enclenchée
    $user = $user_manager->save($_POST);
}
}

if (isset($_POST) && isset($_POST['del']) && $_POST['del'] == 'supprimer_util'){
	$user_manager->supprimer($_POST['pk']);
}

if (isset($_POST) && isset($_POST['del']) && $_POST['del'] == 'supprimer'){
	$product_manager->supprimer($_POST['pk']);
}

/*if (isset($_POST) && isset($_POST['edit']) && $_POST['edit'] == 'modifier'){
	$product = $product_manager->modifier($_POST);
}*/

if(isset($_GET) && isset($_GET['pk'])) {
    $user = $user_manager->fetch($_GET['pk']);
    $display = 'one';
} else {
    $user_list = $user_manager->fetchAll();
}



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
	Créer un produit
        <input type="hidden" name="type" value="create">
        <input type="hidden" id="pk" name="pk">
        <input type="text" id="name" name="name">
        <input type="number" id="price" name="price" step="0.01">
        <input type="number" id="quantity" name="quantity" min="0">
        <input type="submit">
    </form>
    
    <form action="index.php" method="post">
        
    </form>
    <section id="ajax-rsp">
        
    </section>
	
	<table id="product-list">
	<tr>
		<th>Liste des produits</th>
	</tr>
    <tr>
        <th>Nom</th>
        <th>Prix</th>
        <th>Quantité</th>
    </tr>
    <?php foreach($product_list as $product): ?>
        <tr>
			<td class="pk"><?= $product->__get('pk'); ?></td>
            <td class="name"><?= $product->__get('name'); ?></td>
            <td class="prix"><?= $product->__get('price'); ?></td>
            <td class="quantity"><?= $product->__get('quantity'); ?></td>
			<form action='index.php' method='post' >
			<input type="hidden" name="del" value="supprimer">
			<input type="hidden" name="pk" value="<?= $product->__get('pk');?>">
            <td><input type="submit" value="Supprimer"></td>
			</form>
			<td><button type="button" id="edit" name="edit" class="update-btn">UPDATE</button></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<section id="utilisateurs">
<form action="index.php" method="post">
	Créer un utilisateur
        <input type="hidden" name="type" value="create_util">
        <input type="hidden" id="pk" name="pk">
        <input type="text" id="username" name="username">
        <input type="text" id="password" name="password">
        <input type="submit">
    </form>
	
	<table id="user-list">
	<tr>
		<th>Liste des utilisateurs</th>
	</tr>
    <tr>
        <th>Nom d'utilisateur</th>
        <th>Password</th>
    </tr>
    <?php foreach($user_list as $user): ?>
        <tr>
			<td class="pk"><?= $user->__get('pk'); ?></td>
            <td class="username"><?= $user->__get('username'); ?></td>
            <td class="password"><?= $user->__get('password'); ?></td>
			<form action='index.php' method='post' >
			<input type="hidden" name="del" value="supprimer_util">
			<input type="hidden" name="pk" value="<?= $user->__get('pk');?>">
            <td><input type="submit" value="Supprimer utilisateur"></td>
			</form>
			<td><button type="button" id="edit_util" name="edit_util" class="update-btn">UPDATE</button></td>
        </tr>
    <?php endforeach; ?>
</table>
</section>

    
    <?php if($display == 'one') include 'unique_view.php'; ?>
</body>
</html>

