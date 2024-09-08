// Configuration Firebase (à remplacer par vos propres clés Firebase)
const firebaseConfig = {
    apiKey: "VOTRE_API_KEY",
    authDomain: "VOTRE_AUTH_DOMAIN",
    projectId: "VOTRE_PROJECT_ID",
    storageBucket: "VOTRE_STORAGE_BUCKET",
    messagingSenderId: "VOTRE_MESSAGING_SENDER_ID",
    appId: "VOTRE_APP_ID"
};

// Initialisation Firebase
const app = firebase.initializeApp(firebaseConfig);
const auth = firebase.getAuth();

// Gestion de l'inscription
const signupForm = document.getElementById('signup-form');
signupForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    firebase.createUserWithEmailAndPassword(auth, email, password)
        .then((userCredential) => {
            // Utilisateur inscrit
            alert('Inscription réussie !');
        })
        .catch((error) => {
            console.error("Erreur lors de l'inscription", error);
        });
});

// Gestion de la connexion
const loginForm = document.getElementById('login-form');
loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    firebase.signInWithEmailAndPassword(auth, email, password)
        .then((userCredential) => {
            // Utilisateur connecté
            alert('Connexion réussie !');
        })
        .catch((error) => {
            console.error("Erreur lors de la connexion", error);
        });
});
