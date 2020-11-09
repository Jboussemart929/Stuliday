<?php

$title = 'Annonce - Stuliday';

require 'includes/header.php';
$sql = 'SELECT * FROM categories';
$res = $conn->query($sql);
$categories = $res->fetchAll();
?>

<form action="process.php" method="POST">
<div class="container">
<h3 class="field">Créer votre annonce</h3>


<div class="field">
  <label class="label">Nom de votre annonce</label>
  <div class="control">
    <input class="inputannonce" type="text" placeholder="tapez le nom de votre annonce" name="product_title">
  </div>
</div>
<div class="field">
  <label class="label">Description</label>
  <div class="control">
    <textarea class="textarea" placeholder="Veuillez taper la description de votre annonce" name="product_description"></textarea>
  </div>
</div>
<div class="field">
  <label class="label">Ville ou est situé votre annonce</label>
  <div class="control">
    <input class="input " type="text" placeholder="Ex : France, Bordeaux , 33 000" value="" name="product_city">

</div>
<div class="field">
  <label class="label" >Catégories</label>
  <div class="control">
    <div class="select" >
      <select name="product_category">
      <?php foreach ($categories as $category) { ?>
                    <option
                        value="<?php echo $category['categories_id']; ?>">
                        <?php echo $category['categories_name']; ?>
                    </option>
                    <?php } ?>
      </select>
    </div>
  </div>
</div>

<div class="field">
  <label class="label">Durée de votre location</label>
  <div class="control">
    <div class="select">
      <select>
        <option>1 jour</option>
        <option>2 jours</option>
        <option>3 jours</option>
        <option>4 jours</option>
        <option>5 jours</option>
        <option>6 jours</option>
        <option>1 semaine</option>
        <option>2 semaines</option>
        <option>3 semaines</option>
        <option>1 mois</option>
        <option>6 mois</option>
        <option>1 ans</option>
      </select>
    </div>
  </div>
</div>


</div>
<div class="field">
  <label class="label" >Prix de votre annonce</label>
  <div class="control">
    <input class="input" type="number" placeholder="Prix en euros" value="" name="product_price">
    
  <!-- </div>
  
  <button type="submit" class="btn" name="upload_submit">Choissiez votre photo
  </div> -->

<?php
// function uploadFile($upload_submit){
// //Vérification Traitement Upload
//     // Si le fichier est bien envoyé et qu'il n'y a pas d'erreur alors...
//     if(isset($_FILES['uploadFile']) AND $_FILES['uploadFile']['error'] == 0) {
//         // Si le fichier fait moins de 10Mo
//         if ($_FILES['uploadFile']['size'] < 10000000 ) {
//             // Renvoie un array contenant l'extension du fichier
//             $infoUpload = pathinfo($_FILES['uploadFile']['name']);
//             //stocke le résultat de l'array  dans la variable
//             $extensionUpload = $infoUpload['extension'];
//             // On crée un tableau d'extensions autorisées
//             $extensionsAllowed = ['jpg', 'jpeg', 'gif', 'png'];
//             if(in_array($extensionUpload, $extensionsAllowed)) {
//                 // On peut maintenant valider le fichier et le stocker définitivement
//                 move_uploaded_file($_FILES['uploadFile']['tmp_name'], 'uploads/' . basename($_FILES['uploadFile']['name']));
//                 echo "L'envoi a bien été effectué";
//             } else {
//                 echo 'On a eu un soucis';
//             }
//         }
//     }
//   }
    ?>

    

<div class="field">
  <div class="control">
    <label class="checkbox">
      <input type="checkbox">
      J'accepte les <a href="#">termes et les conditions</a>
    </label>
  </div>
</div>

<div class="container">
            </div>
           
            <button type="submit" class="button is-primary" name="product_submit">Enregistrer votre annonce</button>
            
    </div>
</div>
</div>
</div>
<div>
</form>
<?php
require 'includes/footer.php';