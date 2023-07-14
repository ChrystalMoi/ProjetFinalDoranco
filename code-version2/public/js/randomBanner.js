"use strict";

document.addEventListener('DOMContentLoaded', function () {
    // Liste des noms d'images possibles
    let images = ['Bannière1.jpg', 'Bannière2.jpg', 'Bannière3.jpg', 'Bannière4.jpg', 'Bannière5.jpg', 'Bannière6.jpg', 'Bannière7.jpg', 'Bannière8.jpg', 'Bannière9.jpg'];

    // Génération d'un numéro aléatoire
    let randomNumber = Math.floor(Math.random() * images.length);

    // Concaténation du nom de l'image avec le numéro aléatoire
    let imagePath = '/image/banniere/' + images[randomNumber];

    // Attribution de l'image aléatoire à la classe CSS .banner-image
    document.querySelector('.banner-image').style.backgroundImage = 'url(' + imagePath + ')';
});