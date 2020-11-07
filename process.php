<?php

    $title = 'Processing - Stuliday';
    require 'includes/header.php';

    // Verrouiller l'accès à la page process aux méthodes POST.
    if ('POST' != $_SERVER['REQUEST_METHOD']) {
        echo "<div class='alert alert-danger'> La page à laquelle vous tentez d'accéder n'existe pas </div>";
    // Le elseif va servir au traitement du formulaire de création de produits
    } elseif (isset($_POST['product_submit'])) {
        // Vérification back-end du remplissage du formulaire
        if (!empty($_POST['product_title']) && !empty($_POST['product_description']) && !empty($_POST['product_price']) && !empty($_POST['product_city']) && !empty(['product_category'])) {
            // Définition des variables
            $title = strip_tags($_POST['product_title']);
            $content = strip_tags($_POST['product_description']);
            $price = intval(strip_tags($_POST['product_price']));
            $address = strip_tags($_POST['product_city']);
            $category_id = intval(strip_tags($_POST['product_category']));
            // Assigne la variable user_id à partir du token de session
            $author = $_SESSION['id'];
            // Lancement de la fonction d'ajout de produits
            ajoutProduits($title,$content,$address,$price,$author,$category_id);
        }
        // 2nd elseif pour le formulaire de modification
    } elseif (isset($_POST['product_edit'])) {
        // Vérification back-end du formulaire d'édition
        if (!empty($_POST['product_name']) && !empty($_POST['product_description']) && !empty($_POST['product_price']) && !empty($_POST['product_city']) && !empty(['product_category'])) {
            // Définition des variables
            $title = strip_tags($_POST['product_name']);
            $content = strip_tags($_POST['product_description']);
            $price = intval(strip_tags($_POST['product_price']));
            $city = strip_tags($_POST['product_city']);
            $category_id = strip_tags($_POST['product_category']);
            // Assigne la variable user_id à partir du token de session
            $author = $_SESSION['id'];
            $id = strip_tags($_POST['product_id']);

            modifProduits($title, $description, $price, $city, $category, $id, $user_id);
        }
    } elseif (isset($_POST['product_delete'])) {
        $product = $_POST['product_id'];
        $user_id = $_SESSION['id'];

        suppProduits($author, $product);
    } elseif (isset($_POST['user_edit'])) {
        $author = $_POST['user_id'];
        $phone = $_POST['user_phone'];

        modifPhone($author, $phone);
    }
    require 'includes/footer.php';