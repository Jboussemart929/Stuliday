<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="index.php">
            <img src="images/stuliday-logo-dark.png" width=50 height=50>
        </a>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
            data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="index.php">
                Accueil
            </a>

            <a class="navbar-item">
                Annonces
            </a>
        </div>

        <div class="navbar-end">
            <?php
            if (!empty($_SESSION)) {
                ?>
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    <?php echo $_SESSION['email']; ?>
                </a>

                <div class="navbar-dropdown">
                    <a class="navbar-item">
                        Profil
                    </a>
                    <a class="navbar-item">
                        Créer une nouvelle annonce
                    </a>
                    <hr class="navbar-divider">
                    <a class="navbar-item" href="?logout">
                        Déconnection
                    </a>
                </div>
            </div>
            <?php
            } else {
                ?>
            <div class=" navbar-item">
                <div class="buttons">
                    <a class="button is-primary" href="signin.php">
                        <strong>Se connecter</strong>
                    </a>
                </div>
            </div>
            <?php
            }
        ?>
        </div>
    </div>
</nav>