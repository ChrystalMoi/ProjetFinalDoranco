function initialiserFormCreerCompte() {
    console.log("Initialisation du formulaire de création de compte");

    let emailInput = document.getElementById("email");
    let nomInput = document.getElementById("nom");
    let prenomInput = document.getElementById("prenom");
    let pwdInput = document.getElementById("pwd");
    let pwdConfirmationInput = document.getElementById("pwd2");

    /*  On ajoute un listener au bouton de creation du compte pour vérifier que les champs sont valides
        et si c'est le cas envoyer la demande de création du compte au serveur
        En cas de succès, on redirige vers la page de connexion
        En cas d'échec, on affiche le message d'erreur renvoyé par le serveur */
    document.getElementById("btn-creer-compte").addEventListener("click", (event) => {
        console.log("on a cliqué !");
        event.preventDefault();

        if(isEmailValide() && isPwdValide() && arePwdsIdentiques()){   // on vérifie que l'email et le mot de passe sont valides
            emailInput.classList.remove("is-invalid");
            pwdInput.classList.remove("is-invalid");
            pwdConfirmationInput.classList.remove("is-invalid");
            masquerErreur();
            fetch("/creer-compte", {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                method: 'POST',
                body: JSON.stringify({
                    email: emailInput.value,
                    nom: nomInput.value,
                    prenom: prenomInput.value,
                    password: pwdInput.value
                })
            })
                .then(response => {
                    console.log(response.status);
                    if(response.status === 201) {
                        console.log("compte créé !")
                        window.location.reload();
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
    pwdConfirmationInput.addEventListener("change", arePwdsIdentiques);
}