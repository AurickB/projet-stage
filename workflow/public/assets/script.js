"use strict"

/** Gestion de la navbar responsive */

function toggleNav() {
  /**
   * Event au clic d'un élément possédant la classe "menu-toggle".
   * Au premier click on ajout la classe "is-opened".
   * Au deuxième click on enlève la classe "is-opened".
   */
  $('.menu-toggle').click(function () {
    $('.content').toggleClass('is-opened');
  });
  // Fermer le menu responsive au click sur un élément du menu.
  $('ul li a').click(function () {
    $('.menu-toggle:visible').click();
  });
}
toggleNav();

/** Gestion du menu accordéon */

function displayScrollMenu() {
  let acc = document.getElementsByClassName("accordionItemHeading");
  let accItem = document.getElementsByClassName('accordionItem');
  let i;
  // On parcours tous les titres.
  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
      // On crée une variable qui renvoie la valeur du noeud parent.
      let itemClass = this.parentNode.className;
      /**
       * Au click sur le titre d'un élément accordéon,
       * On réduit tout les éléments accordéon.
       */
      for (i = 0; i < accItem.length; i++) {
        accItem[i].className = 'accordionItem close';
        console.log("close")
      }
      // Si au click le noeud parent à pour class "close" alors il récupère la class "open".
      if (itemClass == 'accordionItem close') {
        this.parentNode.className = 'accordionItem open';
        console.log("open")
      }
    });
  }
}
displayScrollMenu();

/** Gestion du scroll vers les liens ciblés */

function scrollTo() {
  // Au clic sur un lien possédant la class "js-scrollTo".
  $('.js-scrollTo').on('click', function () {
    if (location.hostname == this.hostname 
      && this.pathname.replace(/^\//, "") == location.pathname.replace(/^\//, "")){
      // Enregistrement de l'attribut href dans la variable target.
      let target = $(this).attr('href');
      /**
       * On arrete les animation en cours.
       * On déclenche l'animation vers notre ancre target.
       */
      $('html, body').stop().animate({ scrollTop: $(target).offset().top }, 'slow');
      return false;
    }
  });
}
scrollTo();

/** Gestion du bouton permettant le scroll vers le haut de la page */

function topBotton(id) {
  document.addEventListener('DOMContentLoaded', function () {
    window.onscroll = function () {
      document.getElementById(id).className = (window.pageYOffset > 50) ? "visible" : "invisible";
    };
  });
}
topBotton("topBotton");

/** Gestion de la page actualité */

// Création du code html d'après les données récupérées du serveur
function template(data){
  let output ='';
  output += '<section id="actualite">';
  output += '<div class="content-wrapper">';
  output += '<h1 class="page-header">Actualités</h1>';
  output += '<div class="item-list">';
  output += '<ul class="">';
  if (data.length === 0){ // Si la table est vide...
    output += '<p style="height: 163px;">à venir...</p>';
  } else {
    data.forEach( element => { // ...sinon
      output +=  '<li class="">';
      output +=  '<div class="zone-actu">';
      output +=  '<div class="update-actu">';
      output +=  '<div class="date-actus">' + element.created_at + '</div>';
      output +=  '<div><p>Cabinet Les Pyrénnées - Actualites</p>';
      output +=  '</div>';
      output +=  '<div class="titre-actus"><h1>' + element.title + '</h1></div>';
      output +=  '<div class="content-actus"><p>' + excerpt(element.content) + '</p></div>';
      output +=  '<div class="btn-actu"><a href="index.php?page=post&id=' + element.id + '"><p>Lire plus</p></a></div>';
      output +=  '</div>';
      output +=  '</li>';
    });
  }
  output += '</ul>';
  output +='</div>';
  output +='</div>';
  output += '</section>';
  return output;
}

// Création de la pagination et récupération des données sur le serveur
$('#page').pagination({
  dataSource: function(done){
    $.ajax({
      type: 'GET',
      url : 'controller/apiActuController.php',
      dataType : 'json',
      success: function(response){
        done(response);
      },
      error : function(){
        console.log("error");
      }
    })
  },
  // Une fois les données récupérée on écrit le code html via la function template
  callback: function(data, pagination) {
      console.log(data);
      let html = template(data);
      $('#data').html(html);
  }
, pageSize : 3
})

// Fonction qui permet de couper une chaine de caractère au premier espace trouvé en fonction de la taille imposée.
function excerpt(str){
  let limit = 300;
  
  if (str.length <= limit){
    return str;
  }
  let space = ' ';
  let lastSpace = str.indexOf(space, limit);

  return str.substring(0, lastSpace) + ' ...';
}




