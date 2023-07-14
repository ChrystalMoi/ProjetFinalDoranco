// Sélectionnez tous les textarea avec la classe "autoresize"
const textareas = document.querySelectorAll('.autoresize');

// Fonction pour ajuster la hauteur du textarea
function adjustTextareaHeight(textarea) {
    console.log("Dans adjustTextareaHeight")
    textarea.style.height = 'auto'; // Réinitialiser la hauteur du textarea
    textarea.style.height = textarea.scrollHeight + 'px'; // Ajuster la hauteur en fonction du contenu
}

// Appliquer l'ajustement de la hauteur pour chaque textarea lors de l'événement input
textareas.forEach(textarea => {
    console.log('forEach textarea');
    textarea.addEventListener('input', () => {
        adjustTextareaHeight(textarea);
    });
});

// Ajuster la hauteur initiale pour chaque textarea au chargement de la page
textareas.forEach(textarea => {
    adjustTextareaHeight(textarea);
});