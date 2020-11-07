<?php
//  require  "includes/navbar.php";
 require "includes/header.php";


if (!empty($_POST['submit_signup']) && !empty($_POST['email_signup']) && !empty($_POST['password1_signup'])) {
    $pass_su = htmlspecialchars($_POST['password1_signup']);
    $repass_su = htmlspecialchars($_POST['password2_signup']);
    $email_su = htmlspecialchars($_POST['email_signup']);

    inscription($email_su, $pass_su, $repass_su); 

} elseif (!empty($_POST['submit_login']) && !empty($_POST['email_login']) && !empty($_POST['password_login'])) {
$email = htmlspecialchars($_POST['email_login']);
$password = htmlspecialchars($_POST['password_login']);

 connexion($email, $password);

}
?>

<div class="container">
<h3>Créer votre compte</h3>
    <div class="columns">
        <div class="column">
            <form
                action="<?php $_SERVER['REQUEST_URI']; ?>"
                method="post">
                <div class="field">
                    <label class="label">Veuillez entrer votre adresse E-mail</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="email" placeholder="Type your e-mail" value="" name="email_signup"
                            required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Veuillez entrer votre mot de passe</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" placeholder="Choisissez un mot de passe" value=""
                            name="password1_signup" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Veuillez retaper votre mot de passe</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" placeholder="Veuillez retaper le mot de passe de votre compte" value=""
                            name="password2_signup" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <label class="checkbox">
                            <input type="checkbox" required>
                            J'accepte les <a href="#">termes les conditions</a>
                        </label>
                    </div>
                </div>


                <div class="field is-grouped">
                    <div class="control">
                        <input type="submit" value="S'inscrire" name="submit_signup" class="button is-primary">
                    </div>
                </div>
            </form>
        </div>
<div class="container">
        <h3>Ce connecter</h3>
        <div class="column">
        <div class="columns">
            <form
                action="<?php $_SERVER['REQUEST_URI']; ?>"
                method="post">
                <div class="field">
                    <label class="label">Votre E-mail</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="email" placeholder="Entrez votre E-mail" value="" name="email_login"
                            required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Mot de passe</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" placeholder="Entrez votre mot de passe" value=""
                            name="password_login" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <input type="submit" value="connection" name="submit_login" class="button is-primary">
                    </div>
                </div>
                <a href="#">Mot de passe oublier ?</a>
            </form>
        </div>
    </div> 
</div>
</div>
</div>
<?php
require 'includes/footer.php';