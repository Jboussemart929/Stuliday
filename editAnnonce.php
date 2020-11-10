<?php

$title = 'Modification - Stuliday';
require 'includes/header.php';

$user_id = $_GET['id'];
$sql1 = "SELECT p.*,c.* FROM annonces AS p INNER JOIN categories AS c ON p.category_id = c.categories_id WHERE p.author = {$id}";
$sql2 = 'SELECT * FROM categories';
$res1 = $conn->query($sql1);
$product = $res1->fetch(PDO::FETCH_ASSOC);
$res2 = $conn->query($sql2);
$categories = $res2->fetchAll();
?>
<div class="field">
    <div class="col-12">
        <form action="process.php" method="POST">
            <div class="form-group">
                <label for="InputName">Nom de l'annonce</label>
                <input type="text" class="form-control" id="InputName" value="<?php echo $product['products_name']; ?>" name="product_name" required>
            </div>
            <div class="form-group">
                <label for="InputDescription">Description de l'annonce</label>
                <textarea class="form-control" id="InputDescription" rows="3" name="product_description" required><?php echo $product['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="InputPrice">Prix de l'annonce</label>
                <input type="number" max="999999" class="form-control" id="InputPrice" value="<?php echo $product['price']; ?>" name="product_price" required>
            </div>
            <div class="form-group">
                <label for="InputPrice">Ville où l'annonce est situé</label>
                <input type="text" class="form-control" id="InputPrice" value="<?php echo $product['city']; ?>" name="product_city" required>
            </div>
            <div class="form-group">
                <label for="InputCategory">Catégorie de l'annonce</label>
                <select class="form-control" id="InputCategory" name="product_category">
                    <option value="<?php echo $product['category_id']; ?>" selected>
                        -- <?php echo $product['categories_name']; ?>
                        --
                    </option>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo $category['categories_id']; ?>">
                            <?php echo $category['categories_name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <input type="hidden" name="product_id" value="<?php echo $product['products_id']; ?>" />
            <button type="submit" class="btn btn-success" name="product_edit">Modifier l'article</button>
        </form>
    </div>
</div>


<?php
require 'includes/footer.php';
