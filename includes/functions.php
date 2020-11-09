<?php
require 'includes/config.php';

function inscription($email, $password1, $password2)
{
    global $conn;

    try {
        $sql1 = "SELECT * FROM users WHERE email = '{$email}'";
        $res1 = $conn->query($sql1);
        $count_email = $res1->fetchColumn();
        if (!$count_email) {
                if ($password1 === $password2) {
                    $password1 = password_hash($password1, PASSWORD_DEFAULT);
                    $sth = $conn->prepare('INSERT INTO users (email, password) VALUES (:email,:password)');
                    $sth->bindValue(':email', $email);
                    $sth->bindValue(':password', $password1);
                    $sth->execute();
                    echo "<div class='alert alert-success mt-2'> L'utilisateur a bien été enregistré, vous pouvez désormais vous connecter</div>";
                } else {
                    echo 'Les mots de passe ne concordent pas !';
                    unset($_POST);
                }
        } elseif ($count_email > 0) {
            echo 'Cette adresse mail existe déja !';
            unset($_POST);
        }
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
    }
}

function connexion($email, $password)
{
    global $conn;

    try {
        $sql = "SELECT * FROM users WHERE email = '{$email}'";
        $res = $conn->query($sql);
        $user = $res->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $db_password = $user['password'];
            if (password_verify($password, $db_password)) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];

                echo 'Vous êtes désormais connectés !';
                header('Location: index.php');
            } else {
                echo 'Le mot de passe est erroné !';
                unset($_POST);
            }
        } else {
            echo "L'email utilisé n'est pas connu !";
            unset($_POST);
        }
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
    }
}

function affichageProduits($id)
{
    global $conn;
    $sth = $conn->prepare("SELECT p.*,c.categories_name FROM annonces AS p LEFT JOIN categories AS c ON p.category_id = c.categories_id");
   // $sth = $conn->prepare("SELECT a.*,c.categories_name,u.email FROM annonces AS a LEFT JOIN categories AS c ON a.category_id = c.categories_id
    //LEFT JOIN users AS u ON a.author = u.id WHERE a.ad_id = {$id}");
    $sth->execute();

    $products = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($products as $product) {
        ?>
<tr>
    <th scope="row"><?php echo $product['ad_id']; ?>
    </th>
    <td><?php echo $product['title']; ?>
    </td>
    <td><?php echo $product['content']; ?>
    </td>
    <td><?php echo $product['price']; ?>
    </td>
    <td><?php echo $product['city']; ?>
    </td>
    <td><?php echo $product['categories_name']; ?>
    </td>
    <td><?php echo $product['author']; ?>
    </td>
    <td> <a
            href="annonce.php/?id=<?php echo $product['ad_id']; ?>">Afficher
            article</a>
    </td>
</tr>
<?php
    }
}


function affichageProduitsByUser($user_id)
{
    global $conn;
    $sth = $conn->prepare("SELECT p.*,c.categories_name FROM products AS p LEFT JOIN categories AS c ON p.category_id = c.categories_id WHERE p.user_id = {$user_id}");
    $sth->execute();

    $products = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($products as $product) {
        ?>
<tr>
    <th scope="row"><?php echo $product['products_id']; ?>
    </th>
    <td><?php echo $product['products_name']; ?>
    </td>
    <td><?php echo shorten_text($product['description']); ?>
    </td>
    <td><?php echo $product['price']; ?> €
    </td>
    <td><?php echo $product['city']; ?>
    </td>
    <td><?php echo $product['categories_name']; ?>
    </td>
    <td> <a href="product.php?id=<?php echo $product['products_id']; ?>"
            class="fa btn btn-outline-primary"><i class="fas fa-eye"></i></a>
    </td>
    <td> <a href="editproducts.php?id=<?php echo $product['products_id']; ?>"
            class="fa btn btn-outline-warning"><i class="fas fa-pen"></i></a>
    </td>
    <td>
        <form action="process.php" method="post">
            <input type="hidden" name="product_id"
                value="<?php echo $product['products_id']; ?>">
            <input type="submit" name="product_delete" class="fa btn btn-outline-danger" value="&#xf2ed;"></input>
        </form>
    </td>
</tr>
<?php
    }
}
function affichageProduit($id)
{
    global $conn;
    $sth = $conn->prepare("SELECT a.*,c.categories_name,u.email FROM annonces AS a LEFT JOIN categories AS c ON a.category_id = c.categories_id
     LEFT JOIN users AS u ON a.author = u.id WHERE a.ad_id = {$id}");
    $sth->execute();

    $annonces = $sth->fetch(PDO::FETCH_ASSOC); ?>
<div class="row">
    <div class="col-12">
        <h1><?php echo $annonces['title']; ?>
        </h1>
        <p><?php echo $annonces['content']; ?>
        </p>
        <p><?php echo $annonces['address']; ?>
        </p>
        
        <p><?php echo $annonces['price']; ?>
        </p>
        
    </div>
</div>
<?php
}

function ajoutProduits($title,$content,$address,$price,$author,$category_id)
{
    global $conn;
    // Vérification du prix (doit être un entier, et inférieur à 1 million d'euros)
    if (is_int($price) && $price > 0 && $price < 1000000) {
        // Utilisation du try/catch pour capturer les erreurs PDO/SQL
        try {
            // Création de la requête avec tous les champs du formulaire
            $sth = $conn->prepare('INSERT INTO annonces (title,content,address,price,author,category_id) VALUES (:title,:content,:address,:price,:author,:category_id)');
            $sth->bindValue(':title', $title, PDO::PARAM_STR);
            $sth->bindValue(':content', $content, PDO::PARAM_STR);
            $sth->bindValue(':price', $price, PDO::PARAM_INT);
            $sth->bindValue(':address', $address, PDO::PARAM_STR);
            $sth->bindValue(':author', $author, PDO::PARAM_INT);
            $sth->bindValue(':category_id', $category_id, PDO::PARAM_INT);
            

            // Affichage conditionnel du message de réussite
            if ($sth->execute()) {
                //echo "<div class='alert alert-success'> Votre article a été ajouté à la base de données </div>";
                header('Location: annonce.php?id='.$conn->lastInsertId());
            }
        } catch (PDOException $e) {
           
            echo 'Error: '.$e->getMessage();

        }
    }
}
// Fonction de suppression des produits. Les arguments renseignés sont des placeholders étant donné qu'ils seront remplacés par les véritables variables une fois la fonction appelée;
function suppProduits($user_id, $produit_id)
{
    // Récupération de la connexion à la BDD à partir de l'espace global.
    global $conn;

    // Tentative de la requête de suppression.
    try {
        $sth = $conn->prepare('DELETE FROM products WHERE products_id = :products_id AND user_id =:user_id');
        $sth->bindValue(':products_id', $produit_id);
        $sth->bindValue(':user_id', $user_id);
        if ($sth->execute()) {
            header('Location:profile.php?s');
        }
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
    }
}
