/*****************************************************************************************************/
/**************** Fichier de fonctions utilitaires pour la validation des formulaires ****************/
/*****************************************************************************************************/

/*On affiche l'erreur sur le formulaire*/
function afficherErreur(errorMessage) {
    let errorMessageDiv = document.getElementById("errorMessage");
    console.log("error message : " + errorMessageDiv);
    errorMessageDiv.innerText = errorMessage;
    errorMessageDiv.style.removeProperty("display");
}

/*On cache l'erreur sur le formulaire*/
function masquerErreur() {
    let errorMessageDiv = document.getElementById("errorMessage");
    errorMessageDiv.style.display = "none";
    console.log("on a masquer l'erreur")
}

/* On vérifie la validité du mot de passe saisi.
Si le mdp est invalide, on marque le champ Pwd comme invalide et on affiche un message d'erreur */
function isPwdValide() {
    // console.log("vérification du pwd")
    let pwdInput = document.getElementById("pwd");
    
    // On vérifie que le mot de passe est saisi et conforme
    if (pwdInput.value == "" || pwdInput.value.length < 8) {  
        pwdInput.classList.add("is-invalid");
        afficherErreur("Le mot de passe est obligatoire et doit faire au moins 8 caractères");
        // console.log("Mot de passe invalide");
        return false;
    }
    else {
        pwdInput.classList.remove("is-invalid");
        masquerErreur();
        // console.log("Mot de passe valide");
        return true;
    }
}

/* On vérifie la validité du mot de passe saisi.
Si le mdp est invalide, on marque le champ Pwd comme invalide et on affiche un message d'erreur */
function arePwdsIdentiques() {
    // console.log("vérification des deux pwd")
    let pwdInput = document.getElementById("pwd");
    let pwdConfirmationInput = document.getElementById("pwd2");
    
    // On vérifie que les deux mdp sont identiques
    if (pwdInput.value != pwdConfirmationInput.value) {
        pwdInput.classList.add("is-invalid");
        pwdConfirmationInput.classList.add("is-invalid");
        afficherErreur("Les mots de passes ne sont pas identiques !");
        // console.log("Mot de passes non identiques");
        return false;
    }
    else {
        pwdConfirmationInput.classList.remove("is-invalid");
        pwdInput.classList.remove("is-invalid");
        masquerErreur();
        // console.log("Mots de passes valide");
        return true;
    }
}

/*On vérifie la validité de l'email saisi.
Si l'email est invalide, on marque le champ email comme invalide et on affiche un message d'erreur*/
function isEmailValide() {
    let emailInput = document.getElementById("email");
    const emailRegExp = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(emailInput.value == "") {    // On vérifie que l'email est saisi
        emailInput.classList.add("is-invalid");
        afficherErreur("L'email est obligatoire !");
        // console.log("Email obligatoire");
        return false;
    }

     // On vérifie que l'email saisi est conforme
    else if(!emailRegExp.test(emailInput.value)){  
        emailInput.classList.add("is-invalid");
        afficherErreur("L'email saisi n'est pas conforme !");
        // console.log("Email non conforme");
        return false;
    }
    
    else {
        emailInput.classList.remove("is-invalid");
        masquerErreur();
        // console.log("Email valide");
        return true;
    }
}