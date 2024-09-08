<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h2>S'inscrire</h2>
    <form method="POST" action="signup.php">
        <label>Email :</label>
        <input type="email" name="email" required>
        <br><br>
        <label>Mot de passe :</label>
        <input type="password" name="password" required>
        <br><br>
        <button type="submit">S'inscrire</button>
    </form>

    <?php
    // Connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=simple_auth', 'root', '');

    // Vérifier si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Vérification si l'email existe déjà
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            echo "Cet email est déjà utilisé.";
        } else {
            // Hachage du mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insertion de l'utilisateur dans la base de données
            $stmt = $db->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
            if ($stmt->execute([$email, $hashed_password])) {
                echo "Inscription réussie ! Vous pouvez maintenant vous <a href='login.php'>connecter</a>.";
            } else {
                echo "Erreur lors de l'inscription.";
            }
        }
    }
    ?>
</body>
</html>
