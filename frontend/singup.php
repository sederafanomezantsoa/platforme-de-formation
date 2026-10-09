<?php
require_once __DIR__. "/../backend/config/database.php";
require_once __DIR__. "/../backend/controllers/users.controllers.php";
$controller = new UserController($pdo);
if($_SERVER["REQUEST_METHOD"]==="POST"){
	$name = $_POST["name"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$password_v = $_POST["password_v"];
	if(!$controller->addUser($name,$email,$password,$password_v)){
		header("location: /frontend/singup.php");
		exit;
	}

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | LearnHub</title>

    <link rel="stylesheet" href="css/style1.css">
</head>

<body class="login-page">

    <main class="login-container">

        <section class="login-card">

            <a href="/index.php" class="login-logo">
                Learn<span>Hub</span>
            </a>

            <div class="login-header">
                <h1>Créer un compte</h1>
                <p>
                    Rejoignez LearnHub et commencez votre parcours
                    d'apprentissage dès aujourd'hui.
                </p>
            </div>

            <form action="singup.php" method="POST" class="login-form">

                <div class="form-group">
                    <label for="name">Nom complet</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Votre nom complet"
                        autocomplete="name"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="exemple@email.com"
                        autocomplete="email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Créez un mot de passe"
                        autocomplete="new-password"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password_v">Confirmer le mot de passe</label>
                    <input
                        type="password"
                        id="password_v"
                        name="password_v"
                        placeholder="Répétez votre mot de passe"
                        autocomplete="new-password"
                        required
                    >
                </div>

                <button type="submit" class="login-button">
                    Créer mon compte
                    <span aria-hidden="true">→</span>
                </button>

            </form>

            <div class="login-footer">
                <p>Vous avez déjà un compte ?</p>
                <a href="login.php">Se connecter</a>
            </div>

            <a href="/index.php" class="back-home">
                ← Retour à l'accueil
            </a>

        </section>

        <div class="login-description">
            <span class="description-label">
                VOTRE APPRENTISSAGE COMMENCE ICI
            </span>

            <h2>Développez vos compétences, construisez votre avenir.</h2>

            <p>
                Rejoignez notre plateforme de formation, découvrez
                de nouveaux cours et progressez à votre rythme.
            </p>
        </div>

    </main>

</body>
</html>
