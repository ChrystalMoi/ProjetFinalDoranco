console.log("Pop up connexion js chargé");
let formulaireCompte = document.getElementById("formulaire-compte");
initialiserFormConnexion();
function loadConnexionForm() {
    fetch("/form-connexion")
        .then(response => {
            response.text().then(content => {
                console.log(content);
                formulaireCompte.innerHTML = content;
                document.getElementById("btn-form-creer-compte").addEventListener("click", loadCreerCompteForm);
                initialiserFormConnexion();
            })
        })
        .catch((error => {
            console.log(error);
        }))
}

function loadCreerCompteForm() {
    fetch("/form-creer-compte")
        .then(response => {
            response.text().then(content => {
                console.log(content)
                formulaireCompte.innerHTML = content;
                document.getElementById("btn-form-connexion").addEventListener("click", loadConnexionForm);
                initialiserFormCreerCompte();
            })
        })
}
document.getElementById("btn-form-creer-compte").addEventListener("click", loadCreerCompteForm);