<?php
session_start();
require_once __DIR__ . "/backend/config/database.php";
require_once __DIR__ . "/backend/controllers/users.controllers.php";
//equire_once __DIR__ . "/frontend/login.php";
$userController = new UserController($pdo);
// if(!isset($_SESSION['id_user'])){
// 	header("location: /frontend/login.php");
// 	exit;
// }
$details = $userController->getDetailsUser($_SESSION["id_user"]);
//header('Content-Type: application/json');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="frontend/css/style.css">
    <title>LearnHub | Plateforme de formation</title>
</head>
<body>

    <header class="header">
        <a href="index.html" class="logo">Learn<span>Hub</span></a>

        <nav class="navbar">
            <a href="#accueil">Accueil</a>
            <a href="#cours">Cours</a>
            <a href="#apropos">À propos</a>
            <a href="#btn-profile">Mon profile</a>
        </nav>

        <div class="header-actions">
            <a href="frontend/login.php" class="btn btn-outline">Connexion</a>
            <a href="frontend/singup.php" class="btn btn-primary">S'inscrire</a>
        </div>
    </header>

    <main>
        <section class="hero" id="accueil">
            <div class="hero-content">
                <span class="badge">APPRENEZ À VOTRE RYTHME</span>

                <h1>Développez vos compétences pour <span>réussir demain.</span></h1>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Découvrez de nouvelles connaissances et progressez grâce
                    à des formations adaptées à vos objectifs.
                </p>

                <div class="hero-actions">
                    <a href="#cours" class="btn btn-primary">
                        Découvrir les cours →
                    </a>

                    <a href="#apropos" class="btn btn-outline">
                        En savoir plus
                    </a>
                </div>

                <div class="stats">
                    <div>
                        <strong>+20</strong>
                        <span>Formations</span>
                    </div>

                    <div>
                        <strong>+500</strong>
                        <span>Étudiants</span>
                    </div>

                    <div>
                        <strong>95%</strong>
                        <span>Satisfaction</span>
                    </div>
                </div>
            </div>

            <div class="hero-card">
                <div class="illustration">📚</div>
                <h2>Votre avenir commence ici</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>

                <div class="progress-label">
                    <span>Progression du cours</span>
                    <strong>75%</strong>
                </div>

                <div class="progress-bar">
                    <div></div>
                </div>
            </div>
        </section>

        <section class="courses section" id="cours">
            <div class="section-heading">
                <span class="badge">NOS FORMATIONS</span>
                <h2>Explorez nos cours</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Choisissez un domaine et commencez votre apprentissage.
                </p>
            </div>

            <div class="course-grid">
                <article class="course-card">
                    <div class="course-icon">💻</div>
                    <span class="category">Programmation</span>
                    <h3>Développement web</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Apprenez à créer des applications web.
                    </p>
                    <a href="frontend/login.php">Découvrir le cours →</a>
                </article>

                <article class="course-card">
                    <div class="course-icon">📊</div>
                    <span class="category">Data</span>
                    <h3>Analyse de données</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Explorez les données et interprétez les résultats.
                    </p>
                    <a href="frontend/login.php">Découvrir le cours →</a>
                </article>

                <article class="course-card">
                    <div class="course-icon">🤖</div>
                    <span class="category">Intelligence artificielle</span>
                    <h3>Introduction à l'IA</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Découvrez les bases de l'intelligence artificielle.
                    </p>
                    <a href="frontend/login.php">Découvrir le cours →</a>
                </article>
            </div>
        </section>

        <section class="about section" id="apropos">
            <div>
                <span class="badge">À PROPOS</span>
                <h2>Apprenez autrement</h2>
            </div>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Notre plateforme vous accompagne dans votre parcours,
                avec des contenus accessibles et une progression structurée.
            </p>
        </section>

        <section class="contact section" id="contact">
            <h2>Prêt à commencer ?</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Rejoignez notre communauté d'apprenants.
            </p>

            <a href="frontend/singup.php" class="btn btn-primary">
                Commencer maintenant →
            </a>
        </section>
    </main>

    <!-- <button type="button" id="btn-profile">Mon Profile</button> -->
    <!-- <form action="/frontend/logout.php" onsubmit="return confirm('Voulez-vous vraiment deconnecter?')" class="deconnexion">
        <button type="submit">Déconnexion</button>
    </form>     -->

    <!-- <form action="index.php">
        <input type="text" value=<?//php //$_SESSION["id_user"]?> name >
    </form> -->
    <!-- <div class="hidden" id="profile-0">
        <h2>Votre profile</h2>
        <p>
            id :  <?//= //htmlspecialchars($_SESSION["id_user"])?> <br>
            nom : <?//=//htmlspecialchars($details[1]["name"])?> <br>
            email : <?//= //htmlspecialchars($_SESSION["email"])?> <br>
            role : <?//= //htmlspecialchars($_SESSION["role"])?> <br>
        </p>
        <p>suivre le cours :</p>
        <P>
            <?//php foreach ($details as $dt): ?>
                <?//=//htmlspecialchars($dt["cTitle"])?><br>
            <?//php endforeach; ?>
        </p>
    </div> -->
    <footer class="footer">
        <a href="index.html" class="logo">Learn<span>Hub</span></a>
        <p>© 2026 LearnHub — Tous droits réservés.</p>
    </footer>

<script src="frontend/js/script.js"></script>
</body>
</html>
