<?php
require_once __DIR__. "/../backend/config/database.php";
require_once __DIR__ ."/../backend/middleware/auth.php";
require_once __DIR__. "/../backend/controllers/cours.controllers.php";
require_once __DIR__. "/../backend/controllers/users.controllers.php";
//require_once __DIR__. "/../backend/model/cours.php";

requireAdmin();
$coursController = new CoursController($pdo);
$usersController = new UserController($pdo);
$resultatRecherche=[];
if($_SERVER["REQUEST_METHOD"]==="POST"){
	$postAction = $_POST["action"] ?? "";
	if($postAction==="ajouter_cours"){
		$cours = $_POST["cours"];
		$mod_title = $_POST["module"];
		$mod_ordre = $_POST["ordre_module"];
		$lec_title = $_POST["lecon"];

		$coursController->addCours($cours,$mod_title,$mod_ordre,$lec_title);
	}
	else if($postAction==="supprimer_user"){
        	$students = $_GET["recherche_students"] ?? "";
        	if ($students !== "") {
                	$resultatRecherche = $usersController->findUser($students);
		}
        }
}
if($_SERVER["REQUEST_METHOD"]==="GET"){
        $students = $_GET["recherche_students"] ?? "";
	if ($students !== "") {
        	$resultatRecherche = $usersController->findUser($students);
    	}
}
if($_SERVER["REQUEST_METHOD"]==="POST"){
        $user = $_POST['id_user'];
        $usersController->deleteUser($user);
}



//echo "email : ".$_SESSION["email"] . "<br>" . "Role : " . $_SESSION["role"];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration | LearnHub</title>

    <link rel="stylesheet" href="css/style1.css">
</head>

<body class="admin-page">

    <aside class="admin-sidebar">
        <a href="/index.php" class="admin-logo">
            Learn<span>Hub</span>
        </a>

        <p class="sidebar-label">ESPACE ADMINISTRATION</p>

        <nav class="admin-nav">
            <a href="#dashboard" class="nav-item active">
                <span>▦</span> Tableau de bord
            </a>

            <a href="#ajouter-cours" class="nav-item">
                <span>＋</span> Ajouter un cours
            </a>

            <a href="#rechercher-users" class="nav-item">
                <span>⌕</span> Utilisateurs
            </a>

            <a href="#supprimer-user" class="nav-item">
                <span>♧</span> Gestion des comptes
            </a>
        </nav>

        <div class="sidebar-bottom">
            <a href="/index.php">← Retour au site</a>
        </div>
    </aside>

    <main class="admin-main">

        <header class="admin-topbar" id="dashboard">
            <div>
                <p class="admin-eyebrow">ESPACE DE GESTION</p>
                <h1>Tableau de bord</h1>
                <p class="admin-subtitle">
                    Gérez vos cours et les utilisateurs de LearnHub.
                </p>
            </div>

            <div class="admin-avatar" title="Administrateur">A</div>
        </header>

        <section class="admin-welcome">
            <div>
                <h2>Bienvenue dans votre espace admin 👋</h2>
                <p>
                    Gérez les contenus pédagogiques et les comptes
                    de votre plateforme depuis cet espace.
                </p>
            </div>
        </section>

        <section class="admin-section" id="ajouter-cours">
            <div class="section-heading">
                <div>
                    <span class="section-tag">CONTENU PÉDAGOGIQUE</span>
                    <h2>Ajouter un cours</h2>
                    <p>Créez un cours, son module et sa première leçon.</p>
                </div>
            </div>

            <div class="admin-card">
                <form action="admin.php" method="POST" class="admin-form">

                    <div class="admin-form-grid">

                        <div class="admin-field">
                            <label for="cours">Titre du cours</label>
                            <input
                                type="text"
                                id="cours"
                                name="cours"
                                placeholder="Ex. Introduction à Python"
                                required
                            >
                        </div>

                        <div class="admin-field">
                            <label for="module">Titre du module</label>
                            <input
                                type="text"
                                id="module"
                                name="module"
                                placeholder="Ex. Les bases du langage"
                                required
                            >
                        </div>

                        <div class="admin-field">
                            <label for="ordre_module">Ordre du module</label>
                            <input
                                type="number"
                                id="ordre_module"
                                name="ordre_module"
                                min="1"
                                placeholder="Ex. 1"
                                required
                            >
                        </div>

                        <div class="admin-field">
                            <label for="lecon">Titre de la leçon</label>
                            <input
                                type="text"
                                id="lecon"
                                name="lecon"
                                placeholder="Ex. Variables et types"
                                required
                            >
                        </div>

                    </div>

                    <div class="admin-form-actions">
                        <button
                            type="submit"
                            name="action"
                            value="ajouter_cours"
                            class="admin-button primary-button"
                        >
                            + Créer le cours
                        </button>
                    </div>

                </form>
            </div>
        </section>

        <section class="admin-section" id="rechercher-users">
            <div class="section-heading">
                <div>
                    <span class="section-tag">GESTION DES COMPTES</span>
                    <h2>Rechercher des utilisateurs</h2>
                    <p>Recherchez un utilisateur par son nom.</p>
                </div>
            </div>

            <div class="admin-card">
                <form action="admin.php" method="GET" class="search-form">

                    <div class="admin-field search-field">
                        <label for="recherche_students">
                            Nom de l'utilisateur
                        </label>

                        <input
                            type="search"
                            id="recherche_students"
                            name="recherche_students"
                            placeholder="Rechercher un nom..."
                            value="<?= htmlspecialchars($_GET['recherche_students'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        >
                    </div>

                    <button type="submit" class="admin-button primary-button">
                        Rechercher
                    </button>
                </form>

                <?php if (!empty($resultatRecherche)): ?>

                    <div class="admin-table-wrapper">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>E-mail</th>
                                    <th>Rôle</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($resultatRecherche as $user): ?>
                                    <tr>
                                        <td>
                                            <?= htmlspecialchars((string)$user["id_user"]) ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($user["name"]) ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($user["email"]) ?>
                                        </td>
                                        <td>
                                            <span class="role-badge">
                                                <?= htmlspecialchars($user["role"]) ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                <?php elseif (isset($_GET["recherche_students"])): ?>

                    <p class="admin-empty">
                        Aucun utilisateur trouvé pour cette recherche.
                    </p>

                <?php endif; ?>
            </div>
        </section>

        <section class="admin-section" id="supprimer-user">
            <div class="section-heading">
                <div>
                    <span class="section-tag danger-tag">ACTION SENSIBLE</span>
                    <h2>Supprimer un utilisateur</h2>
                    <p>
                        Cette action peut supprimer définitivement
                        un compte de la plateforme.
                    </p>
                </div>
            </div>

            <div class="admin-card delete-card">
                <form
                    action="admin.php"
                    method="POST"
                    class="delete-form"
                    onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');"
                >
                    <div class="admin-field">
                        <label for="id_user">ID de l'utilisateur</label>
                        <input
                            type="number"
                            id="id_user"
                            name="id_user"
                            min="1"
                            placeholder="Ex. 12"
                            required
                        >
                    </div>

                    <button
                        type="submit"
                        name="supprimer_user"
                        value="1"
                        class="admin-button danger-button"
                    >
                        Supprimer le compte
                    </button>
                </form>
            </div>
        </section>

        <footer class="admin-footer">
            LearnHub · Administration
        </footer>

    </main>

</body>
</html>


