// console.log("form connexion js chargé");

function initialiserFormConnexion() {
    // console.log("Initialisation du formulaire de connexion");
    let emailInput = document.getElementById("email");
    let pwdInput = document.getElementById("pwd");

    /* On ajoute un listener au bouton d'authentification pour vérifier que les champs requis sont bien remplis
        et si c'est le cas envoyer la demande d'authentification au serveur
        En cas de succès, on redirige vers la page d'accueil
        En cas d'échec, on affiche le message d'erreur renvoyé par le serveur*/
    document.getElementById("btn-authent").addEventListener("click", (event) => {
        event.preventDefault();
        // console.log("dans la clic de btn-authent");

        if(isEmailValide() && isPwdValide()){   // on vérifie que l'email et le mot de passe sont valides
            emailInput.classList.remove("is-invalid");
            pwdInput.classList.remove("is-invalid");
            masquerErreur();

            fetch("/authent", {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                method: 'POST',
                body: JSON.stringify({
                    email: emailInput.value,
                    password: pwdInput.value
                })
            })
                .then(response => {
                    console.log("affichage response.status : " + response.status);
                    if(response.status === 200) {
                        window.location.href = "/";
                    }
                    else {
                        response.text().then(data => {
                            let error = JSON.parse(data);
                            if(error.message) afficherErreur(error.message);
                            else afficherErreur("Une erreur inconnue est survenue !")
                        })
                    }
                })
        }
    })

    emailInput.addEventListener("change", isEmailValide);
    pwdInput.addEventListener("change", isPwdValide);
}