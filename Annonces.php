<?php

$title = 'Annonce - Stuliday';

require 'includes/header.php';



$sql = 'SELECT * FROM categories';
$res = $conn->query($sql);
$categories = $res->fetchAll();
//
//global $conn;
//$sth- = $conn->prepare('SELECT * FROM categories WHERE ')
//$sth->execute();
//$    =$sth->(PDO::FETCH_ASSOC);
//
if (isset($_POST['search_form'])) {
  $category = intval(strip_tags($_POST['product_category']));
  $search_text = strip_tags($_POST['search_text']);

  $sql2 = "SELECT * FROM products WHERE category_id LIKE '%{$category}%' AND products_name LIKE '%{$search_text}%'";
  $res2 = $conn->query($sql2);
  $search = $res2->fetchAll();
}
?>
<div class="container">

  <form action="products.php" method="post">
    <div class="form-inline">
      <div class="form-group">
        <!-- <label for="InputCategory">Rechercher par nom</label> -->
        <input type="text" name="search_text" id="InputText" placeholder="Rechercher par nom" class="form-control mb-2 mx-2">
      </div>
      <div class="form-group">
        <select class="form-control mb-2 mx-2" id="InputCategory" name="product_category">
          <option value="" selected> -- Filtrer par catégorie -- </option>
          <?php foreach ($categories as $category) { ?>
            <option value="<?php echo $category['categories_id']; ?>">
              <?php echo $category['categories_name']; ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <input type="submit" value="Recherche" name="search_form" class=" mb-2 btn btn-info">
      <?php if (isset($search)) {
        echo '<a href="annonces.php" class="btn btn-danger mx-2 mb-2">Reset</a>';
      } ?>
    </div>
  </form>
</div>



<?php
if (isset($search)) {
  foreach ($search as $product) { ?>
    <div class="container">
      <div class="field">
        <div class="card">
          <!-- ////tentaive de création de card/// -->
          <!-- <div class="card-image">
    <figure class="image is-4by3">
      <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
    </figure>
  </div>
  <div class="card-content">
  
    <div class="media">
      <div class="media-left">
        <figure class="image is-48x48">
          <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
        </figure>
      </div>
      <div class="media-content">
        <p class="title is-4">John Smith</p>
        <p class="subtitle is-6">@johnsmith</p>
      </div>
    </div>

    <div class="content">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      Phasellus nec iaculis mauris. <a>@bulmaio</a>.
      <a href="#">#css</a> <a href="#">#responsive</a>
      <br>
      <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
    </div>
  </div>
</div> -->



      <?php
    }
  } else {
    affichageProduits($_SESSION['id']);
  }
      ?>
        </div>
      </div>
    </div>
    <?php
    require 'includes/footer.php';
