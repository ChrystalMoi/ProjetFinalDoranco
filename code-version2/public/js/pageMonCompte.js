/*
Permet d'afficher les infos du compte en mode readonly
 */
function loadInfosCompte() {
    fetch("/infos-compte")
        .then(response => {
            if(response.status === 200) {
                response.text().then(content => {
                    document.getElementById("form-infos-compte").innerHTML = content;
                    document.getElementById("btn-form-maj-compte").addEventListener("click", loadFormMajCompte);
                    // TODO initialiserInfosCompte();
                });
            }
            else {
                console.error("Erreur inconnue ! code erreur : " + response.status);
            }
        })
        .catch(error => {
            console.error("Une erreur est survenue !\n" + error);
        })
}

/*
Permet d'afficher le formulaire de mise Ã  jour des infos du compte
 */
function loadFormMajCompte() {
    fetch("/form-maj-compte")
        .then(response => {
            if(response.status === 200) {
                response.text().then(content => {
                    document.getElementById("form-infos-compte").innerHTML = content;
                    document.getElementById("btn-infos-compte").addEventListener("click", loadInfosCompte);
                    initialiserFormMajInfosCompte();
                });
            }
            else {
                console.error("Erreur inconnue ! code erreur : " + response.status);
            }
        })
        .catch(error => {
            console.error("Une erreur est survenue !\n" + error);
        })
}


document.getElementById("btn-form-maj-compte").addEventListener("click", loadFormMajCompte)