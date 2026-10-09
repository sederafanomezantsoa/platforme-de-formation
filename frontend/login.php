<?php
require_once __DIR__. "/../backend/config/database.php";
require_once __DIR__. "/../backend/controllers/users.controllers.php";
require_once __DIR__. '/../backend/middleware/auth.php';

$controller = new UserController($pdo);
if($_SERVER["REQUEST_METHOD"]==="POST"){
	$email = trim($_POST["email"] ?? "");
	$password = $_POST["password"];
	$user = $controller->login($email,$password);

	if($user === null){
        	echo "login incorrect";
        	exit;
	}
	else{	       
		$_SESSION['id_user'] = $user["id_user"];
        	$_SESSION['email'] = $user["email"];
        	$_SESSION['role'] = $user["role"];
		if(requireAdmin()){
			header("location: /frontend/admin.php");
			exit;
		}
		else{
			header('location: /index.php');
			exit;
		   }	
	}	
}


//echo "email : ".$_SESSION["email"] . "<br>" . "Role : " . $_SESSION["role"];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | LearnHub</title>

    <link rel="stylesheet" href="css/style1.css">
</head>
<body class="login-page">

    <main class="login-container">

        <section class="login-card">

            <a href="/index.php" class="login-logo">
                Learn<span>Hub</span>
            </a>

            <div class="login-header">
                <h1>Bon retour !</h1>
                <p>Connectez-vous pour continuer votre apprentissage.</p>
            </div>

            <form action="login.php" method="POST" class="login-form">

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
                        placeholder="Entrez votre mot de passe"
                        autocomplete="current-password"
                        required
                    >
                </div>

                <button type="submit" class="login-button">
                    Se connecter
                    <span aria-hidden="true">→</span>
                </button>

            </form>

            <div class="login-footer">
                <p>Vous n'avez pas encore de compte ?</p>
                <a href="singup.php">Créer un compte</a>
            </div>

            <a href="/index.php" class="back-home">
                ← Retour à l'accueil
            </a>

        </section>

        <div class="login-description">
            <span class="description-label">APPRENEZ. PROGRESSEZ. RÉUSSISSEZ.</span>
            <h2>Votre avenir commence par un apprentissage.</h2>
            <p>
                Accédez à vos cours, développez vos compétences
                et avancez vers vos objectifs avec LearnHub.
            </p>
        </div>

    </main>

</body>
</html>
