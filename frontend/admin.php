<?php
require_once __DIR__ . "/../backend/config/database.php";
require_once __DIR__ . "/../backend/middleware/auth.php";
require_once __DIR__ . "/../backend/controllers/cours.controllers.php";
require_once __DIR__ . "/../backend/controllers/users.controllers.php";

/*
|--------------------------------------------------------------------------
| Protection de la page
|--------------------------------------------------------------------------
*/

if (!requireAdmin()) {
    header("Location: /index.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| Initialisation
|--------------------------------------------------------------------------
*/

$coursController = new CoursController($pdo);
$usersController = new UserController($pdo);

$resultatRecherche = [];
$message = "";
$typeMessage = "";

$recherche = trim($_GET["recherche_students"] ?? "");

/*
|--------------------------------------------------------------------------
| Traitement des formulaires POST
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $action = $_POST["action"] ?? "";

    /*
    | Ajouter un cours
    */

    if ($action === "ajouter_cours") {

        $cours = trim($_POST["cours"] ?? "");
        $module = trim($_POST["module"] ?? "");
        $ordreModule = $_POST["ordre_module"] ?? "";
        $lecon = trim($_POST["lecon"] ?? "");

        if (
            $cours !== ""
            && $module !== ""
            && filter_var($ordreModule, FILTER_VALIDATE_INT) !== false
            && (int) $ordreModule >= 1
            && $lecon !== ""
        ) {
            $coursController->addCours(
                $cours,
                $module,
                (string) $ordreModule,
                $lecon
            );

            $message = "La demande de création du cours a été traitée.";
            $typeMessage = "success";
        } else {
            $message = "Veuillez vérifier les informations du cours.";
            $typeMessage = "error";
        }
    }

    /*
    | Ajouter un administrateur
    */

    elseif ($action === "add_admin") {

        $idUser = $_POST["add-admin"] ?? "";

        if (
            filter_var($idUser, FILTER_VALIDATE_INT) !== false
            && (int) $idUser > 0
        ) {
            $ajout = $usersController->addAdmin((int) $idUser);

            if ($ajout) {
                $message = "Le traitement de la demande d'ajout d'administrateur est terminé.";
                $typeMessage = "success";
            } else {
                $message = "Impossible d'ajouter cet administrateur. Vérifiez l'identifiant et le rôle actuel.";
                $typeMessage = "error";
            }
        } else {
            $message = "Veuillez saisir un identifiant valide.";
            $typeMessage = "error";
        }
    }

    /*
    | Supprimer un utilisateur
    */

    elseif ($action === "supprimer_user") {

        $idUser = $_POST["id_user"] ?? "";

        if (
            filter_var($idUser, FILTER_VALIDATE_INT) !== false
            && (int) $idUser > 0
        ) {
            $usersController->deleteUser((int) $idUser);

            $message = "La demande de suppression a été traitée.";
            $typeMessage = "success";
        } else {
            $message = "Veuillez saisir un identifiant valide.";
            $typeMessage = "error";
        }
    }
}

/*
|--------------------------------------------------------------------------
| Recherche d'utilisateurs
|--------------------------------------------------------------------------
*/

if ($recherche !== "") {
    $resultatRecherche = $usersController->findUser($recherche);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Administration | LearnHub</title>

    <link rel="stylesheet" href="css/style1.css">
</head>

<body class="admin-page">

    <!-- Barre latérale -->

    <aside class="admin-sidebar">

        <a href="/index.php" class="admin-logo">
            Learn<span>Hub</span>
        </a>

        <p class="sidebar-label">
            ESPACE ADMINISTRATION
        </p>

        <nav class="admin-nav">

            <a href="#dashboard" class="nav-item active">
                <span>▦</span>
                Tableau de bord
            </a>

            <a href="#ajouter-cours" class="nav-item">
                <span>＋</span>
                Ajouter un cours
            </a>

            <a href="#rechercher-users" class="nav-item">
                <span>⌕</span>
                Utilisateurs
            </a>

            <a href="#ajouter-admin" class="nav-item">
                <span>♙</span>
                Ajouter un administrateur
            </a>

            <a href="#supprimer-user" class="nav-item">
                <span>♧</span>
                Gestion des comptes
            </a>

        </nav>

        <div class="sidebar-bottom">
            <a href="/index.php">
                ← Retour au site
            </a>
        </div>

    </aside>

    <!-- Contenu principal -->

    <main class="admin-main">

        <!-- En-tête -->

        <header class="admin-topbar" id="dashboard">

            <div>

                <p class="admin-eyebrow">
                    ESPACE DE GESTION
                </p>

                <h1>Tableau de bord</h1>

                <p class="admin-subtitle">
                    Gérez vos cours et les utilisateurs de LearnHub.
                </p>

            </div>

            <div class="admin-avatar" title="Administrateur">
                A
            </div>

        </header>

        <!-- Messages -->

        <?php if ($message !== ""): ?>

            <div
                class="admin-notice <?= htmlspecialchars($typeMessage, ENT_QUOTES, 'UTF-8') ?>"
                role="status"
            >
                <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
            </div>

        <?php endif; ?>

        <!-- Bienvenue -->

        <section class="admin-welcome">

            <div>

                <h2>
                    Bienvenue dans votre espace admin 👋
                </h2>

                <p>
                    Gérez les contenus pédagogiques et les comptes
                    de votre plateforme depuis cet espace.
                </p>

            </div>

        </section>

        <!-- Ajouter un cours -->

        <section class="admin-section" id="ajouter-cours">

            <div class="section-heading">

                <div>

                    <span class="section-tag">
                        CONTENU PÉDAGOGIQUE
                    </span>

                    <h2>Ajouter un cours</h2>

                    <p>
                        Créez un cours, son module et sa première leçon.
                    </p>

                </div>

            </div>

            <div class="admin-card">

                <form
                    action="admin.php#ajouter-cours"
                    method="POST"
                    class="admin-form"
                >

                    <div class="admin-form-grid">

                        <div class="admin-field">

                            <label for="cours">
                                Titre du cours
                            </label>

                            <input
                                type="text"
                                id="cours"
                                name="cours"
                                placeholder="Ex. Introduction à Python"
                                required
                            >

                        </div>

                        <div class="admin-field">

                            <label for="module">
                                Titre du module
                            </label>

                            <input
                                type="text"
                                id="module"
                                name="module"
                                placeholder="Ex. Les bases du langage"
                                required
                            >

                        </div>

                        <div class="admin-field">

                            <label for="ordre_module">
                                Ordre du module
                            </label>

                            <input
                                type="number"
                                id="ordre_module"
                                name="ordre_module"
                                min="1"
                                step="1"
                                placeholder="Ex. 1"
                                required
                            >

                        </div>

                        <div class="admin-field">

                            <label for="lecon">
                                Titre de la leçon
                            </label>

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

        <!-- Rechercher des utilisateurs -->

        <section
            class="admin-section"
            id="rechercher-users"
        >

            <div class="section-heading">

                <div>

                    <span class="section-tag">
                        GESTION DES COMPTES
                    </span>

                    <h2>Rechercher des utilisateurs</h2>

                    <p>
                        Recherchez un utilisateur par son nom.
                    </p>

                </div>

            </div>

            <div class="admin-card">

                <form
                    action="admin.php#rechercher-users"
                    method="GET"
                    class="search-form"
                >

                    <div class="admin-field search-field">

                        <label for="recherche_students">
                            Nom de l'utilisateur
                        </label>

                        <input
                            type="search"
                            id="recherche_students"
                            name="recherche_students"
                            placeholder="Rechercher un nom..."
                            value="<?= htmlspecialchars(
                                $recherche,
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>"
                        >

                    </div>

                    <button
                        type="submit"
                        class="admin-button primary-button"
                    >
                        Rechercher
                    </button>

                </form>

                <?php if ($recherche !== ""): ?>

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
                                                <?= htmlspecialchars(
                                                    (string) $user["id_user"],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars(
                                                    $user["name"],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars(
                                                    $user["email"],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </td>

                                            <td>
                                                <span class="role-badge">
                                                    <?= htmlspecialchars(
                                                        $user["role"],
                                                        ENT_QUOTES,
                                                        'UTF-8'
                                                    ) ?>
                                                </span>
                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>

                            </table>

                        </div>

                    <?php else: ?>

                        <p class="admin-empty">
                            Aucun utilisateur trouvé pour cette recherche.
                        </p>

                    <?php endif; ?>

                <?php endif; ?>

            </div>

        </section>

        <!-- Ajouter un administrateur -->

        <section
            class="admin-section"
            id="ajouter-admin"
        >

            <div class="section-heading">

                <div>

                    <span class="section-tag">
                        GESTION DES ACCÈS
                    </span>

                    <h2>Ajouter un administrateur</h2>

                    <p>
                        Attribuez les droits d'administration
                        à un utilisateur existant.
                    </p>

                </div>

            </div>

            <div class="admin-card add-admin-card">

                <div class="add-admin-icon">
                    ♙
                </div>

                <div class="add-admin-content">

                    <h3>Promouvoir un utilisateur</h3>

                    <p>
                        Saisissez l'identifiant de l'utilisateur
                        qui doit obtenir les privilèges
                        d'administrateur.
                    </p>

                    <form
                        action="admin.php#ajouter-admin"
                        method="POST"
                        class="add-admin-form"
                        onsubmit="return confirm('Voulez-vous vraiment attribuer les droits administrateur à cet utilisateur ?');"
                    >

                        <div class="admin-field">

                            <label for="add-admin">
                                ID de l'utilisateur
                            </label>

                            <input
                                type="number"
                                id="add-admin"
                                name="add-admin"
                                min="1"
                                step="1"
                                placeholder="Ex. 12"
                                required
                            >

                            <small>
                                Utilisez l'identifiant affiché
                                dans la liste des utilisateurs.
                            </small>

                        </div>

                        <button
                            type="submit"
                            name="action"
                            value="add_admin"
                            class="admin-button promote-button"
                        >
                            <span>＋</span>
                            Ajouter comme administrateur
                        </button>

                    </form>

                </div>

            </div>

        </section>

        <!-- Supprimer un utilisateur -->

        <section
            class="admin-section"
            id="supprimer-user"
        >

            <div class="section-heading">

                <div>

                    <span class="section-tag danger-tag">
                        ACTION SENSIBLE
                    </span>

                    <h2>Supprimer un utilisateur</h2>

                    <p>
                        Cette action peut supprimer définitivement
                        un compte de la plateforme.
                    </p>

                </div>

            </div>

            <div class="admin-card delete-card">

                <form
                    action="admin.php#supprimer-user"
                    method="POST"
                    class="delete-form"
                    onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ? Cette action peut être irréversible.');"
                >

                    <div class="admin-field">

                        <label for="delete-id-user">
                            ID de l'utilisateur
                        </label>

                        <input
                            type="number"
                            id="delete-id-user"
                            name="id_user"
                            min="1"
                            step="1"
                            placeholder="Ex. 12"
                            required
                        >

                    </div>

                    <button
                        type="submit"
                        name="action"
                        value="supprimer_user"
                        class="admin-button danger-button"
                    >
                        Supprimer le compte
                    </button>

                </form>

            </div>

        </section>

        <!-- Pied de page -->

        <footer class="admin-footer">
            LearnHub · Administration
        </footer>

    </main>

</body>

</html>
