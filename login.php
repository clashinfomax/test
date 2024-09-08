<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h2>Se connecter</h2>
    <form method="POST" action="login.php">
        <label>Email :</label>
        <input type="email" name="email" required>
        <br><br>
        <label>Mot de passe :</label>
        <input type="password" name="password" required>
        <br><br>
        <button type="submit">Se connecter</button>
    </form>

    <?php
    // Connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=simple_auth', 'root', '');

    // Vérifier si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Récupérer l'utilisateur depuis la base de données
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            echo "Connexion réussie ! Bienvenue, " . $user['email'];
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    }
    ?>
</body>
</html>
