// Fonction de rechargement des commentaires 
function reloadCommentaires() {
    fetch("/commentaires", {
            method: 'GET'
        })
        .then(response => {
            if (response.status === 200) {
                response.text().then(content => {
                    document.getElementById("accordion-commentaires").innerHTML = content;
                })
            } else {
                console.log("Une erreur inconnue est survenue, statut erreur : " + response.status);
            }
        })
}

// Fonction de suppression des commentaire pour les utilisateurs uniquement
function supprimerCommentaire(id) {
    fetch("/commentaires/supprimer/" + id, {
            method: 'DELETE'
        })
        .then(response => {
            if (response.status === 204) {
                reloadCommentaires();
            } else {
                console.log("Une erreur inconnue est survenue, statut erreur : " + response.status);
            }
        })
}

// Fonction de modification de commentaire par un formulaire pour les utilisateurs uniquement
function formMajCommentaire(id) {
    fetch("/commentaires/maj/" + id)
        .then(response => {
            if (response.status === 200) {
                response.text().then(content => {
                    document.getElementById("commentaire-" + id).innerHTML = content;

                    ouvrirAccordionItem(id);

                    adjustTextareaHeight(document.getElementById("commentaire-textarea-" + id));
                })
            } else {
                response.text().then(jsonData => {
                    let error = JSON.parse(jsonData);
                    if (error.message) afficherErreur(error.message);
                    else afficherErreur("Une erreur inconnue est survenue !");
                })
            }
        })
        .catch(error => {
            console.log("Impossible de modifier le commentaire !\n" + error);
        })
}

function ouvrirAccordionItem(id) {
    let accordionButton = document.getElementById("accordion-button-commentaire-" + id);
    accordionButton.classList.remove("collapsed");
    accordionButton.setAttribute("aria-expanded", "true");

    let collapseDiv = document.getElementById("collapse-" + id);
    collapseDiv.classList.add("show");
}

function majCommentaire(id) {
    fetch("/commentaires/maj/" + id, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: 'POST',
            body: JSON.stringify({
                commentaire: document.getElementById("commentaire-textarea-" + id).value
            })
        })
        .then(response => {
            if (response.status === 204) {
                getCommentaire(id);
            } else {
                response.text().then(jsonData => {
                    let error = JSON.parse(jsonData);
                    if (error.message) {
                        let errorMessageDiv = document.getElementById("error-message-" + id);
                        console.log("error message : " + errorMessageDiv);
                        errorMessageDiv.innerText = error.message;
                        errorMessageDiv.style.removeProperty("display");
                    }

                    else console.log("Une erreur inconnue est survenue !");
                })
                console.log(response.status);
            }
        })
        .catch(error => {
            console.log("Impossible de modifier le commentaire !\n" + error);
        })
}

function getCommentaire(id) {
    fetch("/commentaires/" + id)
        .then(response => {
            if (response.status === 200) {
                response.text().then(content => {
                    document.getElementById("commentaire-" + id).innerHTML = content;
                    ouvrirAccordionItem(id);
                });
            }
            // else {
            //     response.text().then(jsonData => {
            //         let error = JSON.parse(jsonData);
            //         if(error.message) afficherErreur(error.message);
            //         else afficherErreur("Une erreur inconnue est survenue !");
            //     })
            // }
        })
}