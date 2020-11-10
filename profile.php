<?php

$title = 'Page de profil - Stuliday';
require 'includes/header.php';

$user_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = '{$user_id}'";
$res = $conn->query($sql);
$user = $res->fetch(PDO::FETCH_ASSOC);

if (isset($_GET['s'])) {
    echo '<div class="alert alert-warning">Votre article a bien été supprimé </div>';
}
?>
<div class="row">
    <div class="col-8">
        <h3>Bienvenue <?php echo $user['email']; ?> </h3>

        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
        <input type="submit" class="btn" name="user_edit" value="Mettre à jour">
        </form>
    </div>
    <h3>Mes Annonces publiés</h3>

    <?php
    affichageProduitsByUser($user_id);

    ?>
    <?php
    require 'includes/footer.php';
